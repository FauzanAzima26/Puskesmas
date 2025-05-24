<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Pasien_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('debug');

    }
    public function login()
    {
        $this->load->view('auth/login'); // pastikan file view ini juga ada
    }

    public function process_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Ambil data user berdasarkan email
        $user = $this->User_model->get_user_by_email($email);

        // Cek apakah user ditemukan, password cocok, dan email sudah diverifikasi
        if ($user && password_verify($password, $user->password)) {
            if ($user->is_email_verified == 1) {
                // Set session termasuk role
                $this->session->set_userdata([
                    'id_user' => $user->id_user,
                    'email' => $user->email,
                    'role' => $user->role
                ]);

                // Redirect ke dashboard
                redirect('dashboard/index');
            } else {
                $this->session->set_flashdata('error', 'Email Anda belum diverifikasi.');
                redirect('auth/login');
            }
        } else {
            // Email atau password salah
            $this->session->set_flashdata('error', 'Email atau password salah.');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        // Hapus session, lalu redirect ke halaman login
        $this->session->sess_destroy();
        redirect('login'); // Ganti 'login' jika loginmu di controller lain
    }

    public function register()
    {
        $this->load->view('auth/register'); // pastikan file view ini juga ada
    }

    public function process_register()
    {
        // Set aturan validasi
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_users.email]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[50]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[L,P]');
        $this->form_validation->set_rules('nik', 'NIK', 'numeric|exact_length[2]');
        $this->form_validation->set_rules('no_bpjs', 'No BPJS', 'max_length[2]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'numeric|min_length[2]|max_length[12]');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[10]|max_length[255]');

        // Jalankan validasi
        if ($this->form_validation->run() === FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('error', $errors);
            $this->session->set_flashdata('old_input', $this->input->post());
            redirect('auth/register');
            return;
        }

        // Mulai database transaction
        $this->db->trans_begin();

        try {
            // Proses upload avatar jika ada
            $avatar_name = null;
            if (!empty($_FILES['avatar']['name'])) {
                $upload_path = './uploads/avatar/';

                // Buat direktori jika belum ada
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                // Konfigurasi upload
                $config = [
                    'upload_path' => $upload_path,
                    'allowed_types' => 'jpg|jpeg|png|gif',
                    'max_size' => 2048, // 2MB
                    'file_name' => 'avatar_' . time() . '_' . bin2hex(random_bytes(4)),
                    'overwrite' => false,
                    'file_ext_tolower' => true,
                    'encrypt_name' => false
                ];

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('avatar')) {
                    throw new Exception($this->upload->display_errors());
                }

                $upload_data = $this->upload->data();
                $avatar_name = $upload_data['file_name'];

                // Resize image jika diperlukan
                $this->load->library('image_lib');
                $resize_config = [
                    'image_library' => 'gd2',
                    'source_image' => $upload_data['full_path'],
                    'maintain_ratio' => true,
                    'width' => 200,
                    'height' => 200,
                    'new_image' => $upload_path . 'thumb_' . $upload_data['file_name']
                ];

                $this->image_lib->initialize($resize_config);
                if (!$this->image_lib->resize()) {
                    // Tidak throw exception, karena upload utama sudah berhasil
                    log_message('error', 'Gagal resize gambar: ' . $this->image_lib->display_errors());
                }
                $this->image_lib->clear();
            }

            // Data untuk tabel user
            // Ubah bagian user_data menjadi:
            $user_data = [
                'email' => strtolower(trim($this->input->post('email', true))),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_email_verified' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            // Simpan data user
            $user_id = $this->User_model->insert_user($user_data);
            if (!$user_id) {
                throw new Exception('Gagal menyimpan data pengguna');
            }

            // Data untuk tabel pasien
            $pasien_data = [
                'id_user' => $user_id,
                'nama' => ucwords(strtolower(trim($this->input->post('nama', true)))),
                'nik' => $this->input->post('nik', true),
                'no_bpjs' => $this->input->post('no_bpjs', true),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'alamat' => $this->input->post('alamat', true),
                'tgl_lahir' => date('Y-m-d', strtotime($this->input->post('tgl_lahir', true))),
                'no_hp' => $this->input->post('no_hp', true),
                'avatar' => $avatar_name,
            ];

            // Simpan data pasien
            if (!$this->Pasien_model->insert_pasien($pasien_data)) {
                throw new Exception('Gagal menyimpan data pasien');
            }

            $pasien_id = $this->db->insert_id(); // Dapatkan id_pasien terakhir yang disimpan

            // Update tb_users
            $this->db->where('id_user', $user_id);
            $this->db->update('tb_users', ['id_pasien' => $pasien_id]);


            // Generate OTP
            $otp_code = mt_rand(100000, 999999);
            $expired_at = date('Y-m-d H:i:s', strtotime('+24 hours'));

            // Data OTP untuk verifikasi email
            $otp_data = [
                'id_user' => $user_id,
                'token' => $otp_code,
                'expired_at' => $expired_at,
            ];

            // Simpan OTP ke database
            if (!$this->db->insert('tb_verifikasi_email', $otp_data)) {
                throw new Exception('Gagal menyimpan kode OTP');
            }

            // Kirim email verifikasi
            $email_sent = $this->_send_verification_email($user_data['email'], $pasien_data['nama'], $otp_code);
            if (!$email_sent) {
                throw new Exception('Gagal mengirim email verifikasi');
            }

            // Commit transaction jika semua berhasil
            $this->db->trans_commit();

            // Set session dan redirect
            $this->session->set_userdata([
                'verify_email' => $user_data['email'],
                'verify_user_id' => $user_id
            ]);

            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan cek email Anda untuk kode verifikasi.');
            redirect('auth/verify_otp');

        } catch (Exception $e) {
            // Rollback transaction jika ada error
            $this->db->trans_rollback();

            // Hapus file yang sudah diupload jika ada error
            if (!empty($avatar_name) && file_exists($upload_path . $avatar_name)) {
                unlink($upload_path . $avatar_name);
                if (file_exists($upload_path . 'thumb_' . $avatar_name)) {
                    unlink($upload_path . 'thumb_' . $avatar_name);
                }
            }

            $this->session->set_flashdata('error', $e->getMessage());
            $this->session->set_flashdata('old_input', $this->input->post());
            redirect('auth/register');
        }
    }

    private function _send_verification_email($email, $name, $otp_code)
    {
        $this->load->library('email');

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'zfau261024@gmail.com',
            'smtp_pass' => 'jexw pbqk kveq rutb',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'smtp_timeout' => 30,
            'crlf' => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('zfau261024@gmail.com', 'Puskesmas');
        $this->email->to($email);
        $this->email->subject('Verifikasi Email Anda');

        $message = $this->load->view('auth/email', [
            'name' => $name,
            'otp_code' => $otp_code,
            'expiry_hours' => 24
        ], true);

        $this->email->message($message);

        if (!$this->email->send()) {
            log_message('error', 'Email Error: ' . $this->email->print_debugger());
            return false;
        }

        return true;
    }

    public function verify_otp()
    {
        if ($this->input->post()) {
            $otp = $this->input->post('otp', true);
            $email = $this->session->userdata('verify_email');

            // Ambil data user berdasarkan email
            $user = $this->User_model->get_user_by_email($email);

            if (!$user) {
                $this->session->set_flashdata('error', 'Email tidak ditemukan.');
                redirect('auth/verify_otp');
                return;
            }

            // Cek apakah ada OTP yang cocok dan belum expired
            $this->db->where('id_user', $user->id_user);
            $this->db->where('token', $otp);
            $this->db->where('expired_at >=', date('Y-m-d H:i:s'));
            $otp_data = $this->db->get('tb_verifikasi_email')->row();

            if ($otp_data) {
                // Set email terverifikasi
                $this->User_model->update_user($user->id_user, ['is_email_verified' => 1]);

                // Hapus OTP dari database
                $this->db->delete('tb_verifikasi_email', ['id_user' => $user->id_user]);

                // Hapus session email
                $this->session->unset_userdata('verify_email');

                $this->session->set_flashdata('success', 'Email berhasil diverifikasi. Silakan login.');
                redirect('auth/login'); // Arahkan ke halaman login
            } else {
                $this->session->set_flashdata('error', 'Kode OTP tidak valid atau telah kedaluwarsa.');
                redirect('auth/verify_otp');
            }
        } else {
            $this->load->view('auth/verify_otp');
        }
    }

}

