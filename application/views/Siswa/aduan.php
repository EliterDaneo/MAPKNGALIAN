<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
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

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="<?=base_url('siswa/kirimAduan')?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Tambah Pengaduan</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="myTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th>Nama Pengadu</th> -->
                            <th>Jenis Pengaduan</th>
                            <th>Isi Pengaduan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($pengaduan as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <!-- <td><?= $value->nama_siswa ?></td>
                                -->                                <td><?= $value->jenis_pengaduan ?></td>
                                <td><?= $value->isi ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</section>