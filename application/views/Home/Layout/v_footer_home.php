<!-- Footer -->

<footer class="footer">
    <div class="footer_background"
        style="background-image:url(<?= base_url()?>assets/depan-web/images/footer_background.png)"></div>
    <div class="container">
        <div class="row footer_row">
            <div class="col">
                <div class="footer_content">
                    <div class="row">

                        <div class="col-lg-3 footer_col">

                            <!-- Footer About -->
                            <div class="footer_section footer_about">
                                <div class="footer_logo_container">
                                    <a href="#">
                                        <div class="footer_logo_text"><?= $sekolah->nama_sekolah ?></div>
                                    </a>
                                </div>
                                <div class="footer_about_text">
                                    <p>Sekolah Menengah Keislaman yang menjunjung tinggi nilai keislaman dalam
                                        melakukan kegiatan belajar
                                        mengajar.</p>
                                </div>
                                <div class="footer_social">
                                    <ul>
                                        <li><a
                                                href="https://www.facebook.com/pg/MA-PK-Maarif-Ngalian-624990901176103/posts/"><i
                                                    class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.instagram.com/mapkmaarifngalian/"><i
                                                    class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-3 footer_col">

                            <!-- Footer Contact -->
                            <div class="footer_section footer_contact">
                                <div class="footer_title">Contact Us</div>
                                <div class="footer_contact_info">
                                    <ul>
                                        <li><?= $sekolah->email?></li>
                                        <li><?= $sekolah->telepon?></li>
                                        <li><?= $sekolah->alamat?></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-3 footer_col">

                            <!-- Footer links -->
                            <div class="footer_section footer_links">
                                <div class="footer_title">Fast Menu</div>
                                <div class="footer_links_container">
                                    <ul>
                                        <li><a href="<?= base_url()?>">Home</a></li>
                                        <li><a href="<?= base_url('Home/pengumuman')?>">Tentang Sekolah</a></li>
                                        <li><a href="<?= base_url('Home/pengumuman')?>">Kontak Sekolah</a></li>
                                        <li><a href="<?= base_url('Home/pengumuman')?>">Pengumuman Sekolah</a></li>
                                        <li><a href="<?= base_url('Home/galery')?>">Galery Sekolah</a></li>
                                        <li><a href="<?= base_url('Home/sarpras')?>">Sarpras Sekolah</a></li>
                                        <li><a href="<?= base_url('Home/siswa')?>">Siswa</a></li>
                                        <li><a href="<?= base_url('Home/guru')?>">Guru</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-3 footer_col clearfix">

                            <!-- Footer links -->
                            <div class="footer_section footer_mobile">
                                <div class="footer_title">Mobile</div>
                                <div class="footer_mobile_content">
                                    <div class="footer_image"><a href="#"><img
                                                src="<?= base_url()?>assets/depan-web/images/mobile_1.png" alt=""></a>
                                    </div>
                                    <div class="footer_image"><a href="#"><img
                                                src="<?= base_url()?>assets/depan-web/images/mobile_2.png" alt=""></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row copyright_row">
            <div class="col">
                <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
                    <div class="cr_text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                            aria-hidden="true"></i> by <a href="https://github.com/EliterDaneo/Webmapk.git"
                            target="_blank"><?= $sekolah->nama_sekolah ?></a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <div class="ml-lg-auto cr_links">
                        <ul class="cr_list">
                            <li><a href="#">Copyright notification</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<script src="<?= base_url()?>assets/depan-web/assets/js/jquery-3.2.1.min.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/styles/bootstrap4/popper.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/plugins/easing/easing.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?= base_url()?>assets/depan-web/assets/js/custom.js"></script>
</body>

</html>