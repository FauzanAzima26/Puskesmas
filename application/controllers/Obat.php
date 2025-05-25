<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obat_model');
        $this->load->helper('url');
        $this->load->helper('security');
    }

    public function index()
    {
        $data['title'] = 'Obat';
        $data['content'] = 'backend/obat/index';
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }

    public function get_data()
    {
        // Jika ada parameter ID (untuk edit)
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
            $obat = $this->Obat_model->get_by_id($id);

            if ($obat) {
                echo json_encode([
                    'id_obat' => $obat->id_obat,
                    'nama_obat' => $obat->nama_obat,
                    'kategori' => $obat->kategori,
                    'stok' => $obat->stok,
                    'keterangan' => $obat->keterangan
                ]);
            } else {
                echo json_encode([
                    'error' => 'Data tidak ditemukan'
                ]);
            }
            return;
        }

        // Jika tidak ada ID (untuk DataTable)
        $data = $this->Obat_model->get_datatables();
        echo json_encode([
            "data" => $data
        ]);
    }

    public function store()
    {
        $data = $this->input->post();

        if ($this->input->post('_method') == 'DELETE') {
            // Proses delete
            $id = $this->input->post('id_obat');
            $delete = $this->Obat_model->delete($id);

            if ($delete) {
                echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menghapus data']);
            }
            return;
        }

        if (empty($data['id_obat'])) {
            // Proses insert
            $insert = $this->Obat_model->insert($data);
            $message = $insert ? 'Data berhasil ditambahkan' : 'Gagal menambahkan data';
        } else {
            // Proses update
            $update = $this->Obat_model->update($data['id_obat'], $data);
            $message = $update ? 'Data berhasil diperbarui' : 'Gagal memperbarui data';
        }

        echo json_encode([
            'success' => isset($insert) ? $insert : $update,
            'message' => $message
        ]);
    }
}
