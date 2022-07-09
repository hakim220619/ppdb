<?php if ($this->session->userdata['id_level'] == 1) { ?>


    <div class="main-panel">
        <div class="content">
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-secondary">
                        <div class="card-body skew-shadow">
                            <!-- <h1><?= $ang['total_ang'] ?></h1> -->
                            <h5 class="op-8">Total Anggota</h5>
                            <div class="pull-right">
                                <h3 class="fw-bold op-8">Active</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-secondary-gradient">
                        <div class="card-body bubble-shadow">
                            <!-- <h1><?= $pgw['total_pgw'] ?></h1> -->
                            <h5 class="op-8">Total Pegawai</h5>
                            <div class="pull-right">
                                <h3 class="fw-bold op-8">Active</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-secondary2">
                        <div class="card-body curves-shadow">
                            <!-- <h1><?= $adm['total_adm'] ?></h1> -->
                            <h5 class="op-8">Total Admin</h5>
                            <div class="pull-right">
                                <h3 class="fw-bold op-8">Active</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-secondary2">
                        <div class="card-body curves-shadow">
                            <!-- <h1><?= rupiah($sim['total_simpanan']) ?></h1> -->
                            <h5 class="op-8">Total Simpanan</h5>
                            <div class="pull-right">
                                <h3 class="fw-bold op-8">Active</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } elseif ($this->session->userdata['id_level'] == 2) { ?>
    <div class="main-panel">
        <div class="content">
            <br>
            <div class="row">
                <div class="card-body">
                    <div class="card shadow mb-4 border-bottom-success" style="text-align: center;" id="infosantri" value="0">
                        <!-- Card Header - Accordion -->
                        <a href="#informasisantri" class="d-block bg-success border border-success card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h2 class="m-0 font-weight-bold text-white">Informasi Pengumuman Siswa</h2>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="informasisantri">
                            <?php if ($ver_siswa->id_verivikasi == 2) { ?>
                                <H3>Belum Ada Pengumuman Terkait Kelulusan, Silahkan lengkapi berkas AKTA, KTP Orang tua dan KK. Jika ada yang ditanyakan silahkan hubungi admin sekolah </H3>
                                <div class="list-content">
                                    <a href="#listthree" class="d-block bg-primary border border-primary card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                        <h2 class="m-0 font-weight-bold text-white">Data Siswa</h2>
                                    </a>
                                    <?php if ($ver_siswa->ktp == null) { ?>
                                        <div class="collapse" id="listthree">
                                            <div class="list-box">
                                                <form role="form" action="<?= base_url('admin/insert_data_scan') ?>" class="login-box" enctype="multipart/form-data" method="POST">
                                                    <div class="row">
                                                        <input class="form-control" type="text" name="no_pendaftaran" placeholder="" value="<?= $ver_siswa->no_pendaftaran ?>" hidden>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Scan Akta</label>
                                                                <input class="form-control" type="file" name="userfile" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Scan KK</label>
                                                                <input class="form-control" type="file" name="userfile" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Scan ktp Orang tua</label>
                                                                <input class="form-control" type="file" name="userfile" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="list-inline pull-center">
                                                        <li><button type="submit" class="btn btn-primary">Upload</button></li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                        </div>
                    <?php } elseif ($ver_siswa->id_verivikasi == 3) { ?>
                        <div class="card-body">
                            <H3>Selamat Kepada <?= $this->session->userdata['full_name'] ?>, Anda dinyatakan
                                <?php if ($ver_siswa->id_verivikasi == 3) { ?>
                                    <a type="text" style="font-size: 20px; color: black; font-weight: 50px;">BELUM LULUS</a>

                                <?php } ?>
                            </H3>
                        </div>
                    <?php } elseif ($ver_siswa->id_verivikasi == 1) { ?>
                        <div class="card-body">
                            <H3>Selamat Kepada <?= $this->session->userdata['full_name'] ?>, Anda dinyatakan
                                <?php if ($ver_siswa->id_verivikasi == 1) { ?>
                                    <a type="text" style="font-size: 20px; color: black; font-weight: 50px;">LULUS</a>
                                <?php } ?>
                            </H3>
                        </div>
                    <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php } ?>