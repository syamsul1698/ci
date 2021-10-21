<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    public function getAllKelasByAsc()
    {
        $kelas = $this->db->select('*')->from('kelas')->order_by('kelas', 'ASC')->get();
        return $kelas;
    }
    public function getAllKelas()
    {
        $kelas = $this->db->get('kelas');
        return $kelas;
    }

    public function getKelasByID($id)
    {
        $kelas = $this->db->get_where('kelas', ['id_kelas' => $id])->row_array();
        return $kelas;
    }

    public function getKelasByUrl()
    {
        $url = $this->uri->segment(3);
        $kelas = $this->db->query("SELECT * FROM kelas
        WHERE kelas.`id_kelas` = $url");
        return $kelas;
    }
}
