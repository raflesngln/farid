  
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
    
         $('#tablebisnis tbody').on('dblclick', 'tr', function () {
            var tr = $(this).closest('tr');
            var row = tablebisnis.row(tr);
           // alert(row.data().firstName);
         });
});

function add_materi()
    {
      save_method3 = 'add';
      $('#form3')[0].reset(); // reset form on modals
      $('#modal_form3').modal('show'); // show bootstrap modal
      $('.modal-title3').text('Add materi'); // Set Title to Bootstrap modal title
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
            $('[name="judul_materi"]').val(data.judul_materi);
			 $('[name="id_materi"]').val(data.id_materi	);
            $('[name="ket_materi"]').val(data.ket_materi);
			
            $('#modal_form3').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title3').text('Edit materi'); // Set title to Bootstrap modal title
            
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
          url3 = "<?php echo site_url('materi/ajax_add')?>";
      }
      else
      {
        url3 = "<?php echo site_url('materi/ajax_update')?>";
      }

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
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
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
    <table id="tablebisnis" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>no</th>
          <th>Tgl Update</th>  
          <th> Name</th>
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
        <h3 class="modal-title3">Addrest Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form3" class="form-horizontal">
          <input name="id_materi" type="hidden" id="id_materi" value=""/> 
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3"> Name</label>
              <div class="col-md-9">
                <input name="judul_materi" type="text" class="form-control nama" id="judul_materi" placeholder="Name" value="" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Address</label>
              <div class="col-md-9">
                <textarea name="ket_materi" placeholder="decription"class="form-control" id="ket_materi"></textarea>
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
      $("#bt").click(function(e) {
    alert('hello');
});
  


  </script>
  
  