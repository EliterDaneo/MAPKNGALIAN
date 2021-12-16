<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url()?>">Home</a></li>
                            <li>Menu Galery</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Events -->

<div class="events">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">Halaman Galery Sekolah</h2>
                    <div class="section_subtitle">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum
                            feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row events_row">

            <!-- Event -->
            <?php foreach ($galery as $key => $value) { ?>
            <div class="col-lg-4 event_col">
                <div class="event event_left">
                    <div class="event_image"><img src="<?= base_url ('assets/data/foto/sampul/'.$value->sampul)?>"
                            alt=""></div>
                    <div class="event_body d-flex flex-row align-items-start justify-content-start">
                        <div class="event_date">
                            <div class="d-flex flex-column align-items-center justify-content-center trans_200">
                                <div class="event_day trans_200"><?= $value->tanggal_galery?></div>
                            </div>
                        </div>
                        <div class="event_content">
                            <div class="event_title"><a
                                    href="<?= base_url('home/detail_galery/'.$value->id_galery) ?>"><?= $value->nama_galery?></a>
                            </div>
                            <div class="event_info_container">
                                <div class="event_info"><i class="fa fa-clock-o" aria-hidden="true"></i><span>jumlah :
                                        <?= $value->jml_foto ?> Foto</span></div>
                                <div class="event_text">
                                    <p><?= $value->tanggal_galery?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>