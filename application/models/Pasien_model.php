<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    public function insert_pasien($data)
    {
        // Simpan data pasien (nama, nik, no_bpjs, jenis_kelamin, alamat, tgl_lahir, no_hp, avatar)
        return $this->db->insert('tb_pasien', $data);
    }
}
