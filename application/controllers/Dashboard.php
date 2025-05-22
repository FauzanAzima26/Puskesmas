<?php
class Dashboard extends CI_Controller {
  public function index() {
    $data['title'] = 'Dashboard';
    $data['content'] = 'backend/dashboard/index'; // halaman utama yang akan disisipkan
    $this->load->view('backend/layouts/header', $data);
    $this->load->view('backend/layouts/main', $data);
  }
}
