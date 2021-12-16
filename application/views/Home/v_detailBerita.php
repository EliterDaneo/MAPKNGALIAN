 <!-- Home -->

 <div class="home">
     <div class="breadcrumbs_container">
         <div class="container">
             <div class="row">
                 <div class="col">
                     <div class="breadcrumbs">
                         <ul>
                             <li><a href="<?= base_url()?>">Home</a></li>
                             <li>Halaman Detail Berita Sekolah</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Latest News -->

 <!-- Blog -->

 <div class="blog">
     <div class="container">
         <div class="row">

             <!-- Blog Content -->
             <div class="col-lg-8">
                 <div class="blog_content">
                     <div class="blog_title"><?= $beritaBerita->judul_berita ?></div>
                     <div class="blog_meta">
                         <ul>
                             <li>Post on <a><?= $beritaBerita->tanggal_berita ?></a></li>
                             <li>By <a><?= $beritaBerita->nama_user ?></a></li>
                         </ul>
                     </div>
                     <div class="blog_image"><img
                             src="<?= base_url('assets/data/foto/gambar_berita/' . $beritaBerita->gambar_berita) ?>"
                             alt=""></div>
                     <p><?= $beritaBerita->isi_berita ?></p>
                 </div>
             </div>

             <!-- Blog Sidebar -->
             <div class="col-lg-4">
                 <div class="sidebar">

                     <!-- Latest News -->
                     <div class="sidebar_section">
                         <div class="sidebar_section_title">Latest Courses</div>
                         <div class="sidebar_latest">

                             <!-- Latest Course -->
                             <?php foreach ($sideBerita as $key => $value) { ?>
                             <div class="latest d-flex flex-row align-items-start justify-content-start">
                                 <div class="latest_image">
                                     <div><img
                                             src="<?= base_url('assets/data/foto/gambar_berita/' . $value->gambar_berita) ?>"
                                             alt=""></div>
                                 </div>
                                 <div class="latest_content">
                                     <div class="latest_title"><a
                                             href="<?= base_url('Home/detail_berita/'.$value->slug_berita) ?>"><?= $value->judul_berita ?>"></a>
                                     </div>
                                     <div class="latest_date"><?= $value->tanggal_berita ?></div>
                                 </div>
                             </div>
                             <?php }?>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </div>