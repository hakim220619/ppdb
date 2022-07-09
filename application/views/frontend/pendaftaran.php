<header class="hero-area">
    <div class="overlay">
        <span></span>
        <span></span>
    </div>
    <div class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="<?= base_url('frontend/index') ?>">
                            <img src="<?= base_url('assets/frontend/foto/logo') ?>/logo.png" alt="Logo" style="width: 50%;">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="page-scroll" href="#home">Tentang Sekolah</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#services">Informasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#features">Kontak</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#showcase">Login</a>
                                </li>


                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="home">
        <div class="container">
            <div class="row space-100">
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="contents">

                        <h2>Form Pendaftaran PPDB Online <strong>Tk Aba Al Amin Pasaranom</strong></h2>

                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12 p-0">
                    <div class="intro-img">
                        <img src="https://preview.uideck.com/items/slick/business/img/intro.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php if ($tahun_ajaran->status == "Y") { ?>


    <section class="signup-step-container">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Ketentuan</i></a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Data Pribadi</i></a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Data Priodik</i></a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Data Pendukung</i></a>
                                </li>

                            </ul>
                        </div>


                        <form role="form" action="<?= base_url('frontend/pendaftaran') ?>" class="login-box" enctype="multipart/form-data" method="POST">
                            <div class="tab-content" id="main_form">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="row" style="margin-left: 40px">
                                        <h2 style="font-size: 30px;">Kententuan PPDB <strong class="" style="color:#4374fb; ">Tk Aba Al Amin Pasaranom</strong></h2>
                                        <div class="panel-body">

                                            <ol style="color:#333;">

                                                <li>Setiap calon siswa wajib mengisi form pendaftaran dengan lengkap. </li>

                                                <li>Data-data yang diisikan pada form PPDB Online harus sesuai dengan data asli dan benar adanya.</li>

                                                <li>Siapkan scan akta, KK, Ktp orang tua, dalam format PDF maksimal berukuran 2MB yang akan di-upload melalui form pendaftaran PPDB Online.</li>

                                                <li>Calon siswa yang sudah mendaftarkan secara online akan mendapatkan Nomor Pendaftaran yang harus dicetak dan dilampirkan dalam persyaratan yang diminta oleh Panitia PPDB Tk Aba Al Amin Pasaranom. </li>

                                                <li>Calon siswa yang sudah mendaftarkan diri melalui PPDB Online Tk Aba Al Amin Pasaranom akan mendapatkan Nomor Pendaftaran dan Password yang nantinya akan digunakan untuk akses informasi yang berkaitan dengan PPDB Tk Aba Al Amin Pasaranom.</li>

                                                <li>Calon siswa yang sudah mendaftarakan diri melalui PPDB Online Tk Aba Al Amin Pasaranom wajib menyerahkan dokumen persyaratan yang sudah ditentukan oleh Panitia PPDB Tk Aba Al Amin Pasaranom.</li>

                                                <li>Data yang sudah diberikan oleh Panitia PPDB Tk Aba Al Amin Pasaranom hanya digunakan untuk keperluan penerimaan siswa baru dan <strong class="text-danger">data tidak akan dipublikasikan serta dijaga kerahasiaannya oleh Panita PPDB</strong>.</li>

                                            </ol>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn next-step">Continue to next step</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <h4 class="text-center">Data Pribadi</h4>
                                    <p style="text-align: center;" name="tanggal_daftar">Tanggal: <?= date('Y-m-d ') ?></p>
                                    <div class="row">
                                        <input class="form-control" type="text" name="tanggal_daftar" id="tanggal_daftar" placeholder="" value="<?= date('Y-m-d ') ?>" hidden>
                                        <input class="form-control" type="text" name="id_tahun" id="id_tahun" placeholder="" value="<?= $tahun_ajaran->id ?>" hidden>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input class="form-control" type="text" name="full_name" id="full_name" placeholder="" value="<?= set_value('full_name') ?>">
                                                <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Panggilan</label>
                                                <input class="form-control" type="text" name="username" id="username" placeholder="" value="<?= set_value('username') ?>">
                                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="laki-laki">Laki-Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                                <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input class="form-control" type="text" name="tempat_lahir" placeholder="" value="<?= set_value('tempat_lahir') ?>">
                                                <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="" value="<?= set_value('tanggal_lahir') ?>" onchange="getAge();">
                                                <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Umur Per 1 Juli</label>
                                                <select name="golongan" class="form-control" id="golongan">
                                                    <option value="">Pilih Umur</option>
                                                    <option value="A">Kurang Dari 5 tahun 6 Bulan</option>
                                                    <option value="B">Lebih Dari 5 tahun 6 Bulan</option>
                                                </select>
                                                <?= form_error('golongan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>AGAMA</label>
                                                <select class="form-control" name="agama" id="agama">
                                                    <option value=""></option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Protestan">Protestan</option>
                                                    <option value="Katolik">Katolik</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Buddha">Buddha</option>
                                                    <option value="Khonghucu">Khonghucu</option>
                                                </select>
                                                <?= form_error('agama', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kewarganegaraan</label>
                                                <select name="kewarganegaraan" class="form-control" id="kewarganegaraan" value="<?= set_value('kewarganegaraan') ?>">
                                                    <option value="" selected="selected">Pilih Kewarganegaraan</option>
                                                    <option value="wni">Warga Negara Indonesia</option>
                                                    <option value="wna">Warga Negara Asing</option>
                                                </select>
                                                <?= form_error('kewarganegaraan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Berkebutuhan Khusus</label>
                                                <input class="form-control" type="text" name="ber_khusus" placeholder="" value="<?= set_value('ber_khusus') ?>">
                                                <?= form_error('ber_khusus', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alamat Jalan</label>
                                                <input class="form-control" type="text" name="alamat" placeholder="" value="<?= set_value('alamat') ?>">
                                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>RT</label>
                                                <input class="form-control" type="text" name="rt" placeholder="" value="<?= set_value('rt') ?>">
                                                <?= form_error('rt', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>RW</label>
                                                <input class="form-control" type="text" name="rw" placeholder="" value="<?= set_value('rw') ?>">
                                                <?= form_error('rw', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Nama Dusun</label>
                                                <input class="form-control" type="text" name="dusun" placeholder="" value="<?= set_value('dusun') ?>">
                                                <?= form_error('dusun', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Kelurahan/ Desa</label>
                                                <input class="form-control" type="text" name="desa" placeholder="" value="<?= set_value('desa') ?>">
                                                <?= form_error('desa', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Kecamatan</label>
                                                <input class="form-control" type="text" name="kecamatan" placeholder="" value="<?= set_value('kecamatan') ?>">
                                                <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Kode Pos</label>
                                                <input class="form-control" type="text" name="kode_pos" placeholder="" value="<?= set_value('kode_pos') ?>">
                                                <?= form_error('kode_pos', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Tinggal</label>
                                                <input class="form-control" type="text" name="tempat_tinggal" placeholder="" value="<?= set_value('tempat_tinggal') ?>">
                                                <?= form_error('tempat_tinggal', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Moda Transportasi</label>
                                                <input class="form-control" type="text" name="transportasi" placeholder="" value="<?= set_value('transportasi') ?>">
                                                <?= form_error('transportasi', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Anak keberapa</label>
                                                <input class="form-control" type="text" name="anak_keberapa" placeholder="" value="<?= set_value('anak_keberapa') ?>">
                                                <?= form_error('anak_keberapa', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn prev-step">Back</button></li>
                                        <li><button type="button" class="default-btn next-step">Continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h4 class="text-center">Data Priodik</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor HP</label>
                                                <input class="form-control" type="text" name="no_tlp" placeholder="" value="<?= set_value('no_tlp') ?>">
                                                <?= form_error('no_tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tinggi Badan</label>
                                                <input class="form-control" type="text" name="tinggi_badan" placeholder="cm" value="<?= set_value('tinggi_badan') ?>">
                                                <?= form_error('tinggi_badan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Berat Badan</label>
                                                <input class="form-control" type="text" name="berat_badan" placeholder="kg" value="<?= set_value('berat_badan') ?>">
                                                <?= form_error('berat_badan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jarak tempat tinggal ke sekolah</label>
                                                <select name="jarak_kesekolah" class="form-control" id="jarak_kesekolah" value="<?= set_value('jarak_kesekolah') ?>">
                                                    <option value="" selected="selected">Pilih Jarak</option>
                                                    <option value="kd_1_km">Kurang dari 1 km</option>
                                                    <option value="ld_1_km">lebih dari 1 km</option>
                                                </select>
                                                <?= form_error('jarak_kesekolah', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Waktu Tempuh ke sekolah (Jam/mnt)</label>
                                                <input class="form-control" type="text" name="waktu_kesekolah" placeholder="jam/menit" value="<?= set_value('waktu_kesekolah') ?>">
                                                <?= form_error('waktu_kesekolah', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Jumlah Saudara Kandung</label>
                                                <input class="form-control" type="text" name="saudara_kandung" placeholder="" value="<?= set_value('saudara_kandung') ?>">
                                                <?= form_error('saudara_kandung', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn prev-step">Back</button></li>
                                        <li><button type="button" class="default-btn next-step">Continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <h4 class="text-center">Data Orang Tua</h4>
                                    <div class="all-info-container">
                                        <div class="list-content">
                                            <a href="#listone" data-toggle="collapse" aria-expanded="false" aria-controls="listone">Data Ayah Kandung <i class="fa fa-chevron-down"></i></a>
                                            <div class="collapse" id="listone">
                                                <div class="list-box">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nama ayah Kandung</label>
                                                                <input class="form-control" type="text" name="nama_ayah" placeholder="" value="<?= set_value('nama_ayah') ?>">
                                                                <?= form_error('nama_ayah', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tempat Lahir</label>
                                                                <input class="form-control" type="text" name="tempat_lahir" placeholder="" value="<?= set_value('tempat_lahir') ?>">
                                                                <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
                                                                <input class="form-control" type="date" name="tanggal_lahir" placeholder="" value="<?= set_value('tanggal_lahir') ?>">
                                                                <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pendidikan</label>
                                                                <select class="form-control" name="pendidikan" id="pendidikan">
                                                                    <option value="">Pilih Pendidikan Ayah</option>
                                                                    <option value="tidak sekolah">Tidak Sekolah</option>
                                                                    <option value="sd/mi">SD/MI</option>
                                                                    <option value="smp/mts">SMP/MTS</option>
                                                                    <option value="sma/smk/ma">SMA/SMK/MA</option>
                                                                    <option value="diploma">Diploma</option>
                                                                    <option value="s1">S1</option>
                                                                    <option value="s2">S2</option>
                                                                    <option value="s3">S3</option>
                                                                </select>
                                                                <?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pekerjaan</label>
                                                                <select class="form-control" name="pekerjaan" id="pekerjaan">
                                                                    <option value="">Pilih Pekerjaan Ayah</option>
                                                                    <option value="buruh">Buruh</option>
                                                                    <option value="tani">Tani</option>
                                                                    <option value="wiraswasta">Wiraswasta</option>
                                                                    <option value="pns">Pns</option>
                                                                    <option value="tni/polri">Tni/Polri</option>
                                                                    <option value="perangkat desa">Perangkat Desa</option>
                                                                    <option value="nelayan">Nelayan</option>
                                                                    <option value="lain-lain">Lain-lain</option>
                                                                </select>
                                                                <?= form_error('pekerjaan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-content">
                                            <a href="#listtwo" data-toggle="collapse" aria-expanded="false" aria-controls="listtwo">Data Ibu Kandung <i class="fa fa-chevron-down"></i></a>
                                            <div class="collapse" id="listtwo">
                                                <div class="list-box">
                                                    <h4 class="text-center">Data Ibu Kandung</h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nama Ibu Kandung</label>
                                                                <input class="form-control" type="text" name="nama_ibu" placeholder="" value="<?= set_value('nama_ibu') ?>">
                                                                <?= form_error('nama_ibu', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tempat Lahir</label>
                                                                <input class="form-control" type="text" name="tempat_lahir" placeholder="" value="<?= set_value('tempat_lahir') ?>">
                                                                <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
                                                                <input class="form-control" type="date" name="tanggal_lahir" placeholder="" value="<?= set_value('tanggal_lahir') ?>">
                                                                <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pendidikan</label>
                                                                <select class="form-control" name="pendidikan" id="pendidikan">
                                                                    <option value=""></option>
                                                                    <option value="tidak sekolah">Tidak Sekolah</option>
                                                                    <option value="sd/mi">SD/MI</option>
                                                                    <option value="smp/mts">SMP/MTS</option>
                                                                    <option value="sma/smk/ma">SMA/SMK/MA</option>
                                                                    <option value="diploma">Diploma</option>
                                                                    <option value="s1">S1</option>
                                                                    <option value="s2">S2</option>
                                                                    <option value="s3">S3</option>
                                                                </select>
                                                                <?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pekerjaan</label>
                                                                <select class="form-control" name="pekerjaan" id="pekerjaan">
                                                                    <option value="">Pilih Pekerjaan Ayah</option>
                                                                    <option value="ibu rumah tangga">Ibu Rumah Tangga</option>
                                                                    <option value="buruh">Buruh</option>
                                                                    <option value="tani">Tani</option>
                                                                    <option value="wiraswasta">Wiraswasta</option>
                                                                    <option value="pns">Pns</option>
                                                                    <option value="tni/polri">Tni/Polri</option>
                                                                    <option value="perangkat desa">Perangkat Desa</option>
                                                                    <option value="nelayan">Nelayan</option>
                                                                    <option value="lain-lain">Lain-lain</option>
                                                                </select>
                                                                <?= form_error('pekerjaan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-content">
                                            <a href="#listthree" data-toggle="collapse" aria-expanded="false" aria-controls="listthree">Data Wali <i class="fa fa-chevron-down"></i></a>
                                            <div class="collapse" id="listthree">
                                                <div class="list-box">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nama Wali</label>
                                                                <input class="form-control" type="text" name="nama_wali" placeholder="" value="<?= set_value('nama_wali') ?>">
                                                                <?= form_error('nama_wali', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tempat Lahir</label>
                                                                <input class="form-control" type="text" name="tempat_lahir" placeholder="" value="<?= set_value('tempat_lahir') ?>">
                                                                <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
                                                                <input class="form-control" type="date" name="tanggal_lahir" placeholder="" value="<?= set_value('tanggal_lahir') ?>">
                                                                <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pendidikan</label>
                                                                <select class="form-control" name="pendidikan" id="pendidikan">
                                                                    <option value=""></option>
                                                                    <option value="tidak sekolah">Tidak Sekolah</option>
                                                                    <option value="sd/mi">SD/MI</option>
                                                                    <option value="smp/mts">SMP/MTS</option>
                                                                    <option value="sma/smk/ma">SMA/SMK/MA</option>
                                                                    <option value="diploma">Diploma</option>
                                                                    <option value="s1">S1</option>
                                                                    <option value="s2">S2</option>
                                                                    <option value="s3">S3</option>
                                                                </select>
                                                                <?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pekerjaan</label>
                                                                <select class="form-control" name="pekerjaan" id="pekerjaan">
                                                                    <option value=""></option>
                                                                    <option value="buruh">Buruh</option>
                                                                    <option value="tani">Tani</option>
                                                                    <option value="wiraswasta">Wiraswasta</option>
                                                                    <option value="pns">Pns</option>
                                                                    <option value="tni/polri">Tni/Polri</option>
                                                                    <option value="perangkat desa">Perangkat Desa</option>
                                                                    <option value="nelayan">Nelayan</option>
                                                                    <option value="lain-lain">Lain-lain</option>
                                                                </select>
                                                                <?= form_error('pekerjaan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn prev-step">Back</button></li>
                                        <li><button type="submit" class="default-btn next-step">Finish</button></li>
                                    </ul>
                                </div>
                                <div class="clearfix">

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } elseif ($tahun_ajaran->status == "N") { ?>
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card" style="text-align: center;">
                <h5 class="card-header">Pengumuman</h5>
                <div class="card-body">

                    <button class="btn btn-primary">Pendaftran Sudah Di Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <br>
<?php } ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript">
    $(function() {

        $("#tgl_lahir").datepicker({

            changeMonth: true,

            changeYear: true

        });

    });

    window.onload = function() {

        $('#tgl_lahir').on('change', function() {

            var dob = new Date(this.value);

            var today = new Date();

            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));

            $('#umur').val(age);

        });

    }
</script>