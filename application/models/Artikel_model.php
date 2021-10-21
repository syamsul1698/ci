<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_model extends CI_Model
{
    public function getArtikel()
    {
        return $this->db->get('artikel');
    }

    public function getaArtikelById($id)
    {
        return $this->db->get_where('artikel', ['id_artikel' => $id]);
    }

    public function crud($tabel, $kolom, $id, $methdo)
    {
        if ($methdo == 'all') {
            return $this->db->get($tabel);
        } else if ($methdo == 'satu') {
            return $this->db->get_where($tabel, [$kolom => $id]);
        }
    }
}
