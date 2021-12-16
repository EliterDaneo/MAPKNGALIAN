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
		<div class="col-12">
			<div class="callout callout-danger">
				<h5><i class="fas fa-info"></i> Note:</h5>
				<text class="text-danger"><b>Selamat datang di Sistem Akademik MA PK MA'ARIF NGALIAN</b></text>
			</div>
		</div>

		<?php echo form_open_multipart('admin/SettingsSturcture'); ?>

		<!-- Default box -->
		<div class="card card-solid">
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-sm-6">
						<h3 class="my-3 text-center">Struktur Organisasi</h3>
						<div class="col-12">
							<img src="<?= base_url('assets/data/foto/struktur/'.$struktur->foto_struktur) ?>" class="product-image">
						</div>
						<div class="form-group">
							<label>Ganti Foto Struktur Organisasi</label>
							<input class="form-control" type="file" name="foto_struktur" >
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label>Nama Sekolah</label>
							<input class="form-control" type="text" value="<?= $struktur->keterangan ?>" name="keterangan" placeholder="keterangan Struktur">
						</div>
						<div class="form-group" type="text-center">
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</div>

					<?php echo form_close() ; ?>
					<div class="row mt-4">
						<nav class="w-100">
							<div class="nav nav-tabs" id="product-tab" role="tablist">
								<a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Penjelasan</a>
							</div>
						</nav>
						<div class="tab-content p-3" id="nav-tabContent">
							<div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Foto dan semua yang berada di menu ini bisa diubah tergantung dari kepa sekolah </div>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->

		</section>
		<!-- /.content -->
	</div>