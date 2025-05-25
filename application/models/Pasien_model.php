<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    public function insert_pasien($data)
    {
        return $this->db->insert('tb_pasien', $data);
    }

    public function get_all()
    {
        return $this->db->get('tb_pasien')->result();
    }

    public function get_by_user_id($user_id)
    {
        return $this->db->get_where('tb_pasien', ['id_user' => $user_id])->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_pasien', ['id_pasien' => $id])->row();
    }

    public function delete($id)
    {
        return $this->db->delete('tb_pasien', ['id_pasien' => $id]);
    }
}
