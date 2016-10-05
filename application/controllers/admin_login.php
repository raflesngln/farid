<?php
class Admin_login extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->model('my_model');
    }

    function index(){
        $data=array(
            'title'=>'Login Administrator'
        );
        $this->load->view('admin/v_login',$data);
    }

    function cek_admin() {

        $nik =$this->input->post('user');
        $password =  sha1($this->input->post('pass'));
        //query the database
        $result = $this->my_model->login_admin('karyawan',$nik, $password);
        if($result) {
            $sess_array = array();
            foreach($result as $row) {
                //create the session
                $sess_array = array(
                    'idusr' => $row->id_karyawan,
                    'nikuser' => $row->nik,
                    'passuser'=>$row->password,
                    'nameuser'=>$row->nama,
					'level_admin'=>$row->level,
					'picuser'=>$row->picture,
					'emailuser'=>$row->email,
                    'login_status'=>true,
                );
                //set session with value from database
                $this->session->set_userdata($sess_array);
                redirect('dashboard/admin_dashboard');
            }
            return TRUE;
        } else {
            //if form validate false
          $data=array(
            'message'=>'Nik and passsword no match, Try again !'
        	);
            $this->load->view('admin/v_login',$data);
            return FALSE;
        }
    }

    function logout() {
        $this->session->unset_userdata('idusr');
        $this->session->unset_userdata('nikuser');
        $this->session->unset_userdata('passuser');
        $this->session->unset_userdata('nameuser');
		$this->session->unset_userdata('picuser');
		$this->session->unset_userdata('emailuser');
		$this->session->unset_userdata('level_admin');
        $this->session->unset_userdata('login_status');
        $this->session->set_flashdata('notif','THANK YOU FOR LOGIN IN THIS APP');
        redirect('admin_login');
    }
}
