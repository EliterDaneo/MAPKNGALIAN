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
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title"><?= $title?></h3>
				</div>
				<!-- /.card-header -->
				<div class="panel-body">

					<!-- /.card-body -->
					<?php echo form_open_multipart('admin/addSarpras'); ?>	
					<form role="form">
						<div class="card-body">	
							<div class="form-group">
								<label>Nama Sarpras</label>
								<input class="form-control" type="text" name="nama_sarpras" placeholder="Nama Sarpras" required>
							</div>
							<div class="form-group">
								<label>Keterangan Sarana</label>
								<input class="form-control" type="text" name="keterangan_sarana" placeholder="Keterangan Sarana" required>
							</div>
							<div class="form-group">
								<label>Keterangan Alat</label>
								<select name="keterangan_alat" class="form-control">
									<option value="">----Pilih Berdasarkan Kondisi----</option>
									<option value="cukup">Cukup</option>
									<option value="sedang">Sedang</option>
									<option value="baik">Baik</option>
								</select>
							</div>
							<div class="form-group">
								<label>Foto</label>
								<input class="form-control" type="file" name="foto" placeholder="Foto Sarana" required>
							</div>
							<div class="form-group" type="text-center">
								<button type="submit" class="btn btn-primary">Simpan</button>
								<button type="reset" class="btn btn-success">Reset</button>
								<a href="<?= base_url('admin/pengaturanGalery')?>"  class="btn btn-danger">Kembali</a>
							</div>
							<?php echo form_close(); ?>
						</div>
					</form>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
