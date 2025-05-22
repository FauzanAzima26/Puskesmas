<?php
class Doctor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Doctor_model');
    $this->load->model('User_model');
  }
  public function index()
  {
    $data['title'] = 'Doctor';
    $data['content'] = 'backend/doctor/index'; // halaman utama yang akan disisipkan
    $this->load->view('backend/layouts/header', $data);
    $this->load->view('backend/layouts/main', $data);
  }

  public function store()
  {
    $id_dokter = $this->input->post('id_dokter');
    $nama = $this->input->post('nama');
    $spesialisasi = $this->input->post('spesialisasi');
    $jenis_kelamin = $this->input->post('jenis_kelamin');
    $no_hp = $this->input->post('no_hp');

    if ($id_dokter) {
      // ==== UPDATE ====

      // Ambil data dokter untuk ambil id_user
      $dokter = $this->Doctor_model->get_by_id($id_dokter);
      if (!$dokter) {
        echo json_encode(['status' => false, 'message' => 'Dokter tidak ditemukan']);
        return;
      }

      // Generate email baru berdasarkan nama
      $email = strtolower(str_replace(' ', '', $nama)) . '@puskesmas.com';
      $counter = 1;
      while (
        $this->User_model->get_user_by_email($email) &&
        $this->User_model->get_user_by_email($email)->id_user != $dokter->id_user // pastikan bukan email dirinya sendiri
      ) {
        $email = strtolower(str_replace(' ', '', $nama)) . $counter++ . '@puskesmas.com';
      }

      // Update tb_users
      $this->db->where('id_user', $dokter->id_user);
      $this->db->update('tb_users', ['email' => $email]);

      // Update tb_dokter
      $doctor_data = [
        'nama' => $nama,
        'spesialisasi' => $spesialisasi,
        'jenis_kelamin' => $jenis_kelamin,
        'no_hp' => $no_hp
      ];

      $this->db->where('id_dokter', $id_dokter);
      $update = $this->db->update('tb_dokter', $doctor_data);

      echo json_encode([
        'status' => $update,
        'message' => $update ? 'Data dokter berhasil diperbarui' : 'Update gagal',
        'email' => $email
      ]);
    } else {
      // ==== INSERT ====

      // Generate email unik
      $email = strtolower(str_replace(' ', '', $nama)) . '@puskesmas.com';
      $counter = 1;
      while ($this->User_model->get_user_by_email($email)) {
        $email = strtolower(str_replace(' ', '', $nama)) . $counter++ . '@puskesmas.com';
      }

      // Data untuk tb_users
      $user_data = [
        'email' => $email,
        'password' => password_hash('123456', PASSWORD_DEFAULT),
        'role' => 'dokter',
        'created_at' => date('Y-m-d H:i:s'),
        'is_email_verified' => 1
      ];

      $id_user = $this->User_model->insert_user($user_data);

      // Data untuk tb_dokter
      $doctor_data = [
        'id_user' => $id_user,
        'nama' => $nama,
        'spesialisasi' => $spesialisasi,
        'jenis_kelamin' => $jenis_kelamin,
        'no_hp' => $no_hp
      ];

      $insert = $this->Doctor_model->insert($doctor_data);

      echo json_encode([
        'status' => $insert ? true : false,
        'message' => $insert ? 'Data dokter berhasil disimpan' : 'Gagal insert dokter',
        'email' => $email
      ]);
    }
  }

  public function get_data()
  {
    try {
      $this->load->model('Doctor_model');
      $doctors = $this->Doctor_model->get_all();

      header('Content-Type: application/json');
      echo json_encode(['data' => $doctors]);
    } catch (Exception $e) {
      // Kirim pesan error agar mudah debugging
      http_response_code(500);
      echo json_encode(['error' => $e->getMessage()]);
    }
  }

  public function edit($id)
  {
    $doctor = $this->Doctor_model->get_by_id($id);
    if ($doctor) {
      echo json_encode(['status' => true, 'data' => $doctor]);
    } else {
      echo json_encode(['status' => false, 'message' => 'Data dokter tidak ditemukan']);
    }
  }

  public function delete($id)
  {
    // Cek apakah dokter ada
    $doctor = $this->Doctor_model->get_by_id($id);
    if (!$doctor) {
      echo json_encode(['status' => false, 'message' => 'Data dokter tidak ditemukan']);
      return;
    }

    // Hapus dari tabel tb_users dan tb_dokter
    $this->db->trans_start();
    $this->db->delete('tb_dokter', ['id_dokter' => $id]);
    $this->db->delete('tb_users', ['id_user' => $doctor->id_user]);
    $this->db->trans_complete();

    if ($this->db->trans_status() === false) {
      echo json_encode(['status' => false, 'message' => 'Gagal menghapus data']);
    } else {
      echo json_encode(['status' => true, 'message' => 'Data dokter berhasil dihapus']);
    }
  }
}
