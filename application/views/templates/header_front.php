<?php
$apl = $this->db->get_where('aplikasi')->row_array();

// dead($apl);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preview.uideck.com/items/slick/business/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Jul 2022 06:43:15 GMT -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title><?php echo $apl['title']; ?></title>

    <link rel="shortcut icon" href="<?= base_url() ?>assets/foto/logo/<?php echo $apl['logo']; ?>" type="image/png">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/bootstrap-4.5.0.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/LineIcons.2.0.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/owl.carousel.2.3.4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/owl.theme.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/nivo-lightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/main.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/responsive.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/slick/') ?>/css/step-wyzard.css">
</head>

<body>