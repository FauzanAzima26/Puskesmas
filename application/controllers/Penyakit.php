<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penyakit_model');
        $this->load->helper('url');
        $this->load->helper('security');
    }

    public function index()
    {
        $data['title'] = 'Penyakit';
        $data['content'] = 'backend/penyakit/index';
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }

    public function get_data()
    {
        // Jika ada parameter ID (untuk edit)
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
            $penyakit = $this->Penyakit_model->get_by_id($id);

            if ($penyakit) {
                echo json_encode([
                    'id_penyakit' => $penyakit->id_penyakit,
                    'nama_penyakit' => $penyakit->nama_penyakit,
                    'keterangan' => $penyakit->keterangan
                ]);
            } else {
                echo json_encode([
                    'error' => 'Data tidak ditemukan'
                ]);
            }
            return;
        }

        // Jika tidak ada ID (untuk DataTable)
        $data = $this->Penyakit_model->get_datatables();
        echo json_encode([
            "data" => $data
        ]);
    }

    public function store()
    {
        $data = $this->input->post();

        if ($this->input->post('_method') == 'DELETE') {
            // Proses delete
            $id = $this->input->post('id_penyakit');
            $delete = $this->Penyakit_model->delete($id);

            if ($delete) {
                echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menghapus data']);
            }
            return;
        }

        if (empty($data['id_penyakit'])) {
            // Proses insert
            $insert = $this->Penyakit_model->insert($data);
            $message = $insert ? 'Data berhasil ditambahkan' : 'Gagal menambahkan data';
        } else {
            // Proses update
            $update = $this->Penyakit_model->update($data['id_penyakit'], $data);
            $message = $update ? 'Data berhasil diperbarui' : 'Gagal memperbarui data';
        }

        echo json_encode([
            'success' => isset($insert) ? $insert : $update,
            'message' => $message
        ]);
    }
}