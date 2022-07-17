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
<style>
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 80px;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 100%;
        max-width: 1100px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }
</style>
<style>
    #myImg2 {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg2:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal2 {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 80px;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 100%;
        max-width: 1100px;
    }

    /* Caption of Modal Image */
    #caption2 {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption2 {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close2 {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close2:hover,
    .close2:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
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

                <img id="myImg" src="<?= base_url('assets/frontend/foto/') ?>/alur_ppdb.jpg" alt="" class="alur_ppdb responsive zoom">
            </div>
            <div class="col-md-6">
                <img id="myImg2" src="<?= base_url('assets/frontend/foto/') ?>/pendaftaran.jpg" alt="" class="pendaftaran_ppdb responsive">
            </div>
        </div>
    </div>
    <br>
</section>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
<div id="myModal2" class="modal2">
    <span class="close2">&times;</span>
    <img class="modal-content" id="img02">
    <div id="caption2"></div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>
<script>
    // Get the modal
    var modal = document.getElementById("myModal2");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg2");
    var modalImg = document.getElementById("img02");
    var captionText = document.getElementById("caption2");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close2")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>