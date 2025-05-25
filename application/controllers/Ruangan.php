<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ruangan_model');
        $this->load->helper('url');
        $this->load->helper('security');
    }

    public function index()
    {
        $data['title'] = 'Ruangan';
        $data['content'] = 'backend/ruangan/index';
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }

    public function get_data()
    {
        // Jika ada parameter ID (untuk edit)
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
            $ruangan = $this->Ruangan_model->get_by_id($id);

            if ($ruangan) {
                echo json_encode([
                    'id_ruangan' => $ruangan->id_ruangan,
                    'nama_ruangan' => $ruangan->nama_ruangan,
                    'jenis' => $ruangan->jenis,
                    'kapasitas' => $ruangan->kapasitas
                ]);
            } else {
                echo json_encode([
                    'error' => 'Data tidak ditemukan'
                ]);
            }
            return;
        }

        // Jika tidak ada ID (untuk DataTable)
        $data = $this->Ruangan_model->get_datatables();
        echo json_encode([
            "data" => $data
        ]);
    }

    public function store()
    {
        $data = $this->input->post();

        if ($this->input->post('_method') == 'DELETE') {
            // Proses delete
            $id = $this->input->post('id_ruangan');
            $delete = $this->Ruangan_model->delete($id);

            if ($delete) {
                echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menghapus data']);
            }
            return;
        }

        if (empty($data['id_ruangan'])) {
            // Proses insert
            $insert = $this->Ruangan_model->insert($data);
            $message = $insert ? 'Data berhasil ditambahkan' : 'Gagal menambahkan data';
        } else {
            // Proses update
            $update = $this->Ruangan_model->update($data['id_ruangan'], $data);
            $message = $update ? 'Data berhasil diperbarui' : 'Gagal memperbarui data';
        }

        echo json_encode([
            'success' => isset($insert) ? $insert : $update,
            'message' => $message
        ]);
    }
}