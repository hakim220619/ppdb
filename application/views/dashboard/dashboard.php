<?php echo $this->session->flashdata('success'); ?>
<?php if ($this->session->userdata['id_level'] == 1) { ?>
    <div class="main-panel">
        <div class="content">
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-secondary">
                        <div class="card-body skew-shadow">
                            <h1><?= $tot_ver->total_terverifikasi ?></h1>
                            <h5 class="op-8">Total Siswa Terverifikasi</h5>
                            <div class="pull-right">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-secondary-gradient">
                        <div class="card-body bubble-shadow">
                            <h1><?= $tot_belver->total_belumterverifikasi ?></h1>
                            <h5 class="op-8">Total Siswa Belum Terverifikasi</h5>
                            <div class="pull-right">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-dark bg-secondary2">
                        <div class="card-body curves-shadow">
                            <h1><?= $tot_ditolak->total_ditolak ?></h1>
                            <h5 class="op-8">Total Siswa Di Tolak</h5>
                            <div class="pull-right">

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
                                    <?php if ($ver_siswa->akta == null) { ?>
                                        <div class="collapse" id="listthree">
                                            <div class="list-box">
                                                <?php if ($ver_siswa->ktp == null) { ?>
                                                    <form role="form" action="<?= base_url('admin/update_ktp') ?>" class="login-box" enctype="multipart/form-data" method="POST">
                                                        <div class="row">
                                                            <input class="form-control" type="text" name="no_pendaftaran" placeholder="" value="<?= $ver_siswa->no_pendaftaran ?>" hidden>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Scan ktp Orang tua</label>
                                                                    <input class="form-control" type="file" name="ktp" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="list-inline pull-center">
                                                            <li><button type="submit" class="btn btn-primary">Upload</button></li>
                                                        </ul>
                                                    </form>
                                                <?php } elseif ($ver_siswa->kk == null) { ?>

                                                    <form role="form" action="<?= base_url('admin/update_kk') ?>" class="login-box" enctype="multipart/form-data" method="POST">
                                                        <div class="row">
                                                            <input class="form-control" type="text" name="no_pendaftaran" placeholder="" value="<?= $ver_siswa->no_pendaftaran ?>" hidden>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Scan KK</label>
                                                                    <input class="form-control" type="file" name="kk" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="list-inline pull-center">
                                                            <li><button type="submit" class="btn btn-primary">Upload</button></li>
                                                        </ul>
                                                    </form>
                                                <?php } elseif ($ver_siswa->akta == null) { ?>
                                                    <form role="form" action="<?= base_url('admin/update_akta') ?>" class="login-box" enctype="multipart/form-data" method="POST">
                                                        <div class="row">
                                                            <input class="form-control" type="text" name="no_pendaftaran" placeholder="" value="<?= $ver_siswa->no_pendaftaran ?>" hidden>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Scan Akta</label>
                                                                    <input class="form-control" type="file" name="akta" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="list-inline pull-center">
                                                            <li><button type="submit" class="btn btn-primary">Upload</button></li>
                                                        </ul>
                                                    </form>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                        </div>


                    <?php } elseif ($ver_siswa->id_verivikasi == 3) { ?>
                        <div class="card-body">
                            <H3>Mohon Maaf Kepada <?= $this->session->userdata['full_name'] ?>, Anda dinyatakan
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
                                    <h3>Silahkan Masuk Link Grup <h3><a href="whatsapp://send?text=Hello&phone=+628********1" style="color: #25D366;">Whatsapp</a></h3>
                                    </h3>
                                <?php } ?>
                            </H3>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <?php foreach ($pembayaran as $u) { ?>
                                            <table class="table table-striped">
                                                <tbody>

                                                    <tr>
                                                        <td>Sumbangan Awal </td>
                                                        <td>: <?php echo rupiah($u->sumbangan_awal) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Seragam</td>
                                                        <td>: <?php echo rupiah($u->seragam) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Majalah</td>
                                                        <td>: <?php echo rupiah($u->majalah) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alat Tulis</td>
                                                        <td>: <?php echo rupiah($u->alat_tulis) ?></td>
                                                    </tr>
                                                    <?php $total = $u->sumbangan_awal + $u->seragam + $u->majalah + $u->alat_tulis; ?>
                                                    <tr>
                                                        <td style="color: black;">Total</td>
                                                        <td style="color: red;">: <?php echo rupiah($total) ?></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <h3>Silahkan Bayarkan Ke No Rekening 1219302083 dan kirim bukti pembayaran ke wa admin 085797887711</h3>
                        </div>
                    <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php } ?>