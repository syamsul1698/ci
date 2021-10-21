<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('jadwal_model', 'jadwal');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['jam'] = $this->jadwal->getAllJam();

        $data['haris'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu',];


        $data['judul'] = 'Jam Pelajaran';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('jadwal/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambah()
    {
        $data['user'] = $this->auth->getSession();
        $data['jam'] = $this->jadwal->getAllJam();

        $data['judul'] = 'Jam Pelajaran';

        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');
        $this->form_validation->set_rules('jamke', 'Jam', 'required|trim');
        $this->form_validation->set_rules('jamawal', 'Jam Awal', 'required|trim');
        $this->form_validation->set_rules('jamakhir', 'Jam Akhir', 'required|trim');

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('jadwal/index', $data);
        $this->load->view('templates/user_footer');

        $data = [
            'hari' => htmlspecialchars($this->input->post('hari')),
            'jamke' => htmlspecialchars($this->input->post('jamke')),
            'jam_awal' => htmlspecialchars($this->input->post('jamawal')),
            'jam_akhir' => htmlspecialchars($this->input->post('jamakhir')),
            'keterangan' => htmlspecialchars($this->input->post('ket')),
        ];

        $this->db->insert('jam', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data telah Ditambahkan</div>');
        redirect('jadwal');
    }

    public function edit($id)
    {
        $data['user'] = $this->auth->getSession();
        $data['jam'] = $this->jadwal->getAllJamByID($id);

        $data['judul'] = 'Jam Pelajaran';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('jadwal/edit', $data);
        $this->load->view('templates/user_footer');
    }

    public function update()
    {
        $data = [
            'hari' => htmlspecialchars($this->input->post('hari')),
            'jamke' => htmlspecialchars($this->input->post('jamke')),
            'jam_awal' => htmlspecialchars($this->input->post('jamawal')),
            'jam_akhir' => htmlspecialchars($this->input->post('jamakhir')),
            'keterangan' => htmlspecialchars($this->input->post('ket')),
        ];
        $id = $this->input->post('id');

        $this->db->where('id_jam', $id);
        $this->db->update('jam', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data telah Ditambahkan</div>');
        redirect('jadwal');
    }

    public function hapus($id)
    {
        $this->db->where('id_jam', $id);
        $this->db->delete('jam');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah dihapus</div>');
        redirect('jadwal');
    }
}
