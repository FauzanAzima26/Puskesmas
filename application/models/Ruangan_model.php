<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan_model extends CI_Model
{

    private $table = 'tb_ruangan';

    public function get_datatables()
    {
        $this->db->select('*');
        $this->db->from('tb_ruangan');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->where('id_ruangan', $id);
        $query = $this->db->get('tb_ruangan');
        return $query->row(); // Mengembalikan single object
    }

    public function insert($data)
    {
        return $this->db->insert('tb_ruangan', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_ruangan', $id);
        return $this->db->update('tb_ruangan', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_ruangan', $id);
        return $this->db->delete('tb_ruangan');
    }
}
