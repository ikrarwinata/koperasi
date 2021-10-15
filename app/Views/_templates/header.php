<!doctype html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $Page->header ?></title>
    <base href="<?php echo(base_url()) ?>">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="assets/fontawesome/css/all.css" >
    <!-- <link rel="stylesheet" href="assets/css/all.css" > -->
    <?php foreach ($Page->stylesheets as $key => $stylesheet): ?>
      <link rel="stylesheet" href="<?php echo $stylesheet ?>" >
    <?php endforeach ?>
  </head>
  <body>