  
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
    var tablemateri;
 
 $(document).ready(function() {    
    
          tablemateri = $('#tablemateri').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('materi/ajax_list')?>",
                "type": "POST"
            },
            "columns": [
            { "data": "no" },
            { "data": "tgl_update" },
            { "data": "judul_materi" },
			{ "data": "ket_materi" },
			{ "data": "kategori" },
            { "data": "action" }
            ]
          });
    
         $('#tablemateri tbody').on('dblclick', 'tr', function () {
            var tr = $(this).closest('tr');
            var row = tablemateri.row(tr);
           // alert(row.data().firstName);
         });
});

function add_materi()
    {
      save_method3 = 'add';
      $('#form3')[0].reset(); // reset form on modals
      $('#modal_form3').modal('show'); // show bootstrap modal
      $('.modal-title3').text('Add materi'); // Set Title to Bootstrap modal title
	  getkategori();
    }

function edit_data(id)
    {
      save_method3 = 'update';
      $('#form3')[0].reset(); // reset form on modals
        
      var nmtabel='materi';
      var keytabel='id_materi';
        
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('materi/ajax_edit/')?>",
        type: "POST",
        data:({cid:id,cnmtabel:nmtabel,ckeytabel:keytabel}),
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nama2"]').val(data.judul_materi);
			 $('[name="idmateri"]').val(data.id_materi	);
			 $('[name="ket2"]').val(data.ket_materi);
			$('[name="oldpic"]').val(data.file_path);
			$('#image').attr('src','<?php echo base_url();?>asset/images/materi/'+data.file_path);
			$('#image').attr('title',data.file_path);
			
       
			
            $('#modal_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title3').text('Edit materi'); 
			getkategori();
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function reload_table()
    {
      tablemateri.ajax.reload(null,false); //reload datatable ajax 
    }



function delete_data(id)
    {
      if(confirm('Are you sure delete this data?'))
      var nmtabel='materi';
      var keytabel='id_materi';
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('materi/ajax_delete')?>",
            type: "POST",
            data:({cid:id,cnmtabel:nmtabel,ckeytabel:keytabel}),
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal_form3').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
      }
    }

  </script>





 <br /><br />
    <button class="btn btn-primary" onclick="add_materi()"><i class="fa fa-plus"></i> Add New  </button>
    <br /><br />
    <table id="tablemateri" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>no</th>
          <th>Tgl</th>  
          <th> Judul</th>
          <th>Description</th>
          <th>Kategori</th>
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
        <form method="post" action="<?php echo site_url('materi/ajax_add')?>" id="form3" name="form3" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3"> Judul</label>
              <div class="col-md-9">
                <input name="nama" type="text" class="form-control nama" id="nama" placeholder="fullname" required />
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">kategori</label>
              <div class="col-md-9">
                <select name="kat" id="kat" class="form-control kategori" required></select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Ket</label>
              <div class="col-md-9">
                <textarea name="ket" required="required" class="form-control nama" id="ket" placeholder="Username"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">File</label>
              <div class="col-md-9">
              <input name="myfile" class="form-controll" type="file" id="myfile">              
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
        <form method="post" action="<?php echo site_url('materi/ajax_update')?>" id="form_edit" name="form_edit" class="form-horizontal" enctype="multipart/form-data">
          <input name="idmateri" type="hidden" id="idmateri" value=""/> 
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3"> Nama</label>
              <div class="col-md-9">
                <input name="nama2" type="text" class="form-control nama" id="nama2" placeholder="fullname" required="required" />
              </div>
            </div>
 <div class="form-group">
              <label class="control-label col-md-3">KAtegori</label>
              <div class="col-md-9">
                <select name="kat2" id="kat2" class="form-control kategori" required></select>
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Ket</label>
              <div class="col-md-9">
                <textarea name="ket2" required="required" class="form-control nama" id="ket2" placeholder="Username"></textarea>
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Picture</label>
              <div class="col-md-9">
              <input name="myfile" class="form-controll" type="file" id="myfile">              
              <span class="col-sm-11">
              <input name="oldpic" type="hidden" id="oldpic" />
              </span></div>
            </div>
            
 <div class="form-group">
              <label class="control-label col-md-3">file</label>
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

function getkategori(){
   
     $.ajax({
	url: "<?php echo base_url('admin_user/getkategori');?>",
			//dataType: "json",
			type: "POST",
			data: "",
			success: function(data) {
				$('.kategori').html(data);	
			}
		});
 }
  
  </script>
  
  
  
  
<!-- end of edit modal -->


  <script>

function getkategori(){
   
     $.ajax({
	url: "<?php echo base_url('materi/getkategori');?>",
			//dataType: "json",
			type: "POST",
			data: "",
			success: function(data) {
				$('.kategori').html(data);	
			}
		});
 }
  
  </script>
  
  