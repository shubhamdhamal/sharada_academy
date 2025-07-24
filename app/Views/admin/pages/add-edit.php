<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
         <li class="breadcrumb-item"><a href="<?php echo admin_site_url('pages'); ?>"><?php echo translate('pages'); ?></a></li>
         <li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
      </ol>
   </div>
   <div class="btn btn-list">
      <a class="btn ripple btn-primary" href="<?php echo admin_site_url('pages'); ?>"><i class="fe fe-list ml-2"></i> <?php echo translate('list') ?></a>
   </div>
</div>
<div class="row sidemenu-height">
   <div class="col-lg-12">
      <div class="card custom-card">
         <div class="card-body">
            <?php echo form_open(admin_site_url('pages/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$page_action,'id'=>encode_string($id))); ?>
               <div class="row">
                  <div class="col-12 col-sm-9">
                     <div class="form-group">
                        <label><?php echo translate('name'); ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="<?php echo translate('name'); ?>" tabindex="2" value="<?php echo get_column_value(TBL_PAGES,array('id'=>$id),'name'); ?>" required />
                     </div>
                  </div>
                  <?php 
                     $status_list = array (
                        ''   => translate("select"), 
                        '1'  => translate("active"), 
                        '0'  => translate("inactive")
                     );
                  ?>
                  <div class="col-12 col-sm-3">
                     <div class="form-group">
                        <label><?php echo translate('status'); ?> <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('is_active', $status_list, get_column_value(TBL_PAGES,array('id'=>$id),'is_active'),array('class'=>'form-control select2','required'=>true, 'tabindex' => '6', 'data-parsley-errors-container'=>"#error_status")); ?>
                        <span id="error_status"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <div class="form-group">
                        <label><?php echo translate('short_description'); ?> <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="short_description" placeholder="<?php echo translate('SEO_description'); ?>" tabindex="4" required><?php echo get_column_value(TBL_PAGES,array('id'=>$id),'seo_description'); ?></textarea>
                     </div>
                  </div>
                  <div class="col-12 col-sm-6">
                     <div class="form-group">
                        <label><?php echo translate('SEO_description'); ?></label>
                        <textarea class="form-control" name="seo_description" placeholder="<?php echo translate('SEO_description'); ?>" tabindex="4"><?php echo get_column_value(TBL_PAGES,array('id'=>$id),'seo_description'); ?></textarea>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12">
                     <div class="form-group">
                        <label><?php echo translate('SEO_keywords'); ?></label>
                        <input type="text" data-role="tagsinput" class="form-control" name="seo_keywords" placeholder="<?php echo translate('SEO_keywords'); ?>" value="<?php echo get_column_value(TBL_PAGES,array('id'=>$id),'seo_keywords'); ?>" tabindex="7" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 col-sm-12">
                     <div class="form-group">
                        <label><?php echo translate('description'); ?> <span class="text-danger">*</span></label>
                        <?php echo app_html_editor("description","description",translate('description'),get_column_value(TBL_PAGES,array('id'=>$id),'description')); ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 col-sm-12 text-center">
                     <button type="submit" class="btn ripple btn-submit btn-primary" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" tabindex="7"><?php echo translate('submit'); ?></button>
                     <a class="btn ripple btn-secondary" href="<?php echo admin_site_url('pages') ?>"><?php echo translate('close'); ?></a>
                  </div>
               </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>
<script>
   $( document ).ready(function() {
      init_select2();
   });
</script>