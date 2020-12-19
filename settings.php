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
                  Ayarlar <a class="btn btn-info" href="settings.php"><i class="icon-refresh"></i></a>
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
                        <i class="icon-globe"></i>Ayarlar
                      </h4>
                   </div>
                   <?php
                      if (isset($_POST['submit'])) {
                       $query1 = $remote_db->update('ofb_settings')
                                           ->where('ofb_key', "title")
                                           ->set(array(
                                                'ofb_value' => $_POST['title']
                                           ));
                       $query2 = $remote_db->update('ofb_settings')
                                          ->where('ofb_key', "about_title")
                                          ->set(array(
                                               'ofb_value' => $_POST['about_title']
                                          ));
                       $query3 = $remote_db->update('ofb_settings')
                                           ->where('ofb_key', "about_text")
                                           ->set(array(
                                                'ofb_value' => $_POST['about_text']
                                           ));
                       $query4 = $remote_db->update('ofb_settings')
                                            ->where('ofb_key', "header_text")
                                            ->set(array(
                                                 'ofb_value' => $_POST['header_text']
                                            ));
                       $query5 = $remote_db->update('ofb_settings')
                                           ->where('ofb_key', "profile_img")
                                           ->set(array(
                                               'ofb_value' => $_POST['profile_img']
                                           ));
                       $query6 = $remote_db->update('ofb_settings')
                                           ->where('ofb_key', "favicon")
                                           ->set(array(
                                               'ofb_value' => $_POST['favicon']
                                           ));
                       $query7 = $remote_db->update('ofb_settings')
                                           ->where('ofb_key', "copyright")
                                           ->set(array(
                                               'ofb_value' => $_POST['copyright']
                                           ));
                       $query8 = $remote_db->update('ofb_settings')
                                           ->where('ofb_key', "site_url")
                                           ->set(array(
                                               'ofb_value' => $_POST['site_url']
                                           ));
                       $query9 = $remote_db->update('ofb_settings')
                                           ->where('ofb_key', "lang")
                                           ->set(array(
                                               'ofb_value' => $_POST['lang']
                                           ));
                         if ($query1 && $query2 && $query3 && $query4 && $query5 && $query6 && $query7 && $query8 && $query9) {
                           $success = true;
                         }else {
                           $danger = true;
                         }
                      }
                    ?>
                   <div class="widget-body">
                     <?php
                      if (isset($success)) {
                        echo '<div class="alert alert-info">
     										 <button class="close" data-dismiss="alert">×</button>
     										 <strong>Başarılı!</strong> Kayıtlar Güncenlendi.
       								 </div>';
                      }
                      ?>
                      <?php
                       if (isset($error)) {
                         echo '<div class="alert alert-danger">
      										 <button class="close" data-dismiss="alert">×</button>
      										 <strong>Hata!</strong> Sistemsel bir hata oluştu
        								 </div>';
                       }
                       ?>
                     <form class="" action="" method="post">
                       <div class="control-group">
                          <label class="control-label">Site İsmi</label>
                          <div class="controls">
                             <input type="text" name="title" value="<?=$title?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Site URL</label>
                          <div class="controls">
                             <input type="text" name="site_url" value="<?=$site_url?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Hakkımda Başlığı</label>
                          <div class="controls">
                             <input type="text" name="about_title" value="<?=$about_title?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Hakkımda Yazısı</label>
                          <div class="controls">
                             <textarea class="span6" name="about_text"><?=htmlspecialchars($about_text)?></textarea>
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Header Yazısı</label>
                          <div class="controls">
                             <input type="text" name="header_text" value="<?=htmlspecialchars($header_text)?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Profile</label>
                          <div class="controls">
                             <input type="text" name="profile_img" value="<?=$profile_img?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Favicon</label>
                          <div class="controls">
                             <input type="text" name="favicon" value="<?=$favicon?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">COPYRIGHT</label>
                          <div class="controls">
                             <input type="text" name="copyright" value="<?=$copyright?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Site Dili</label>
                          <div class="controls">
                             <input type="text" name="lang" value="<?=$lang?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <div class="controls">
                             <input type="submit" name="submit" value="Kaydet" class="btn btn-success">
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
