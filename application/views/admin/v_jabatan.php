  
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
                "url": "<?php echo site_url('jabatan/ajax_list')?>",
                "type": "POST"
            },
            "columns": [
            { "data": "no" },
            { "data": "id_jabatan" },
            { "data": "nama_jabatan" },
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

function add_jabatan()
    {
      save_method3 = 'add';
      $('#form3')[0].reset(); // reset form on modals
      $('#modal_form3').modal('show'); // show bootstrap modal
      $('.modal-title3').text('Add jabatan'); 
	  getDevisi();
    }

function edit_data(id)
    {
      save_method3 = 'update';
      $('#form3')[0].reset(); // reset form on modals
        
      var nmtabel='jabatan';
      var keytabel='id_jabatan';
        
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('jabatan/ajax_edit/')?>",
        type: "POST",
        data:({cid:id,cnmtabel:nmtabel,ckeytabel:keytabel}),
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nama_jabatan"]').val(data.nama_jabatan);
			 $('[name="id_jabatan"]').val(data.id_jabatan	);
            $('[name="deskripsi"]').val(data.deskripsi);
			getDevisi();
			
            $('#modal_form3').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title3').text('Edit jabatan'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function reload_table()
    {
      tablebisnis.ajax.reload(null,false); //reload datatable ajax 
    }

function save_data()
    {
      var url3;
      if(save_method3 == 'add') 
      {
          url3 = "<?php echo site_url('jabatan/ajax_add')?>";
      }
      else
      {
        url3 = "<?php echo site_url('jabatan/ajax_update')?>";
      }

var nama_jabatan=$('#nama_jabatan').val();
var devisi=$('#devisi').val();
    if (nama_jabatan =='' || devisi=='') {
swal("Warning !","Jabatan dan devisi harus di isi !","error");

} else {
       // ajax adding data to database
          $.ajax({
            url : url3,
            type: "POST",
            data: $('#form3').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form3').modal('hide');
			   swal("Sukses !","Data tersimpan !","success");
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
	}
	
}

function delete_data(id)
    {
      if(confirm('Are you sure delete this data?'))
      var nmtabel='jabatan';
      var keytabel='id_jabatan';
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('jabatan/ajax_delete')?>",
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
    <button class="btn btn-primary" onclick="add_jabatan()"><i class="fa fa-plus"></i> Add New  </button>
    <br /><br />
    <table id="tablebisnis" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>no</th>  
          <th>Name Jabatan</th>
          <th>Deskripsi </th>
          <th>Devisi</th>
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
        </tr>
      </tfoot>
    </table>
            
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form3" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title3">Addrest Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form3" class="form-horizontal">
          <input name="id_jabatan" type="hidden" id="id_jabatan" value=""/> 
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3"> Name Jabatan</label>
              <div class="col-md-9">
                <input name="nama_jabatan" type="text" class="form-control nama" id="nama_jabatan" placeholder="Name" required="required"/>
              </div>
            </div>
<div class="form-group">
              <label class="control-label col-md-3">Devisi</label>
              <div class="col-md-9">
                <select name="devisi" id="devisi" class="form-control jabatan"></select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Keterangan</label>
              <div class="col-md-9">
                <textarea name="deskripsi" placeholder="decription"class="form-control" id="deskripsi"></textarea>
              </div>
            </div>
            
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_data()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
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
  
  