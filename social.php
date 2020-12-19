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
                  Sosyal Medya Ayarları <a class="btn btn-success" href="social.php?do=add">Kayıt Ekle</a> <a class="btn btn-info" href="social.php"><i class="icon-refresh"></i></a>
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
                          <i class="icon-globe"></i>Listele
                        </h4>
                     </div>
                     <div class="widget-body">
                       <?php
                        if (@$_GET['do'] == 'delete' && isset($_GET['id'])) {
                          $social_delete = $remote_db->delete('ofb_social')
                                             ->where('ofb_id', $_GET['id'])
                                             ->done();

                          if ( $social_delete ){
                            $success = true;
                          }else {
                            $error = true;
                          }
                        }
                       ?>
                       <?php
                        if (isset($success)) {
                          echo '<div class="alert alert-info">
       										 <button class="close" data-dismiss="alert">×</button>
       										 <strong>Başarılı!</strong> Kayıdı Sildiniz
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
                        <table class="table table-striped table-bordered table-advance table-hover">
                           <thead>
                              <tr>
                                 <th>İcon</th>
                                 <th class="hidden-phone">Url</th>
                                 <th>View</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                             <?php foreach ($social as $key): ?>
                               <tr>
                                  <td>
                                   <i class="<?=$key['ofb_icon']?>"></i> <?=$key['ofb_icon']?>
                                  </td>
                                  <td><?=$key['ofb_url']?></td>
                                  <td><?=$key['ofb_view']?></td>
                                  <td><a href="social.php?do=edit&id=<?=$key['ofb_id']?>"><button class="btn btn-primary"><i class="icon-pencil icon-white"></i> Edit</button></a>
                                      <a href="social.php?do=delete&id=<?=$key['ofb_id']?>"><button class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete</button></a></td>
                               </tr>
                             <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>
               </div>
               <?php if (@$_GET['do'] == 'edit' && isset($_GET['id'])): ?>
                 <?php
                   $social_one = $remote_db->from('ofb_social')
                                           ->where('ofb_id', $_GET['id'])
                                           ->first();
                  ?>
                  <?php
                    if (isset($_POST['ofb_icon']) && isset($_POST['ofb_url'])) {
                      if (!isset($_POST['ofb_view'])) {
                        $view = 0;
                      }else {
                        $view = 1;
                      }
                      $query = $remote_db->update('ofb_social')
                                  ->where('ofb_id', $_GET['id'])
                                  ->set(array(
                                      'ofb_icon' => $_POST['ofb_icon'],
                                      'ofb_url' => $_POST['ofb_url'],
                                      'ofb_view' => $view
                                  ));

                      if ( $query ){
                       $success = true;
                     }else {
                       $error = true;
                     }
                    }
                   ?>
                 <div class="widget">
                   <div class="widget-title">
                      <h4>
                        <i class="icon-globe"></i>Düzenle
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
                       <div class="control-group">
                          <label class="control-label">İcon</label>
                          <div class="controls">
                             <input type="text" name="ofb_icon" value="<?=$social_one['ofb_icon']?>" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Url</label>
                          <div class="controls">
                             <input type="text" name="ofb_url" value="<?=$social_one['ofb_url']?>" class="span6">
                          </div>
                       </div>
                       <div class="controls-group">
                         <div class="controls">
                          <input type="checkbox" name="ofb_view" <?=($social_one['ofb_view'] == 1) ? "checked" : null?> value="1"> Aktif
                         </div>
                      </div>
                      <hr>
                       <div class="control-group">
                          <div class="controls">
                             <input type="submit" value="Kaydet" class="btn btn-success">
                          </div>
                       </div>
                     </form>
                   </div>
                 </div>
               <?php endif; ?>

               <?php if (@$_GET['do'] == 'add'): ?>
                  <?php
                    if (isset($_POST['ofb_icon']) && isset($_POST['ofb_url'])) {
                      if (!isset($_POST['ofb_view'])) {
                        $view = 0;
                      }else {
                        $view = 1;
                      }
                      $query = $remote_db->insert('ofb_social')
                                         ->set(array(
                                             'ofb_icon' => $_POST['ofb_icon'],
                                             'ofb_url' => $_POST['ofb_url'],
                                             'ofb_view' => $view
                                         ));

                      if ( $query ){
                       $success = true;
                     }else {
                       $error = true;
                     }
                    }
                   ?>
                 <div class="widget">
                   <div class="widget-title">
                      <h4>
                        <i class="icon-globe"></i>Ekle
                      </h4>
                   </div>
                   <div class="widget-body">
                     <?php
                      if (isset($success)) {
                        echo '<div class="alert alert-info">
     										 <button class="close" data-dismiss="alert">×</button>
     										 <strong>Başarılı!</strong> Kayıt eklendi.
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
                       <div class="control-group">
                          <label class="control-label">İcon</label>
                          <div class="controls">
                             <input type="text" name="ofb_icon" value="" class="span6">
                          </div>
                       </div>
                       <div class="control-group">
                          <label class="control-label">Url</label>
                          <div class="controls">
                             <input type="text" name="ofb_url" value="" class="span6">
                          </div>
                       </div>
                       <div class="controls-group">
                         <div class="controls">
                          <input type="checkbox" name="ofb_view" checked value="1"> Aktif
                         </div>
                      </div>
                      <hr>
                       <div class="control-group">
                          <div class="controls">
                             <input type="submit" value="Kaydet" class="btn btn-success">
                          </div>
                       </div>
                     </form>
                   </div>
                 </div>
               <?php endif; ?>
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
