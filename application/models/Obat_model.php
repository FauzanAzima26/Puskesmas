<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_model extends CI_Model
{

    private $table = 'tb_obat';

    public function get_datatables()
    {
        $this->db->select('*');
        $this->db->from('tb_obat');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->where('id_obat', $id);
        $query = $this->db->get('tb_obat');
        return $query->row(); // Mengembalikan single object
    }

    public function insert($data)
    {
        return $this->db->insert('tb_obat', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_obat', $id);
        return $this->db->update('tb_obat', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_obat', $id);
        return $this->db->delete('tb_obat');
    }
}
