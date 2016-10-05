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
     <?php
	foreach($list as $row){
	?>
<form method="post" action="<?php echo base_url();?>home_karyawan/detail_message"> 
   
   <div class="col-sm-12 list">
                  
    <img src="<?php echo base_url();?>asset/images/karyawan/<?php echo $row->picture;?>" class="img-circle" alt="User Image" height="35" width="35" style="float:left">
      <p> &nbsp;  <?php echo $row->pengirim;?></p>
    <span><?php echo date('d-m-Y / H:i:s',strtotime($row->tgl_kirim));?></span>
                    <p><?php echo substr($row->pesan,0,200);?>
                      <input type="hidden" name="id_pengirim" id="id_pengirim" value="<?php echo $row->id_pengirim;?>" />
                    </p>
                    
                            
     <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-eye"></i> View message&raquo; </button>
                </div> 
   <hr />
                  </form>
                  
                  
                  <?php } ?>                 
                  
        </div>
        
      