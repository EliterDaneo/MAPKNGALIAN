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
<section class="content ">
  <div class="container-fluid">
   <!-- Default box -->
   <div class="card card-outline card-info">
    <div class="card-header">
        <a href="<?=base_url('admin/tambahpengumuman')?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Tambah Data</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <table id="example1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Pengumuman</th>
                    <th>Isi Pengumuman</th>
                    <th>Tanggal Di Terbitkan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($pengumuman as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->judul_pengumuman ?></td>
                        <td><?= $value->isi_pengumuman ?></td>
                        <td><?= $value->tanggal_pengumuman ?></td>
                        <td>
                            <a href="<?= base_url('admin/editPengumuman/'.$value->id_pengumuman) ?>" title="Edit"><i class="fas fa-edit text-warning"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deletePengumuman<?= $value->id_pengumuman ?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->


<!-- Barang Hapus Modal-->
<?php $i=0; foreach($pengumuman as $value) :  $i++;?>
<div class="modal fade" id="deletePengumuman<?php echo $value->id_pengumuman;?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title">Hapus <?= $title;?> "<?php echo $value->judul_pengumuman;?>" </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Pilih "Hapus" dibawah untuk menghapus <?= $title;?> <b><?php echo $value->judul_pengumuman;?></b>.</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
                <a class="btn btn-danger btn-sm" href="<?= base_url('admin/deletePengumuman/' .$value->id_pengumuman) ?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>


</section>

