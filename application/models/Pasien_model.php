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
}
