
 <div class="jdl-treats">
     <?php
	foreach($judul as $data){
	?>
 <h2 align="center"><i class="fa fa-comments"></i> <?php echo $data->judul_diskusi;?></h2>  
 <p align="center"><?php echo $data->ket_diskusi;?></p>
<?php } ?>
 </div>
 
<ul class="timeline">
            <!-- timeline time label -->
 
            <!-- /.timeline-label -->
            <!-- timeline item -->
        
     <?php
	foreach($list as $row){
	?>
     <li>
              <span class="fa">
              <img src="<?php echo base_url();?>asset/images/karyawan/<?php echo $row->picture;?>" class="img-circle" alt="User Image" height="35" width="35" style="float:left">
              </span>
              
              <div class="timeline-item">

                <h3 class="timeline-header">
                <a href="#"><?php echo $row->nama;?></a></h3>

                <div class="timeline-body">
     <p><em><?php echo date("d-M-Y ( H:i:s )",strtotime($row->tgl_dibuat));?></em></p>
     <p><?php echo $row->komentar;?></p>
                </div>
                
              </div>
            
              
            </li> <?php } ?> 

</ul>

<div class="box-footer">
              <form action="<?php echo base_url();?>home_karyawan/sendMessage" method="post">
                <div class="col-sm-12">
                  <textarea name="pesan" cols="" rows="" class="form-control" required="required"></textarea>
                  <input type="hidden" name="id_penerima" id="id_penerima" value="<?php echo $row->id_penerima;;?>" />
                  <input type="hidden" name="id_pengirim" id="id_pengirim" value="<?php echo $row->id_pengirim;;?>" />
                  <br />
                  <div class="col-sm-3">
   <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-send-o"></i>&nbsp;  Send</button>
                  </div>
                </div>
              </form>
            </div>



