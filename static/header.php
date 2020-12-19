<?php
  session_start();
  require 'classes/cibzadb.php';
  /*
    Eğer bunu sitenize entegre ettiyseniz $db olan değişkeni sunucu veritabanı ayarlarınız ile değiştirin
    eğer kendi bilgisayarınızda kurduysanız kendi veritabanı bilgilerinizi giriniz.

    $remote_db değişkenini eğer admin paneli bilgisayarınızda kurulu ise uzak mysql bağlantısı yapmalısınız.
    değil ise sunucu veritabanı bilgilerinizi giriniz.
  */
  $db = new CibzaDB('host', 'dbname', 'username', 'password'); // Kendi bilgisayarınızdan yönetmek için bunu kendi bilgisayarınızdaki bilgileri girin
  $remote_db = new CibzaDB('host', 'dbname', 'username', 'password'); // Bu uzak sunucu bağlantısı eğer siteye kurduysanız bunu sunucunun bilgilerini girin yani host yukardaki seçenek ile aynı olsun
  if (!isset($_SESSION['MM_Userid'])) {
    header('Location: login.php');
  }
  $kullanici_bilgileri = $db->from('kullanicilar')
                            ->where('id', $_SESSION['MM_Userid'])
                            ->first();
  $settings = $remote_db->from('ofb_settings')
                        ->all();
  $social = $remote_db->from('ofb_social')
                        ->all();
  $work = $remote_db->from('ofb_work')
                        ->all();
  if ( $settings ){
    foreach ( $settings as $row ){
      if ($row['ofb_key'] == 'title') {
        $title = $row['ofb_value'];
      }
      if ($row['ofb_key'] == 'about_title') {
        $about_title = $row['ofb_value'];
      }
      if ($row['ofb_key'] == 'about_text') {
        $about_text = $row['ofb_value'];
      }
      if ($row['ofb_key'] == 'header_text') {
        $header_text = $row['ofb_value'];
      }
      if ($row['ofb_key'] == 'copyright') {
        $copyright = $row['ofb_value'];
      }
      if ($row['ofb_key'] == 'menu') {
        $menu = json_decode($row['ofb_value'], true);
      }
      if ($row['ofb_key'] == 'cv_btn') {
        $cv_btn = json_decode($row['ofb_value'], true);
      }
      if ($row['ofb_key'] == 'smtp') {
        $smtp = json_decode('[' . $row['ofb_value'] . ']', true);
      }
      if ($row['ofb_key'] == 'favicon') {
        $favicon = $row['ofb_value'];
      }
      if ($row['ofb_key'] == 'profile_img') {
        $profile_img = $row['ofb_value'];
      }
      if ($row['ofb_key'] == 'site_url') {
        $site_url = $row['ofb_value'];
      }
      if ($row['ofb_key'] == 'lang') {
        $lang = $row['ofb_value'];
      }
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>Yönetim - <?=$kullanici_bilgileri['kullaniciadi']?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta content="Ömer Faruk Biçer" name="author">
   <link href="assets\bootstrap\css\bootstrap.css" rel="stylesheet">
   <link href="assets\bootstrap\css\bootstrap-responsive.css" rel="stylesheet">
   <link href="assets\bootstrap\css\bootstrap-fileupload.css" rel="stylesheet">
   <link href="assets\font-awesome\css\font-awesome.css" rel="stylesheet">
   <link href="css\style.css" rel="stylesheet">
   <link href="css\style_responsive.css" rel="stylesheet">
   <link href="css\style_default.css" rel="stylesheet" id="style_color">
   <link href="assets\fancybox\source\jquery.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="assets\uniform\css\uniform.css">
   <!-- =====BOX ICONS===== -->
   <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN HEADER -->
   <div id="header" class="navbar navbar-inverse navbar-fixed-top">
       <!-- BEGIN TOP NAVIGATION BAR -->
       <div class="navbar-inner">
           <div class="container-fluid">
               <!-- BEGIN LOGO -->
               <a class="brand" href="index.html">
                   <span style="font-size:30px;color:#ffffff;">Admin</span>
               </a>
               <!-- END LOGO -->
               <!-- BEGIN RESPONSIVE MENU TOGGLER -->
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="arrow"></span>
               </a>
               <!-- END RESPONSIVE MENU TOGGLER -->
               <div class="top-nav ">
                   <ul class="nav pull-right top-menu">
                       <!-- BEGIN USER LOGIN DROPDOWN -->
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <img src="img\avatar1_small.jpg" alt="">
                               <span class="username"><?=$kullanici_bilgileri['kullaniciadi']?></span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu">
                               <li><a href="logout.php"><i class="icon-key"></i> Çıkış Yap</a></li>
                           </ul>
                       </li>
                       <!-- END USER LOGIN DROPDOWN -->
                   </ul>
                   <!-- END TOP NAVIGATION MENU -->
               </div>
           </div>
       </div>
       <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
