<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
         <li class="breadcrumb-item"><a href="<?php echo admin_site_url('course'); ?>"><?php echo translate('course'); ?></a></li>
         <li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
      </ol>
   </div>
   <div class="btn btn-list">
      <a class="btn ripple btn-primary" href="<?php echo admin_site_url('course'); ?>"><i class="fe fe-list ml-2"></i> <?php echo translate('list') ?></a>
   </div>
</div>
<div class="row sidemenu-height">
   <div class="col-lg-12">
      <div class="card custom-card">
         <div class="card-body">
            <?php echo form_open(admin_site_url('course/crud'), array('class' => 'data-parsley-validate', 'method' => 'post', 'data-block_form' => 'true', 'enctype' => 'multipart/form-data', 'data-multipart' => 'true'), array('action' => $page_action, 'id' => encode_string($id))); ?>
            <div class="col-12 col-sm-12">
               <div class="row">
                  <div class="col-12 col-sm-2">
                     <div class="form-group">
                        <?php echo app_file_manager('image', 'image', 1, get_column_value(TBL_COURSE, array('id' => $id), 'image', 'default.png')); ?>
                     </div>
                  </div>
                  <div class="col-12 col-sm-10">
                     <div class="row">
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('name'); ?> <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="name" placeholder="<?php echo translate('name'); ?>" tabindex="2" value="<?php echo get_column_value(TBL_COURSE, array('id' => $id), 'name'); ?>" required />
                           </div>
                        </div>
                        <?php
                        $status_list = array(
                           ''   => translate("select"),
                           '1'  => translate("active"),
                           '0'  => translate("inactive")
                        );
                        ?>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('status'); ?> <span class="text-danger">*</span></label>
                              <?php echo form_dropdown('is_active', $status_list, get_column_value(TBL_COURSE, array('id' => $id), 'is_active'), array('class' => 'form-control select2', 'required' => true, 'tabindex' => '6', 'data-parsley-errors-container' => "#error_status")); ?>
                              <span id="error_status"></span>
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('short_description'); ?></label>
                              <textarea class="form-control" name="short_description" placeholder="<?php echo translate('short_description'); ?>" tabindex="5"><?php echo get_column_value(TBL_COURSE, array('id' => $id), 'short_description'); ?></textarea>
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('SEO_keywords'); ?></label>
                              <input type="text" data-role="tagsinput" class="form-control" name="seo_keywords" placeholder="<?php echo translate('SEO_keywords'); ?>" value="<?php echo get_column_value(TBL_COURSE, array('id' => $id), 'seo_keywords'); ?>" tabindex="6" />
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 col-sm-12">
                        <div class="form-group">
                           <label><?php echo translate('description'); ?> <span class="text-danger">*</span></label>
                           <?php echo app_html_editor("description", "description", translate('description'), get_column_value(TBL_COURSE, array('id' => $id), 'description')); ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12 col-sm-12 text-center">
                  <button type="submit" class="btn ripple btn-submit btn-primary" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" tabindex="7"><?php echo translate('submit'); ?></button>
                  <a class="btn ripple btn-secondary" href="<?php echo admin_site_url('course') ?>"><?php echo translate('close'); ?></a>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   function responsive_filemanager_callback(field_id) {
      var url = $('#' + field_id).val();
      $('#img_' + field_id).attr('src', url);
   }
   $(document).ready(function() {
      init_select2();
   });
</script>