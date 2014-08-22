<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Humara College">
  <meta name="keywords" content="Humara College">
  <title><?php echo $page_title; ?></title>

  <link rel="icon" type="favicon" href="<?php echo base_url(); ?>public/img/favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/font-awesome.min.css">
  <!--[if IE 7]>
  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css">
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Crimson+Text:700,400' rel='stylesheet' type='text/css'>
  <script src="<?php echo base_url(); ?>public/js/jquery.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>public/js/humanize.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>
  <div class="container">
    <header class="row" role="banner">
      <div class="span4">
        <h1><a href="<?php echo site_url(); ?>">BITS WAVES</a></h1>
      </div>
      <div class="span8">
        <nav class="navbar" role="navigation">
          <?php include 'navigation.php'; ?>
        </nav>
      </div>
    </header>
    <div class="row">
      <article class="span12 content" role="content">