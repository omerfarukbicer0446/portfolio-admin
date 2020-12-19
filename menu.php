<?php require 'static/header.php'; ?>
<!-- BEGIN CONTAINER -->
<?php

 if (isset($_POST['title']) && isset($_POST['title']) && isset($_POST['active'])) {
   foreach ($_POST['title'] as $key => $value) {
     $menu_title[] = $value;
   }
   foreach ($_POST['link'] as $key => $value) {
     $menu_link[] = $value;
   }
   foreach ($_POST['active'] as $key => $value) {
     $menu_active[] = $value;
   }
   foreach ($menu_title as $key => $value) {
     if (!isset($menu_active[$key])) {
       $menu_active[$key] = 0;
     }
     $menus[] = [
       'title' => $menu_title[$key],
       'link' => $menu_link[$key],
       'active' => $menu_active[$key]
     ];
   }
   $query = $remote_db->update('ofb_settings')
               ->where('ofb_key', 'menu')
               ->set(array(
                    'ofb_value' => json_encode($menus)
               ));

   if ( $query ){
     $success = true;
   }else {
     $error = true;
   }
 }

?>
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
                  Menü <a class="btn btn-info" href="menu.php"><i class="icon-refresh"></i></a>
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
                        <i class="icon-globe"></i>Menü düzenle
                      </h4>
                   </div>
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
                     <form action="" method="post">
                       <?php $i = 0; $count = count($menu); ?>
                       <?php foreach ($menu as $key): ?>
                         <div class="control-group">
                            <label class="control-label">Başlık</label>
                            <div class="controls">
                               <input type="text" name="title[]" value="<?=$key['title']?>" class="span6">
                            </div>
                         </div>
                         <div class="control-group">
                            <label class="control-label">Link</label>
                            <div class="controls">
                               <input type="text" name="link[]" value="<?=$key['link']?>" class="span6">
                            </div>
                         </div>
                         <div class="controls-group">
                           <div class="controls">
                            <input type="checkbox" name="active[]" <?=($key['active'] == 1) ? "checked" : null?> value="1"> Aktif
                           </div>
                        </div>
                         <?php
                            if (++$i === $count) {
                              echo "<label></label>";
                            }else {
                              echo "<hr>";
                            }
                          ?>
                       <?php endforeach; ?>
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
