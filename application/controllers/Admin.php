<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'application/libraries/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_admin');
        $this->load->model('Mod_user');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function user_data()
    {
        $data['title'] = "User Data";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['user'] = $this->Mod_admin->admin()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/user_data', $data);
    }
    public function insert_admin()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'no_tlp'  => $this->input->post('no_tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'no_tlp'  => $this->input->post('no_tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function update_admin()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'no_tlp'  => $this->input->post('no_tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'no_tlp'  => $this->input->post('no_tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'no_tlp'  => $this->input->post('no_tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'no_tlp'  => $this->input->post('no_tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'no_tlp'  => $this->input->post('no_tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'no_tlp'  => $this->input->post('no_tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/user_data');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function del_admin()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/user_data');
    }

    public function verivikasi()
    {
        $data['title'] = "Verifikasi Data";
        $data['verivikasi'] = $this->Mod_admin->verivikasi()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/verivikasi', $data);
    }

    public function tahun_ajaran()
    {
        $data['title'] = "Tahun Ajaran Data";
        $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->result();
        $data['status'] = ['Y', 'N'];
        $this->template->load('layoutbackend', 'admin/tahun_ajaran', $data);
    }
    public function insert_thajaran()
    {
        $save  = array(
            'id' => rand(00, 99),
            'tahun' => $this->input->post('tahun'),
            'status' => $this->input->post('status'),
        );
        // dead($save);
        $this->db->insert('tahun_ajaran', $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Tambah Tahun Ajaran Berhasil',
                    icon: 'success'
                    });
                </script>");
        redirect('admin/tahun_ajaran');
    }

    public function update_tahunajaran()
    {
        $id = $this->input->post('id');
        $save  = array(
            'id' => $id,
            'tahun' => $this->input->post('tahun'),
            'status' => $this->input->post('status'),
        );
        // dead($save);
        $this->Mod_user->updatethajaran($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Update Tahun Ajaran Berhasil',
                    icon: 'success'
                    });
                </script>");
        redirect('admin/tahun_ajaran');
    }

    public function delete_tahunajaran()
    {
        $id = $this->input->get('id');

        $this->db->delete('tahun_ajaran', array('id' => $id));
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Delete Tahun Ajaran Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/tahun_ajaran');
    }

    public function detail_siswa($id)
    {
        $data['title'] = "Detail Data Siswa";
        $data['detail_siswa'] = $this->Mod_user->siswa_all($id)->result();
        $data['priodik'] = $this->Mod_user->priodik($id)->result();
        $data['ayah'] = $this->Mod_user->ayah($id)->result();
        $data['ibu'] = $this->Mod_user->ibu($id)->result();
        $data['wali'] = $this->Mod_user->wali($id)->result();
        $data['get_id'] = $this->Mod_user->siswa_all($id)->row();

        // dead($id);
        $this->template->load('layoutbackend', 'admin/detail_siswa', $data);
    }
    public function acc_siswa($id)
    {
        $save = array(
            'id_verivikasi' => 1
        );
        // dead($save);
        $this->Mod_user->accsiswa($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Verifikasi Siswa Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/verivikasi');
    }
    public function batal_siswa($id)
    {
        $save = array(
            'id_verivikasi' => 2
        );
        // dead($save);
        $this->Mod_user->accsiswa($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Batal Verifikasi Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/verivikasi');
    }

    public function tidterima_siswa($id)
    {
        $save = array(
            'id_verivikasi' => 3
        );
        // dead($save);
        $this->Mod_user->accsiswa($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Batal Verifikasi Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/verivikasi');
    }
    public function update_ktp()
    {
        if (!empty($_FILES['ktp']['name'])) {
            // $this->_validate();
            $id = $this->input->post('no_pendaftaran');

            $nama = 'KTP' . $id;

            $config['upload_path']   = './assets/foto/scan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('ktp')) {
                $gambar = $this->upload->data();


                $save  = array(
                    'ktp' => $gambar['file_name']
                );
                $g = $this->Mod_user->getktp($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/scan/' . $g['ktp']);
                }
                // dead($save);
                $this->Mod_user->updatektp($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Upload KTP Berhasil',
                    icon: 'success'
                    });
                </script>");
                redirect('dashboard/index');
            }
        }
    }
    public function update_kk()
    {
        if (!empty($_FILES['kk']['name'])) {
            // $this->_validate();
            $id = $this->input->post('no_pendaftaran');

            $nama = 'KK' . $id;

            $config['upload_path']   = './assets/foto/scan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('kk')) {
                $gambar = $this->upload->data();


                $save  = array(
                    'kk' => $gambar['file_name']
                );
                $g = $this->Mod_user->getkk($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/scan/' . $g['kk']);
                }
                // dead($save);
                $this->Mod_user->updatekk($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Upload KK Berhasil',
                    icon: 'success'
                    });
                </script>");
                redirect('dashboard/index');
            }
        }
    }
    public function update_akta()
    {
        if (!empty($_FILES['akta']['name'])) {
            // $this->_validate();
            $id = $this->input->post('no_pendaftaran');

            $nama = 'AKTA' . $id;

            $config['upload_path']   = './assets/foto/scan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('akta')) {
                $gambar = $this->upload->data();


                $save  = array(
                    'akta' => $gambar['file_name']
                );
                $g = $this->Mod_user->getakta($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/scan/' . $g['akta']);
                }
                // dead($save);
                $this->Mod_user->updatekk($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Upload AKTA Berhasil',
                    icon: 'success'
                    });
                </script>");
                redirect('dashboard/index');
            }
        }
    }


    public function delete_all_datasiswa($id)
    {
        $g = $this->Mod_user->getImageall($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/scan/' . $g['kk']);
            unlink('assets/foto/scan/' . $g['akta']);
            unlink('assets/foto/scan/' . $g['ktp']);
        }

        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->db->delete('siswa', array('no_pendaftaran' => $id));
        $this->db->delete('ayah', array('no_pendaftaran' => $id));
        $this->db->delete('ibu', array('no_pendaftaran' => $id));
        $this->db->delete('priodik', array('no_pendaftaran' => $id));
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Delete Siswa Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/verivikasi');
    }

    public function pembayaran()
    {
        $data['title'] = "Detail Pembayaran Siswa";
        $data['pembayaran'] = $this->Mod_user->pembayaran()->result();
        $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->result();
        $data['gol'] = ['A', 'B'];
        $data['act'] = ['Y', 'N'];
        // dead($id);
        $this->template->load('layoutbackend', 'admin/pembayaran', $data);
    }

    public function insert_pembayaran()
    {
        $save  = array(
            'id' => rand(00, 99),
            'id_tahun' => $this->input->post('id_tahun'),
            'golongan' => $this->input->post('golongan'),
            'sumbangan_awal' => $this->input->post('sumbangan_awal'),
            'seragam' => $this->input->post('seragam'),
            'majalah' => $this->input->post('majalah'),
            'alat_tulis' => $this->input->post('alat_tulis'),
        );
        // dead($save);
        $this->db->insert('pembayaran', $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Tambah Pembayaran Berhasil',
                    icon: 'success'
                    });
                </script>");
        redirect('admin/pembayaran');
    }

    public function update_pembayaran()
    {
        $id = $this->input->post('id');
        $save  = array(
            'id' => $id,
            'id_tahun' => $this->input->post('id_tahun'),
            'golongan' => $this->input->post('golongan'),
            'sumbangan_awal' => $this->input->post('sumbangan_awal'),
            'seragam' => $this->input->post('seragam'),
            'majalah' => $this->input->post('majalah'),
            'alat_tulis' => $this->input->post('alat_tulis'),
        );
        // dead($save);
        $this->Mod_user->updatepembayaran($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Update Pembayaran Berhasil',
                    icon: 'success'
                    });
                </script>");
        redirect('admin/pembayaran');
    }
    public function delete_pembayaran()
    {
        $id = $this->input->get('id');


        $this->db->delete('pembayaran', array('id' => $id));
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Delete Pembayaran Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/pembayaran');
    }

    public function cetak_siswa($id)
    {
        $data['title'] = "Detail Pembayaran Siswa";
        $data['detail_siswa'] = $this->Mod_user->siswa_all($id)->result();
        $data['priodik'] = $this->Mod_user->priodik($id)->result();
        $data['ayah'] = $this->Mod_user->ayah($id)->result();
        $data['ibu'] = $this->Mod_user->ibu($id)->result();
        $data['wali'] = $this->Mod_user->wali($id)->result();
        $data['get_id'] = $this->Mod_user->siswa_all($id)->row();
        $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->result();
        $data['pembayaran'] = $this->Mod_user->pembayaran()->result();
        // dead($id);
        $this->load->view('admin/cetak_siswa', $data);
    }

    public function siswa()
    {
        $data['title'] = "Siswa Diterima";
        $data['verivikasi'] = $this->Mod_admin->verifikasiacc()->result();

        // dead($id);
        $this->template->load('layoutbackend', 'admin/siswa', $data);
    }

    function laporan()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $id_user = $_GET['id_user'];
                $ket = 'Data Transaksi dari Siswa dengan Nomor Induk ' . $id_user;
                $url_cetak = 'admin/cetak1?&id_user=' . $id_user;
                $url_excel = 'admin/excel1?&id_user=' . $id_user;
                $siswa = $this->Mod_user->view_by_siswa($id_user)->result();
            } else if ($filter == '2') {
                $golongan = $_GET['golongan'];
                $ket = 'Data Per Golongan ' . $golongan;
                $url_cetak = 'admin/cetak2?&golongan=' . $golongan;
                $url_excel = 'admin/excel2?&golongan=' . $golongan;
                $siswa = $this->Mod_user->view_by_golongan($golongan)->result();
            } else if ($filter == '3') {
                $tahun_ajaran = $_GET['tahun_ajaran'];
                $ket = 'Data Per Tahun Ajaran ' . $tahun_ajaran;
                $url_cetak = 'admin/cetak3?&tahun_ajaran=' . $tahun_ajaran;
                $url_excel = 'admin/excel3?&tahun_ajaran=' . $tahun_ajaran;
                $siswa = $this->Mod_user->view_by_tahun_ajaran($tahun_ajaran)->result();
            }
        } else {
            $ket = 'Semua Data Siswa';
            $url_cetak = 'admin/cetak';
            $url_excel = 'admin/excel';
            $siswa = $this->Mod_user->view_all()->result();
        }

        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['url_excel'] = base_url($url_excel);
        $data['siswa'] = $siswa;
        // dead($data['siswa']);
        $data['siswa_select'] = $this->Mod_user->siswa()->result();
        $data['tahun_ajaran'] = $this->Mod_user->tahun()->result();
        $data['title'] = 'Laporan Data Siswa Diterima';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->template->load('layoutbackend', 'admin/laporan', $data);
    }
    public function cetak()
    {
        $ket = 'Semua Data Siswa Diterima';
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['siswa_all'] = $this->Mod_user->view_all()->result();;
        $data['ket'] = $ket;
        $this->load->view('admin/print_siswa', $data);
    }
    public function cetak1()
    {
        $id_user = $_GET['id_user'];
        $ket = 'Data Siswa Dengan Id ' . $id_user;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['siswa_all'] = $this->Mod_user->view_by_siswa($id_user)->result();
        $data['ket'] = $ket;
        $this->load->view('admin/print_siswa', $data);
    }
    public function cetak2()
    {
        $golongan = $_GET['golongan'];
        $ket = 'Data Siswa Dengan Golongan ' . $golongan;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['siswa_all'] = $this->Mod_user->view_by_golongan($golongan)->result();
        $data['ket'] = $ket;
        $this->load->view('admin/print_siswa', $data);
    }
    public function cetak3()
    {
        $tahun_ajaran = $_GET['tahun_ajaran'];
        $ket = 'Data Siswa Dengan Tahun Ajaran ' . $tahun_ajaran;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['siswa_all'] = $this->Mod_user->view_by_tahun_ajaran($tahun_ajaran)->result();
        $data['ket'] = $ket;
        $this->load->view('admin/print_siswa', $data);
    }
    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $sheet->setCellValue('A1', "DATA SISWA YANG SUDAH DI VERIFIKASI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "Nama Lengkap"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "Nama Panggilan"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "Tanggal Daftar"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "No Telepon"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "Tahun Ajaran"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "Jenis Kelamin"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('H3', "Tempat Lahir / Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('I3', "Agama / Kewarganegaraan / Berkebutuhan Khusus"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('J3', "Alamat"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('K3', "Rt / Rw"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('L3', "Dusun / Desa"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('M3', "Kecamatan / Kode Pos"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('N3', "Tempat Tinggal / Transportasi"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('O3', "Anak Ke / Golongan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Q3', "Nama Ayah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('R3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('S3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('T3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('U3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('W3', "Nama Ibu"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('X3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Y3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Z3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AA3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AC3', "Nama Wali"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AD3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AE3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AF3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AG3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AI3', "Tinggi Badan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AJ3', "Berat Badan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AK3', "Jarak Kesekolah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AL3', "Waktu Kesekolah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AM3', "Saudara Kandung"); // Set kolom E3 dengan tulisan "ALAMAT"


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        $sheet->getStyle('I3')->applyFromArray($style_col);
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);
        $sheet->getStyle('L3')->applyFromArray($style_col);
        $sheet->getStyle('M3')->applyFromArray($style_col);
        $sheet->getStyle('N3')->applyFromArray($style_col);
        $sheet->getStyle('O3')->applyFromArray($style_col);
        $sheet->getStyle('Q3')->applyFromArray($style_col);
        $sheet->getStyle('R3')->applyFromArray($style_col);
        $sheet->getStyle('S3')->applyFromArray($style_col);
        $sheet->getStyle('T3')->applyFromArray($style_col);
        $sheet->getStyle('U3')->applyFromArray($style_col);
        $sheet->getStyle('W3')->applyFromArray($style_col);
        $sheet->getStyle('X3')->applyFromArray($style_col);
        $sheet->getStyle('Y3')->applyFromArray($style_col);
        $sheet->getStyle('Z3')->applyFromArray($style_col);
        $sheet->getStyle('AA3')->applyFromArray($style_col);
        $sheet->getStyle('AC3')->applyFromArray($style_col);
        $sheet->getStyle('AD3')->applyFromArray($style_col);
        $sheet->getStyle('AE3')->applyFromArray($style_col);
        $sheet->getStyle('AF3')->applyFromArray($style_col);
        $sheet->getStyle('AG3')->applyFromArray($style_col);
        $sheet->getStyle('AI3')->applyFromArray($style_col);
        $sheet->getStyle('AJ3')->applyFromArray($style_col);
        $sheet->getStyle('AK3')->applyFromArray($style_col);
        $sheet->getStyle('AL3')->applyFromArray($style_col);
        $sheet->getStyle('AM3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $siswa = $this->Mod_user->view_all()->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        // dead($siswa);
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->full_name);
            $sheet->setCellValue('C' . $numrow, $data->username);
            $sheet->setCellValue('D' . $numrow, $data->tanggal_daftar);
            $sheet->setCellValue('E' . $numrow, $data->no_tlp);
            $sheet->setCellValue('F' . $numrow, $data->tahun);
            $sheet->setCellValue('G' . $numrow, $data->jenis_kelamin);
            $sheet->setCellValue('H' . $numrow, $data->tempat_lahir . '/' . $data->tanggal_lahir);
            $sheet->setCellValue('I' . $numrow, $data->agama . '/' . $data->kewarganegaraan . '/' . $data->ber_khusus);
            $sheet->setCellValue('J' . $numrow, $data->alamat);
            $sheet->setCellValue('K' . $numrow, $data->rt . '/' . $data->rw);
            $sheet->setCellValue('L' . $numrow, $data->dusun . '/' . $data->desa);
            $sheet->setCellValue('M' . $numrow, $data->kecamatan . '/' . $data->kode_pos);
            $sheet->setCellValue('N' . $numrow, $data->tempat_tinggal . '/' . $data->transportasi);
            $sheet->setCellValue('O' . $numrow, $data->anak_keberapa . '/' . $data->golongan);
            $sheet->setCellValue('Q' . $numrow, $data->nama_ayah);
            $sheet->setCellValue('R' . $numrow, $data->temp_ayah);
            $sheet->setCellValue('S' . $numrow, $data->tgl_ayah);
            $sheet->setCellValue('T' . $numrow, $data->pendidikan);
            $sheet->setCellValue('U' . $numrow, $data->pekerjaan);
            $sheet->setCellValue('W' . $numrow, $data->nama_ibu);
            $sheet->setCellValue('X' . $numrow, $data->temp_ibu);
            $sheet->setCellValue('Y' . $numrow, $data->tgl_ibu);
            $sheet->setCellValue('Z' . $numrow, $data->pend_ibu);
            $sheet->setCellValue('AA' . $numrow, $data->pek_ibu);
            $sheet->setCellValue('AC' . $numrow, $data->nama_wali);
            $sheet->setCellValue('AD' . $numrow, $data->temp_wali);
            $sheet->setCellValue('AE' . $numrow, $data->tgl_wali);
            $sheet->setCellValue('AF' . $numrow, $data->pend_wali);
            $sheet->setCellValue('AG' . $numrow, $data->pek_wali);
            $sheet->setCellValue('AI' . $numrow, $data->tinggi_badan);
            $sheet->setCellValue('AJ' . $numrow, $data->berat_badan);
            $sheet->setCellValue('AK' . $numrow, $data->jarak_kesekolah);
            $sheet->setCellValue('AL' . $numrow, $data->waktu_kesekolah);
            $sheet->setCellValue('AM' . $numrow, $data->saudara_kandung);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('U' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('W' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('X' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Y' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Z' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AA' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AC' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AD' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AE' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AF' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AG' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AI' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AJ' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AK' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AL' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AM' . $numrow)->applyFromArray($style_row);





            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(20); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('H')->setWidth(30); // Set width kolom G
        $sheet->getColumnDimension('I')->setWidth(40); // Set width kolom G
        $sheet->getColumnDimension('J')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('K')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('L')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('M')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('N')->setWidth(30); // Set width kolom G
        $sheet->getColumnDimension('O')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Q')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('R')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('S')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('T')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('U')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('W')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('X')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Y')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Z')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AA')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AC')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AD')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AE')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AF')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AG')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AI')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AJ')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AK')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AL')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AM')->setWidth(20); // Set width kolom G




        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function excel1()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $id_user = $_GET['id_user'];
        $sheet->setCellValue('A1', "DATA SISWA YANG SUDAH DI VERIFIKASI DENGAN ID" . $id_user); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "Nama Lengkap"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "Nama Panggilan"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "Tanggal Daftar"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "No Telepon"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "Tahun Ajaran"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "Jenis Kelamin"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('H3', "Tempat Lahir / Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('I3', "Agama / Kewarganegaraan / Berkebutuhan Khusus"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('J3', "Alamat"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('K3', "Rt / Rw"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('L3', "Dusun / Desa"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('M3', "Kecamatan / Kode Pos"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('N3', "Tempat Tinggal / Transportasi"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('O3', "Anak Ke / Golongan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Q3', "Nama Ayah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('R3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('S3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('T3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('U3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('W3', "Nama Ibu"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('X3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Y3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Z3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AA3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AC3', "Nama Wali"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AD3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AE3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AF3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AG3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AI3', "Tinggi Badan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AJ3', "Berat Badan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AK3', "Jarak Kesekolah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AL3', "Waktu Kesekolah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AM3', "Saudara Kandung"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        $sheet->getStyle('I3')->applyFromArray($style_col);
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);
        $sheet->getStyle('L3')->applyFromArray($style_col);
        $sheet->getStyle('M3')->applyFromArray($style_col);
        $sheet->getStyle('N3')->applyFromArray($style_col);
        $sheet->getStyle('O3')->applyFromArray($style_col);
        $sheet->getStyle('Q3')->applyFromArray($style_col);
        $sheet->getStyle('R3')->applyFromArray($style_col);
        $sheet->getStyle('S3')->applyFromArray($style_col);
        $sheet->getStyle('T3')->applyFromArray($style_col);
        $sheet->getStyle('U3')->applyFromArray($style_col);
        $sheet->getStyle('W3')->applyFromArray($style_col);
        $sheet->getStyle('X3')->applyFromArray($style_col);
        $sheet->getStyle('Y3')->applyFromArray($style_col);
        $sheet->getStyle('Z3')->applyFromArray($style_col);
        $sheet->getStyle('AA3')->applyFromArray($style_col);
        $sheet->getStyle('AC3')->applyFromArray($style_col);
        $sheet->getStyle('AD3')->applyFromArray($style_col);
        $sheet->getStyle('AE3')->applyFromArray($style_col);
        $sheet->getStyle('AF3')->applyFromArray($style_col);
        $sheet->getStyle('AG3')->applyFromArray($style_col);
        $sheet->getStyle('AI3')->applyFromArray($style_col);
        $sheet->getStyle('AJ3')->applyFromArray($style_col);
        $sheet->getStyle('AK3')->applyFromArray($style_col);
        $sheet->getStyle('AL3')->applyFromArray($style_col);
        $sheet->getStyle('AM3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $siswa = $this->Mod_user->view_by_siswa($id_user)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //     var_dump($siswa);
        // die();
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->full_name);
            $sheet->setCellValue('C' . $numrow, $data->username);
            $sheet->setCellValue('D' . $numrow, $data->tanggal_daftar);
            $sheet->setCellValue('E' . $numrow, $data->no_tlp);
            $sheet->setCellValue('F' . $numrow, $data->tahun);
            $sheet->setCellValue('G' . $numrow, $data->jenis_kelamin);
            $sheet->setCellValue('H' . $numrow, $data->tempat_lahir . '/' . $data->tanggal_lahir);
            $sheet->setCellValue('I' . $numrow, $data->agama . '/' . $data->kewarganegaraan . '/' . $data->ber_khusus);
            $sheet->setCellValue('J' . $numrow, $data->alamat);
            $sheet->setCellValue('K' . $numrow, $data->rt . '/' . $data->rw);
            $sheet->setCellValue('L' . $numrow, $data->dusun . '/' . $data->desa);
            $sheet->setCellValue('M' . $numrow, $data->kecamatan . '/' . $data->kode_pos);
            $sheet->setCellValue('N' . $numrow, $data->tempat_tinggal . '/' . $data->transportasi);
            $sheet->setCellValue('O' . $numrow, $data->anak_keberapa . '/' . $data->golongan);
            $sheet->setCellValue('Q' . $numrow, $data->nama_ayah);
            $sheet->setCellValue('R' . $numrow, $data->temp_ayah);
            $sheet->setCellValue('S' . $numrow, $data->tgl_ayah);
            $sheet->setCellValue('T' . $numrow, $data->pendidikan);
            $sheet->setCellValue('U' . $numrow, $data->pekerjaan);
            $sheet->setCellValue('W' . $numrow, $data->nama_ibu);
            $sheet->setCellValue('X' . $numrow, $data->temp_ibu);
            $sheet->setCellValue('Y' . $numrow, $data->tgl_ibu);
            $sheet->setCellValue('Z' . $numrow, $data->pend_ibu);
            $sheet->setCellValue('AA' . $numrow, $data->pek_ibu);
            $sheet->setCellValue('AC' . $numrow, $data->nama_wali);
            $sheet->setCellValue('AD' . $numrow, $data->temp_wali);
            $sheet->setCellValue('AE' . $numrow, $data->tgl_wali);
            $sheet->setCellValue('AF' . $numrow, $data->pend_wali);
            $sheet->setCellValue('AG' . $numrow, $data->pek_wali);
            $sheet->setCellValue('AI' . $numrow, $data->tinggi_badan);
            $sheet->setCellValue('AJ' . $numrow, $data->berat_badan);
            $sheet->setCellValue('AK' . $numrow, $data->jarak_kesekolah);
            $sheet->setCellValue('AL' . $numrow, $data->waktu_kesekolah);
            $sheet->setCellValue('AM' . $numrow, $data->saudara_kandung);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('U' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('W' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('X' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Y' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Z' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AA' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AC' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AD' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AE' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AF' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AG' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AI' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AJ' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AK' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AL' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AM' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(20); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('H')->setWidth(30); // Set width kolom G
        $sheet->getColumnDimension('I')->setWidth(40); // Set width kolom G
        $sheet->getColumnDimension('J')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('K')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('L')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('M')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('N')->setWidth(30); // Set width kolom G
        $sheet->getColumnDimension('O')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Q')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('R')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('S')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('T')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('U')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('W')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('X')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Y')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Z')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AA')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AC')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AD')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AE')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AF')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AG')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AI')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AJ')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AK')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AL')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AM')->setWidth(20); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function excel2()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $golongan = $_GET['golongan'];
        $sheet->setCellValue('A1', "DATA SISWA YANG SUDAH DI VERIFIKASI DENGAN GOLONGAN " . $golongan); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "Nama Lengkap"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "Nama Panggilan"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "Tanggal Daftar"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "No Telepon"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "Tahun Ajaran"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "Jenis Kelamin"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('H3', "Tempat Lahir / Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('I3', "Agama / Kewarganegaraan / Berkebutuhan Khusus"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('J3', "Alamat"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('K3', "Rt / Rw"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('L3', "Dusun / Desa"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('M3', "Kecamatan / Kode Pos"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('N3', "Tempat Tinggal / Transportasi"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('O3', "Anak Ke / Golongan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Q3', "Nama Ayah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('R3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('S3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('T3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('U3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('W3', "Nama Ibu"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('X3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Y3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Z3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AA3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AC3', "Nama Wali"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AD3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AE3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AF3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AG3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AI3', "Tinggi Badan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AJ3', "Berat Badan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AK3', "Jarak Kesekolah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AL3', "Waktu Kesekolah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AM3', "Saudara Kandung"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        $sheet->getStyle('I3')->applyFromArray($style_col);
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);
        $sheet->getStyle('L3')->applyFromArray($style_col);
        $sheet->getStyle('M3')->applyFromArray($style_col);
        $sheet->getStyle('N3')->applyFromArray($style_col);
        $sheet->getStyle('O3')->applyFromArray($style_col);
        $sheet->getStyle('Q3')->applyFromArray($style_col);
        $sheet->getStyle('R3')->applyFromArray($style_col);
        $sheet->getStyle('S3')->applyFromArray($style_col);
        $sheet->getStyle('T3')->applyFromArray($style_col);
        $sheet->getStyle('U3')->applyFromArray($style_col);
        $sheet->getStyle('W3')->applyFromArray($style_col);
        $sheet->getStyle('X3')->applyFromArray($style_col);
        $sheet->getStyle('Y3')->applyFromArray($style_col);
        $sheet->getStyle('Z3')->applyFromArray($style_col);
        $sheet->getStyle('AA3')->applyFromArray($style_col);
        $sheet->getStyle('AC3')->applyFromArray($style_col);
        $sheet->getStyle('AD3')->applyFromArray($style_col);
        $sheet->getStyle('AE3')->applyFromArray($style_col);
        $sheet->getStyle('AF3')->applyFromArray($style_col);
        $sheet->getStyle('AG3')->applyFromArray($style_col);
        $sheet->getStyle('AI3')->applyFromArray($style_col);
        $sheet->getStyle('AJ3')->applyFromArray($style_col);
        $sheet->getStyle('AK3')->applyFromArray($style_col);
        $sheet->getStyle('AL3')->applyFromArray($style_col);
        $sheet->getStyle('AM3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $siswa = $this->Mod_user->view_by_golongan($golongan)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //     var_dump($siswa);
        // die();
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->full_name);
            $sheet->setCellValue('C' . $numrow, $data->username);
            $sheet->setCellValue('D' . $numrow, $data->tanggal_daftar);
            $sheet->setCellValue('E' . $numrow, $data->no_tlp);
            $sheet->setCellValue('F' . $numrow, $data->tahun);
            $sheet->setCellValue('G' . $numrow, $data->jenis_kelamin);
            $sheet->setCellValue('H' . $numrow, $data->tempat_lahir . '/' . $data->tanggal_lahir);
            $sheet->setCellValue('I' . $numrow, $data->agama . '/' . $data->kewarganegaraan . '/' . $data->ber_khusus);
            $sheet->setCellValue('J' . $numrow, $data->alamat);
            $sheet->setCellValue('K' . $numrow, $data->rt . '/' . $data->rw);
            $sheet->setCellValue('L' . $numrow, $data->dusun . '/' . $data->desa);
            $sheet->setCellValue('M' . $numrow, $data->kecamatan . '/' . $data->kode_pos);
            $sheet->setCellValue('N' . $numrow, $data->tempat_tinggal . '/' . $data->transportasi);
            $sheet->setCellValue('O' . $numrow, $data->anak_keberapa . '/' . $data->golongan);
            $sheet->setCellValue('Q' . $numrow, $data->nama_ayah);
            $sheet->setCellValue('R' . $numrow, $data->temp_ayah);
            $sheet->setCellValue('S' . $numrow, $data->tgl_ayah);
            $sheet->setCellValue('T' . $numrow, $data->pendidikan);
            $sheet->setCellValue('U' . $numrow, $data->pekerjaan);
            $sheet->setCellValue('W' . $numrow, $data->nama_ibu);
            $sheet->setCellValue('X' . $numrow, $data->temp_ibu);
            $sheet->setCellValue('Y' . $numrow, $data->tgl_ibu);
            $sheet->setCellValue('Z' . $numrow, $data->pend_ibu);
            $sheet->setCellValue('AA' . $numrow, $data->pek_ibu);
            $sheet->setCellValue('AC' . $numrow, $data->nama_wali);
            $sheet->setCellValue('AD' . $numrow, $data->temp_wali);
            $sheet->setCellValue('AE' . $numrow, $data->tgl_wali);
            $sheet->setCellValue('AF' . $numrow, $data->pend_wali);
            $sheet->setCellValue('AG' . $numrow, $data->pek_wali);
            $sheet->setCellValue('AI' . $numrow, $data->tinggi_badan);
            $sheet->setCellValue('AJ' . $numrow, $data->berat_badan);
            $sheet->setCellValue('AK' . $numrow, $data->jarak_kesekolah);
            $sheet->setCellValue('AL' . $numrow, $data->waktu_kesekolah);
            $sheet->setCellValue('AM' . $numrow, $data->saudara_kandung);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('U' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('W' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('X' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Y' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Z' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AA' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AC' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AD' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AE' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AF' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AG' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AI' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AJ' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AK' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AL' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AM' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(20); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('H')->setWidth(30); // Set width kolom G
        $sheet->getColumnDimension('I')->setWidth(40); // Set width kolom G
        $sheet->getColumnDimension('J')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('K')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('L')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('M')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('N')->setWidth(30); // Set width kolom G
        $sheet->getColumnDimension('O')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Q')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('R')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('S')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('T')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('U')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('W')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('X')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Y')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Z')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AA')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AC')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AD')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AE')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AF')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AG')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AI')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AJ')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AK')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AL')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AM')->setWidth(20); // Set width kolom G
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function excel3()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $tahun_ajaran = $_GET['tahun_ajaran'];
        $sheet->setCellValue('A1', "DATA SISWA YANG SUDAH DI VERIFIKASI DENGAN ID TAHUN " . $tahun_ajaran); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "Nama Lengkap"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "Nama Panggilan"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "Tanggal Daftar"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "No Telepon"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "Tahun Ajaran"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "Jenis Kelamin"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('H3', "Tempat Lahir / Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('I3', "Agama / Kewarganegaraan / Berkebutuhan Khusus"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('J3', "Alamat"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('K3', "Rt / Rw"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('L3', "Dusun / Desa"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('M3', "Kecamatan / Kode Pos"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('N3', "Tempat Tinggal / Transportasi"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('O3', "Anak Ke / Golongan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Q3', "Nama Ayah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('R3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('S3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('T3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('U3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('W3', "Nama Ibu"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('X3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Y3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('Z3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AA3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AC3', "Nama Wali"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AD3', "Tempat Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AE3', "Tanggal Lahir"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AF3', "Pendidikan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AG3', "Pekerjaan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AI3', "Tinggi Badan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AJ3', "Berat Badan"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AK3', "Jarak Kesekolah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AL3', "Waktu Kesekolah"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('AM3', "Saudara Kandung"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        $sheet->getStyle('I3')->applyFromArray($style_col);
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);
        $sheet->getStyle('L3')->applyFromArray($style_col);
        $sheet->getStyle('M3')->applyFromArray($style_col);
        $sheet->getStyle('N3')->applyFromArray($style_col);
        $sheet->getStyle('O3')->applyFromArray($style_col);
        $sheet->getStyle('Q3')->applyFromArray($style_col);
        $sheet->getStyle('R3')->applyFromArray($style_col);
        $sheet->getStyle('S3')->applyFromArray($style_col);
        $sheet->getStyle('T3')->applyFromArray($style_col);
        $sheet->getStyle('U3')->applyFromArray($style_col);
        $sheet->getStyle('W3')->applyFromArray($style_col);
        $sheet->getStyle('X3')->applyFromArray($style_col);
        $sheet->getStyle('Y3')->applyFromArray($style_col);
        $sheet->getStyle('Z3')->applyFromArray($style_col);
        $sheet->getStyle('AA3')->applyFromArray($style_col);
        $sheet->getStyle('AC3')->applyFromArray($style_col);
        $sheet->getStyle('AD3')->applyFromArray($style_col);
        $sheet->getStyle('AE3')->applyFromArray($style_col);
        $sheet->getStyle('AF3')->applyFromArray($style_col);
        $sheet->getStyle('AG3')->applyFromArray($style_col);
        $sheet->getStyle('AI3')->applyFromArray($style_col);
        $sheet->getStyle('AJ3')->applyFromArray($style_col);
        $sheet->getStyle('AK3')->applyFromArray($style_col);
        $sheet->getStyle('AL3')->applyFromArray($style_col);
        $sheet->getStyle('AM3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $siswa = $this->Mod_user->view_by_tahun_ajaran($tahun_ajaran)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //     var_dump($siswa);
        // die();
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->full_name);
            $sheet->setCellValue('C' . $numrow, $data->username);
            $sheet->setCellValue('D' . $numrow, $data->tanggal_daftar);
            $sheet->setCellValue('E' . $numrow, $data->no_tlp);
            $sheet->setCellValue('F' . $numrow, $data->tahun);
            $sheet->setCellValue('G' . $numrow, $data->jenis_kelamin);
            $sheet->setCellValue('H' . $numrow, $data->tempat_lahir . '/' . $data->tanggal_lahir);
            $sheet->setCellValue('I' . $numrow, $data->agama . '/' . $data->kewarganegaraan . '/' . $data->ber_khusus);
            $sheet->setCellValue('J' . $numrow, $data->alamat);
            $sheet->setCellValue('K' . $numrow, $data->rt . '/' . $data->rw);
            $sheet->setCellValue('L' . $numrow, $data->dusun . '/' . $data->desa);
            $sheet->setCellValue('M' . $numrow, $data->kecamatan . '/' . $data->kode_pos);
            $sheet->setCellValue('N' . $numrow, $data->tempat_tinggal . '/' . $data->transportasi);
            $sheet->setCellValue('O' . $numrow, $data->anak_keberapa . '/' . $data->golongan);
            $sheet->setCellValue('Q' . $numrow, $data->nama_ayah);
            $sheet->setCellValue('R' . $numrow, $data->temp_ayah);
            $sheet->setCellValue('S' . $numrow, $data->tgl_ayah);
            $sheet->setCellValue('T' . $numrow, $data->pendidikan);
            $sheet->setCellValue('U' . $numrow, $data->pekerjaan);
            $sheet->setCellValue('W' . $numrow, $data->nama_ibu);
            $sheet->setCellValue('X' . $numrow, $data->temp_ibu);
            $sheet->setCellValue('Y' . $numrow, $data->tgl_ibu);
            $sheet->setCellValue('Z' . $numrow, $data->pend_ibu);
            $sheet->setCellValue('AA' . $numrow, $data->pek_ibu);
            $sheet->setCellValue('AC' . $numrow, $data->nama_wali);
            $sheet->setCellValue('AD' . $numrow, $data->temp_wali);
            $sheet->setCellValue('AE' . $numrow, $data->tgl_wali);
            $sheet->setCellValue('AF' . $numrow, $data->pend_wali);
            $sheet->setCellValue('AG' . $numrow, $data->pek_wali);
            $sheet->setCellValue('AI' . $numrow, $data->tinggi_badan);
            $sheet->setCellValue('AJ' . $numrow, $data->berat_badan);
            $sheet->setCellValue('AK' . $numrow, $data->jarak_kesekolah);
            $sheet->setCellValue('AL' . $numrow, $data->waktu_kesekolah);
            $sheet->setCellValue('AM' . $numrow, $data->saudara_kandung);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('U' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('W' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('X' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Y' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Z' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AA' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AC' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AD' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AE' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AF' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AG' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AI' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AJ' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AK' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AL' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AM' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(20); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('H')->setWidth(30); // Set width kolom G
        $sheet->getColumnDimension('I')->setWidth(40); // Set width kolom G
        $sheet->getColumnDimension('J')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('K')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('L')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('M')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('N')->setWidth(30); // Set width kolom G
        $sheet->getColumnDimension('O')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Q')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('R')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('S')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('T')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('U')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('W')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('X')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Y')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('Z')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AA')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AC')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AD')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AE')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AF')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AG')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AI')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AJ')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AK')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AL')->setWidth(20); // Set width kolom G
        $sheet->getColumnDimension('AM')->setWidth(20); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function data_siswa()
    {
        $user = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $id = $user['id_user'];
        $data['title'] = "Detail Data Siswa";
        $data['detail_siswa'] = $this->Mod_user->siswa_all($id)->result();
        $data['priodik'] = $this->Mod_user->priodik($id)->result();
        $data['ayah'] = $this->Mod_user->ayah($id)->result();
        $data['ibu'] = $this->Mod_user->ibu($id)->result();
        $data['wali'] = $this->Mod_user->wali($id)->result();
        $data['get_id'] = $this->Mod_user->siswa_all($id)->row();

        // dead($id);
        $this->template->load('layoutbackend', 'admin/data_siswa', $data);
    }

    public function reset_password()
    {
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('current_password', 'Password saat ini', 'required|trim');
        $this->form_validation->set_rules('new_password', 'Password baru', 'required|trim|min_length[6]|matches[konfirmasi_password]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi password', 'required|trim|min_length[6]|matches[new_password]');

        if ($this->form_validation->run() == false) {
            $this->template->load('layoutbackend', 'admin/reset_password', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Password Saat Ini Salah',
                    icon: 'error'
                    });
                </script>");
                redirect('admin/reset_password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('success', "<script>
                    swal({
                    text: ' Password baru tidak boleh sama dengan saat ini !',
                    icon: 'warning'
                    });
                </script>");

                    redirect('admin/reset_password');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('id_user', $this->session->userdata('id_user'));
                    $this->db->update('tbl_user');
                    $this->session->set_flashdata('success', "<script>
                    swal({
                    text: ' Password berhasil diubah !',
                    icon: 'success'
                    });
                </script>");
                    redirect('admin/reset_password');
                }
            }
        }
    }

    public function backup_data()
    {
        $data['title'] = "User Data";
        // dead($data);
        $this->template->load('layoutbackend', 'admin/backup_data');
    }
    public function backup()
    {
        $this->load->helper('download');
        $this->load->dbutil();
        $data['setting_school'] = "DATA";
        $prefs = [
            'format' => 'zip',
            'filename' => $data['setting_school'] . '-' . date("Y-m-d H-i-s") . '.sql'
        ];
        $backup = $this->dbutil->backup($prefs);
        $file_name = $data['setting_school'] . '-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->download($file_name);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('full_name') == '') {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Full Name is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
