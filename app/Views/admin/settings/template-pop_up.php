<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$tab)); ?>
<div class="card custom-card">
   <div class="card-header custom-card-header">
      <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('Pop_up') ?></h5>
      <div class="card-options">
         <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
      </div>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-12 col-sm-4">
         <label class="custom-switch">
               <span class="custom-switch-description"><?php echo translate('status'); ?></span>
               &nbsp;&nbsp;
               <input type="checkbox" name="popup_status" class="custom-switch-input" <?php echo app_setting('popup_status','off')=='on' ? 'checked' : ''; ?>>
               <span class="custom-switch-indicator"></span>
            </label>
         </div>
         <div class="col-12 col-sm-8">
            <small class="text-muted"><i><?php echo translate("if_you_enable_it,_then_it_will_active"); ?></i></small>
         </div>
      </div>
      <hr/>
      <div class="row">
         <div class="col-12 col-sm-4 text-right">
            <label><?php echo translate('banner'); ?> <span class="text-danger">*</span></label>
         </div>
         <div class="col-12 col-sm-8">
            <div class="form-group">
                <?php echo app_file_manager('popup_banner','popup_banner',2,app_setting('popup_banner')); ?>
            </div>
         </div>
      </div>
      <hr/>
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
    function responsive_filemanager_callback(field_id){
      var url = $('#'+field_id).val();
      $('#img_'+field_id).attr('src', url);
    }
</script>
