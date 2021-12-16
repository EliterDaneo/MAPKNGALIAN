  <!-- partial -->
  <div class="main-panel">        
  	<div class="content-wrapper">
  		<div class="row">
        <?php echo $this->session->flashdata('pesan'); ?>
        <?php if(validation_errors()) : ?>
          <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
          </div>
        <?php endif?>
        <div class="col-md-14 grid-margin stretch-card">
          <div class="card">
           <div class="card-body">
            <h4 class="card-title">Default form</h4>
            <p class="card-description text-left">
             <a href="<?=base_url('Admin/AddUserManagement')?>" class="btn btn-primary btn-sm">Tambah Data</a>
           </p>
           <table id="example1" class="table table-striped table-bordered table-hover">
             <thead>
              <tr>
               <th>Judul News</th>
               <th>Slug News</th>
               <th>Gambar News</th>
               <th>TGL News</th>
               <th>User ID</th>
               <th>Aksi</th>
             </tr>
           </thead>
           <tbody>
            <?php foreach ($News as $key => $value) { ?>
             <tr>
              <td><?= $value->judul_berita ?></td>
              <td><?= $value->slug_berita ?></td>
              <td><img src="<?= base_url('assets/data/foto/gambar_berita/'. $value->gambar_berita) ?>" width="100px"></td>
              <td><?= $value->tanggal_berita ?></td>
              <td><?= $value->nama_user ?></td>
              <td>
               <a href="#" data-toggle="modal" data-target="#editUser<?= $value->id_user ?>" title="Edit"><i style="margin-right:10px; height: 50px; width: 50px;" class="mdi mdi-table-edit"></i></a>
               <a href="#" data-toggle="modal" data-target="#deleteUser<?= $value->id_user ?>" title="Delete"><i style="margin-right:10px; height: 50px; width: 50px;" class="mdi mdi-delete-sweep"></i></a>
             </td>
           </tr>
         <?php } ?>
       </tbody>
     </table>
   </div>
 </div>
</div>