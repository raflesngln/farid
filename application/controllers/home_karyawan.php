<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_karyawan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','You Must Login First !');
            redirect('');
            }
		$this->load->model('m_karyawan');
		$this->load->model('my_model');
	}

    function index(){
		$data=array(
		  'crumb'=>'web',
		  'title'=>'Welcome User',
		  'view'=>'admin/home/welcome'
		  );
	      $this->load->view('admin/home/home',$data);
	}
	 //--VIEW MASTER USER
function view_karyawan(){  
	 $idkategori=$this->input->post('idkategori');
	  $id_jabatan=$this->input->post('id_jabatan');
	 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
        $data['title']='<i class="fa fa-users"></i> Data Karyawan';
		$data['link']='<a href="'.base_url().'Home_karyawan/view_karyawan">Data User</a>';
		$data['user']=$this->my_model->getdatapaging('*','karyawan',"");
		$data['list']=$this->my_model->getdata('karyawan a',"LEFT JOIN jabatan b on a.id_jabatan=b.id_jabatan
					  LEFT JOIN kategori c on b.id_kategori=c.id_kategori 
					  WHERE c.id_kategori='$idkategori'
					  ORDER by a.nama ASC LIMIT $offset,$limit");
		$tot_hal = $this->my_model->hitung_isi_tabel('*','karyawan a',"INNER JOIN jabatan b on a.id_jabatan=b.id_jabatan 
					  INNER JOIN kategori c on a.id_kategori=c.id_kategori 
					  WHERE c.id_kategori='$idkategori'
					  ORDER by a.nama ASC");
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
		
		$data['view']='admin/staff/view_user';
        $this->load->view('admin/home/home',$data);
     } 
	 //--VIEW MASTER USER
function view_message(){  
	 $nik=$this->session->userdata('nikuser');
	 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$kolom='a.id_pesan,a.id_penerima,a.id_pengirim,a.pesan,a.lampiran,a.tgl_kirim,a.dilihat,b.nik,b.nama as pengirim,b.id_karyawan';
        $data['title']='<i class="fa fa-envelope"></i> Message';
		$data['link']='<a href="'.base_url().'Home_karyawan/view_message">Data Pesan</a>';
		$data['list']=$this->my_model->getDataMessage("a.id_pesan,a.tgl_kirim,a.pesan,a.id_pengirim,a.id_penerima,c.nama AS pengirim,c.picture","pesan a",
				      "INNER JOIN karyawan b ON a.id_penerima=b.nik 
					LEFT JOIN karyawan c ON a.id_pengirim=c.nik 
					 WHERE a.id_penerima='$nik'
					 GROUP BY a.id_pengirim ORDER BY a.id_pesan DESC LIMIT $offset,$limit");
					  
		$tot_hal = $this->my_model->hitung_isi_tabel('*','pesan a',"INNER JOIN karyawan b on a.id_penerima=b.nik 
		              WHERE a.id_penerima='$nik' GROUP BY a.id_pengirim ORDER BY a.tgl_kirim");
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
		
		$data['view']='admin/staff/v_message';
        $this->load->view('admin/home/home',$data);
     } 

	 //--VIEW MASTER USER
function materi(){  
	 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		//$kolom='a.id_pesan,a.id_penerima,a.id_pengirim,a.pesan,a.lampiran,a.tgl_kirim,a.dilihat,b.nik,b.nama as pengirim,b.id_karyawan';
        $data['title']='<i class="fa fa-envelope"></i> Materi';
		$data['link']='<a href="'.base_url().'Home_karyawan/view_message">Data Pesan</a>';
		$data['list']=$this->my_model->getDataMessage("*","materi a",
				      "INNER JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_kategori DESC LIMIT $offset,$limit");
					  
		$tot_hal = $this->my_model->hitung_isi_tabel('*','materi a',"INNER JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_kategori");
        					//create for pagination		
			$config['base_url'] = base_url() . 'Home_karyawan/materi/';
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
	    	$config['first_link'] = 'First';
			$config['last_link'] = 'last';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
       		$this->pagination->initialize($config);
			$data["paginator"] =$this->pagination->create_links();
		
		$data['view']='admin/staff/materi';
        $this->load->view('admin/home/home',$data);
     } 

 function detail_message(){
	 $penerima=$this->session->userdata('nikuser');
	 
	 $id_pengirim=$this->input->post('id_pengirim');
	 $kode_flash=$this->session->flashdata('kode_flash');
	 $pengirim=($id_pengirim=="")?$kode_flash:$id_pengirim;
	 
	 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
        $data['title']='<i class="fa fa-envelope"></i> Message';
		$data['link']='<a href="'.base_url().'Home_karyawan/view_message">Data Pesan</a>';
		$data['list']=$this->my_model->getDataMessage("a.id_pesan,a.tgl_kirim,a.pesan,a.id_pengirim,a.id_penerima,b.nama AS penerima,c.nama as pengirim,b.picture as gbr1,c.picture as gbr2","pesan a",
				      "INNER JOIN karyawan b ON a.id_penerima=b.nik 
					   LEFT JOIN karyawan c ON a.id_pengirim=c.nik 
					   WHERE a.aktif='Y' AND a.id_penerima='$penerima' AND a.id_pengirim='$pengirim' OR a.aktif='Y' AND a.id_penerima='$pengirim' AND a.id_pengirim='$penerima'
					   
					   ORDER BY a.id_pesan asc ");
					  
		$tot_hal = $this->my_model->hitung_isi_tabel('*','pesan a',"INNER JOIN karyawan b on a.id_penerima=b.nik 
		              WHERE a.id_penerima='$nik' GROUP BY a.id_pengirim ORDER BY a.tgl_kirim");
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
		
		$data['view']='admin/staff/detail_message';
        $this->load->view('admin/home/home',$data);		
	}
 function new_message(){
	 $pengirim=$this->session->userdata('nikuser');
	 $penerima=$this->input->post('nik');
		 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$kolom='a.id_pesan,a.id_penerima,a.id_pengirim,a.pesan,a.lampiran,a.tgl_kirim,a.dilihat,b.nik,b.nama as pengirim,b.id_karyawan';
        $data['title']='<i class="fa fa-envelope"></i> Message';
		$data['pengirim']=$pengirim;
		$data['penerima']=$penerima;
		$data['link']='<a href="'.base_url().'Home_karyawan/view_message">Data Pesan</a>';
		$data['list']=$this->my_model->getDataMessage("a.tgl_kirim,a.pesan,a.id_pengirim,a.id_penerima,b.nama AS penerima,c.nama as pengirim,b.picture as gbr1,c.picture as gbr2","pesan a",
				      "INNER JOIN karyawan b ON a.id_penerima=b.nik 
					   LEFT JOIN karyawan c ON a.id_pengirim=c.nik 
					   WHERE a.id_penerima='$penerima' AND a.id_pengirim='$pengirim' OR a.id_penerima='$pengirim' AND a.id_pengirim='$penerima'
					   ORDER BY a.id_pesan asc ");
					  
		$tot_hal = $this->my_model->hitung_isi_tabel('*','pesan a',"INNER JOIN karyawan b on a.id_penerima=b.nik 
		              WHERE a.id_penerima='$nik' GROUP BY a.id_pengirim ORDER BY a.tgl_kirim");
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
		
		$data['view']='admin/staff/new_message';
        $this->load->view('admin/home/home',$data);	
	}

 function sendMessage(){
	 $pesan=$this->input->post('pesan');
	 $id_session=$this->session->userdata('nikuser');
	 
	 $id_pengirim=$this->input->post('id_pengirim');
	 $id_penerima=$this->input->post('id_penerima');
	if($id_session==$id_pengirim){
		$penerima=$id_penerima;
	} else {
		$penerima=$id_pengirim;
	}
	 
	 $data=array(
	 'id_pengirim'=>$id_session,
	 'id_penerima'=>$penerima,
	 'pesan'=>$pesan,
	 'tgl_kirim'=>date('Y-m-d H:i:s'),
	 'pesan'=>$pesan,
	 'dilihat'=>'N',
	 
	 );
	$save=$this->my_model->insert('pesan',$data);
	$this->session->set_flashdata('kode_flash', $penerima);	
	 redirect('home_karyawan/detail_message');
	 
 }

function deletemessage(){
	 $pesan=$this->input->post('pesan');
	 $id_session=$this->session->userdata('nikuser');
	 
	 $id_pengirim=$this->input->post('id_pengirim');
	 $id_penerima=$this->input->post('id_penerima');
	if($id_session==$id_pengirim){
		$penerima=$id_penerima;
	} else {
		$penerima=$id_pengirim;
	}
	 
	 $data=array(
	 'id_pengirim'=>$id_session,
	 'id_penerima'=>$penerima,
	 'pesan'=>$pesan,
	 'tgl_kirim'=>date('Y-m-d H:i:s'),
	 'pesan'=>$pesan,
	 'dilihat'=>'N',
	 
	 );
	$save=$this->my_model->insert('pesan',$data);
	$this->session->set_flashdata('kode_flash', $penerima);	
	 redirect('home_karyawan/detail_message');
	 
 }

 function discuss(){	
	$kategori=$this->my_model->getdata5("b.id_diskusi,a.id_kategori,a.kategori,count(b.id_kategori) as jml",'kategori a'," LEFT join diskusi b on a.id_kategori=b.id_kategori group by a.id_kategori");
		  $data=array(
		  'title'=>'<i class="fa fa-comments"></i> Thread Category',
		  'list'=>$kategori,
		  'view'=>'admin/staff/diskusi/v_discuss'
		  );
		
	      $this->load->view('admin/home/home',$data);
	}

	 //--VIEW MASTER USER
function list_discuss(){  
	 $nik=$this->session->userdata('nikuser');
	 $idkategori=$this->input->post('idkategori');
	 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$kolom='a.id_pesan,a.id_penerima,a.id_pengirim,a.pesan,a.lampiran,a.tgl_kirim,a.dilihat,b.nik,b.nama as pengirim,b.id_karyawan';
        $data['title']='<i class="fa fa-comments"></i> List Diskusi';
		$data['link']='<a href="'.base_url().'Home_karyawan/view_message">Data Pesan</a>';
		$data['list']=$this->my_model->getdata5("a.id_diskusi,a.judul_diskusi,a.ket_diskusi,a.tgl_dibuat,a.aktif,a.createby,b.id_user",'diskusi a'," LEFT join user b on a.createby=b.id_user WHERE a.id_kategori='$idkategori' order by a.id_diskusi DESC");
					  
		$tot_hal = $this->my_model->hitung_isi_tabel('*','diskusi a',"LEFT join user b on a.createby=b.id_user WHERE a.id_kategori='$idkategori' order by a.id_diskusi");
        					//create for pagination		
			$config['base_url'] = base_url() . 'Home_karyawan/list_discuss/';
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
	    	$config['first_link'] = 'First';
			$config['last_link'] = 'last';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
       		$this->pagination->initialize($config);
			$data["paginator"] =$this->pagination->create_links();
		
		$data['view']='admin/staff/diskusi/v_list_discuss';
        $this->load->view('admin/home/home',$data);
     } 

 function karyawan(){	
	$kategori=$this->my_model->getdata5("b.id_jabatan,a.id_kategori,a.kategori,count(c.id_jabatan) as jml",'kategori a'," LEFT join jabatan b on a.id_kategori=b.id_kategori
	LEFT JOIN karyawan c on b.id_jabatan=c.id_jabatan
	 group by a.id_kategori");
		  $data=array(
		  'title'=>'<i class="fa fa-comments"></i> Thread Category',
		  'list'=>$kategori,
		  'view'=>'admin/staff/karyawan/v_karyawan'
		  );
		
	      $this->load->view('admin/home/home',$data);
	}
	 //--VIEW MASTER USER
function detail_discuss(){  
	 $nik=$this->session->userdata('nikuser');
	 $id_discuss=$this->input->post('id_discuss');
	 $kode_flash=$this->session->flashdata('kode_flash');

	 	$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$kolom='a.id_pesan,a.id_penerima,a.id_pengirim,a.pesan,a.lampiran,a.tgl_kirim,a.dilihat,b.nik,b.nama as pengirim,b.id_karyawan';
        $data['title']='<i class="fa fa-comments"></i> Message';
		$data['judul']=$this->my_model->getdata5("a.id_diskusi,a.judul_diskusi,a.ket_diskusi",'diskusi a',"WHERE id_diskusi='$id_discuss' OR id_diskusi='$kode_flash' LIMIT 1");
		$data['list']=$this->my_model->getdata5("a.id_diskusi_detail,a.id_diskusi,a.komentar,a.tgl_dibuat,b.judul_diskusi,b.ket_diskusi,c.level,c.nama,c.picture",'diskusi_detail a'," LEFT join diskusi b on a.id_diskusi=b.id_diskusi 
		INNER JOIN karyawan c on a.id_karyawan=c.nik
		WHERE a.id_diskusi='$id_discuss' OR a.id_diskusi='$kode_flash' order by a.id_diskusi");
					  
		$tot_hal = $this->my_model->hitung_isi_tabel('*','diskusi_detail a',"LEFT join diskusi b on a.id_diskusi=b.id_diskusi 
					INNER JOIN karyawan c on a.id_karyawan=c.nik
		           WHERE a.id_diskusi='$id_diskusi' order by a.id_diskusi");
        					//create for pagination		
			$config['base_url'] = base_url() . 'Home_karyawan/detail_discuss/';
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
	    	$config['first_link'] = 'First';
			$config['last_link'] = 'last';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
       		$this->pagination->initialize($config);
			$data["paginator"] =$this->pagination->create_links();
		
		$data['view']='admin/staff/diskusi/v_detail_discuss';
        $this->load->view('admin/home/home',$data);

     }  
 function sendComment(){
	 $pesan=$this->input->post('pesan');
	 $id_session=$this->session->userdata('nikuser');
	 $id_diskusi=$this->input->post('id_diskusi');
	 
	 $data=array(
	 'id_diskusi'=>$id_diskusi,
	 'komentar'=>$pesan,
	 'id_karyawan'=>$id_session,
	 'tgl_dibuat'=>date('Y-m-d H:i:s')
	 );
	 
	$save=$this->my_model->insert('diskusi_detail',$data);	
	$this->session->set_flashdata('kode_flash', $id_diskusi);
	redirect('home_karyawan/detail_discuss');
	 
 }
 
     function form_setting(){
		$nik=$this->session->userdata('nikuser');
		$namekarya=$this->session->userdata('nameuser');
       	  $data=array(
		  'crumb'=>'Setting Profile',
		  'title'=>'<i class="fa fa-cog"></i> Setting Profile',
		  'userprofil'=>$this->my_model->getdata('karyawan',"WHERE nik='$nik'"),
		  'view'=>'admin/staff/form_setting_profil'
		  );
	      $this->load->view('admin/home/home',$data);
	}
function update_profile_setting(){
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
	
 	$idkarya=$this->input->post('idkarya');
 	$old=$this->input->post('old');
 	$pass=sha1($this->input->post('old'));
 	$new=$this->input->post('new');
 	$retype=$this->input->post('retype');


 	if($old==""){
// if not change password
 		$update=array(
		'nama'=>$this->input->post('nama'),
		'jenis_kelamin'=>$this->input->post('jk'),
		'email'=>$this->input->post('email'),
		'picture'=>$image,
		);
		  $message='Profil Change Succesfull !';
		  $label='success';$icon='check';
		  $this->my_model->update('karyawan','nik',$idkarya,$update);
     	}
 	 else  {
 		   $cek=$this->my_model->getdata('karyawan',"WHERE password='$pass' AND nik='$idkarya'");
 			if($cek){
 				
 				if($new==$retype AND !empty($new)){
		//if new password same n not empty
 		$update=array(
		'nama'=>$this->input->post('nama'),
		'jenis_kelamin'=>$this->input->post('jk'),
		'email'=>$this->input->post('email'),
		'picture'=>$image,
		'password'=>sha1($new),
		);
		$message='Profil and Password Change Succesfull !';
		$label='success';$icon='check';
		$this->my_model->update('karyawan','nik',$idkarya,$update);
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
		  'title'=>'profil karyawan',
		  'userprofil'=>$this->my_model->getdata('karyawan',"WHERE nik='$id_session'"),
		  'message'=>$message,
		  'label'=>$label,'icon'=>$icon,
		  'view'=>'admin/staff/form_setting_profil'
		  );
     	   $this->load->view('admin/home/home',$data);
}



}
