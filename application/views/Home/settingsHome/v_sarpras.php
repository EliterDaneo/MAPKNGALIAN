<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?= base_url()?>">Home</a></li>
                            <li>Menu Sarana Prasarana Sekolah</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="events">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">Sarana Prasarana Sekolah</h2>
                    <div class="section_subtitle">
                        <p><?= $sarana->keterangan_sarpras ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row events_row">

            <!-- Course -->
            <?php foreach ($sarpras as $key => $value) { ?>
            <div class="col-lg-4 course_col">
                <div class="course">
                    <div class="course_image"><img src="<?= base_url ('assets/data/foto/sarpras/'.$value->foto)?>"
                            alt=""></div>
                    <div class="course_body">
                        <h3 class="course_title"><a><?= $value->nama_sarpras ?></a></h3>
                        <div class="course_teacher"><?= $value->nama_user ?></div>
                        <div class="course_text">
                            <p><?= $value->keterangan_alat ?></p>
                        </div>
                    </div>
                    <div class="course_footer">
                        <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
                            <div class="course_info">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span><?= $value->tanggal ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

</div>