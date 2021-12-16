    <!-- Home -->

    <div class="home">
        <div class="home_slider_container">

            <!-- Home Slider -->
            <div class="owl-carousel owl-theme home_slider">

                <!-- Home Slider Item -->
                <?php foreach ($berita as $key => $value) { ?>
                <div class="owl-item">
                    <div class="home_slider_background"
                        style="background-image:url(<?= base_url('assets/data/foto/gambar_berita/'. $value->gambar_berita) ?>)">
                    </div>
                    <div class="home_slider_content">
                        <div class="container">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="home_slider_title"><?= $value->judul_berita ?></div>
                                    <div class="home_slider_subtitle">
                                        <?= substr(strip_tags($value->isi_berita), 0, 100) ?>...</div>
                                    <a href="<?= base_url('Home/detail_berita/' . $value->slug_berita) ?>"
                                        class="btn-get-started animate__animated animate__fadeInUp">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Home Slider Nav -->

        <div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
        <div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
    </div>

    <!-- Features -->

    <div class="features">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <h2 class="section_title">Welcome To Website <?= $sekolah->nama_sekolah ?></h2>
                        <div class="section_subtitle">
                            <p>
                                <?= $sekolah->sejarah?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row features_row">

                <!-- Features Item -->
                <div class="col-lg-3 feature_col">
                    <div class="feature text-center trans_400">
                        <div class="feature_icon"><img src="<?= base_url()?>assets/depan-web/images/icon_1.png" alt="">
                        </div>
                        <h3 class="feature_title">Visi Sekolah</h3>
                        <div class="feature_text">
                            <p><?= $sekolah->visi?></p>
                        </div>
                    </div>
                </div>

                <!-- Features Item -->
                <div class="col-lg-3 feature_col">
                    <div class="feature text-center trans_400">
                        <div class="feature_icon"><img src="<?= base_url()?>assets/depan-web/images/icon_2.png" alt="">
                        </div>
                        <h3 class="feature_title">Misi Sekolah</h3>
                        <div class="feature_text">
                            <p><?= $sekolah->visi?></p>
                        </div>
                    </div>
                </div>

                <!-- Features Item -->
                <div class="col-lg-3 feature_col">
                    <div class="feature text-center trans_400">
                        <div class="feature_icon"><img src="<?= base_url()?>assets/depan-web/images/icon_3.png" alt="">
                        </div>
                        <h3 class="feature_title">Sarana Prasarana</h3>
                        <div class="feature_text">
                            <p><?= $sarana->keterangan_sarpras?></p>
                        </div>
                    </div>
                </div>

                <!-- Features Item -->
                <div class="col-lg-3 feature_col">
                    <div class="feature text-center trans_400">
                        <div class="feature_icon"><img src="<?= base_url()?>assets/depan-web/images/icon_4.png" alt="">
                        </div>
                        <h3 class="feature_title">Alamat Sekolah</h3>
                        <div class="feature_text">
                            <p><?= $sekolah->alamat?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Popular Courses -->

    <div class="courses">
        <div class="section_background parallax-window" data-parallax="scroll"
            data-image-src="images/courses_background.jpg" data-speed="0.8"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <h2 class="section_title">Jumlah Pengguna</h2>
                        <div class="section_subtitle">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu.
                                Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Counter -->

    <div class="counter">
        <div class="counter_background"
            style="background-image:url(<?= base_url()?>assets/depan-web/images/chart_bg.png)"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="counter_content">

                        <!-- Milestones -->

                        <div
                            class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">

                            <!-- Milestone -->
                            <div class="milestone">
                                <div class="milestone_counter" data-end-value="<?php echo $tot_guru;?>"
                                    data-sign-after="+">0</div>
                                <div class="milestone_text">Total Guru</div>
                            </div>

                            <!-- Milestone -->
                            <div class="milestone">
                                <div class="milestone_counter" data-end-value="<?php echo $tot_siswa;?>"
                                    data-sign-after="+">0</div>
                                <div class="milestone_text">Total Siswa</div>
                            </div>

                            <!-- Milestone -->
                            <div class="milestone">
                                <div class="milestone_counter" data-end-value="<?php echo $tot_files;?>"
                                    data-sign-after="+">0</div>
                                <div class="milestone_text">Total Files</div>
                            </div>

                            <!-- Milestone -->
                            <div class="milestone">
                                <div class="milestone_counter" data-end-value="<?php echo $tot_pengumuman;?>">0</div>
                                <div class="milestone_text">Total Pengumuman</div>
                            </div>

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
                        <h2 class="section_title">Berita Terbaru Sekolah</h2>
                        <div class="section_subtitle">
                            <p>Berikut adalah berita yang dapat ditampilkan, diharapkan berita sekolah tersebut bisa
                                digunakan sebagai mana mestinya
                        </div>
                    </div>
                </div>
            </div>
            <div class="row news_row">
                <div class="col-lg-7 news_col">

                    <!-- News Post Large -->
                    <?php $no=1; foreach ($update as $key => $value) { ?>
                    <div class="news_post_large_container">
                        <div class="news_post_large">
                            <div class="news_post_image"><img
                                    src="<?= base_url('assets/data/foto/gambar_berita/'.$value->gambar_berita)?>"
                                    alt=""></div>
                            <div class="news_post_large_title"><a
                                    href="<?= base_url('Home/detail_berita/'.$value->slug_berita) ?>"><?= substr(strip_tags($value->judul_berita), 0, 25) ?>...</a>
                            </div>
                            <div class="news_post_meta">
                                <ul>
                                    <li><a href="#">Uploader : <?= $value->nama_user ?></a></li>
                                    <li><a href="#"><?= $value->tanggal_berita ?></a></li>
                                </ul>
                            </div>
                            <div class="news_post_text">
                                <p><?= substr(strip_tags($value->isi_berita), 0, 100) ?>...</p>
                            </div>
                            <div class="news_post_link"><a
                                    href="<?= base_url('Home/detail_berita/'.$value->slug_berita) ?>">read more</a>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                    <?php }?>
                </div>

                <div class="col-lg-5 news_col">
                    <div class="news_posts_small">

                        <!-- News Posts Small -->
                        <?php foreach ($update as $key => $value) { ?>
                        <div class="news_post_small">
                            <div class="news_post_small_title"><a
                                    href="<?= base_url('Home/detail_berita/'.$value->slug_berita) ?>"><?= substr(strip_tags($value->judul_berita), 0, 25) ?>...</a>
                            </div>
                            <div class="news_post_meta">
                                <ul>
                                    <li><a href="#">Uploader : <?= $value->nama_user ?></a></li>
                                    <li><a href="#"><?= $value->tanggal_berita ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>