<!-- Home -->

<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Download</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="">
        <div class="container">
            <div class="row">
                <div class="card-body">
                    <table id="myTable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Keterangan File</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach ($download as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->ket_file?></td>
                                <td class="text-center"><a href="<?= base_url('assets/data/foto/file/'.$value->file)?>"
                                        class="btn btn-success"><i class="fa fa-download"></i> Download</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>