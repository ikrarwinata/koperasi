<!doctype html>
<html lang="<?php echo ($Page->locale) ?>">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?php echo $Page->header ?></title>
  <base href="<?php echo (base_url()) ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- <link rel="stylesheet" href="assets/css/all.css" > -->
  <?php foreach ($Page->stylesheets as $key => $stylesheet) : ?>
    <link rel="stylesheet" href="<?php echo $stylesheet ?>">
  <?php endforeach ?>
</head>

<body>