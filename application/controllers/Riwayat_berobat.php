<?php
class Riwayat_berobat extends CI_Controller{
    public function index(){
        $data['title'] = 'Riwayat Berobat';
        $data['content'] = 'backend/riwayat_berobat/index';
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }
}