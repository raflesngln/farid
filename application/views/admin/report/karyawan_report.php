<div class="content">
    <div class="box-body">              
<form class="" method="post" action="<?php echo base_url() ;?>report/print_karyawan" target="new">
  <div class="form-group">
        <label for="inputName" class="col-sm-10 control-label">Pilih Kategori</label>
                    <div class="col-sm-10">
                      <label for="kategori"></label>
                      <select required name="kategori" id="kategori" class="form-control" style="width:33%">
              <option value="">PIlih kategori</option>
              <option value="all">Semua Kategori</option>
                      <?php
					  foreach($kategori as $data){
					  ?>
         
         <option value="<?php echo $data->id_kategori.'#'.$data->kategori;?>"><?php echo $data->kategori ;?></option>
            <?php } ?>
                      </select>
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