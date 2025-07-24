<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$tab)); ?>
<div class="card custom-card">
   <div class="card-header custom-card-header">
      <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('theme') ?></h5>
      <div class="card-options">
         <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
      </div>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-12 col-sm-4 text-right">
            <label><?php echo translate('app_logo'); ?> <span class="text-danger">*</span></label>
         </div>
         <div class="col-12 col-sm-8">
            <img class="app-image-input img-thumbnail" data-name="app_logo" src="<?php echo uploads_url('logo.png'); ?>" style="height: 80px;"/>
            <p><small class="text-muted"><i><?php echo translate('click_on_the_image_to_change').' '.translate('best_size_is_80px_X_80px'); ?></i></small></p>
         </div>
      </div>
      <hr/>
      <div class="row">
         <div class="col-12 col-sm-4 text-right">
            <label><?php echo translate('app_favicon'); ?> <span class="text-danger">*</span></label>
         </div>
         <div class="col-12 col-sm-8">
            <img class="app-image-input img-thumbnail" data-name="app_favicon" src="<?php echo uploads_url('favicon.png'); ?>" style="height: 80px;"/>
            <p><small class="text-muted"><i><?php echo translate('click_on_the_image_to_change').' '.translate('best_size_is_80px_X_80px'); ?></i></small></p>
         </div>
      </div>
      <hr/>
      <div class="row">
         <div class="col-12 col-sm-4">
            <div class="form-group">
               <label><?php echo translate('app_color'); ?> <span class="text-danger">*</span></label><br/>
               <input type="text" class="form-control colorpicker" name="app_color" placeholder="<?php echo translate('app_color'); ?>" tabindex="1" value="<?php echo app_setting('app_color'); ?>" autofocus required />
            </div>
         </div>
         <div class="col-12 col-sm-4">
            <?php
               $menubar = array('left'=>translate('left'),'top'=>translate('top'));
            ?>
            <div class="form-group">
               <label><?php echo translate('menubar'); ?> <span class="text-danger">*</span></label>
               <?php echo form_dropdown('menubar', $menubar, app_setting('menubar','left'),array('class'=>'form-control select2','required'=>true)); ?>
            </div>
         </div>
      </div>
      <hr/>
      <div class="row">
         <div class="col-12 col-sm-4">
            <label class="custom-switch">
               <span class="custom-switch-description"><?php echo translate('RTL_mode'); ?></span>
               &nbsp;&nbsp;
               <input type="checkbox" name="app_rtl" class="custom-switch-input"  <?php echo app_setting('app_rtl','off')=='on' ? 'checked' : ''; ?>>
               <span class="custom-switch-indicator"></span>
            </label>
         </div>
         <div class="col-12 col-sm-8">
            <small class="text-muted"><i><?php echo translate("if_you_enable_it,_then_panel_will_in_RTL_direction"); ?></i></small>
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
   if($('.colorpicker').length){
      $('.colorpicker').spectrum({
         showInput: true,
         preferredFormat: 'hex6'
      });
   }
</script>