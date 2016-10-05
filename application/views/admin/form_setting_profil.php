<section class="content">
   <?php
   foreach ($userprofil as $row) {
   ?>
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>asset/images/karyawan/<?php echo $row->picture;?>" alt="User profile picture" data-pin-nopin="true">

              <h3 class="profile-username text-center"><?php echo $row->nama;?></h3>

              <p class="text-muted text-center"><?php echo $row->email;?></p>




            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">

                <div class="post clearfix">
                  <form class="form-horizontal" method="post" action="<?php echo base_url();?>setting_profil/change_profil_admin" enctype="multipart/form-data">
                    <div class="form-group margin-bottom-none">


<?php
if(isset($message)){
?>
<div class="alert alert-block alert-<?=$label;?>">
<button type="button" class="close" data-dismiss="alert">
<i class="fa fa-remove"></i></button><i class="fa fa-<?=$icon;?> green"></i>
<?php echo isset($message)?$message:'';?></div>
<?php } ?>                          
                            
 <h3 class="text-left">Edit Profile User</h3>
 <hr>
 
<div class="form-group">
<div class="col-md-3">Full Name : </div>
<div class="col-md-8">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row->nama;?>">
<span class="col-sm-11">
<input name="iduser" type="hidden" id="iduser" value="<?php echo $this->session->userdata('nikuser');?>" />
</span><span class="col-sm-11">
<input name="oldpic" type="hidden" id="oldpic" value="<?php echo $row->picture;?>" />
</span></div>
</div>

<div class="form-group">
<div class="col-md-3">NIK : </div>
<div class="col-md-8">
<input name="nik" class="form-control" type="text" id="nik" readonly="readonly" value="<?php echo $row->nik;?>">
</div>
</div>

<div class="form-group">
<div class="col-md-3">Level : </div>
<div class="col-md-8">
<input name="nik" class="form-control" type="text" id="nik" readonly="readonly" value="<?php echo $row->level;?>">
</div>
</div>
<div class="form-group">
<div class="col-md-3">email : </div>
<div class="col-md-8">
<input name="email" class="form-control" type="text" id="email" value="<?php echo $row->email;?>">
</div>
</div>

<hr />
<h5 class="label label-warning"> <i class="fa fa-info"></i>  Biarkan password kosong jika tidak ingin ganti password</h5>
<hr />

<div class="form-group">
<div class="col-md-3">Old Password : </div>
<div class="col-md-8">
<input name="old" class="form-control" type="text" id="old" value="">
</div>
</div>

<div class="form-group">
<div class="col-md-3">New Password : </div>
<div class="col-md-8">
<input name="new" class="form-control" type="password" id="new">
</div>
</div>

<div class="form-group">
<div class="col-md-3">Retype password : </div>
<div class="col-md-8">
<input name="retype" class="form-control" type="password" id="retype">
</div>
</div>

<div class="form-group">
<div class="col-md-3">Picture : </div>
<div class="col-md-8">
<input name="gambar" class="form-control" type="file" id="gambar">
</div>
</div>



<div class="col-md-11 text-center"><button class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp; Update </button></div>
                     
                  </form>
              

              </div>
          
        </div>
      </div>
    
<?php } ?>
    </section>