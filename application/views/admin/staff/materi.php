<table class="table table-hover table-striped">
                  <tbody>                      <?php
	foreach($list as $row){
	?>
                  <tr>
                  
 
   
                    <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                  
<td class="mailbox-star">
<a title="downlolad file" href="<?php echo base_url();?>asset/images/materi/<?php echo $row->file_path;?>"><i class="fa fa-cloud-download fa-2x text-green"></i></a>

</td>
                    
                    <td class="mailbox-name"><a href="read-mail.html"><?php echo date('d-m-Y / H:i:s',strtotime($row->judul_materi));?></a></td>
                    <td class="mailbox-subject"><?php echo $row->judul_materi;?></td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo substr($row->ket_materi,0,200);?></td>
                    
                  </tr>  <?php } ?> 
                  </tbody>
                </table>