<?php
class Penyakit extends CI_Controller{
    public function index(){
        $data['title'] = 'Penyakit';
        $data['content'] = 'backend/penyakit/index';
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }
}