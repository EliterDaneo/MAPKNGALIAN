<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $page?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= base_url('siswa/chat')?>"><small><?= $page ;?></small></a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <?php echo $this->session->flashdata('pesan'); ?>
    <?php if(validation_errors()) : ?>
      <div class="alert alert-danger" role="alert">
        <?php echo validation_errors(); ?>
      </div>
    <?php endif?>
  </section> 
  <!-- /.content-header -->

  <div class="col-md-8">
    <!-- general form elements disabled -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Isian</h3>
      </div>
      <!-- /.card-header -->
      <?php echo form_open_multipart('siswa/kirimAduan'); ?>   
      <div class="card-body">
        <form role="form">
          <div class="row">
            <div class="col-sm-12">
              <!-- text input -->
              <!-- <div class="form-group">
                <label>Pilih Jenis Pengaduan</label>
                <select name="id_pengaduan" class="form-control">
                  <option value="">----Pilih Jenis Pengaduan----</option>
                  <?php foreach ($pengaduan as $key => $value) { ?>
                    <option value="<?= $value->id_pengaduan ?>"><?= $value->jenis_pengaduan ?></option>
                  <?php } ?>
                </select>
              </div> -->
              <div class="form-group">
                <label>Jenis Pengaduan</label>
                <select name="jenis_pengaduan" class="form-control">
                  <option value="">----Pilih Jenis Pengaduan----</option>
                  <option value="Nilai Tidak Sesuai">Nilai Tidak Sesuai</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <!-- textarea -->
              <div class="form-group">
                <label>Textarea</label>
                <textarea class="form-control" name="isi" rows="3" placeholder="Enter ..."></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form-group" type="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-success">Reset</button>
            <a href="<?= base_url('admin/pengaturanSiswa')?>"  class="btn btn-danger">Kembali</a>
          </div>
        </div>
      </form>
      <?php echo form_close(); ?>  
    </div>
    <!-- /.card-body -->
  </div>