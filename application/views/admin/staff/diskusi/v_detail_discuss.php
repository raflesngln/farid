
 <div class="jdl-treats">
     <?php
	foreach($judul as $data){
		$idDiskusi=$data->id_diskusi;
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
		$lvl=$row->level;
		if($lvl=='staff'){
			$warna='blue';
		} else if($lvl=='manager') {
			$warna='green';
		} else {
			$warna='red';
		}
	?>
     <li>
              <span class="fa">
              <img src="<?php echo base_url();?>asset/images/karyawan/<?php echo $row->picture;?>" class="img-circle" alt="User Image" height="35" width="35" style="float:left">
              </span>
              
              <div class="timeline-item">

                <h3 class="timeline-header">
<a href="#"><?php echo $row->nama;?></a></h3>
<label class="badge bg-<?php echo $warna;?>"><?php echo $row->level;?></label>

                <div class="timeline-body">
     <p><em><?php echo date("d-M-Y ( H:i:s )",strtotime($row->tgl_dibuat));?></em></p>
     <p><?php echo $row->komentar;?></p>
                </div>
                
              </div>
            </li> <?php } ?> 

</ul>

<div class="box-footer">
              <form action="<?php echo base_url();?>home_karyawan/sendComment" method="post">
                <div class="col-sm-12">
                  <textarea name="pesan" cols="" rows="" class="form-control" required="required" placeholder="write a comment at this topic"></textarea>
                  <input type="hidden" name="id_diskusi" id="id_diskusi" value="<?php echo $idDiskusi;?>" />
                  <br />
                  <div class="col-sm-3">
   <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-send-o"></i>&nbsp;  Send</button>
                  </div>
                </div>
              </form>
            </div>



