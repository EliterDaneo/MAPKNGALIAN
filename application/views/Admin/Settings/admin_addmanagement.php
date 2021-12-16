<div class="content-wrapper">
 <!-- Main content -->
 <section class="content ">
  <div class="container-fluid">

   <div class="row">

    <div class="col-sm-8">

     <div>
      <div class="callout callout-danger">
       <h5><i class="fas fa-info"></i> Note:</h5>
       <text class="text-danger"><b>Silahkan Memilih Level Terlebih Dahulu Nanti ada Petujuk Selanjutnya!!!</b></text>
     </div>
     <br>
   </div>

   <!-- Default box -->
   <div class="card card-outline card-info">
     <div class="card-header">
      <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
      <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('Admin/ManagementUsers');?>">
       <i class="fas fa-arrow-left"></i>&ensp;Back
     </a>
   </div>
   <div class="card-body">


     <form action="<?= base_url('admin/AddUserManagement')?>" method="post">


      <!-- Level -->
      <div class="form-group">
       <label for="addPenggunaLevel" class="col-form-label">Level</label>
       <select class="form-control" name="level" id="addPenggunaLevel">
        <option value="">Silahkan Memilih Level</option>
        <option value="Administrator">Administrator</option>
        <option value="Guru">Guru</option>
        <option value="Wali">Wali</option>
        <option value="Siswa">Siswa</option>
      </select>
      <?= form_error('level', '<small class="text-danger pl-3">', '</small>');?>
    </div>
    <!-- / Level -->


    <div id=addPenggunaAdmin style="display: none">

      <!-- Fullname -->
      <div class="form-group">
       <label for="addPenggunaFullnameAdmin" class="col-form-label">Fullname</label>
       <input type="text" name="fullnameAdmin" class="form-control" id="addPenggunaFullnameAdmin" placeholder="Fullname" value="<?= set_value('fullname')?>" />
       <?= form_error('fullnameAdmin', '<small class="text-danger pl-3">', '</small>');?>
     </div>
     <!-- / Fullname -->

     <!-- Fullname -->
     <div class="form-group">
       <label for="addPenggunaEmailAdmin" class="col-form-label">Email</label>
       <input type="text" name="emailAdmin" class="form-control" id="addPenggunaEmailAdmin" placeholder="Email" value="<?= set_value('email')?>" />
       <?= form_error('emailAdmin', '<small class="text-danger pl-3">', '</small>');?>
     </div>
     <!-- / Fullname -->

     <!-- Username -->
     <div class="form-group">
       <label for="addPenggunaUsernameAdmin" class="col-form-label">Username</label>
       <input type="text" name="usernameAdmin" class="form-control" id="addPenggunaUsernameAdmin" placeholder="Username" value="<?= set_value('username')?>" />
       <?= form_error('usernameAdmin', '<small class="text-danger pl-3">', '</small>');?>
     </div>
     <!-- / Username -->

     <!-- Password -->
     <div class="form-group">
       <label for="addPenggunaPasswordAdmin" class="col-form-label">Password</label>
       <input type="text" name="passwordAdmin" class="form-control" id="addPenggunaPasswordAdmin" placeholder="Password" value="<?= set_value('password')?>" />
       <?= form_error('passwordAdmin', '<small class="text-danger pl-3">', '</small>');?>
     </div>
     <!-- / Password -->

   </div>

   <div id=addPenggunaGuru style="display: none">

    <!-- NIK -->
    <div class="form-group">
     <label for="addNIKGuru" class="col-form-label">Silahkan Cari NIK Guru</label>
     <select class="form-control select2" name="addNIKGuru" id="addNIKGuru">
      <option value="">Tulis NIK / Nama Guru</option>
      <?php
      foreach ($guruAll as $guru) {
       echo '<option value="'.$guru->id_guru.'">'.$guru->nik.' / '. $guru->nama_guru .'</option>';
     }
     ;?>
   </select>
 </div>
 <!-- / NIK -->

 <!-- Fullname -->
 <div class="form-group">
   <label for="addPenggunaFullnameGuru" class="col-form-label">Nama Guru</label>
   <input type="text" name="fullnameGuru" class="form-control" id="addPenggunaFullnameGuru" placeholder="Nama Guru" readonly/>
   <?= form_error('fullnameGuru', '<small class="text-danger pl-3">', '</small>');?>
 </div>
 <!-- / Fullname -->

 <!-- Fullname -->
 <div class="form-group">
   <label for="addPenggunaEmailGuru" class="col-form-label">Email</label>
   <input type="text" name="emailGuru" class="form-control" id="addPenggunaEmailGuru" placeholder="Email" value="<?= set_value('email')?>" />
   <?= form_error('emailGuru', '<small class="text-danger pl-3">', '</small>');?>
 </div>
 <!-- / Fullname -->
 <!-- Username -->
 <div class="form-group">
   <label for="addPenggunaUsernameGuru" class="col-form-label">Username</label>
   <input type="text" name="usernameGuru" class="form-control" id="addPenggunaUsernameGuru" placeholder="Username" value="<?= set_value('username')?>" readonly/>
   <?= form_error('usernameGuru', '<small class="text-danger pl-3">', '</small>');?>
 </div>
 <!-- / Username -->

 <!-- Password -->
 <div class="form-group">
   <label for="addPenggunaPasswordGuru" class="col-form-label">Password</label>
   <input type="text" name="passwordGuru" class="form-control" id="addPenggunaPasswordGuru" placeholder="Password" value="<?= set_value('password')?>" />
   <?= form_error('passwordGuru', '<small class="text-danger pl-3">', '</small>');?>
 </div>
 <!-- / Password -->

</div>

<div id=addPenggunaWali style="display: none">

  <!-- NISN -->
  <div class="form-group">
   <label for="addNISNWali" class="col-form-label">Silahkan Cari NISN Siswa</label>
   <select class="form-control select2" name="addNISNWali" id="addNISNWali">
    <option value="">Tulis NISN / Nama Siswa</option>
    <?php
    foreach ($siswaAll as $siswa) {
     echo '<option value="'.$siswa->id_siswa.'">'.$siswa->nis.' / '. $siswa->nama_siswa .'</option>';
   }
   ;?>
 </select>
</div>
<!-- / NISN -->

<!-- Fullname -->
<div class="form-group">
 <label for="addPenggunaFullnameWali" class="col-form-label">Fullname</label>
 <input type="text" name="fullnameWali" class="form-control" id="addPenggunaFullnameWali" placeholder="Fullname" readonly/>
 <?= form_error('fullnameWali', '<small class="text-danger pl-3">', '</small>');?>
</div>
<!-- / Fullname -->

<!-- Fullname -->
<div class="form-group">
 <label for="addPenggunaEmailWali" class="col-form-label">Email</label>
 <input type="text" name="emailWali" class="form-control" id="addPenggunaEmailWali" placeholder="Email" value="<?= set_value('email')?>" />
 <?= form_error('emailWali', '<small class="text-danger pl-3">', '</small>');?>
</div>
<!-- / Fullname -->
<!-- Username -->
<div class="form-group">
 <label for="addPenggunaUsernameWali" class="col-form-label">Username</label>
 <input type="text" name="usernameWali" class="form-control" id="addPenggunaUsernameWali" placeholder="Username" value="<?= set_value('username')?>" readonly/>
 <?= form_error('usernameWali', '<small class="text-danger pl-3">', '</small>');?>
</div>
<!-- / Username -->

<!-- Password -->
<div class="form-group">
 <label for="addPenggunaPasswordWali" class="col-form-label">Password</label>
 <input type="text" name="passwordWali" class="form-control" id="addPenggunaPasswordWali" placeholder="Password" value="<?= set_value('password')?>" />
 <?= form_error('passwordWali', '<small class="text-danger pl-3">', '</small>');?>
</div>
<!-- / Password -->

</div>

<div id=addPenggunaSiswa style="display: none">

  <!-- NISN -->
  <div class="form-group">
   <label for="addNISNSiswa" class="col-form-label">Silahkan Cari NISN Siswa</label>
   <select class="form-control select2" name="addNISNSiswa" id="addNISNSiswa">
    <option value="">Tulis NISN / Nama Siswa</option>
    <?php
    foreach ($siswaAll as $siswa) {
     echo '<option value="'.$siswa->id_siswa.'">'.$siswa->nis.' / '. $siswa->nama_siswa .'</option>';
   }
   ;?>
 </select>
</div>
<!-- / NISN -->

<!-- Fullname -->
<div class="form-group">
 <label for="addPenggunaFullnameSiswa" class="col-form-label">Fullname</label>
 <input type="text" name="fullnameSiswa" class="form-control" id="addPenggunaFullnameSiswa" placeholder="Fullname" readonly/>
 <?= form_error('fullnameSiswa', '<small class="text-danger pl-3">', '</small>');?>
</div>
<!-- / Fullname -->

<!-- Fullname -->
<div class="form-group">
 <label for="addPenggunaEmailSiswa" class="col-form-label">Email</label>
 <input type="text" name="emailSiswa" class="form-control" id="addPenggunaEmailSiswa" placeholder="Email" value="<?= set_value('email')?>" />
 <?= form_error('emailSiswa', '<small class="text-danger pl-3">', '</small>');?>
</div>
<!-- / Fullname -->
<!-- Username -->
<div class="form-group">
 <label for="addPenggunaUsernameSiswa" class="col-form-label">Username</label>
 <input type="text" name="usernameSiswa" class="form-control" id="addPenggunaUsernameSiswa" placeholder="Username" value="<?= set_value('username')?>" readonly/>
 <?= form_error('usernameSiswa', '<small class="text-danger pl-3">', '</small>');?>
</div>
<!-- / Username -->

<!-- Password -->
<div class="form-group">
 <label for="addPenggunaPasswordSiswa" class="col-form-label">Password</label>
 <input type="text" name="passwordSiswa" class="form-control" id="addPenggunaPasswordSiswa" placeholder="Password" value="<?= set_value('password')?>" />
 <?= form_error('passwordSiswa', '<small class="text-danger pl-3">', '</small>');?>
</div>
<!-- / Password -->

</div>

<div class="form-group text-right">
  <a class="btn btn-danger btn-sm" href="<?= base_url('admin/pengaturanPenggunaAdd');?>"><i class="fa fa-undo"></i>&ensp;Reset</a>
  <button type="submit" class="btn btn-primary btn-sm ">Submit &ensp;<i class="fas fa-arrow-right"></i></button>
</div> 

</form>

</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>


<div class="col-sm-4">

 <!-- Default box -->
 <div class="card card-outline card-info">
  <div class="card-header">
   <h4 class="card-title " text-align="center"><strong>List Level</strong></h4>
 </div>
 <div class="card-body">
   <ol>
    <li><b>Admin</b></li>
    <p>Untuk Level Admin Bisa Memasukkan Username Yang Diingkan</p>
    <li><b>Guru</b></li>
    <p>Untuk Level Guru Silahkan Mencari berdasarkan NIK<br> <b>Contoh</b> guru12345</p>
    <li><b>Wali</b></li>
    <p>Untuk Level Wali Silahkan Mencari berdasarkan NISN Siswa<br> <b>Contoh</b> wali12345</p>
    <li><b>Siswa</b></li>
    <p>Untuk Level Siswa Silahkan Mencari berdasarkan NISN Siswa<br> <b>Contoh</b> siswa12345</p>
  </ol>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

</div>

</div>


</div>
<!-- /.Container Fluid -->
</section>
<!-- /.content -->

</div>

<script type="text/javascript">

 window.onload = function () {

  $(document).ready(function() {

   /*-- Ajax Select Level  --*/
   $('#addPenggunaLevel').change(function(){
    var penggunaLevel = $('#addPenggunaLevel').val();
    if(penggunaLevel == 'Administrator'){

     $("#addPenggunaAdmin").css("display", "block");
     $("#addPenggunaGuru").css("display", "none");
     $("#addPenggunaWali").css("display", "none");
     $("#addPenggunaSiswa").css("display", "none");

   }else if(penggunaLevel == 'Guru'){

     $("#addPenggunaAdmin").css("display", "none");
     $("#addPenggunaGuru").css("display", "block");
     $("#addPenggunaWali").css("display", "none");
     $("#addPenggunaSiswa").css("display", "none");

   }else if(penggunaLevel == 'Wali'){

     $("#addPenggunaAdmin").css("display", "none");
     $("#addPenggunaGuru").css("display", "none");
     $("#addPenggunaWali").css("display", "block");
     $("#addPenggunaSiswa").css("display", "none");

   }else if(penggunaLevel == 'Siswa'){

     $("#addPenggunaAdmin").css("display", "none");
     $("#addPenggunaGuru").css("display", "none");
     $("#addPenggunaWali").css("display", "none");
     $("#addPenggunaSiswa").css("display", "block");

   }
 });

 });

  /*-- Ajax Select Nama Kelas  --*/
  $('#addNIKGuru').change(function(){
   var idGuru = $('#addNIKGuru').val();
   if(idGuru != ''){
    $.ajax({
     url:baseUrl+'admin/fetch_nikGuru',
     method:"POST",
     dataType:'json',
     data:{idGuru:idGuru},
     success:function(data){
      $('#addPenggunaFullnameGuru').val(data.nama);
      $('#addPenggunaUsernameGuru').val(data.nik);
    }
  })
  }
});

  /*-- Ajax Select Nama Kelas  --*/
  $('#addNISNWali').change(function(){
   var nisnWali = $('#addNISNWali').val();
   if(nisnWali != ''){
    $.ajax({
     url:baseUrl+'admin/fetch_nisnWali',
     method:"POST",
     dataType:'json',
     data:{nisnWali:nisnWali},
     success:function(data){
      $('#addPenggunaFullnameWali').val(data.nama);
      $('#addPenggunaUsernameWali').val(data.nisn);
    }
  })
  }
});

  /*-- Ajax Select Nama Kelas  --*/
  $('#addNISNSiswa').change(function(){
   var nisnSiswa = $('#addNISNSiswa').val();
   if(nisnSiswa != ''){
    $.ajax({
     url:baseUrl+'admin/fetch_nisnSiswa',
     method:"POST",
     dataType:'json',
     data:{nisnSiswa:nisnSiswa},
     success:function(data){
      $('#addPenggunaFullnameSiswa').val(data.nama);
      $('#addPenggunaUsernameSiswa').val(data.nisn);
    }
  })
  }
});

}

</script>