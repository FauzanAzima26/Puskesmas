<?php
class Riwayat_berobat extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Riwayat Berobat';
        $data['content'] = 'backend/riwayat_berobat/index';
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }

    public function store()
    {
        $id_dokter = $this->session->userdata('id_dokter'); // pastikan sudah disimpan di session saat login

        $data = [
            'id_pasien' => $this->input->post('id_pasien'),
            'id_dokter' => $id_dokter, // ambil langsung dari session
            'tgl_periksa' => $this->input->post('tgl_periksa'),
            'keluhan' => $this->input->post('keluhan'),
            'diagnosa' => $this->input->post('diagnosa'),
            'tindakan' => $this->input->post('tindakan'),
            'resep' => $this->input->post('resep'),
        ];

        $this->db->insert('tb_riwayat_berobat', $data);
        echo json_encode(['status' => 'success']);
    }
}