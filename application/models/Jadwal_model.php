<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    public function getAllJam()
    {

        $return  = $this->db->query("SELECT DISTINCT hari FROM jam")->result_array();


        // $senin = array();
        // $selasa = array();
        // $rabu = array();
        // $kamis = array();
        // $jumat = array();
        // $sabtu = array();
        // $ahad = array();


        // foreach ($jam as $data) {
        //     if ($data->hari == 'Senin') {
        //         $senin[] = $data;
        //     } else if ($data->hari == 'Selasa') {
        //         $selasa[] = $data;
        //     } else if ($data->hari == 'Rabu') {
        //         $rabu[] = $data;
        //     } else if ($data->hari == 'Kamis') {
        //         $kamis[] = $data;
        //     } else if ($data->hari == 'Jumat') {
        //         $jumat[] = $data;
        //     } else if ($data->hari == 'Sabtu') {
        //         $sabtu[] = $data;
        //     } else if ($data->hari == 'Ahad') {
        //         $ahad[] = $data;
        //     }
        // }

        // $return = array(
        //     $senin,
        //     $selasa,
        //     $rabu,
        //     $kamis,
        //     $jumat,
        //     $sabtu,
        //     $ahad

        // );
        // $return = [
        //     'Senin' => $senin,
        //     'selasa' => $selasa,
        //     'rabu' => $rabu,
        //     'kamis' => $kamis,
        //     'jumat' => $jumat,
        //     'sabtu' => $sabtu,
        //     'ahad' => $ahad
        // ];
        // echo json_encode($return);
        // die;
        return $return;
    }
    public function getAllJamByID($id)
    {
        $jam = $this->db->get_where('jam', ['id_jam' => $id])->row_array();
        return $jam;
    }
}
