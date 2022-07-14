<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="row">
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tabel <?= $title; ?></h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="container">
                                    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.css'); ?>" />
                                    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script> <!-- Load file jquery -->
                                    <form method="get" action="" class="form">
                                        <div class="form-group">
                                            <label>Filter Berdasarkan</label>
                                            <select class="form-control" name="filter" id="filter" style="width: 50%">
                                                <option value="">Pilih</option>
                                                <option value="1">Per Siswa</option>
                                                <option value="2">Per Golongan</option>
                                                <option value="3">Per Tahun Ajaran</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="form-nis">
                                            <label>Nama Siswa</label>
                                            <select name="id_user" class="form-control" style="width: 50%">
                                                <option value="">Pilih</option>
                                                <?php
                                                foreach ($siswa_select as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                                    echo '<option value="' . $data->id_user . '">' . $data->id_user . ' | ' . $data->username . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="form-golongan">
                                            <label>Per Golongan</label>
                                            <select name="golongan" class="form-control" style="width: 50%">
                                                <option value="">Pilih</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="form-tahun">
                                            <label>Tahun Ajaran</label>
                                            <select name="tahun_ajaran" class="form-control" style="width: 50%">
                                                <option value="">Pilih</option>
                                                <?php
                                                foreach ($tahun_ajaran as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                                    echo '<option value="' . $data->id . '">' . $data->id . ' | ' . $data->tahun . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Tampilkan</button>
                                        <a href="<?php echo base_url() . "admin/laporan"; ?>">Reset Filter</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><?php echo $ket; ?></h6>
                            </div>
                            <div class="card-body">
                                <a href="<?php echo $url_cetak; ?>" class=" btn btn-danger mb-3"><i class="fas fa-file-pdf"></i>CETAK PDF</a>
                                <a href="<?php echo $url_excel; ?>" class=" btn btn-success mb-3"><i class="fas fa-file-excel"></i>CETAK EXCEL</a>
                                <!-- <a href="<?php echo $url_cetak; ?> class=" btn btn-danger mb-4"><i class="fas fa-file-pdf"></i> Download pdf</a> -->
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                        <thead style="text-align: center">
                                            <tr>
                                                <th style="text-align: center;">NO</th>
                                                <th style="text-align: center;">Nama Lengkap</th>
                                                <th style="text-align: center;">No Telepon</th>
                                                <th style="text-align: center;">Jenis Kelamin</th>
                                                <th style="text-align: center;">Tempat Lahir</th>
                                                <th style="text-align: center;">Tanggal Lahir</th>
                                                <th style="text-align: center;">Agama</th>
                                                <th style="text-align: center;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($siswa)) {
                                                $no = 1;
                                                foreach ($siswa as $data) {
                                            ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $no++ ?></td>
                                                        <td style="text-align: center;"><?php echo $data->full_name ?></td>
                                                        <td style="text-align: center;"><?php echo $data->no_tlp ?></td>
                                                        <td style="text-align: center;"><?php echo $data->jenis_kelamin ?></td>
                                                        <td style="text-align: center;"><?php echo $data->tempat_lahir ?></td>
                                                        <td style="text-align: center;"><?php echo $data->tanggal_lahir ?></td>
                                                        <td style="text-align: center;"><?php echo $data->agama ?></td>
                                                        <td style="text-align: center;"> <?php if ($data->id_verivikasi == 1) { ?>
                                                                <button type="button" class="btn btn-success" style="font-size: 10px;">DITERIMA</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                        <script src="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
                                        <script>
                                            $(document).ready(function() { // Ketika halaman selesai di load
                                                $('#form-nis, #form-golongan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
                                                $('#filter').change(function() { // Ketika user memilih filter
                                                    if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                                                        $('#form-golongan, #form-tahun').hide();
                                                        $('#form-nis').show(); // Tampilkan form tanggal
                                                    } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                                                        $('#form-nis, #form-tahun').hide();
                                                        $('#form-golongan').show(); // Tampilkan form bulan dan tahun
                                                    } else if ($(this).val() == '3') { // Jika filter nya 2 (per bulan)
                                                        $('#form-nis, #form-golongan').hide();
                                                        $('#form-tahun').show(); // Tampilkan form bulan dan tahun
                                                    } else { // Jika filternya 3 (per tahun)
                                                        $('#form-nis, #form-golongan, #form-tahun').hide();
                                                    }
                                                    $('#form-nis select, #form-golongan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
                                                })
                                            })
                                        </script>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->