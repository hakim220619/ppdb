<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Laporan Siswa</title>
    <base href="<?php echo base_url(); ?>" />
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <style>
        table {
            border-collapse: collapse;
        }

        thead>tr {
            background-color: #0070C0;
            color: #f1f1f1;
        }

        thead>tr>th {
            background-color: #0070C0;
            color: #fff;
            padding: 10px;
            border-color: #fff;
        }

        th,
        td {
            padding: 2px;
        }

        th {
            color: #222;
        }

        body {
            font-family: Calibri;
        }
    </style>
</head>

<body onload="window.print();">
    <?php $this->load->view('admin/kop_lap'); ?>
    <h4 align="center" style="margin-top:0px;"><u>BUKTI PENDAFTARAN</u></h4>
    <b>

    </b>
    <br>
    <h2>Data Siswa</h2>
    <table width="100%" border="0">
        <?php foreach ($detail_siswa as $u) { ?>
            <tr>
                <td>No Pendaftaran </td>
                <td>: <?php echo $u->no_pendaftaran ?></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>: <?php echo $u->no_tlp ?></td>
            </tr>
            <tr>
                <td>Golongan</td>
                <td>: <?php echo $u->golongan ?></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>: <?php echo $u->full_name ?></span></td>
            </tr>
            <tr>
                <td>Jenis Kelmain</td>
                <td>: <?php echo $u->jenis_kelamin ?></td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>: <?php echo $u->tahun ?></td>
            </tr>
            <tr>
                <td>Tanggal Daftar</td>
                <td>: <?php echo $u->tanggal_daftar ?></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>: <?php echo $u->tempat_lahir ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: <?php echo $u->tanggal_lahir ?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: <?php echo $u->agama ?></td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td>: <?php echo $u->kewarganegaraan ?></td>
            </tr>
            <tr>
                <td>Berkebutuhan Khususu</td>
                <td>: <?php echo $u->ber_khusus ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: <?php echo $u->alamat ?></td>
            </tr>
            <tr>
                <td>Rt</td>
                <td>: <?php echo $u->rt ?></td>
            </tr>
            <tr>
                <td>Rw</td>
                <td>: <?php echo $u->rw ?></td>
            </tr>
            <tr>
                <td>Dusun</td>
                <td>: <?php echo $u->dusun ?></td>
            </tr>
            <tr>
                <td>Desa</td>
                <td>: <?php echo $u->desa ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>: <?php echo $u->kecamatan ?></td>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td>: <?php echo $u->kode_pos ?></td>
            </tr>
            <tr>
                <td>Tempat Tinggal</td>
                <td>: <?php echo $u->tempat_tinggal ?></td>
            </tr>
            <tr>
                <td>Transportasi</td>
                <td>: <?php echo $u->transportasi ?></td>
            </tr>
            <tr>
                <td>Anak Ke</td>
                <td>: <?php echo $u->anak_keberapa ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>


    <h2>Data Priodik</h2>
    <table width="100%" border="0">
        <?php foreach ($priodik as $u) { ?>
            <tr>
                <td>No Pendaftaran </td>
                <td>: <?php echo $u->no_pendaftaran ?></td>
            </tr>
            <tr>
                <td>Tinggi Badan</td>
                <td>: <?php echo $u->tinggi_badan ?></td>
            </tr>
            <tr>
                <td>Berat Badan</td>
                <td>: <?php echo $u->berat_badan ?></span></td>
            </tr>
            <tr>
                <td>Jarak Kesekolah</td>
                <td>: <?php echo $u->jarak_kesekolah ?></span></td>
            </tr>
            <tr>
                <td>Waktu Kesekolah</td>
                <td>: <?php echo $u->waktu_kesekolah ?></span></td>
            </tr>
            <tr>
                <td>Saudara Kandung</td>
                <td>: <?php echo $u->saudara_kandung ?></span></td>
            </tr>
        <?php } ?>
    </table>
    <h2>Data Ayah</h2>
    <table width="100%" border="0">
        <?php foreach ($ayah as $u) { ?>
            <tr>
                <td>No Pendaftaran </td>
                <td>: <?php echo $u->no_pendaftaran ?></td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>: <?php echo $u->nama_ayah ?></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>: <?php echo $u->tempat_lahir ?></span></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: <?php echo $u->tanggal_lahir ?></span></td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>: <?php echo $u->pendidikan ?></span></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: <?php echo $u->pekerjaan ?></span></td>
            </tr>
        <?php } ?>
    </table>
    <h2>Data Ibu</h2>
    <table width="100%" border="0">
        <?php foreach ($ibu as $u) { ?>
            <tr>
                <td>No Pendaftaran </td>
                <td>: <?php echo $u->no_pendaftaran ?></td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>: <?php echo $u->nama_ibu ?></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>: <?php echo $u->tempat_lahir ?></span></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: <?php echo $u->tanggal_lahir ?></span></td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>: <?php echo $u->pendidikan ?></span></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: <?php echo $u->pekerjaan ?></span></td>
            </tr>
        <?php } ?>
    </table>
    <h2>Data Wali</h2>
    <table width="100%" border="0">
        <?php foreach ($wali as $u) { ?>
            <tr>
                <td>No Pendaftaran </td>
                <td>: <?php echo $u->no_pendaftaran ?></td>
            </tr>
            <tr>
                <td>Nama Wali</td>
                <td>: <?php echo $u->nama_wali ?></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>: <?php echo $u->tempat_lahir ?></span></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: <?php echo $u->tanggal_lahir ?></span></td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>: <?php echo $u->pendidikan ?></span></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: <?php echo $u->pekerjaan ?></span></td>
            </tr>
        <?php } ?>
    </table>


    <div style="float:right;">
        Purworejo, <?php date('d-m-Y'); ?> <br>
        Ketua Panitia PPDB, <br>
        <img src="img/ttd.jpg" alt="" width="100"><br>
        <b><u>KETUT SUDIARTE, S.Pd.</u></b><br>
        NIP. 197001301997031006
    </div>
    <br><br><br><br><br><br><br><br><br><br>



</body>

</html>