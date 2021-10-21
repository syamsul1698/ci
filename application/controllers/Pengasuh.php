<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengasuh extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('auth_model', 'auth');
        $this->load->model('pengasuh_model', 'pengasuh');
        $this->load->model('admin_model', 'admin');
        $this->load->model('mapel_model', 'mapel');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['pengasuhs'] = $this->pengasuh->getAllPengasuh();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Guru';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('pengasuh/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambah()
    {
        $data['user'] = $this->auth->getSession();
        $data['pengasuhs'] = $this->pengasuh->getAllPengasuh();
        $data['mapel'] = $this->mapel->getMapel();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Guru';

        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required|trim',
            [
                'required' => 'Kolom %s harus terisi',
            ]
        );
        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]', [
            'required' => 'Kolom %s harus terisi',
            'is_unique' => '%s sudah terdaftar'
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[user.nip]', [
            'required' => 'Kolom %s harus terisi',
            'is_unique' => '%s sudah terdaftar'
        ]);

        $this->form_validation->set_rules('tempat', 'Tempat', 'required|trim');
        $this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('hp', 'HP', 'required|trim|numeric|min_length[12]|max_length[13]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|trim|min_length[8]|matches[password]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('pengasuh/tambah', $data);
            $this->load->view('templates/user_footer');
        } else {
            $upload_gambar = $_FILES['gambar']['name'];
            $pengasuh = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('tempat', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'hp' => htmlspecialchars($this->input->post('hp', true)),
                'mengajar' => htmlspecialchars($this->input->post('mapel', true)),
                'role_id' => 2,
            ];

            $user = [
                'email' => htmlspecialchars($this->input->post('email', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'role_id' => 2
            ];

            if ($upload_gambar) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $new_gambar = $this->upload->data('file_name');
                    $user['gambar'] = $new_gambar;
                }
            }
            $this->db->insert('pengasuh', $pengasuh);
            $this->db->insert('user', $user);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data telah Ditambahkan, Silahkan Login</div>');
            redirect('pengasuh');
        }
    }


    public function edit($id)
    {
        $data['user'] = $this->auth->getSession();

        $data['pengasuhs'] = $this->pengasuh->getPengasuhById($id);
        $data['users'] = $this->admin->getUserById($id);
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Guru';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('pengasuh/edit', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit_profil()
    {
        $pengasuh = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'tempat_lahir' => htmlspecialchars($this->input->post('tempat', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'hp' => htmlspecialchars($this->input->post('hp', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),

        ];

        $user = [
            'email' => htmlspecialchars($this->input->post('email', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),


        ];
        $upload_gambar = $_FILES['gambar']['name'];
        // echo json_encode($upload_gambar);
        // die;

        if ($upload_gambar) {

            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $gambar_lama = $this->input->post('hapus_gambar');
                if ($gambar_lama != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                }
                $new_gambar = $this->upload->data('file_name');
                $pengasuh['gambar'] = $new_gambar;
                $user['gambar'] = $new_gambar;
            }
        }
        $nip = $this->input->post('nip');

        $this->db->where('nip', $nip);
        $this->db->update('pengasuh', $pengasuh);
        $this->db->where('nip', $nip);
        $this->db->update('user', $user);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data telah Ditambahkan, Silahkan Login</div>');
        redirect('pengasuh');
    }

    public function ubahdata()
    {
        $nip = $this->input->post('nip');
        $pengasuh = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'tempat_lahir' => htmlspecialchars($this->input->post('tempat', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'hp' => htmlspecialchars($this->input->post('hp', true)),

        ];

        $user = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),

        ];

        $this->db->where('nip', $nip);
        $this->db->update('pengasuh', $pengasuh);
        $this->db->where('nip', $nip);
        $this->db->update('user', $user);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data telah Diubah</div>');
        redirect('pengasuh');
    }

    public function hapus($id)
    {
        $data['pengasuh'] = $this->pengasuh->getPengasuhById($id)->row_array();

        $gambar = $data['pengasuh']['gambar'];

        if ($gambar) {
            unlink(FCPATH . 'assets/img/profile/' . $gambar);
        }

        $this->db->where('id_pengasuh', $id);
        $this->db->delete('pengasuh');
        $this->db->where('id_user', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Dihapus</div>');
        redirect('pengasuh');
    }
}
