<?php
class Riwayat_berobat extends CI_Controller
{
    public function index($id_pasien = null)
    {
        // Jika parameter kosong dan role pasien, ambil dari session
        if ($id_pasien === null && $this->session->userdata('role') == 'pasien') {
            $id_pasien = $this->session->userdata('id_pasien');
        }

        // Jika masih kosong, error
        if (!$id_pasien) {
            show_error('ID Pasien tidak ditemukan.');
        }

        // Ambil data pasien
        $data['pasien'] = $this->db->get_where('tb_pasien', ['id_pasien' => $id_pasien])->row();

        // Cek apakah data pasien ada
        if (!$data['pasien']) {
            show_error('Data pasien tidak ditemukan.');
        }

        // Ambil riwayat berobat pasien
        $this->db->select('tb_riwayat_berobat.*, tb_dokter.nama as nama_dokter');
        $this->db->from('tb_riwayat_berobat');
        $this->db->join('tb_dokter', 'tb_riwayat_berobat.id_dokter = tb_dokter.id_dokter', 'left');
        $this->db->where('tb_riwayat_berobat.id_pasien', $id_pasien);
        $this->db->order_by('tgl_periksa', 'DESC');
        $data['riwayat'] = $this->db->get()->result();

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