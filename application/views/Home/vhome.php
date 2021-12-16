<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            <?php foreach ($berita as $key => $value) { ?>
            <div class="carousel-item active"
                style="background-image:url(<?= base_url('assets/data/foto/gambar_berita/'. $value->gambar_berita) ?>)">
                <div class="carousel-container">
                    <div class="container">
                        <h2 class="animate__animated animate__fadeInDown"><span><?= $value->judul_berita ?></span></h2>
                        <p class="animate__animated animate__fadeInUp">
                        <p><?= substr(strip_tags($value->isi_berita), 0, 100) ?>...</p>
                        </p>
                        <a href="<?= base_url('Home/detail_berita/' . $value->slug_berita) ?>"
                            class="btn-get-started animate__animated animate__fadeInUp">Read
                            More</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services section-bg">
        <div class="container">

            <div class="row no-gutters">
                <div class="col-lg-4 col-md-6">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-laptop"></i></div>
                        <h4 class="title"><a href="#about">Tentang Sekolah</a></h4>
                        <p class="description"><?= $sekolah->sejarah ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-briefcase"></i></div>
                        <h4 class="title"><a href="#services">Sarana Prasarana Sekolah</a></h4>
                        <p class="description"><?= $sarana->keterangan_sarpras ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-calendar4-week"></i></div>
                        <h4 class="title"><a href="<?= base_url('Home/Download')?>">Download</a></h4>
                        <p class="description">Ada beberapa data yang bisa anda download, data tersebut bersifat terbuka
                            kepada seluruh masyarakat umum</p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="section-title">
                <h2>About Us</h2>
                <p><?= $sekolah->sejarah ?></p>
            </div>

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2">
                    <img src="<?= base_url('assets/data/foto/sekolah/foto_kapsek/'. $sekolah->foto_kapsek ) ?>"
                        class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h3>Data berupa valid dimana data ini adalah tentang skeolah.</h3>
                    <p class="fst-italic">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form_title">Nama Sekolah</div>
                            <p class="text-align"><strong><?= $sekolah->nama_sekolah ?></strong></p>
                        </li>
                        <li class="list-group-item">
                            <div class="form_title">Alamat Sekolah</div>
                            <p class="text-align"><strong><?= $sekolah->alamat ?></strong></p>
                        </li>
                        <li class="list-group-item">
                            <div class="form_title">Telephone Sekolah</div>
                            <p class="text-align"><strong><?= $sekolah->telepon ?></strong></p>
                        </li>
                        <li class="list-group-item">
                            <div class="form_title">Email Sekolah</div>
                            <p class="text-align"><strong><?= $sekolah->email ?></strong></p>
                        </li>
                    </ul>
                    </p>

                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row no-gutters">

                <div class="col-lg-12 col-md-4 d-flex align-items-stretch">
                    <div class="member">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form_title text-center">Visi Sekolah</div>
                                <p class="text-align"><strong><?= $sekolah->visi ?></strong></p>
                            </li>
                            <li class="list-group-item">
                                <div class="form_title text-center">Misi Sekolah</div>
                                <p class="text-align"><strong><?= $sekolah->misi ?></strong></p>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 chart_bottom">
                    <div class="chart-img">
                        <img src="<?= base_url () ?>assets/depan-web/assets/img/chart-icon_1.png" class="img-fluid"
                            alt="chart_icon">
                    </div>
                    <div class="chart-text">
                        <p><span class="counter"><?php echo $tot_guru;?></span> Guru
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 chart_bottom chart_top">
                    <div class="chart-img">
                        <img src="<?= base_url () ?>assets/depan-web/assets/img/chart-icon_2.png" class="img-fluid"
                            alt="chart_icon">
                    </div>
                    <div class="chart-text">
                        <p><span class="counter"><?php echo $tot_siswa;?></span> Siswa
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 chart_top">
                    <div class="chart-img">
                        <img src="<?= base_url () ?>assets/depan-web/assets/img/chart-icon_3.png" class="img-fluid"
                            alt="chart_icon">
                    </div>
                    <div class="chart-text">
                        <p><span class="counter"><?php echo $tot_files;?></span> Download
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="chart-img">
                        <img src="<?= base_url () ?>assets/depan-web/assets/img/chart-icon_4.png" class="img-fluid"
                            alt="chart_icon">
                    </div>
                    <div class="chart-text">
                        <p><span class="counter"><?php echo $tot_pengumuman;?></span> Pengumuman</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Cta Section -->

    <!-- ======= Struktur Section ======= -->
    <section id="Striktur" class="Striktur">
        <div class="container">

            <div class="section-title">
                <h2>Struktur Organisasi</h2>
                <p>Dibawah ini merupakan susunan struktur organisasi sekolah MA PK Ma'arif Ngalian</p>
            </div>

            <div class="text-center wow fadeInUp">
                <img src="<?= base_url('assets/data/foto/struktur/'. $struktur->foto_struktur ) ?>"
                    class="img-repsonsive" width="1100px" height="600px">
            </div>
        </div>
    </section>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Contact</h2>
                <p>Anda dapat menghubungi kami lewat layanan kontak dibawah atau bisa datang langsung ke tempat kami
                    yang berada pada alamat yang sudah tertera dibawah ini, Terima kasih</p>
            </div>

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p><?= $sekolah->alamat ?></p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p><?= $sekolah->email ?></p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p><?= $sekolah->telepon ?></p>
                        </div>
                        <iframe
                            src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=ma pk maarif ngalian&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="<?= base_url ('Contact/kirim_pesan') ?>" method="post" role="form"
                        class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Your Name</label>
                                <input type="text" name="xnama" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="name">Your Email</label>
                                <input type="email" class="form-control" name="xemail" id="email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Phone</label>
                            <input type="text" class="form-control" name="xphone" id="phone" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="xmessage" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                        <div><?php echo $this->session->flashdata('msg');?></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->