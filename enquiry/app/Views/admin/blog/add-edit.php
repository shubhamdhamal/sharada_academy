<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
         <li class="breadcrumb-item"><a href="<?php echo admin_site_url('blog'); ?>"><?php echo translate('blog'); ?></a></li>
         <li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
      </ol>
   </div>
   <div class="btn btn-list">
      <a class="btn ripple btn-primary" href="<?php echo admin_site_url('blog'); ?>"><i class="fe fe-list ml-2"></i> <?php echo translate('list') ?></a>
   </div>
</div>
<div class="row sidemenu-height">
   <div class="col-lg-12">
      <div class="card custom-card">
         <div class="card-body">
            <?php echo form_open(admin_site_url('blog/crud'), array('class' => 'data-parsley-validate', 'method' => 'post', 'data-block_form' => 'true', 'enctype' => 'multipart/form-data', 'data-multipart' => 'true'), array('action' => $page_action, 'id' => encode_string($id))); ?>
            <div class="col-12 col-sm-12">
               <div class="row">
                  <div class="col-12 col-sm-3">
                     <div class="form-group">
                        <?php echo app_file_manager('image', 'image', 1, get_column_value(TBL_BLOG, array('id' => $id), 'image', 'default.png')); ?>
                     </div>
                  </div>
                  <div class="col-12 col-sm-9">
                     <div class="row">
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('name'); ?> <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="name" placeholder="<?php echo translate('name'); ?>" tabindex="2" value="<?php echo get_column_value(TBL_BLOG, array('id' => $id), 'name'); ?>" required />
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
                              <?php echo form_dropdown('is_active', $status_list, get_column_value(TBL_BLOG, array('id' => $id), 'is_active'), array('class' => 'form-control select2', 'required' => true, 'tabindex' => '6', 'data-parsley-errors-container' => "#error_status")); ?>
                              <span id="error_status"></span>
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('short_description'); ?></label>
                              <textarea class="form-control" name="short_description" placeholder="<?php echo translate('short_description'); ?>" tabindex="5"><?php echo get_column_value(TBL_BLOG, array('id' => $id), 'short_description'); ?></textarea>
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('SEO_description'); ?></label>
                              <textarea class="form-control" name="seo_description" placeholder="<?php echo translate('SEO_description'); ?>" tabindex="5"><?php echo get_column_value(TBL_BLOG, array('id' => $id), 'seo_description'); ?></textarea>
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('SEO_keywords'); ?></label>
                              <input type="text" data-role="tagsinput" class="form-control" name="seo_keywords" placeholder="<?php echo translate('SEO_keywords'); ?>" value="<?php echo get_column_value(TBL_BLOG, array('id' => $id), 'seo_keywords'); ?>" tabindex="6" />
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label><?php echo translate('SEO_title'); ?></label>
                              <input type="text" class="form-control" name="seo_title" placeholder="<?php echo translate('SEO_title'); ?>" value="<?php echo get_column_value(TBL_BLOG, array('id' => $id), 'seo_title'); ?>" tabindex="6" />
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 col-sm-12">
                        <div class="form-group">
                           <label><?php echo translate('description'); ?> <span class="text-danger">*</span></label>
                           <?php echo app_html_editor("description", "description", translate('description'), get_column_value(TBL_BLOG, array('id' => $id), 'description')); ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 col-sm-12">
                        <div class="form-group">
                           <label><?php echo translate('images'); ?> (<a href="javascript:void(0);" data-url="<?php echo base_url('filemanager/dialog.php?type=1&field_id=multi_image_field') ?>" class="btn-iframe" data-original-title="<?php echo translate('click_on_the_image_to_change') ?>" data-placement="top" data-toggle="tooltip" title="<?php echo translate('click_on_the_image_to_change') ?>"><?php echo translate('select') ?></a>)</label>
                        </div>
                     </div>
                  </div>
                  <div class="row image-sortable images_row">
                     <?php $i = 0;
                     $images = json_decode(get_column_value(TBL_BLOG, array('id' => $id), 'images')); ?>
                     <?php if (!empty($images)) {
                        foreach ($images as $key => $value) { ?>
                           <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 image-draggable" id="ir<?php echo  $i; ?>" style="float:left;">
                              <div class="form-group text-left">
                                 <img class="img-thumbnail" src="<?php echo uploads_url($value); ?>">
                                 <input type="hidden" name="images[]" value="<?php echo $value; ?>">
                                 <a href="javascript:void(0);" class="btn btn-danger btn-block btn-remove-images" data-id="<?php echo  $i; ?>"><i class="fa fa-times"></i> <?php echo translate('remove'); ?> </a>
                              </div>
                           </div>
                     <?php $i++;
                        }
                     } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 col-sm-12 text-center">
                     <button type="submit" class="btn ripple btn-submit btn-primary" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" tabindex="7"><?php echo translate('submit'); ?></button>
                     <a class="btn ripple btn-secondary" href="<?php echo admin_site_url('blog') ?>"><?php echo translate('close'); ?></a>
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
<input type="hidden" id="img_cnt" value="<?php echo $i; ?>">
<input type="hidden" id="multi_image_field" value="">
<script>
   function responsive_filemanager_callback(field_id) {
      if (field_id == 'multi_image_field') {
         var img_url = $("#multi_image_field").val();
         $("#multi_image_field").val('');
         var img_cnt = $("#img_cnt").val();
         img_cnt++;
         $("#img_cnt").val(img_cnt);
         var html = '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 image-draggable" id="ir' + img_cnt + '" style="float:left;">';
         html += '   <div class="form-group text-left">';
         html += '      <img class="img-thumbnail" src="' + img_url + '">';
         html += '      <input type="hidden" name="images[]" value="' + img_url + '">';
         html += '      <a href="javascript:void(0);" class="btn btn-danger btn-block btn-remove-images" data-id="' + img_cnt + '"><i class="fa fa-times"></i> <?php echo translate('remove'); ?> </a>';
         html += '   </div>';
         html += '</div>';
         $(".images_row").append(html);
      } else {
         var url = $('#' + field_id).val();
         $('#img_' + field_id).attr('src', url);
      }
   }
   $(document).ready(function() {
      init_select2();
      $('body').on('click', '.btn-remove-images', function(e) {
         var id = $(this).data('id');
         if (confirm("<?php echo translate('are_you_sure?') ?>")) {
            $("#ir" + id).remove();
         }
      });
      $(".image-sortable").sortable({
         connectWith: '.image-sortable',
         items: '.image-draggable',
         revert: true,
         placeholder: 'image-draggable-placeholder',
         forcePlaceholderSize: true,
         opacity: 0.77,
         cursor: 'move'
      });
   });
</script>