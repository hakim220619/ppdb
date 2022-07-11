<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_aplikasi');
        $this->load->model('Mod_user');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');

        // backButtonHandle();
    }

    function index()
    {
        $id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $no_pendaftaran = $id['id_user'];

        $data['ver_siswa'] = $this->Mod_user->status($no_pendaftaran)->row();

        $data['pembayaran'] = $this->Mod_user->view_pembayaran($no_pendaftaran)->result();


        // dead($data['pembayaran']);
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $this->template->load('layoutbackend', 'dashboard/dashboard', $data);
        }
    }
}
/* End of file Controllername.php */
