<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function website()
    {

        $query = "SELECT * FROM tbl_logo";
        return $this->db->query($query)->row()->nama_sekolah;
    }
}
