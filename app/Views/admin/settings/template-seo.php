<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab)); ?>
   <div class="card custom-card">
      <div class="card-header custom-card-header">
         <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('SEO') ?></h5>
         <div class="card-options">
            <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
         </div>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-12 col-sm-3">
               <div class="form-group">
                  <label><?php echo translate('SEO_author'); ?></label>
                  <input type="text" class="form-control" name="seo_author" placeholder="<?php echo translate('SEO_author'); ?>" value="<?php echo app_setting('seo_author') ?>" tabindex="1" />
               </div>
            </div>
            <div class="col-12 col-sm-3">
               <div class="form-group">
                  <label><?php echo translate('SEO_visit_after').' ('.translate('in_days').')'; ?></label>
                  <input type="number" class="form-control" name="seo_visit_after" min="0" placeholder="<?php echo translate('SEO_visit_after').' ('.translate('in_days').')'; ?>" value="<?php echo app_setting('seo_visit_after') ?>" tabindex="2" />
               </div>
            </div>
             <div class="col-12 col-sm-3">
               <div class="form-group">
                  <label><?php echo translate('google_analytics_id'); ?></label>
                  <input type="text" class="form-control" name="google_analytics_id" placeholder="<?php echo translate('google_analytics_id'); ?>" value="<?php echo app_setting('google_analytics_id') ?>" tabindex="3" />
               </div>
            </div>
            <div class="col-12 col-sm-3">
               <div class="form-group">
                  <label><?php echo translate('facebook_pixel_id'); ?></label>
                  <input type="text" class="form-control" name="facebook_pixel_id" placeholder="<?php echo translate('facebook_pixel_id'); ?>" value="<?php echo app_setting('facebook_pixel_id') ?>" tabindex="4" />
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('SEO_title'); ?></label>
                  <textarea class="form-control" name="seo_title" placeholder="<?php echo translate('SEO_title'); ?>" tabindex="5" /><?php echo app_setting('seo_title') ?></textarea>
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('SEO_description'); ?></label>
                  <textarea class="form-control" name="seo_description" placeholder="<?php echo translate('SEO_description'); ?>" tabindex="6" /><?php echo app_setting('seo_description') ?></textarea>
               </div>
            </div>
            <div class="col-12 col-sm-12">
               <div class="form-group">
                  <label><?php echo translate('SEO_keywords'); ?></label>
                  <input type="text" data-role="tagsinput" class="form-control" name="SEO_keywords" placeholder="<?php echo translate('SEO_keywords'); ?>" value="<?php echo app_setting('seo_keywords') ?>" tabindex="7" />
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12 col-sm-12">
               <div class="form-group">
                  <label><?php echo translate('SEO_noscript'); ?></label>
               </div>
            </div>
         </div>
         <div class="seo_noscript_row">
            <?php $seo_noscript = json_decode(app_setting('seo_noscript')); ?>
              <?php if(!empty($seo_noscript)){ foreach ($seo_noscript as $key => $value) { ?>
                  <div class="row">
                      <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                          <div class="form-group text-left">
                              <textarea class="form-control" name="seo_noscript[]" placeholder="<?php echo translate('SEO_noscript') ?>" required><?php echo isset($value) && $value != '' ? $value : ''; ?></textarea>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                          <div class="form-group form-group-float">
                              <button type="button" class="btn ripple btn-outline-danger btn-rounded btn-remove-seo-noscript"><i class="fa fa-times" aria-hidden="true"></i></button>
                          </div>
                      </div>
                  </div>
              <?php } } ?>
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
               <div class="form-group">
                  <button type="button" class="btn ripple btn-outline-primary btn-rounded add-new-seo-noscript"><?php echo translate('add_new'); ?></button>
               </div>
           </div>
         </div>
         <div class="row">
            <div class="col-12"><hr/></div>
            <div class="col-12 text-center">
               <?php echo form_button(['content' => translate('save'),'type'=>'submit','class'=>'btn ripple btn-main-primary','data-loading-text'=>"<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> ".translate('please_wait...')]); ?>
            </div>
         </div>
      </div>
   </div>
<?php echo form_close(); ?>
<script>
   $( document ).ready(function() {
      $('body').on('click', '.add-new-seo-noscript', function () {
         var html = '<div class="row">';
            html += '   <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">';
            html += '       <div class="form-group text-left">';
            html += '           <textarea class="form-control" name="seo_noscript[]" placeholder="<?php echo translate('SEO_noscript') ?>" required></textarea>';
            html += '       </div>';
            html += '   </div>';
            html += '   <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">';
            html += '       <div class="form-group form-group-float">';
            html += '           <button type="button" class="btn ripple btn-outline-danger btn-rounded btn-remove-seo-noscript"><i class="fa fa-times" aria-hidden="true"></i></button>';
            html += '       </div>';
            html += '   </div>';
            html += '</div>';
         $(".seo_noscript_row").append(html);
      });
      $('body').on('click', '.btn-remove-seo-noscript', function () {
         var here = $(this);
         swal({
            title: "<?php echo translate('are_you_sure_?') ?>",
            text: "<?php echo translate('submit_to_remove') ?>",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
         }, function () {
            here.parent().parent().parent().remove();
            swal.close();
         });
      });
   });
</script>