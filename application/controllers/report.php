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

function discuss_report(){
       	  $data=array(
		  'title'=>' discuss_report',
		  'title'=>'<i class="fa fa-print"></i> discuss',
		  'kategori'=>$this->my_model->getdata('kategori',"order by kategori"),
		  'view'=>'admin/report/discuss_report'
		  );
	      $this->load->view('admin/home/home',$data);
	}
function print_diskusi(){
	$kategori=$this->input->post('kategori');
	$pecah=explode('.',$this->input->post('kategori'));
	$idkategori=$pecah[0];
	$nmkategori=$pecah[1];
	
	$tgl1=$this->input->post('tgl1');
	$tgl2=$this->input->post('tgl2');
	
	if($kategori=='all'){
		$kondisi='';
		$status='Semua Devisi';
	} else {
		$kondisi="AND a.id_kategori='$kategori'";
		$status=$nmkategori;
	}
	$data = array(
			'periode'=>date('d-m-Y',strtotime($tgl1)).'  s/d  '.date('d-m-Y',strtotime($tgl2)),
			'status'=>$status,
			'periode'=>date('d-m-Y',strtotime($tgl1)).' s/d '.date('d-m-Y',strtotime($tgl2)),
			'list'=>$this->my_model->getdata('diskusi a',
			"LEFT JOIN kategori b on a.id_kategori=b.id_kategori
			WHERE LEFT(a.tgl_dibuat,10) BETWEEN '$tgl1' AND '$tgl2' $kondisi
			order by a.id_diskusi"),
        );  
		
        ob_start();
        $content = $this->load->view('admin/report/print_discuss',$data);
        $content = ob_get_clean();      
        $this->load->library('html2pdf');
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('Discuss Report.pdf');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }

}
	
	
	
}
