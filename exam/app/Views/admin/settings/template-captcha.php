<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab)); ?>
   <div class="card custom-card">
      <div class="card-header custom-card-header">
         <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('captcha') ?></h5>
         <div class="card-options">
            <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
         </div>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-12 col-sm-2">
               <label><?php echo translate('captcha'); ?> <span class="text-danger">*</span></label>
            </div>
            <?php $captcha_type = app_setting('captcha_status','off'); ?>
            <div class="col-12 col-sm-10">
               <div class="row">
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="captcha_type" data-parsley-errors-container="#error_captcha_status" data-action="o" value="off" <?php echo $captcha_type=='off' ? 'checked' : '' ?> required> <span><?php echo translate('off'); ?></span></label>
                  </div>
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="captcha_type" data-parsley-errors-container="#error_captcha_status" data-action="d" value="default" <?php echo $captcha_type=='default' ? 'checked' : '' ?> required> <span><?php echo translate('default'); ?></span></label>
                  </div>
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="captcha_type" data-parsley-errors-container="#error_captcha_status" data-action="gv2" value="gv2" <?php echo $captcha_type=='gv2' ? 'checked' : '' ?> required> <span><?php echo translate('google_v2'); ?></span></label>
                  </div>
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="captcha_type" data-parsley-errors-container="#error_captcha_status" data-action="gv3" value="gv3" <?php echo $captcha_type=='gv3' ? 'checked' : '' ?> required> <span><?php echo translate('google_v3'); ?></span></label>
                  </div>
                  <span id="error_captcha_status"></span>
               </div>
            </div>
         </div>
         <hr/>
         <?php 
            $details = app_setting('captcha_details','[]');
            $details = !empty(json_decode($details)) ? json_decode($details) : array();
         ?>
         <div class="row action-dv o-action-dv">
            <input type="hidden" class="o-action"/>
         </div>
         <div class="row action-dv d-action-dv">
            <div class="col-12 col-sm-2">
               <?php
                  $length = array (
                     '2' => "2", 
                     '3' => "3",
                     '4' => "4",
                     '5' => "5",
                     '6' => "6"
                  );
                  $sel = $captcha_type=='default' && isset($details->len) ? $details->len : '';
               ?>
               <div class="form-group">
                  <label><?php echo translate('length'); ?> <span class="text-danger">*</span></label>
                  <?php echo form_dropdown('default[len]', $length, $sel,array('class'=>'form-control select2 action-fld d-action','required'=>true)); ?>
               </div>
            </div>
            <div class="col-12 col-sm-10">
               <label><?php echo translate('captcha'); ?> <span class="text-danger">*</span></label>
               <div class="row">
                  <?php $string_types = array('alnum'=>translate('alpha_numeric'),'numeric'=>translate('numeric'),'nozero'=>translate('numeric_without_zero'),'alpha'=>translate('only_alphabets')); ?>
                  <?php foreach ($string_types as $key => $value) { ?>
                     <?php $sel = $captcha_type=='default' && isset($details->str) && $details->str==$key ? 'checked' : ''; ?>
                     <div class="col-6 col-sm-3">
                        <label class="rdiobox"><input type="radio" name="default[str]" class="action-fld d-action" data-parsley-errors-container="#error_captcha_type" value="<?php echo $key; ?>" <?php echo $sel; ?> required> <span><?php echo $value; ?></span></label>
                     </div>
                  <?php } ?>
                  <span id="error_captcha_type"></span>
               </div>
            </div>
         </div>
         <div class="row action-dv gv2-action-dv">
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('site_key'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld gv2-action" name="gv2[site]" placeholder="<?php echo translate('site_key'); ?>" value="<?php echo $captcha_type=='gv2' && isset($details->site) ? $details->site : ''; ?>" tabindex="4" required />
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('secret_key'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld gv2-action" name="gv2[secret]" placeholder="<?php echo translate('secret_key'); ?>" tabindex="3" value="<?php echo $captcha_type=='gv2' && isset($details->secret) ? $details->secret : ''; ?>" required />
               </div>
            </div>
         </div>
         <div class="row action-dv gv3-action-dv">
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('site_key'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld gv3-action" name="gv3[site]" placeholder="<?php echo translate('site_key'); ?>" value="<?php echo $captcha_type=='gv3' && isset($details->site) ? $details->site : ''; ?>" tabindex="6" required />
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('secret_key'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld gv3-action" name="gv3[secret]" placeholder="<?php echo translate('secret_key'); ?>" value="<?php echo $captcha_type=='gv3' && isset($details->secret) ? $details->secret : ''; ?>" tabindex="5" required />
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