<?php
class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Doctor_model');
    }
    
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $data['dokter'] = $this->Doctor_model->get_by_id($id_user); // sesuaikan fungsi modelnya

        $data['title'] = 'Pasien';
        $data['content'] = 'backend/pasien/index';
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }

    public function get_data()
    {
        try {
            $this->load->model('Pasien_model');
            $pasien = $this->Pasien_model->get_all();

            header('Content-Type: application/json');
            echo json_encode(['data' => $pasien]);
        } catch (Exception $e) {
            // Kirim pesan error agar mudah debugging
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}