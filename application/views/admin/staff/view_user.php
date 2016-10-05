<style>
.box{
	margin-top:10px;
	box-shadow:1px 1px 3px #CCC;
}
.pagin a{
	height:30px;
	width:35px;
	background-color:#D4D4D4;
	padding:5px 10px 0px 10px;
}
.col-md-3{
	height:380px;
}
.gambar-profile{
	height:100px;
	width:100px;
	margin-left:27%;
	box-shadow:2px 2px 3px #CCC;
}
</style>

<?php 
$no=1;
foreach($list as $data)
{
?>
          <!-- Profile Image -->
<form method="post" action="<?php echo base_url();?>home_karyawan/new_message">
<div class="col-md-3">


          <div class="box box-default">
            <div class="box-body box-profile">
            
              <img class="gambar-profile img-responsive img-circle" src="<?php echo base_url();?>asset/images/karyawan/<?php echo $data->picture;?>" alt="User profile picture" data-pin-nopin="true">

              <h3 class="profile-username text-center"><?php echo $data->nama;?></h3>

   <p class="text-muted text-center"><i class="fa fa-star"></i> &nbsp; <?php echo $data->kategori;?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item"><span class="text-muted text-center"><?php echo $data->nama_jabatan;?><i class="pull-right fa fa-certificate"></i></span>
                </li>
                <li class="list-group-item"><span class="text-muted text-center"><?php echo $data->email;?><i class="pull-right fa fa-envelope"></i></span>
                  <input type="hidden" name="nik" id="nik" value="<?php echo $data->nik;?>" />
                </li>
                <br />
       <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-send-o"></i>&nbsp; Send Message</button>
      
                </ul>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <!-- /.box -->
          
          
        </div>
        </form>
 <?php $no++; } ;?>
 <div class="clearfix"></div>

 <div class="gradeX pagin"><p><?php echo $paginator;?></p></div>