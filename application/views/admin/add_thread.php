<script>
$(document).ready(function(e) {
    getDevisi();
});


</script>

<section class="content">

<form method="post" action="<?php echo base_url();?>discuss/save_discuss">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-edit"></i>  New Thread</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
     <label class="col-sm-12">Title </label>
              <div class="form-group">
                <input name="judul" class="form-control" id="judul" required="required" placeholder="Judul">
              </div>
              <div class="form-group">
   <select name="kategori" class="form-control" id="kategori" required>
   <option value="">Select Category</option>
   <option value="asafa">sdfdsfsd</option>
   
   </select>
              </div>
              <div class="form-group">
<textarea name="ket" class="form-control" id="ket" style="height: 200px;" placeholder="Write a details of discussion">
                       
</textarea>
              </div>
              
<div class="form-group">
   <select name="status" class="form-control" id="status" required>
   <option value="Y">Active</option>
   <option value="N">No Active</option>
   
   </select>
              </div>
              
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input name="attachment" type="file">
                </div>
                <p class="help-block">Insert your file or picture</p>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
              <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Discard</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
  </div>
  
  </form>
      <!-- /.row -->
</section>
    
    
    
    <script>

  
function getDevisi(){
   
     $.ajax({
	url: "<?php echo base_url('jabatan/getDevisi');?>",
			//dataType: "json",
			type: "POST",
			data: "",
			success: function(data) {
				$('#kategori').html(data);	
			}
		});
 }
</script>