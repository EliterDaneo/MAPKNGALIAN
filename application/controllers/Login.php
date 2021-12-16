<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Login extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();


        /*-- untuk mengatasi error confirm form resubmission  --*/
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        $this->ci = get_instance();
        $this->ci->load->model('Login_model');
    }

    public function index()
    {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username = strip_tags($this->input->post('username'));
            $password = strip_tags($this->input->post('password'));
            $this->user_login->login($username, $password);
        }

        if ($this->session->userdata('level') == 'Administrator') {
            redirect('Admin');
        } elseif ($this->session->userdata('level') == 'Guru') {
            redirect('Guru');
        } elseif ($this->session->userdata('level') == 'Wali') {
            redirect('Wali');
        } elseif ($this->session->userdata('level') == 'Siswa') {
            redirect('Siswa');
        }

        $data = array('title' => 'Login');
        $this->load->view('Login/v_login', $data, FALSE);
    }

    public function proseslogin()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Login/v_login');
        } else {

            $username = strip_tags($this->input->post('username'));
            $password = strip_tags($this->input->post('password'));

            $user = $this->db->get_where('tbl_user', ['username' => $this->db->escape_str($username)])->row();

            //Jika usernya Ada
            if ($user) {

                //jika usernya aktif
                if ($user->status == 1) {

                    //cek password
                    if (password_verify($this->db->escape_str($password), $user->password)) {

                        $data = [

                            'username' => $user->username,
                            'level' => $user->level,
                            'nama_sekolah' => '1',

                        ];

                        $this->session->set_userdata($data);

                        if ($user->level == 'Admin') {

                            redirect('Admin');
                        } elseif ($user->level == 'Guru') {

                            redirect('Guru');
                        } elseif ($user->level == 'Siswa') {

                            redirect('Siswa');
                        } elseif ($user->level == 'Wali') {

                            redirect('Wali');
                        }
                    } else {
                        $this->ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                        redirect('login');
                        // $this->toastr->error('Wrong Password!');
                        // redirect('Home/indexloginpage');
                    }
                } else {
                    $this->ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">User Not Active!</div>');
                    redirect('login');
                    // $this->toastr->error('User Not Active!');
                    // redirect('Home/indexloginpage');
                }
            } else {
                $this->ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">username Not Found!</div>');
                redirect('login');
                // $this->toastr->error('username Not Found!');
                // redirect('Home/indexloginpage');
            }
        }
    }


    public function blocked()
    {

        $data['title'] = "Acces Forbidden";
        $this->load->view('Home/home_403', $data);
    }


    public function logout()
    {

        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('nama_sekolah');
        $this->toastr->success('You have been logged out!');
        redirect(base_url());
    }
}
