<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        /*-- Check Session  --*/
        is_login();
        /*-- untuk mengatasi error confirm form resubmission  --*/
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        $this->load->model('siswa_model');
        $this->load->model('admin_model');
    }

    public function index()
    {

        $data = array(
            'title' => 'Web Sekolah',
            'parent' => 'MA PK MAARIF NGALIAN',
            'isi' => 'Siswa/v_siswa_dashboard',
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'profile' => $this->siswa_model->getProfile(str_replace("siswa", "", $this->session->userdata('username'))),
            'logo' => $this->admin_model->detailLogo(),
        );
        $this->load->view('Siswa/Layout/v_wrapper', $data, FALSE);
    }

    public function profile($id_siswa)
    {
        $this->form_validation->set_rules('nama_user', 'nama_user', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/user/img/Siswa/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_siswa')) {

                $data = array(
                    'title' => 'Edit Data',
                    'error' => $this->upload->display_errors(),
                    'profile' => $this->siswa_model->getProfile(str_replace("siswa", "", $this->session->userdata('username'))),
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Siswa/v_siswa_dashboard',
                );
                $this->load->view('admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/user/img/Siswa/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $siswa = $this->siswa_model->detailSiswa($id_siswa);
                if ($siswa->foto_siswa != "") {
                    unlink('./assets/data/foto/user/img/Siswa/' . $siswa->foto_siswa);
                }
                //tutup

                $data = array(
                    'id_siswa'            => $id_siswa,
                    'nama_user'        => $this->input->post('nama_user'),
                    'email'         => $this->input->post('email'),
                );
                $this->siswa_model->editSiswa($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil DiUbah!</div>');
                redirect('siswa');
            }
            $upload_data                         = array('uploads' => $this->upload->data());
            $config['image_library']              = '.gd2';
            $config['source_image']              = './assets/data/foto/user/img/Siswa/' . $upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'id_siswa'            => $id_siswa,
                'nama_user'        => $this->input->post('nama_user'),
                'email'         => $this->input->post('email'),
            );
            $this->siswa_model->editSiswa($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil DiUbah!</div>');
            redirect('siswa');
        }

        $data = array(
            'title' => 'Web Sekolah',
            'parent' => 'MA PK MAARIF NGALIAN',
            'isi' => 'Siswa/v_siswa_dashboard',
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'profile' => $this->siswa_model->getProfile(str_replace("siswa", "", $this->session->userdata('username'))),
            'logo' => $this->admin_model->detailLogo(),
        );
        $this->load->view('Siswa/Layout/v_wrapper', $data, FALSE);
    }

    public function allNilai()
    {

        $data = array(
            'title' => 'List Semua Nilai',
            'parent' => 'MA PK MAARIF NGALIAN',
            'isi' => 'Siswa/v_siswa_allNilai',
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'detailNilai' => $this->siswa_model->detailNilai(str_replace("siswa", "", $this->session->userdata('username'))),
            'logo' => $this->admin_model->detailLogo(),
            'allNilai' => $this->siswa_model->allNilai(str_replace("siswa", "", $this->session->userdata('username')))
        );
        $this->load->view('Siswa/Layout/v_wrapper', $data, FALSE);
    }

    public function getNotif(){
		
		$view = $this->input->post('view');
		// $siswa = $this->db->get_where('tbl_siswa',['nis' => str_replace("siswa","", $this->session->userdata('username'))])->row();
		$data = $this->siswa_model->getNotif(str_replace("siswa","", $this->session->userdata('username')));

		echo json_encode($data);

	}

	public function updateNotif(){

		$request_siswa = $this->input->post('siswa');
		// $siswa = $this->db->get_where('tbl_siswa',['nis' => $nis ])->row()->id_siswa;

		$updateNotif = [ 

			'request_status_siswa' => 1,
		];

		$this->db->where('request_siswa', $request_siswa);
		$data = $this->db->update('tbl_request',$updateNotif);
		echo json_encode($data);
	}

    public function deleteNotif($id_request)
    {

        $this->db->delete('tbl_request', ['id_request' => $this->encrypt->decode($id_request)]);
        $this->toastr->success('Notification Telah Di Hapus!');
        redirect('Siswa/notif');
    }

    public function notif()
    {

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'allnotif' => $this->siswa_model->getAllNotif(str_replace("siswa", "", $this->session->userdata('username'))),
            'logo' => $this->admin_model->detailLogo(),
            'title' => 'Siswa | Notification',
            'parent' => 'Siswa | Notification',
            'page' => 'Notification',
            'isi' => 'Siswa/v_siswa_notif',
        );
        $this->load->view('Siswa/Layout/v_wrapper', $data, FALSE);
    }

    public function pengaduan()
    {
        $data = array(
            'title' => 'Web Sekolah',
            'parent' => 'MA PK MAARIF NGALIAN',
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'page' => 'Pengaduan Nilai',
            'pengaduan' => $this->siswa_model->listspengaduan(),
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Siswa/aduan',
        );
        $this->load->view('Siswa/Layout/v_wrapper', $data, FALSE);
    }

    public function kirimAduan()
    {
        $this->form_validation->set_rules('jenis_pengaduan', 'Jenis Pengaduan', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'title' => 'Kirim Pengaduan',
                'parent' => 'MA PK MAARIF NGALIAN',
                'page' => 'Pengaduan Nilai',
                'logo' => $this->admin_model->detailLogo(),
                'pengaduan' => $this->siswa_model->listspengaduan(),
                'isi' => 'Siswa/v_siswa_chat',
            );
            $this->load->view('Siswa/Layout/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                // 'id_pengaduan' => $id_pengaduan,
                'jenis_pengaduan' => $this->input->post('jenis_pengaduan'),
                'isi' => $this->input->post('isi'),
            );
            $this->siswa_model->kirimPengaduan($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Kirim!!!</div>');
            redirect('Siswa/pengaduan');
        }
    }
}