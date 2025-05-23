<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Antrian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
        $this->load->model('Pasien_model');
        $this->load->library('session');
    }

    public function index()
    {
        // Pastikan hanya pasien yang bisa akses
        if ($this->session->userdata('role') !== 'pasien') {
            redirect('dashboard');
        }

        $id_user = $this->session->userdata('id_user');
        $pasien = $this->Pasien_model->get_by_user_id($id_user);

        if (!$pasien) {
            show_error('Data pasien tidak ditemukan.', 404);
        }

        // Cek apakah sudah ambil antrian hari ini
        $antrian_hari_ini = $this->Antrian_model->get_today_by_pasien($pasien->id_pasien);

        // Jika belum ambil antrian, ambil nomor baru
        if (!$antrian_hari_ini) {
            $nomor_terakhir = $this->Antrian_model->get_last_number_today();
            $nomor_baru = $nomor_terakhir + 1;

            $data = [
                'id_pasien' => $pasien->id_pasien,
                'tanggal' => date('Y-m-d'),
                'nomor_antrian' => $nomor_baru,
            ];

            $this->Antrian_model->insert($data);
            $antrian_hari_ini = (object) $data;
        }

        $this->load->view('backend/antrian/index', ['antrian' => $antrian_hari_ini]);
    }
}
