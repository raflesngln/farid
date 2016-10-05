  
  <link href="<?php echo base_url();?>asset/datatables/css/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="<?php echo base_url();?>asset/datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>asset/datatables/js/dataTables.bootstrap.js"></script>
  
  
<style>
/*#tambahan */

table thead tr th{
	background-color:#EAEAEA;
}
</style>        
        
        
  <script type="text/javascript">
    var save_method3; //for save method string
    var tablebisnis;
 
 $(document).ready(function() {    
    
          tablebisnis = $('#tablebisnis').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('karyawan/ajax_list')?>",
                "type": "POST"
            },
            "columns": [
            { "data": "no" },
            { "data": "nik" },
            { "data": "nama" },
            { "data": "jenis_kelamin" },
			{ "data": "kategori" },
            { "data": "action" }
            ]
          });
    
         $('#tablebisnis tbody').on('dblclick', 'tr', function () {
            var tr = $(this).closest('tr');
            var row = tablebisnis.row(tr);
           // alert(row.data().firstName);
         });
});

function add_data()
    {
      save_method3 = 'add';
      $('#form3')[0].reset(); // reset form on modals
      $('#modal_form3').modal('show'); // show bootstrap modal
      $('.modal-title3').text('Add karyawan'); 
	  getJabatan();
    }

function edit_karyawan(id)
    {
      save_method3 = 'update';
      $('#form3')[0].reset(); // reset form on modals
        
      var nmtabel='karyawan';
      var keytabel='nik';
        
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('admin_user/ajax_edit/')?>",
        type: "POST",
        data:({cid:id,cnmtabel:nmtabel,ckeytabel:keytabel}),
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nama2"]').val(data.nama);
			 $('[name="id_user"]').val(data.nik	);
			 $('[name="nik2"]').val(data.nik);
			 $('[name="jk2"]').val(data.jenis_kelamin);
			 $('[name="level2"]').val(data.level);
			 $('[name="jabatan2"]').val(data.id_jabatan);
            $('[name="email2"]').val(data.email);
			$('[name="oldpic"]').val(data.picture);
			$('#image').attr('src','<?php echo base_url();?>asset/images/karyawan/'+data.picture);
			getJabatan();
			
			
            $('#modal_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-edit').text('Edit User Admin'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function reload_table_linebusiness()
    {
      tablebisnis.ajax.reload(null,false); //reload datatable ajax 
    }

function delete_karyawan(id)
    {
      if(confirm('Are you sure delete this data?'))
      var nmtabel='karyawan';
      var keytabel='nik';
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('karyawan/ajax_delete')?>",
            type: "POST",
            data:({cid:id,cnmtabel:nmtabel,ckeytabel:keytabel}),
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal_form3').modal('hide');
               reload_table_linebusiness();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
      }
    }

  </script>


<?php
if(isset($message)){
?>
<div class="alert alert-block alert-<?=$label;?>">
<button type="button" class="close" data-dismiss="alert">
<i class="fa fa-remove"></i></button><i class="fa fa-<?=$icon;?> green"></i>
<?php echo isset($message)?$message:'';?></div>
<?php } ?>  



 <br /><br />
    <button class="btn btn-primary" onclick="add_data()"><i class="fa fa-plus"></i> Add New  </button>
    <br /><br />
    <table id="tablebisnis" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>no</th>  
          <th>id</th>
          <th> Name</th>
          <th>Description</th>
          <th>Createdby</th>
          <th style="width:125px;">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </tfoot>
    </table>
            
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form3" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title3">Form add</h3>
      </div>
      <div class="modal-body form">
        <form method="post" action="<?php echo site_url('karyawan/ajax_add')?>" id="form3" name="form3" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3"> FullName</label>
              <div class="col-md-9">
                <input name="nama" type="text" class="form-control nama" id="nama" placeholder="fullname" required />
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Jenis Kelamin</label>
              <div class="col-md-9">
                <select name="jk" id="jk" class="form-control" required="required">
 <option value="">Select</option>
 <option value="L">Laki-laki</option>
  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">NIK</label>
              <div class="col-md-9">
                <input name="nik" type="text" class="form-control nama" id="nik" placeholder="Username" required />
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Email</label>
              <div class="col-md-9">
                <input name="email" type="text" class="form-control nama" id="email" placeholder="Username" required />
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Level</label>
              <div class="col-md-9">
                <select name="level" id="level" class="form-control" required="required">
 <option value="">Select</option>
 <option value="staff">Staff</option>
  <option value="manager">Manager</option>
   <option value="admin">administrator</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
                <input name="password" type="password" class="form-control nama" id="password" value="12345" required />
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Jabatan</label>
              <div class="col-md-9">
                <select name="jabatan" id="jabatan" class="form-control jabatan" required></select>
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Picture</label>
              <div class="col-md-9">
              <input name="gambar" class="form-controll" type="file" id="gambar">              
              </div>
            </div>
            

          <div class="modal-footer">
            <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
           
          </div>
        </form>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    


<!-- MODAL EDIT -->
  <!-- Bootstrap modal -->
 <div class="modal fade" id="modal_edit" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-edit">Form EDIT</h3>
      </div>
      <div class="modal-body form">
        <form method="post" action="<?php echo site_url('karyawan/ajax_update')?>" id="form_edit" name="form_edit" class="form-horizontal" enctype="multipart/form-data">
          <input name="id_user" type="hidden" id="id_user" value=""/> 
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3"> Nama</label>
              <div class="col-md-9">
                <input name="nama2" type="text" class="form-control nama" id="nama2" placeholder="fullname" required="required" />
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Jenis Kelamin</label>
              <div class="col-md-9">
                <select name="jk2" id="jk2" class="form-control" required="required">
                  <option value="">Select</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nik</label>
              <div class="col-md-9">
                <input name="nik2" type="text" class="form-control nama" id="nik2" placeholder="Username" required="required" />
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Email</label>
              <div class="col-md-9">
                <input name="email2" type="text" class="form-control nama" id="email2" placeholder="Username" required="required" />
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Level</label>
              <div class="col-md-9">
                <select name="level2" id="level2" class="form-control" required="required">
                  <option value="">Select</option>
                  <option value="staff">Staff</option>
                  <option value="manager">Manager</option>
                  <option value="admin">administrator</option>
                </select>
              </div>
            </div>
 <div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
                <input name="password2" type="password" class="form-control nama" id="password2" value="12345" required="required" />
              </div>
            </div>
 <div class="form-group">
              <label class="control-label col-md-3">Jabatan</label>
              <div class="col-md-9">
                <select name="jabatan2" id="jabatan2" class="form-control jabatan" required="required">
                </select>
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Picture</label>
              <div class="col-md-9">
              <input name="gambar" class="form-controll" type="file" id="gambar">              
              <span class="col-sm-11">
              <input name="oldpic" type="hidden" id="oldpic" />
              </span></div>
            </div>
            
 <div class="form-group">
              <label class="control-label col-md-3">Picture</label>
              <div class="col-md-9">
      <img src="" height="90" width="90" class="image" id="image" />              
              </div>
            </div>
            

          <div class="modal-footer">
            <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
           
          </div>
        </form>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    

  <!-- Bootstrap modal --><!-- /.modal -->
    

  
  <script>

function getJabatan(){
   
     $.ajax({
	url: "<?php echo base_url('admin_user/getJabatan');?>",
			//dataType: "json",
			type: "POST",
			data: "",
			success: function(data) {
				$('.jabatan').html(data);	
			}
		});
 }
  
  </script>
  
  
  
  
<!-- end of edit modal -->


  <script>

function getJabatan(){
   
     $.ajax({
	url: "<?php echo base_url('karyawan/getJabatan');?>",
			//dataType: "json",
			type: "POST",
			data: "",
			success: function(data) {
				$('.jabatan').html(data);	
			}
		});
 }
  
  </script>
  
  