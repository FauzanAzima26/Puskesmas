<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_user($data)
    {
        $this->db->insert('tb_users', $data);
        return $this->db->insert_id(); // ID terakhir dikembalikan ke controller
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('tb_users', ['email' => $email])->row();
    }

    public function update_user($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_users', $data);
    }

}
