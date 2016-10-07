
<style>
*{
	font-size:10px;
}
#mytable tr td{
	border:1px #CCC solid;
}
</style>
<p style="margin-bottom:-10px">LAPORA DISKUSI</p>
<h2>Diskusi    : <?php echo $status;?></h2>
<p style="margin-top:-10px">Periode    : <?php echo $periode;?></p>

<table id="mytable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr style="background-color:#CCC">
          <td width="69" style="height:35px">no</td>
          <td style="width:90px">Tgl dibuat</td>
          <td style="width:330px">Judul</td>  
          <td   style="width:190px"> Devisi</td>
        </tr>
      </thead>
      <tbody>
      </tbody>

<?php 
 ob_start();
$no=1;
foreach($list as $row){
?>
        <tr>
          <td><?php echo $no;?></td>
          <td><?php echo date('d-m-Y',strtotime($row->tgl_dibuat));?></td>
          <td><?php echo $row->judul_diskusi;?></td>
          <td><?php echo $row->kategori;?></td>
        </tr>
 <?php $no++; } ?>    
    </table>