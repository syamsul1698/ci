<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('auth_model', 'auth');
        $this->load->model('kelas_model', 'kelas');
        $this->load->model('santri_model', 'santri');
        $this->load->model('pengasuh_model', 'pengasuh');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();
         $data['santri'] = $this->santri->getAllSantri();


        $data['judul'] = 'Dashboard';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function role()
    {
        $data['user'] = $this->auth->getSession();
        $data['users'] = $this->auth->getAllUser();
        $data['role'] = $this->db->get('role')->result();

        $data['judul'] = 'Hak Akses';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit()
    {
        $id = htmlspecialchars($this->input->post('id'));
        $user = ['role_id' => htmlspecialchars($this->input->post('role'))];

        $this->db->where('id_user', $id);
        $this->db->update('user', $user);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah diubah</div>');
        redirect('admin/role');
    }
}
