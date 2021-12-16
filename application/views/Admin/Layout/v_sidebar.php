 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="" class="brand-link">
         <img src="<?= base_url('assets/data/foto/logo/logo.png') ?>" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">
             <marquee> MA PK MAARIF NGALIAN </marquee>
         </span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <?php if (file_exists(FCPATH . './assets/data/foto/user/img/admin/' . $user->foto_user) || $user->foto_user !== 'default.jpg') : ?>
                 <img class="img-circle elevation-2" alt="User Image"
                     src="<?= base_url('assets/data/foto/user/img/admin/' . $user->foto_user) ?>"
                     alt="User profile picture">
                 <?php else : ?>
                 <img class="img-circle elevation-2" alt="User Image"
                     src="<?= base_url('assets/data/foto/user/img/admin/default.jpg') ?>" alt="User profile picture">
                 <?php endif; ?>
             </div>
             <div class="info">
                 <a class="d-block"><?= $user->nama_user ?></a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                 <li class="nav-item menu-open">
                     <a href="<?= base_url('admin') ?>" class="nav-link active">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                 </li>
                 <li class="nav-header">Management Data</li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/inbox'); ?>" class="nav-link">
                         <i class="nav-icon far fa-envelope"></i>
                         <p>
                             Mailbox
                             <span class="badge badge-info right"><?php echo $jum_pesan; ?></span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/pengaturanGalery'); ?>" class="nav-link">
                         <i class="nav-icon far fa-image"></i>
                         <p>
                             Gallery
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/Sarpras'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-columns"></i>
                         <p>
                             Sarpras
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/pengaturanPengumuman'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-bullhorn"></i>
                         <p>
                             Pengumuman
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/pengaturanBerita'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-newspaper"></i>
                         <p>
                             Pengaturan Berita
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/pengaturanDownload'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-download"></i>
                         <p>
                             pengaturan Download
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/pengaturanGuru'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-chalkboard-teacher"></i>
                         <p>
                             Data Guru
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/pengaturanSiswa'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-user-graduate"></i>
                         <p>
                             Data Siswa
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/pengaturanMapel'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-calendar-day"></i>
                         <p>
                             Data Mata Pelajaran
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/pengaturanKelas'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-house-user"></i>
                         <p>
                             Data Kelas
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Admin/dashboardNilai'); ?>" class="nav-link">
                         <i class="nav-icon far fa-clipboard"></i>
                         <p>
                             Data Nilai
                         </p>
                     </a>
                 </li>
                 <li class="nav-header">Management Website</li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Management
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="<?= base_url('Admin/ManagementUsers') ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Management Pengguna</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="<?= base_url('Admin/SettingsLogo') ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Management Logo</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="<?= base_url('Admin/SettingsSturcture') ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Management Struktur</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="<?= base_url('Admin/SettingsWebsite') ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Management Tentang</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-header">Logout Menu</li>
                 <li class="nav-item">
                     <a class="nav-link" data-toggle="modal" data-target="#logOutModal">
                         <i class="nav-icon fa-fw fas fa-sign-out-alt"></i>
                         <p>
                             Keluar
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>

 <!-- Logout Modal-->
 <div class="modal fade" id="logOutModal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header card-outline">
                 <h5 class="modal-title">Ready to Leave?</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <p>Select "Logout" below if you are ready to end your current session.</p>
             </div>
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i
                         class="fas fa-times"></i>&ensp;Close</button>
                 <a class="btn btn-sm btn-danger" href="<?= base_url('login/logout'); ?>"><i
                         class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>