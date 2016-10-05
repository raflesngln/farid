<?php
class Setting_profil extends CI_Controller{
    function __construct(){
        parent::__construct();
			if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('');
            }		
	   $this->load->helper(array('form', 'url'));
       $this->load->model('m_karyawan');
	   $this->load->model('my_model');
    }

    function reset_admin(){
		$nik=$this->session->userdata('nikuser');
		$nameuser=$this->session->userdata('nameuser');
       	  $data=array(
		  'crumb'=>'Setting Profile',
		  'title'=>'Setting Profile',
		  'title'=>'<i class="fa fa-cog"></i> Setting Profile',
		  'userprofil'=>$this->my_model->getdata('karyawan',"WHERE nik='$nik'"),
		  'view'=>'admin/form_setting_profil'
		  );
	      $this->load->view('admin/home/home',$data);
	}
	    function reset_user(){
       	  $data=array(
		  'crumb'=>'karyawan',
		  'title'=>' Data Karyawan',
		  'view'=>'admin/v_karyawan'
		  );
	      $this->load->view('admin/home/home',$data);
	}	

 function change_profil_admin(){
	$id_session=$this->session->userdata('nikuser');
	$folder='./asset/images/karyawan/';
	$oldpic=$this->input->post('oldpic');
	$gbr=$_FILES['gambar']['name'];
	$tmp  = $_FILES['gambar']['tmp_name'];
	if(!empty($gbr)){
		$image=$gbr;
		move_uploaded_file($tmp,$folder.$gbr);
		unlink('./asset/images/karyawan/'.$oldpic);
	} else {
		$image=$oldpic;
	}
	
 	$iduser=$this->input->post('iduser');
 	$old=$this->input->post('old');
 	$pass=sha1($this->input->post('old'));
 	$new=$this->input->post('new');
 	$retype=$this->input->post('retype');
 	$username=$this->input->post('username');

 	if($old==""){
// if not change password
 		$update=array(
		'nama'=>$this->input->post('name'),
		'email'=>$this->input->post('email'),
		'picture'=>$image,
		);
		  $message='Profil Change Succesfull !';
		  $label='success';$icon='check';
		  $this->my_model->update('karyawan','nik',$iduser,$update);
     	}
 	 else  {
 		   $cek=$this->my_model->getdata('karyawan',"WHERE password='$pass' AND nik='$iduser'");
 			if($cek){
 				
 				if($new==$retype AND !empty($new)){
		//if new password same n not empty
 		$update=array(
		'nama'=>$this->input->post('name'),
		'email'=>$this->input->post('email'),
		'picture'=>$image,
		'password'=>sha1($new),
		);
		$message='Profil and Password Change Succesfull !';
		$label='success';$icon='check';
		$this->my_model->update('karyawan','nik',$iduser,$update);
		//if new password not same
 				} else {
 				
				$message='Password Baru Anda tidak sama atau masih kosong.Mohon ulangi !';
				$label='warning';$icon='times';
 				}
 			} else {
				
				$message='Password Lama Anda Salah !';
				$label='warning';$icon='times';
 			}
 		}
		   $data=array(
		  'crumb'=>'Setting Profile',
		  'title'=>'profil_admin',
		  'userprofil'=>$this->my_model->getdata('karyawan',"WHERE nik='$id_session'"),
		  'message'=>$message,
		  'label'=>$label,'icon'=>$icon,
		  'view'=>'admin/form_setting_profil'
		  );
     	   $this->load->view('admin/home/home',$data);

}



}
