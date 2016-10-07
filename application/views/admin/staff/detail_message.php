<div class="col-md-12">

<h1>Private Message</h1>
          <!-- DIRECT CHAT SUCCESS -->
          <div class="box box-default direct-chat direct-chat-success">
           
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div>
              
       <?php
	foreach($list as $row){
		$id_session=$this->session->userdata('nikuser');
		$id_db=$row->id_pengirim;
		if($id_db==$id_session){
			$clas1='direct-chat-msg';
			$clas2='direct-chat-info clearfix';
			$clas3='direct-chat-name pull-left';
		} else {
		    $clas1='direct-chat-msg right';
			$clas2='direct-chat-info clearfix';
			$clas3='direct-chat-name pull-right';	
			
		}
	?>             
                <!-- Message. Default to the left -->
                <div class="<?php echo $clas1;?>">
                  <div class="<?php echo $clas2;?>">
                    <span class="<?php echo $clas3;?>"><?php echo $row->pengirim ;?>
                
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="<?php echo base_url();?>asset/images/karyawan/<?php echo $row->gbr2;?>" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
     <p><a onclick="return confirm('Yakin hapus pesan ?');" href="<?php echo base_url();?>home_karyawan/deletemessage/<?php echo $row->id_pesan.'.'.$row->id_penerima.'.'.$row->id_pengirim ;?>"><i class="fa fa-times bg-red"></i></a></p>
     <p><em><?php echo date('d-M-Y ( H:i:s )',strtotime($row->tgl_kirim));?></em></p>

     <p><?php echo $row->pesan;?>.</p>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
<?php } ?>

                <!-- Message to the right -->
                
                <!-- /.direct-chat-msg -->
              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
              
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            
       
            
            
            <div class="box-footer">
              <form action="<?php echo base_url();?>home_karyawan/sendMessage" method="post">
                <div class="col-sm-12">
                  <textarea name="pesan" cols="" rows="" class="form-control" required="required" placeholder="wrie a message"></textarea>
                  <input type="hidden" name="id_penerima" id="id_penerima" value="<?php echo $row->id_penerima;;?>" />
                  <input type="hidden" name="id_pengirim" id="id_pengirim" value="<?php echo $row->id_pengirim;;?>" />
                  <br />
                  <div class="col-sm-3">
   <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-send-o"></i>&nbsp;  Send</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>