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
  $this->db->trans_start(); // Mulai transaksi

  $id_dokter = $this->input->post('id_dokter');
  $nama = $this->input->post('nama');
  $spesialisasi = $this->input->post('spesialisasi');
  $jenis_kelamin = $this->input->post('jenis_kelamin');
  $no_hp = $this->input->post('no_hp');

  if ($id_dokter) {
    // ✅ UPDATE data dokter jika id_dokter dikirim
    $doctor_data = [
      'nama' => $nama,
      'spesialisasi' => $spesialisasi,
      'jenis_kelamin' => $jenis_kelamin,
      'no_hp' => $no_hp
    ];
    $this->Doctor_model->update($id_dokter, $doctor_data);

  } else {
    // ✅ 1. Generate email unik
    $base_email = strtolower(str_replace(' ', '', $nama)) . '@puskesmas.com';
    $email = $base_email;
    $counter = 1;

    while ($this->User_model->get_user_by_email($email)) {
      $email = strtolower(str_replace(' ', '', $nama)) . $counter++ . '@puskesmas.com';
    }

    // ✅ 2. Insert ke tb_users dengan id_dokter = NULL
    $user_data = [
      'email' => $email,
      'password' => password_hash('123456', PASSWORD_DEFAULT),
      'role' => 'dokter',
      'created_at' => date('Y-m-d H:i:s'),
      'is_email_verified' => 1,
      'id_dokter' => NULL
    ];
    $this->db->insert('tb_users', $user_data);
    $id_user = $this->db->insert_id(); // Ambil ID user baru

    // ✅ 3. Insert ke tb_dokter, gunakan id_user sebagai FK
    $doctor_data = [
      'id_user' => $id_user,
      'nama' => $nama,
      'spesialisasi' => $spesialisasi,
      'jenis_kelamin' => $jenis_kelamin,
      'no_hp' => $no_hp
    ];
    $this->db->insert('tb_dokter', $doctor_data);
    $id_dokter_baru = $this->db->insert_id(); // Ambil ID dokter baru

    // ✅ 4. Update tb_users untuk isi id_dokter
    $this->db->where('id_user', $id_user);
    $this->db->update('tb_users', ['id_dokter' => $id_dokter_baru]);
  }

  $this->db->trans_complete(); // Selesai transaksi

  if ($this->db->trans_status() === FALSE) {
    echo json_encode([
      'status' => false,
      'message' => 'Terjadi kesalahan saat menyimpan data'
    ]);
  } else {
    echo json_encode([
      'status' => true,
      'message' => ($id_dokter) ? 'Data dokter berhasil diperbarui' : 'Data dokter berhasil disimpan',
      'email' => $email ?? null
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
