<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri_model extends CI_Model
{
    public function getAllSantri()
    {
        return $this->db->query("SELECT santri.*, kelas.`kelas` AS nama_kelas
        FROM santri JOIN kelas
        ON santri.`kelas` = kelas.`id_kelas`")->result();
    }

    public function getSantriById($id)
    {
        return $this->db->get_where('santri', ['id_santri' => $id])->row();
    }

   public function getSantriByKelas()
    {
        $id = $this->uri->segment(3);
        // $nilai = $this->db->query("SELECT * FROM santri
        // WHERE kelas = $id")->result();
        $nilai = $this->db->get_where('santri', ['kelas' => $id])->result();
        return $nilai;
    }

    public function getNilaiSantriByKelas($id)
    {
        // $id = $this->uri->segment(3);
        // $nilai = $this->db->query("SELECT * FROM santri
        // WHERE kelas = $id")->result();
        $nilai = $this->db->get_where('santri', ['kelas' => $id])->result();
        return $nilai;
    }

    public function getSantriByKelasabsen($kelas)
    {
        $nilai = $this->db->query("SELECT * FROM santri
        WHERE kelas = $kelas")->result();
        return $nilai;
    }

    public function joinstatus()
    {
        $join = "SELECT status.`status`, santri.*
        FROM `status` JOIN santri
        WHERE status.`id_status` = status_bayar";
        $status = $this->db->query($join)->result();
        return $status;
    }
}
