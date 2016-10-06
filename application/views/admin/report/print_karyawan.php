
<style>
*{
	font-size:10px;
}
#mytable tr td{
	border:1px #CCC solid;
}
</style>
<p style="margin-bottom:-10px">LAPORA KARYAWAN</p>
<h2>Status    : <?php echo $status;?></h2>

<table id="mytable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr style="background-color:#CCC">
          <td style="height:35px">no</td>
          <td style="width:80px">NIk</td>  
          <td style="width:190px"> Nama</td>
          <td style="width:40px">Jns Kelamin</td>
          <td style="width:120px">Jabatan</td>
          <td style="width:165px;">Email</td>
          <td style="width:110px;">Level</td>
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
          <td><?php echo $row->nik;?></td>
          <td><?php echo $row->nama;?></td>
          <td><?php echo $row->jenis_kelamin;?></td>
          <td><?php echo $row->nama_jabatan;?></td>
          <td><?php echo $row->email;?></td>
          <td><?php echo $row->level;?></td>
        </tr>
 <?php $no++; } ?>    
    </table>