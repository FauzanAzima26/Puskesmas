<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder extends CI_Controller {

    public function index() {
        $this->load->model('User_model');

        $data = [
            'email' => 'admin@puskesmas.com',
            'password' => password_hash('00000000', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_email_verified' => 1
        ];

        $this->User_model->insert_user($data);
        echo "Akun admin berhasil dibuat.";
    }
}
