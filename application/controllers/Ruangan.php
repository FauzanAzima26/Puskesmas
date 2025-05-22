<?php
class Ruangan extends CI_Controller{
    public function index(){
        $data['title'] = 'Ruangan';
        $data['content'] = 'backend/ruangan/index'; // halaman utama yang akan disisipkan
        $this->load->view('backend/layouts/header', $data);
        $this->load->view('backend/layouts/main', $data);
    }
}