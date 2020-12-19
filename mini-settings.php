<?php require 'static/header.php'; ?>
<!-- BEGIN CONTAINER -->
<div id="container" class="row-fluid">
   <?php require 'static/sidebar.php'; ?>
   </div>
   <!-- END SIDEBAR -->
   <!-- BEGIN PAGE -->
   <div id="main-content">
      <!-- BEGIN PAGE CONTAINER-->
      <div class="container-fluid">
         <!-- BEGIN PAGE HEADER-->
         <div class="row-fluid">
            <div class="span12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                  Küçük Ayarlar <a class="btn btn-info" href="mini-settings.php"><i class="icon-refresh"></i></a>
               </h3>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
         </div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         <div class="row-fluid">
            <div class="span12">
              <div class="widget">
                  <div class="widget-title">
                     <h4>
                       <i class="icon-globe"></i>CV düzenle
                     </h4>
                  </div>
                  <?php
                    if (isset($_POST['cv_submit'])){
                      if (!isset($_POST['blank'])) {
                        $blank = 0;
                      }else {
                        $blank = 1;
                      }
                      $cvs = [
                        'text' => $_POST['text'],
                        'link' => $_POST['link'],
                        'blank' => $blank
                      ];

                      $query = $remote_db->update('ofb_settings')
                                         ->where('ofb_key', 'cv_btn')
                                         ->set(array(
                                              'ofb_value' => '['.json_encode($cvs).']'
                                         ));
                       if ( $query ) {
                         $success_cv = true;
                       }else {
                         $error_cv = true;
                       }
                    }
                  ?>
                  <div class="widget-body">
                    <?php
                     if (isset($success_cv)) {
                       echo '<div class="alert alert-info">
                        <button class="close" data-dismiss="alert">×</button>
                        <strong>Başarılı!</strong> Kayıt Güncenlendi.
                      </div>';
                     }
                     ?>
                     <?php
                      if (isset($error_cv)) {
                        echo '<div class="alert alert-danger">
                          <button class="close" data-dismiss="alert">×</button>
                          <strong>Hata!</strong> Sistemsel bir hata oluştu
                        </div>';
                      }
                      ?>
                    <form action="" method="post">
                      <?php foreach ($cv_btn as $key): ?>
                        <div class="control-group">
                           <label class="control-label">Buton Yazısı</label>
                           <div class="controls">
                              <input type="text" name="text" value="<?=$key['text']?>" class="span6">
                           </div>
                        </div>
                        <div class="control-group">
                           <label class="control-label">Link</label>
                           <div class="controls">
                              <input type="text" name="link" value="<?=$key['link']?>" class="span6">
                           </div>
                        </div>
                        <div class="controls-group">
                          <div class="controls">
                           <input type="checkbox" name="blank" <?=($key['blank'] == 1) ? "checked" : null?> value="1"> Yeni Sekme
                          </div>
                       </div><br>
                      <?php endforeach; ?>
                      <div class="control-group">
                         <div class="controls">
                            <input type="submit" name="cv_submit" value="Kaydet" class="btn btn-success">
                         </div>
                      </div>
                    </form>
                 </div>
              </div>


              <div class="widget">
                  <div class="widget-title">
                     <h4>
                       <i class="icon-globe"></i>SMTP Ayarları
                     </h4>
                  </div>
                  <?php
                    if (isset($_POST['smtp_submit'])){
                      $smtps = [
                        'host' => $_POST['host'],
                        'username' => $_POST['username'],
                        'password' => $_POST['password'],
                        'sender' => [
                          'email' => $_POST['sender_email'],
                          'name' => $_POST['sender_name']
                        ],
                        'receiver' => [
                          'email' => $_POST['receiver_email']
                        ],
                      ];

                      $query = $remote_db->update('ofb_settings')
                                         ->where('ofb_key', 'smtp')
                                         ->set(array(
                                              'ofb_value' => json_encode($smtps)
                                         ));
                       if ( $query ) {
                         $success_smtp = true;
                       }else {
                         $error_smtp = true;
                       }
                    }
                  ?>
                  <div class="widget-body">
                    <?php
                     if (isset($success_smtp)) {
                       echo '<div class="alert alert-info">
                        <button class="close" data-dismiss="alert">×</button>
                        <strong>Başarılı!</strong> Kayıt Güncenlendi.
                      </div>';
                     }
                     ?>
                     <?php
                      if (isset($error_smtp)) {
                        echo '<div class="alert alert-danger">
                          <button class="close" data-dismiss="alert">×</button>
                          <strong>Hata!</strong> Sistemsel bir hata oluştu
                        </div>';
                      }
                      ?>
                    <form action="" method="post">
                      <?php foreach ($smtp as $key): ?>
                        <label class="control-label">Hesap Ayarı</label><hr>
                        <div class="control-group">
                           <label class="control-label">Host</label>
                           <div class="controls">
                              <input type="text" name="host" value="<?=$key['host']?>" class="span6">
                           </div>
                        </div>
                        <div class="control-group">
                           <label class="control-label">Username</label>
                           <div class="controls">
                              <input type="text" name="username" value="<?=$key['username']?>" class="span6">
                           </div>
                        </div>
                        <div class="control-group">
                           <label class="control-label">Password</label>
                           <div class="controls">
                              <input type="password" name="password" value="<?=$key['password']?>" class="span6">
                           </div>
                        </div>
                        <label class="control-label">Gönderi Bilgileri</label><hr>
                        <div class="control-group">
                           <label class="control-label">E-Mail</label>
                           <div class="controls">
                              <input type="text" name="sender_email" value="<?=$key['sender']['email']?>" class="span6">
                           </div>
                        </div>
                        <div class="control-group">
                           <label class="control-label">İsim Soyisim</label>
                           <div class="controls">
                              <input type="text" name="sender_name" value="<?=$key['sender']['name']?>" class="span6">
                           </div>
                        </div>
                        <label class="control-label">Alıcı Bilgileri</label><hr>
                        <div class="control-group">
                           <label class="control-label">E-Mail</label>
                           <div class="controls">
                              <input type="text" name="receiver_email" value="<?=$key['receiver']['email']?>" class="span6">
                           </div>
                        </div>
                      <?php endforeach; ?>
                      <div class="control-group">
                         <div class="controls">
                            <input type="submit" name="smtp_submit" value="Kaydet" class="btn btn-success">
                         </div>
                      </div>
                    </form>
                 </div>
              </div>
            </div>
         </div>
         <!-- END PAGE CONTENT-->
      </div>
      <!-- END PAGE CONTAINER-->
   </div>
   <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<?php require 'static/footer.php'; ?>
