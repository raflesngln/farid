  <!-- Jquery UI-->

   <link rel="stylesheet" href="<?php echo base_url();?>asset/jquery_ui/jquery-ui.css">
<script src="<?php echo base_url();?>asset/jquery_ui/jquery-ui.js"></script> 
  

  <script type="text/javascript">
  $(function() {
	$("#tgl1").datepicker({
		dateFormat:'yy-mm-dd',
		});
	$("#tgl2").datepicker({
		dateFormat:'yy-mm-dd',
		});
	
  });
  </script>
<div class="content">
    <div class="box-body">              
<form class="" method="post" action="<?php echo base_url() ;?>report/print_diskusi" target="new">
  <div class="form-group">
        <label for="inputName" class="col-sm-10 control-label">Pilih Kategori</label>
                    <div class="col-sm-10">
                      
                      <select required name="kategori" id="kategori" class="form-control" style="width:33%">
              <option value="">PIlih kategori</option>
              <option value="all">Semua Kategori</option>
                      <?php
					  foreach($kategori as $data){
					  ?>
         
         <option value="<?php echo $data->id_kategori.'.'.$data->kategori;?>"><?php echo $data->kategori ;?></option>
            <?php } ?>
                      </select>
                    </div>
                  </div>
<div class="form-group">
<?php
$kurangtanggal = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-7,date("Y")));
?>
        <label for="inputName" class="col-sm-10 control-label">Periode</label>
        <div class="row">
          <div class="col-sm-3">
                      
            <input name="tgl1" id="tgl1" type="text" value="<?php echo $kurangtanggal;?>" class="form-control" />
          </div>
   <div class="col-sm-3">
   <input name="tgl2" type="text" class="form-control" value="<?php echo date('Y-m-d');?>" id="tgl2" />
   </div>
        </div>
              </div>    
<div class="form-group">
        <label for="inputName" class="col-sm-10 control-label">&nbsp;</label>

      
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-5">
<button type="submit" class="btn btn-primary btn-md"> <i class="fa fa-print"></i>  Print Karyawan</button>
                    </div>
                  </div>
                </form>
              
              
  </div>  
              
            </div>