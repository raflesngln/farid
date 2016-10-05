<?php
class Karyawan_login extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->model('my_model');
    }

    function index(){
        $data=array(
            'title'=>'Login Karyawan'
        );
        $this->load->view('karyawan/v_login',$data);
    }

    function cek_karyawan() {

        $nik =mysql_escape_string($this->input->post('nik'));
        $password =  mysql_escape_string(sha1($this->input->post('pass')));
        //query the database
        $result = $this->my_model->login_karyawan('karyawan',$nik, $password);
        if($result) {
            $sess_array = array();
            foreach($result as $row) {
                //create the session
                $sess_array = array(
                    'idkarya' => $row->id_karyawan,
                    'usrkarya' => $row->nik,
                    'passkarya'=>$row->password,
                    'namekarya'=>$row->nama,
					'imgkarya'=>$row->picture,
					'emailkarya'=>$row->email,
                    'login_karya'=>true,
                );
                //set session with value from database
                $this->session->set_userdata($sess_array);
                redirect('dashboard/karyawan_dashboard');
            }
            return TRUE;
        } else {
            //if form validate false
          $data=array(
            'message'=>'Nik and passsword did not match, Try again !'
        	);
        $this->load->view('karyawan/v_login',$data);
            return FALSE;
        }
    }

    function logout() {
        $this->session->unset_userdata('idkarya');
        $this->session->unset_userdata('usrkarya');
        $this->session->unset_userdata('passkarya');
        $this->session->unset_userdata('namekarya');
		$this->session->unset_userdata('imgkarya');
		$this->session->unset_userdata('emailkarya');
        $this->session->unset_userdata('login_karya');
        $this->session->set_flashdata('notif','THANK YOU FOR LOGIN IN THIS APP');
        redirect('karyawan_login');
    }
}
