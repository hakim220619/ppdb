<style>
    .alur_ppdb {
        height: 700px;

    }

    .pendaftaran_ppdb {
        height: 430px;
        width: 560px;
    }

    @media (min-width: 700px) {
        .alur_ppdb {
            height: 430px;
            width: 560px;
        }

        .pendaftaran_ppdb {
            height: 430px;
            width: 560px;
        }
    }



    @media (max-width: 700px) {
        .alur_ppdb {
            height: 200px;
            width: 373px;
            padding: 5px;
        }

        .pendaftaran_ppdb {
            height: 200px;
            width: 373px;
            padding: 5px;
        }
    }
</style>

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
                                <!-- <li class="nav-item">
                                    <a class="page-scroll" href="#features">Kontak</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="page-scroll" href="<?= base_url('login') ?>">Login</a>
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
                        <h2 class="head-title">PPDB ONLINE <br class="d-none d-xl-block">Tk Aba Al Amin Pasaranom</h2>
                        <p>Dusun gading tengah RT 02 RW 04, Desa Pasaranom, Kec. Grabag, Kab. Purworejo, Prov. Jawa Tengah, Kode Pos 54265
                        </p>
                        <div class="header-button">
                            <a href="<?= base_url('frontend/form_pendaftaran') ?>" rel="nofollow" class="btn btn-border-filled" style="width: 200px;">Pendaftaran PPDB</a>
                            <a href="<?= base_url('login/login_siswa') ?>" class="btn btn-border page-scroll">Login Siswa</a>
                        </div>
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
<section id="services" class="">
    <br><br>
    <div class="container">
        <div class="row justify-content-center justify-content-md-start">
            <div class="col-md-6">
                <img src="<?= base_url('assets/frontend/foto/') ?>/alur_ppdb.jpg" alt="" class="alur_ppdb responsive">
            </div>
            <div class="col-md-6">
                <img src="<?= base_url('assets/frontend/foto/') ?>/pendaftaran.jpg" alt="" class="pendaftaran_ppdb responsive">
            </div>
        </div>
    </div>
    <br>
</section>