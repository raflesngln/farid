<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('admin_login');
            }
		$this->load->model('m_department');
		$this->load->model('my_model');
	}

public function ajax_edit()
	{
	   	$id_materi= $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $key    = $this->input->post('ckeytabel');
		$data = $this->m_department->get_by_id($id_materi,$nmtabel,$key);
		echo json_encode($data);
	}
	public function ajax_add()
	{   
	$username = $this->input->post('nik');
	$folder='./asset/images/materi/';
		$tmp  = $_FILES['myfile']['tmp_name'];
		$myfile=$_FILES['myfile']['name'];
	    $nmtabel='materi';
		
			 $message='Data berhasil disimpan !';
			$label='success';
			$icon='check'; 
		    $data = array(
				'judul_materi' => $this->input->post('nama'),
				'id_kategori' => $this->input->post('kat'),
				'ket_materi' => $this->input->post('ket'),
				'file_path' => $myfile,
				'tgl_update' => date('Y-m-d'),
				'createby' => $this->session->userdata('nikuser'),
			);
		     $simpan = $this->my_model->insert($nmtabel,$data);
		     move_uploaded_file($tmp,$folder.$myfile);
		 
		  $msg=array(
		  'crumb'=>'materi',
		  'title'=>'materi',
		  'message'=>$message,
		  'label'=>$label,'icon'=>$icon,
		  'view'=>'admin/v_materi'
		  );
		$this->load->view('admin/home/home',$msg);
}
	public function ajax_update()
	{	$id=$this->input->post('idmateri');
		$folder='./asset/images/materi/';
		$tmp  = $_FILES['myfile']['tmp_name'];
		$oldpic=$this->input->post('oldpic');
		$myfile=$_FILES['myfile']['name'];
		if(!empty($myfile)){
		$image=$myfile;
		move_uploaded_file($tmp,$folder.$myfile);
		unlink('./asset/images/materi/'.$oldpic);
	} else {
		$image=$oldpic;
	}

		$data = array(
				'judul_materi' => $this->input->post('nama2'),
				'id_kategori' => $this->input->post('kat2'),
				'ket_materi' => $this->input->post('ket2'),
				'file_path' => $image,
				'tgl_update' => date('Y-m-d'),
				'createby' => $this->session->userdata('nikuser'),
			);
		$this->my_model->update("materi","id_materi",$id,$data);
		redirect('materi');
	}



	public function ajax_delete()
	{
	   $id     = $this->input->post('cid');
       $nmtabel= $this->input->post('cnmtabel');
       $key    = $this->input->post('ckeytabel');
       
		$this->m_department->delete_by_id($id,$nmtabel,$key);
		echo json_encode(array("status" => TRUE));
	}
	
  function getkategori(){
	  	
      $result=$cek=$this->my_model->getdata('kategori',"order by id_kategori");
	  echo'<option value="">Pilih kategori</option>';
	if($result)
	{
	foreach($result as $data){
	echo'<option value="'.$data->id_kategori.'">'.$data->kategori.'</option>';
		
		}	
	}  
}
function karyawan_report(){
       	  $data=array(
		  'title'=>' karyawan_report',
		  'title'=>'<i class="fa fa-print"></i> Print Karyawan',
		  'kategori'=>$this->my_model->getdata('kategori',"order by kategori"),
		  'view'=>'admin/report/karyawan_report'
		  );
	      $this->load->view('admin/home/home',$data);
	}
function print_karyawan(){
	$kategori=$this->input->post('kategori');
	$pecah=explode("#",$kategori);
	$idkategori=$pecah[0];
	$nmkategori=$pecah[1];
	if($kategori=='all'){
		$where='';
		$status='Semua Devisi';
	} else {
		$where="WHERE b.id_kategori='$idkategori'";
		$status=$nmkategori;
	}
	$data = array(
			'periode'=>date('d-m-Y',strtotime($tgl1)).'  s/d  '.date('d-m-Y',strtotime($tgl2)),
			'status'=>$status,
			'list'=>$this->my_model->getdata('karyawan a',
			"LEFT JOIN jabatan b on a.id_jabatan=b.id_jabatan
			$where
			order by a.nama"),
        );  
		
        ob_start();
        $content = $this->load->view('admin/report/print_karyawan',$data);
        $content = ob_get_clean();      
        $this->load->library('html2pdf');
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('Karyawan Report.pdf');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }

}
	
	
	
}
