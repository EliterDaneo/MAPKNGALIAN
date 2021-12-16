 <!-- Home -->

 <div class="home">
     <div class="breadcrumbs_container">
         <div class="container">
             <div class="row">
                 <div class="col">
                     <div class="breadcrumbs">
                         <ul>
                             <li><a href="<?= base_url()?>">Home</a></li>
                             <li>Halaman Berita Sekolah</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Latest News -->

 <div class="news">
     <div class="container">
         <div class="row">
             <div class="col">
                 <div class="section_title_container text-center">
                     <h2 class="section_title">Berita Sekolah</h2>
                     <div class="section_subtitle">
                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum
                             feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row news_row">
             <div class="col-lg-7 news_col">

                 <!-- News Post Large -->
                 <?php foreach ($berita as $key => $value) { ?>
                 <div class="news_post_large_container">
                     <div class="news_post_large">
                         <div class="news_post_image"><img
                                 src="<?= base_url('assets/data/foto/gambar_berita/'.$value->gambar_berita)?>" alt="">
                         </div>
                         <div class="news_post_large_title"><a
                                 href="<?= base_url('Home/detail_berita/'.$value->slug_berita) ?>"><?= substr(strip_tags($value->judul_berita), 0, 25) ?>...
                             </a></div>
                         <div class="news_post_meta">
                             <ul>
                                 <li><a>Uploader : <?= $value->nama_user ?></a></li>
                                 <li><a><?= $value->tanggal_berita ?></a></li>
                             </ul>
                         </div>
                         <div class="news_post_text">
                             <p><?= substr(strip_tags($value->isi_berita), 0, 100) ?>...</p>
                         </div>
                         <div class="news_post_link"><a
                                 href="<?= base_url('Home/detail_berita/'.$value->slug_berita) ?>">read more</a></div>
                     </div>
                 </div>
                 <?php } ?>
             </div>


             <div class="col-lg-5 news_col">
                 <div class="news_posts_small">

                     <!-- News Posts Small -->
                     <?php foreach ($update as $key => $value) { ?>
                     <div class="news_post_small">
                         <div class="news_post_small_title"><a
                                 href="<?= base_url('Home/detail_berita/'.$value->slug_berita) ?>"><?= $value->judul_berita ?>"></a>
                         </div>
                         <div class="news_post_meta">
                             <ul>
                                 <li><a><?= $value->nama_user ?></a></li>
                                 <li><a><?= $value->tanggal_berita ?></a></li>
                             </ul>
                         </div>
                     </div>
                     <?php }?>
                 </div>
             </div>
         </div>
     </div>
 </div>