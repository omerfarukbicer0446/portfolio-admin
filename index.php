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
                  Hoş geldiniz  <?=$kullanici_bilgileri['kullaniciadi']?>
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
                          <i class="icon-globe"></i>Başlık
                        </h4>
                     </div>
                     <div class="widget-body">
                         İçerik
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
