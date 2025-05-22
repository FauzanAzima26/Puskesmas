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
    $nama = $this->input->post('nama');
    $spesialisasi = $this->input->post('spesialisasi');
    $jenis_kelamin = $this->input->post('jenis_kelamin');
    $no_hp = $this->input->post('no_hp');

    // Generate email unik
    $email = strtolower(str_replace(' ', '', $nama)) . '@puskesmas.com';
    $counter = 1;
    while ($this->User_model->get_user_by_email($email)) {
      $email = strtolower(str_replace(' ', '', $nama)) . $counter++ . '@puskesmas.com';
    }

    // Data untuk tb_users
    $user_data = [
      'email' => $email,
      'password' => password_hash('123456', PASSWORD_DEFAULT), // default password
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

    if ($insert) {
      echo json_encode([
        'status' => true,
        'message' => 'Data dokter berhasil disimpan',
        'email' => $email
      ]);
    } else {
      echo json_encode([
        'status' => false,
        'message' => 'Gagal insert dokter'
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

}
