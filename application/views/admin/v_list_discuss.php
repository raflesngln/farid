  <script type="text/javascript">
 function add_thread()
    {
      save_method3 = 'add';
      $('#form3')[0].reset(); // reset form on modals
      $('#modal_form3').modal('show'); // show bootstrap modal
      $('.modal-title3').text('Add Diskusi'); 
	  getDevisi();
    } 
  
  
  </script>

<style>
.list{
	border-bottom:1px #CCC solid; padding-bottom:10px;
	padding-top:10px;
}
	
.list:hover{
	background-color:#C7E1E9 ;
	
}

</style>

 <div class="content"> 
 
 
 <a href="<?php echo base_url();?>discuss/add_thread">
 <button class="btn btn-primary" ><i class="fa fa-plus"></i> Add New  </button>
 </a>              
     <?php
	foreach($list as $row){
	?>
 <form method="post" action="<?php echo base_url();?>home_karyawan/detail_discuss" name="detail">   
   <div class="col-sm-12 list">
    <a href="<?php echo base_url();?>home_karyawan/detail_discuss/id/<?php echo $row->id_diskusi;?>">
                  
    <img src="<?php echo base_url();?>asset/images/user.png" class="img-circle" alt="User Image" height="35" width="35" style="float:left">
      <p> &nbsp;  <?php echo $row->judul_diskusi;?></p>
    <span><?php echo date('d-m-Y / H:i:s',strtotime($row->tgl_dibuat));?></span>
                    <p><?php echo substr($row->ket_diskusi,0,200);?>
                      <input type="hidden" name="id_discuss" id="id_discuss" value="<?php echo $row->id_diskusi;?>" />
                    </p>
                    
                           
     <button class="btn btn-xs btn-primary" type="submit"><i class="fa fa-eye"></i> View Comments</button>
    </div> <hr />
    </form>
                  <?php } ?>                 
                  
        </div>
        
        
        
  <!-- Bootstrap modal -->
  <!-- /.modal -->
    
    
  <script>

function getDevisi(){
   
     $.ajax({
	url: "<?php echo base_url('jabatan/getDevisi');?>",
			//dataType: "json",
			type: "POST",
			data: "",
			success: function(data) {
				$('#devisi').html(data);	
			}
		});
 }
  
  </script>
        