<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Berisi Profile Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Siswa') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Your Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <?php echo $this->session->flashdata('pesan'); ?>
        <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
        </div>
        <?php endif ?>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <?= form_open_multipart('siswa/profile/' . $profile->nis); ?>

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="form-group text-center">
                                <label class="col-form-label">Picture</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if (file_exists(FCPATH . './assets/data/foto/user/img/siswa/' . $user->foto_user) || $user->foto_user !== 'default.jpg') : ?>
                                        <img class="img-thumbnail"
                                            src="<?= base_url('assets/data/foto/user/img/siswa/' . $user->foto_user) ?>"
                                            alt="User profile picture">
                                        <?php else : ?>
                                        <img class="img-thumbnail"
                                            src="<?= base_url('assets/data/foto/user/img/siswa/default.jpg') ?>"
                                            alt="User profile picture">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <h3 class="profile-username text-center"><?= $profile->nama_siswa ?></h3>

                            <p class="text-muted text-center"><?= $profile->nis ?></p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tentang Saya</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Kelas / Wali Murid </strong>

                            <p class="text-muted">
                                <?= $profile->jenis_kelas . ' - ' . $profile->nama_kelas . ' / ' . $profile->wali_siswa ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat </strong>

                            <p class="text-muted"><?= $profile->alamat ?></p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Tempat, Tanggal Lahir</strong>

                            <p class="text-muted"><?= $profile->tempat_lahir . ' ' . $profile->tanggal_lahir ?></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#EditProfile" data-toggle="tab">Update
                                        Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="<?= base_url('./assets/data/foto/user/img/siswa/' . $profile->foto_siswa) ?>"
                                                alt="user image">
                                            <span class="username">
                                                <a href="#"><?= $profile->nama_siswa ?></a>
                                                <a href="#" class="float-right btn-tool"><i
                                                        class="fas fa-times"></i></a>
                                            </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            <?= $profile->moto ?>
                                        </p>
                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="EditProfile">
                                    <?php echo form_open_multipart('siswa/editProfile'); ?>
                                    <input type="hidden" name="z" readonly value="<?php echo $user->id_user; ?>"
                                        class="form-control">
                                    <div class="form-group row">
                                        <label for="inputProfileUsrename"
                                            class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control"
                                                value="<?php echo $user->username ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputProfileFullname" class="col-sm-2 col-form-label">Full
                                            Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_user" class="form-control"
                                                value="<?php echo $user->nama_user ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputProfilEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="email" class="form-control" id="inputProfilEmail"
                                                placeholder="Email" value="<?php echo $user->email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <label for="inputProfilAddress" class="col-form-label">Picture</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <img class="img-thumbnail"
                                                        src="<?= base_url('assets/data/foto/user/img/siswa/' . $user->foto_user); ?>"
                                                        alt="User profile picture">
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" name="photo" class="custom-file-input"
                                                            id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-warning btn-sm float-left"><i
                                                    class="fas fa-edit"></i>&ensp;Update</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" action="<?= base_url('siswa/changepassword'); ?>"
                                        method="post">
                                        <input type="hidden" name="dd" readonly value="<?= $user->id_user; ?>"
                                            class="form-control">
                                        <div class="form-group row">
                                            <label for="inputNewPass" class="col-sm-3 col-form-label">New
                                                Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" name="bb" class="form-control"
                                                    placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputRepeatPass" class="col-sm-3 col-form-label">Repeat
                                                Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" name="cc" class="form-control"
                                                    placeholder="Repeat Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-10">
                                                <button type="submit" class="btn btn-danger btn-sm">Change</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- /.content -->