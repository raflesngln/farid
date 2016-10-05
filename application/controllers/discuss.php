<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discuss extends CI_Controller {

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

    function index(){	
	$kategori=$this->my_model->getdata5("b.id_diskusi,a.id_kategori,a.kategori,count(b.id_kategori) as jml",'kategori a'," LEFT join diskusi b on a.id_kategori=b.id_kategori group by a.id_kategori");
		  $data=array(
		  'title'=>'<i class="fa fa-comment"></i> Diskusi Category',
		  'list'=>$kategori,
		  'view'=>'admin/v_discuss'
		  );
		
	      $this->load->view('admin/home/home',$data);
	}

public function ajax_list()
	{
		$nm_tabel='materi a';
		$nm_tabel2='kategori b';
		$kolom1='a.id_kategori';
		$kolom2='b.id_kategori';
		
        $nm_coloum= array('a.id_materi','a.judul_materi','a.ket_materi','b.kategori');
        $orderby= array('a.id_materi' => 'desc');
        $where=  array();
        $list = $this->m_department->get_datatables($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
            'id_materi' => $datalist->id_materi,
            'judul_materi' => $datalist->judul_materi,
            'ket_materi' =>$datalist->ket_materi,
			'kategori' =>$datalist->kategori,
			'tgl_update' =>$datalist->tgl_update,
			
            'action'=> '<div style="text-align:center"><a class="green" href="javascript:void()" title="Edit" onclick="edit_data('."'".$datalist->id_materi."'".')"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
				    <a class="red" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$datalist->id_materi."'".')"><i class="fa fa-trash"></i></a></div>'
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_department->count_all($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->m_department->count_filtered($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
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
	    $nmtabel='materi';
		$data = array(
				'judul_materi' => $this->input->post('judul_materi'),
				'ket_materi' => $this->input->post('ket_materi'),
				'createby' => $this->session->userdata('idusr'),
			);
		$insert = $this->m_department->save($data,$nmtabel);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
	    $nmtabel='materi';
        $key='id_materi';
		$data = array(
				'judul_materi' => $this->input->post('judul_materi'),
				'ket_materi' => $this->input->post('ket_materi'),
				'createby' => $this->session->userdata('idusr'),
			);
		$this->m_department->update(array($key => $this->input->post('id_materi')), $data,$nmtabel);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete()
	{
	   $id     = $this->input->post('cid');
       $nmtabel= $this->input->post('cnmtabel');
       $key    = $this->input->post('ckeytabel');
       
		$this->m_department->delete_by_id($id,$nmtabel,$key);
		echo json_encode(array("status" => TRUE));
	}
	public function countRecord()
	{
		$id=$this->input->post('idkategori');
		
			$diskusi=$this->my_model->countRecord($id);
			foreach($diskusi as $row){
				echo $row->jml;
			}	
	}	
	 //--VIEW MASTER USER
function list_discuss(){  
	 $nik=$this->session->userdata('usrkarya');
	 $kategori=$this->input->post('idkategori');
	 $kode_flash=$this->session->flashdata('kode_flash');
	 $idkategori=($kategori=="")?$kode_flash:$kategori;
	 
	 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$kolom='a.id_pesan,a.id_penerima,a.id_pengirim,a.pesan,a.lampiran,a.tgl_kirim,a.dilihat,b.nik,b.nama as pengirim,b.id_karyawan';
        $data['title']='<i class="fa fa-comment"></i> Diskusi';
		$data['link']='<a href="'.base_url().'Home_karyawan/view_message">Data Pesan</a>';
		$data['list']=$this->my_model->getdata5("a.id_diskusi,a.judul_diskusi,a.ket_diskusi,a.tgl_dibuat,a.aktif,a.createby,b.id_user",'diskusi a'," LEFT join user b on a.createby=b.id_user WHERE a.id_kategori='$idkategori' order by a.id_diskusi DESC");
					  
		$tot_hal = $this->my_model->hitung_isi_tabel('*','diskusi a',"LEFT join user b on a.createby=b.id_user WHERE a.id_kategori='$idkategori' order by a.id_diskusi");
        					//create for pagination		
			$config['base_url'] = base_url() . 'Home_karyawan/view_karyawan/';
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
	    	$config['first_link'] = 'First';
			$config['last_link'] = 'last';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
       		$this->pagination->initialize($config);
			$data["paginator"] =$this->pagination->create_links();
		
		$data['view']='admin/v_list_discuss';
        $this->load->view('admin/home/home',$data);
     } 
	 //--VIEW MASTER USER
function detail_discuss(){  
	 $nik=$this->session->userdata('usrkarya');
	 $id_discuss=$this->input->post('id_discuss');

	 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$kolom='a.id_pesan,a.id_penerima,a.id_pengirim,a.pesan,a.lampiran,a.tgl_kirim,a.dilihat,b.nik,b.nama as pengirim,b.id_karyawan';
        $data['title']='<i class="fa fa-envelope"></i> Message';
		$data['judul']=$this->my_model->getdata5("a.id_diskusi,a.judul_diskusi,a.ket_diskusi",'diskusi a',"WHERE id_diskusi='$id_discuss' LIMIT 1");
		$data['list']=$this->my_model->getdata5("a.id_diskusi_detail,a.id_diskusi,a.komentar,a.tgl_dibuat,b.judul_diskusi,b.ket_diskusi,c.nama,c.picture",'diskusi_detail a'," LEFT join diskusi b on a.id_diskusi=b.id_diskusi 
		INNER JOIN karyawan c on a.id_karyawan=c.nik
		WHERE a.id_diskusi='$id_discuss' order by a.id_diskusi");
					  
		$tot_hal = $this->my_model->hitung_isi_tabel('*','diskusi_detail a',"LEFT join diskusi b on a.id_diskusi=b.id_diskusi 
					INNER JOIN karyawan c on a.id_karyawan=c.nik
		           WHERE a.id_diskusi='$id_diskusi' order by a.id_diskusi");
        					//create for pagination		
			$config['base_url'] = base_url() . 'Home_karyawan/view_karyawan/';
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
	    	$config['first_link'] = 'First';
			$config['last_link'] = 'last';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
       		$this->pagination->initialize($config);
			$data["paginator"] =$this->pagination->create_links();
		
		$data['view']='admin/v_detail_discuss';
        $this->load->view('admin/home/home',$data);

     } 
function add_thread(){
		$data=array(
		  'crumb'=>'add_thread',
		  'title'=>'<i class="fa fa-plus"></i> Add Thread',
		  'view'=>'admin/add_thread'
		  );
	      $this->load->view('admin/home/home',$data);
	}

 function save_discuss(){
	 $judul=$this->input->post('judul');
	 $kategori=$this->input->post('kategori');
	 $ket=$this->input->post('ket');
	 $status=$this->input->post('status');
	 $id_session=$this->session->userdata('usrkarya');
	 
	 
	 $data=array(
	 'judul_diskusi'=>$judul,
	 'ket_diskusi'=>$ket,
	 'id_kategori'=>$kategori,
	 'tgl_dibuat'=>date('Y-m-d H:i:s'),
	 'aktif'=>$status,
	 'createby'=>$id_session,
	 );
	$save=$this->my_model->insert('diskusi',$data);
	$this->session->set_flashdata('kode_flash', $kategori);	
	 redirect('discuss/list_discuss'); 
 }
	
	
}
