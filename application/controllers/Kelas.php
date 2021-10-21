<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('kelas_model', 'kelas');
        $this->load->model('pengasuh_model', 'pengasuh');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['kelas'] = $this->kelas->getAllKelas();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Kelas';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('kelas/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambah()
    {

        $data['judul'] = 'Kelas';

        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('kelas/index', $data);
            $this->load->view('templates/user_footer');
        } else {
            $kelas = ['kelas' => htmlspecialchars($this->input->post('kelas'))];
        }
        $this->db->insert('kelas', $kelas);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Ditambah</div>');
        redirect('kelas');
    }

    public function edit()
    {
        $id =  htmlspecialchars($this->input->post('id'));
        $kelas = ['kelas' => htmlspecialchars($this->input->post('kelas'))];

        $this->db->where('id_kelas', $id);
        $this->db->update('kelas', $kelas);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Ditambah</div>');
        redirect('kelas');
    }

    public function hapus($id)
    {

        $this->db->where('id_kelas', $id);
        $this->db->delete('kelas');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah dihapus</div>');
        redirect('kelas');
    }
}
