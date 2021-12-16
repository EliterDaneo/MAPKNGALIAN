<div class="super_container">

    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->
        <div class="top_bar">
            <div class="top_bar_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                                <ul class="top_bar_contact_list">
                                    <li>
                                        <div class="question">Have any questions?</div>
                                    </li>
                                    <li>
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <div><?= $sekolah->telepon ?></div>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <div><?= $sekolah->email ?></div>
                                    </li>
                                </ul>
                                <div class="top_bar_login ml-auto">
                                    <div class="login_button"><a href="<?= base_url('login') ?>">Login to system</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Content -->
        <div class="header_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header_content d-flex flex-row align-items-center justify-content-start">
                            <div class="logo_container">
                                <a href="#">
                                    <div class="logo_text">
                                        <marquee><?= $sekolah->nama_sekolah ?></marquee>
                                    </div>
                                </a>
                            </div>
                            <nav class="main_nav_contaner ml-auto">
                                <ul class="main_nav">
                                    <li class="active"><a href="<?= base_url('home') ?>">Home</a></li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Menu Sekolah
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="<?= base_url('Home/guru') ?>">Halaman
                                                Guru</a>
                                            <a class="dropdown-item" href="<?= base_url('Home/siswa') ?>">Halaman
                                                Siswa</a>
                                            <a class="dropdown-item" href="<?= base_url('Home/galery') ?>">Halaman
                                                Galery</a>
                                            <a class="dropdown-item" href="<?= base_url('Home/sarpras') ?>">Halaman
                                                Sarpras</a>
                                            <a class="dropdown-item" href="<?= base_url('Home/berita') ?>">Halaman
                                                Berita</a>
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </li>
                                    <li><a href="<?= base_url('Home/pengumuman') ?>">Pengumuman</a></li>
                                    <li><a href="<?= base_url('Home/download') ?>">Download</a></li>
                                    <li><a href="<?= base_url('Home/kontak') ?>">Contact</a></li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>