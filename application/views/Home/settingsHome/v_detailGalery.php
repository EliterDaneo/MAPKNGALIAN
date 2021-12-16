 <!-- ======= Services Section ======= -->
 <section id="services" class="services">
 	<div class="container">

 		<div class="section-title">
 			<h2>Detail Galery</h2>
 			<div class="section_title_container text-center">
 				<h2 class="section_title"><?= $nama_galery->nama_galery ?></h2>
 			</div>
 		</div>

 		<div class="row no-gutters">
 			<?php $no=1; foreach ($foto as $key => $value) { ?>
 				<div class="col-lg-4 col-md-6 content-item">
 					<span><?= $no++ ?></span>
 					<div class="about_item">
 						<div class="about_item_image"><img src="<?= base_url('assets/data/foto/sampul/foto/'. $value->foto) ?>" width="250px" height="180px" ></div>
 						<div class="about_item_title"><?= $value->ket_foto ?></div>
 					</div>
 				</div>
 			<?php } ?>
 		</div>

 		
 	</div>
 </div>
    </section><!-- End Services Section -->