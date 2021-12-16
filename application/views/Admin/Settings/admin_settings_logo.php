 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <section class="content">
      <div class="col-12">
         <div class="callout callout-danger">
            <h5><i class="fas fa-info"></i> Note:</h5>
            <text class="text-danger"><b>Selamat datang di Sistem Akademik MA PK MA'ARIF NGALIAN</b></text>
         </div>
      </div>
      <div class="container-fluid">
       <div class="row">
        <!-- left column -->
        <div class="col-md-6">
         <!-- general form elements -->
         <div class="card card-primary">
          <div class="card-header">
           <h3 class="card-title">Logo Sttings</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php echo form_open_multipart('admin/SettingsLogo'); ?>
        <form>
           <div class="card-body">
            <div class="form-group">
             <label>Nama Sekolah</label>
             <input class="form-control" type="text" value="<?= $logo->nama_sekolah ?>" name="nama_sekolah" placeholder="Nama Sekolah">
          </div>
          <div class="form-group">
             <label>File input</label>
             <div class="input-group">
              <div class="custom-file">
               <input class="form-control" type="file" name="logo">
               <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
         </div>
      </div>
   </div>
   <!-- /.card-body -->
   <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
   </div>
</form>
<?php echo form_close() ; ?>
</div>
<!-- /.card -->

<!--/.col (left) -->
<!-- right column -->
<div class="col-md-6">
   <!-- Form Element sizes -->
   <div class="card card-success">
     <div class="card-header">
      <h3 class="card-title">Your Logo</h3>
   </div>
   <div class="card-body">
    <div class="col-12">
      <img src="<?= base_url('assets/data/foto/logo/'.$logo->logo) ?>" class="product-image" alt="Product Image">
   </div>
</div>
<!-- /.card-body -->
</div>
</div>
<!--/.col (left) -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
    <!-- /.content -->