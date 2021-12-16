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
		</div>
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
						<!-- /.card-header -->
						<div class="card-body">

							<table id="example1" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:70px;">#Tanggal</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Pesan</th>
										<th style="text-align:right;">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=0; foreach ($data->result_array() as $i) :
									$no++;
									$inbox_id=$i['inbox_id'];
									$inbox_nama=$i['inbox_nama'];
									$inbox_email=$i['inbox_email'];
									$inbox_msg=$i['inbox_pesan'];
									$tanggal=$i['tanggal'];

									?>
									<tr>
										<td><?php echo $tanggal;?></td>
										<td><?php echo $inbox_nama;?></td>
										<td><?php echo $inbox_email;?></td>
										<td><?php echo $inbox_msg;?></td>
										<td style="text-align:right;">
											<a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $inbox_id;?>"><span class="fa fa-trash"></span></a>
										</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<?php foreach ($data->result_array() as $i) :
              $inbox_id=$i['inbox_id'];
              $inbox_nama=$i['inbox_nama'];
              $inbox_email=$i['inbox_email'];
              $inbox_msg=$i['inbox_pesan'];
              $tanggal=$i['tanggal'];
            ?>
	<!--Modal Hapus Pengguna-->
        <div class="modal fade" id="ModalHapus<?php echo $inbox_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Agenda</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'admin/inbox/hapus_inbox'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
							       <input type="hidden" name="kode" value="<?php echo $inbox_id;?>"/>
                            <p>Apakah Anda yakin mau menghapus data ini?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
	<?php endforeach;?>

	</section>