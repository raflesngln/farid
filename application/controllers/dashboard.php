<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('m_karyawan'); 
    }
    function admin_dashboard(){
	   if($this->session->userdata('login_status') != TRUE){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('admin_login');
        } else {
       	  $data=array(
		  'crumb'=>'web',
		  'title'=>'Welcome ',
		  'view'=>'admin/home/welcome'
		  );
	      $this->load->view('admin/home/home',$data);
	}
}
	function karyawan_dashboard(){
	    if($this->session->userdata('login_karya') != TRUE){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('karyawan_login');
        } else {
       	  redirect('home_karyawan');
	}	
	
}

}
