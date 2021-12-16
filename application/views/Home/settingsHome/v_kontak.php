<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact -->

<div class="contact">

    <!-- Contact Map -->

    <div class="contact_map">

        <!-- Google Map -->

        <div class="map">
            <div id="google_map" class="google_map">
                <div class="map_container">
                    <div id="map"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Contact Info -->

    <div class="contact_info_container">
        <div class="container">
            <div class="row">

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="contact_form">
                        <div class="contact_info_title">Form Kontak Pengaduan</div>
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
                            <div>
                                <button type="submit" class="comment_button trans_200">submit now</button>
                            </div>

                        </form>
                        <div><?php echo $this->session->flashdata('msg');?></div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-6">
                    <div class="contact_info">
                        <div class="contact_info_title">Kontak Info</div>
                        <div class="contact_info_text">
                            <p>Anda dapat menghubungi kami lewat layanan kontak dibawah atau bisa datang langsung ke
                                tempat kami
                                yang berada pada alamat yang sudah tertera dibawah ini, Terima kasih</p>
                        </div>
                        <div class="contact_info_location">
                            <div class="contact_info_location_title">Alamat Sekolah</div>
                            <ul class="location_list">
                                <li><?= $sekolah->alamat?></li>
                                <li><?= $sekolah->telepon?></li>
                                <li><?= $sekolah->email?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>