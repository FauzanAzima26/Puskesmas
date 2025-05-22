<?php
class Obat extends CI_Controller{
    public function index(){
        $data['title'] = 'Obat';
        $data['content'] = 'backend/obat/index';
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }
}