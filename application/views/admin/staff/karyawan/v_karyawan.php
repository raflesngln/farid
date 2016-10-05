

<section class="content">
<h2><i class="fa fa-comments"></i> Department </h2>
<div class="row">

        <!-- ./col -->
         <?php
 foreach($list as $row){
	 $id=$row->id_kategori;
	 if($id % 2==0){
		 $status='yellow';
	 } else {
		 
		 $status='green';
	 }
 ?> 
  <form method="post" action="<?php echo base_url();?>home_karyawan/view_karyawan">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-<?php echo $status;?>">
            <div class="inner">

              <h3 id="jumlah" class="jumlah"><?php echo $row->jml ;?><small><span class="span text text-success"> People</span></small></h3>
             

              <p><?php echo $row->kategori ;?>
                <input type="hidden" class="idkategori" name="idkategori" id="idkategori" value="<?php echo $row->id_kategori ;?>" />
                <input type="hidden" name="id_jabatan" id="id_jabatan" value="<?php echo $row->id_jabatan ;?>" />
              </p>
     <p align="center"> <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-eye"></i> View Threats &raquo; </button></p>
            </div>
        
          </div>
        </div>
     </form>	
    <?php } ?>
        <!-- ./col -->
        

      </div>

    </section>
    
   
    

