<?php
  session_start();
  require 'classes/cibzadb.php';
  $db = new CibzaDB('localhost', 'admin', 'root', '');
  if (isset($_SESSION['MM_Userid']) && isset($_SESSION['MM_Usertype'])) {
    header('Location: index.php');
  }
  if (isset($_POST['submit'])) {
    // select
    $query = $db->from('kullanicilar')
                ->where('kullaniciadi', $_POST['kullaniciadi'])
                ->where('sifresi', $_POST['sifre'])
                ->first();

    if ( $query ){
       $_SESSION['MM_Userid'] = $query['id'];
       $_SESSION['MM_Usertype'] = $query['tipi'];
       header('Location: index.php');
    }else {
      $error = "Böyle bir kullanıcı bulunamadı";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Giriş Sayfası</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Ömer Faruk Biçer" name="author">
  <link href="assets\bootstrap\css\bootstrap.css" rel="stylesheet">
  <link href="assets\font-awesome\css\font-awesome.css" rel="stylesheet">
  <link href="css\style.css" rel="stylesheet">
  <link href="css\style_responsive.css" rel="stylesheet">
  <link href="css\style_default.css" rel="stylesheet" id="style_color">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body id="login-body">
  <div class="login-header">
      <!-- BEGIN LOGO -->
      <div id="logo" class="center" style="justify-content: center;align-items: center;text-align: center;">
          <span style="font-size:30px;color:#ffffff;">Admin</span>
      </div>
      <!-- END LOGO -->
  </div>

  <!-- BEGIN LOGIN -->
  <div id="login">
    <!-- BEGIN LOGIN FORM -->
    <form id="loginform" class="form-vertical no-padding no-margin" action="" method="post">
      <div class="lock">
          <i class="icon-lock"></i>
      </div>
      <div class="control-wrap">
          <h4>Yönetici Girişi</h4>
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on">
                        <i class="icon-user"></i>
                      </span>
                      <input id="input-username" type="text" name="kullaniciadi" required placeholder="Kullanıcı Adı">
                  </div>
              </div>
          </div>
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on">
                        <i class="icon-key"></i>
                      </span>
                      <input id="input-password" type="password" name="sifre" required placeholder="Şifre">
                  </div>
                  <div class="clearfix space5"></div>
              </div>

          </div>
      </div>

      <input type="submit" id="login-btn" name="submit" class="btn btn-block login-btn" value="Login">
    </form>
    <!-- END LOGIN FORM -->
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div id="login-copyright">
      2020 &copy; <a href="https://www.cibza.com">Powered by Ömer Faruk Biçer</a>
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="js\jquery-1.8.3.js"></script>
  <script src="assets\bootstrap\js\bootstrap.js"></script>
  <script src="js\jquery.js"></script>
  <script src="js\scripts.js"></script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
