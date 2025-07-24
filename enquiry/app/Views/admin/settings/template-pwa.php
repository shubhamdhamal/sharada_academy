<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$tab)); ?>
<div class="card custom-card">
   <div class="card-header custom-card-header">
      <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('PWA') ?></h5>
      <div class="card-options">
         <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
      </div>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-12 col-sm-2">
            <label><?php echo translate('PWA'); ?> <span class="text-danger">*</span></label>
         </div>
         <?php $pwa_status = app_setting('app_pwa_status','off'); ?>
         <div class="col-12 col-sm-10">
            <div class="row">
               <div class="col-6 col-sm-3">
                  <label class="rdiobox"><input type="radio" class="action-field" name="app_pwa_status" data-parsley-errors-container="#error_pwa_status" data-action="o" value="off" <?php echo $pwa_status=='off' ? 'checked' : '' ?> required> <span><?php echo translate('off'); ?></span></label>
               </div>
               <div class="col-6 col-sm-3">
                  <label class="rdiobox"><input type="radio" class="action-field" name="app_pwa_status" data-parsley-errors-container="#error_pwa_status" data-action="d" value="on" <?php echo $pwa_status=='on' ? 'checked' : '' ?> required> <span><?php echo translate('on'); ?></span></label>
               </div>
               <span id="error_pwa_status"></span>
            </div>
         </div>
      </div>
      <hr/>
         <?php 
         $details = app_setting('app_pwa_details','[]');
         $details = !empty(json_decode($details)) ? json_decode($details) : array();
      ?>
      <div class="row action-dv o-action-dv">
         <input type="hidden" class="o-action"/>
      </div>
      <div class="row action-dv d-action-dv">
         <div class="col-12 col-sm-4">
            <div class="form-group">
               <label><?php echo translate('cache_name'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action"data-parsley-type="alphanum" name="app_pwa_details[cache_name]" placeholder="<?php echo translate('cache_name'); ?>" value="<?php echo isset($details->cache_name) ? $details->cache_name : '' ?>" tabindex="2" required />
            </div>
         </div>
         <div class="col-12 col-sm-4">
            <div class="form-group">
               <label><?php echo translate('name'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action" name="app_pwa_details[name]" placeholder="<?php echo translate('name'); ?>" value="<?php echo isset($details->name) ? $details->name : '' ?>" tabindex="3" required />
            </div>
         </div>
         <div class="col-12 col-sm-4">
            <div class="form-group">
               <label><?php echo translate('short_name'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action" name="app_pwa_details[short_name]" placeholder="<?php echo translate('short_name'); ?>" value="<?php echo isset($details->short_name) ? $details->short_name : '' ?>" tabindex="4" required />
            </div>
         </div>
         <div class="col-12 col-sm-12">
            <div class="form-group">
               <label><?php echo translate('description'); ?> <span class="text-danger">*</span></label>
               <textarea type="text" class="form-control action-fld d-action" name="app_pwa_details[description]" placeholder="<?php echo translate('description'); ?>" tabindex="5" required><?php echo isset($details->description) ? $details->description : '' ?></textarea>
            </div>
         </div>
         <div class="col-12 col-sm-3">
            <?php
               $display_mode = array();
               $display_mode['browser'] = translate('browser');
               $display_mode['standalone'] = translate('standalone');
               $display_mode['minimal ui'] = translate('minimal_UI');
               $display_mode['fullscreen'] = translate('fullscreen');
            ?>
            <div class="form-group">
               <label><?php echo translate('display_mode'); ?> <span class="text-danger">*</span></label>
               <?php echo form_dropdown('app_pwa_details[display]', $display_mode, isset($details->display) ? $details->display : 'standalone',array('class'=>'form-control select2 action-fld d-action','required'=>true)); ?>
            </div>
         </div>
         <div class="col-12 col-sm-3">
            <?php
               $orientation = array();
               $orientation['any'] = translate('any');
               $orientation['portrait'] = translate('portrait');
               $orientation['landscape'] = translate('landscape');
            ?>
            <div class="form-group">
               <label><?php echo translate('orientation'); ?> <span class="text-danger">*</span></label>
               <?php echo form_dropdown('app_pwa_details[orientation]', $orientation, isset($details->orientation) ? $details->orientation : 'any',array('class'=>'form-control select2 action-fld d-action','required'=>true)); ?>
            </div>
         </div>
         <div class="col-12 col-sm-2">
            <div class="form-group">
               <label><?php echo translate('theme'); ?> <span class="text-danger">*</span></label><br/>
               <input type="text" class="form-control action-fld d-action colorpicker" data-parsley-errors-container="#error_theme_color" name="app_pwa_details[theme]" placeholder="<?php echo translate('theme'); ?>" tabindex="8" value="<?php echo isset($details->theme) ? $details->theme : ''; ?>" required />
               <span id="error_theme"></span>
            </div>
         </div>
         <div class="col-12 col-sm-2">
            <div class="form-group">
               <label><?php echo translate('background'); ?> <span class="text-danger">*</span></label><br/>
               <input type="text" class="form-control action-fld d-action colorpicker" data-parsley-errors-container="#error_background" name="app_pwa_details[background]" placeholder="<?php echo translate('backgroundr'); ?>" tabindex="9" value="<?php echo isset($details->background) ? $details->background : ''; ?>" required />            
               <span id="error_background"></span>
            </div>
         </div>
         <div class="col-12 col-sm-2">
            <label><?php echo translate('icon'); ?> <span class="text-danger">*</span></label><br/>
            <img class="app-image-input img-thumbnail" data-name="pwa" src="<?php echo uploads_url('pwa.png'); ?>" style="height: 80px;"/>
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
   if($('.colorpicker').length){
      $('.colorpicker').spectrum({
         showInput: true,
         preferredFormat: 'hex6'
      });
   }
</script>