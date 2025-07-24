<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab)); ?>
   <div class="card custom-card">
      <div class="card-header custom-card-header">
         <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('e-Mail') ?></h5>
         <div class="card-options">
            <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
         </div>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('email_from_name'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="email_from_name" placeholder="<?php echo translate('email_from_name'); ?>" value="<?php echo app_setting('email_from_name') ?>" tabindex="1" required />
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('email_from_user'); ?> <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="email_from_user" placeholder="<?php echo translate('email_from_user'); ?>" value="<?php echo app_setting('email_from_user') ?>" tabindex="2" required />
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12 col-sm-2">
               <label><?php echo translate('email_protocol'); ?> <span class="text-danger">*</span></label>
            </div>
            <?php $email_protocol = app_setting('email_protocol','mail'); ?>
            <div class="col-12 col-sm-10">
               <div class="row">
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="email_protocol" data-parsley-errors-container="#error_email_protocol" data-action="m" value="mail" <?php echo $email_protocol=='mail' ? 'checked' : '' ?> required> <span><?php echo translate('mail'); ?></span></label>
                  </div>
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="email_protocol" data-parsley-errors-container="#error_email_protocol" data-action="s" value="smtp" <?php echo $email_protocol=='smtp' ? 'checked' : '' ?> required> <span><?php echo translate('SMTP'); ?></span></label>
                  </div>
                  <span id="error_email_protocol"></span>
               </div>
            </div>
         </div>
         <hr/>
         <div class="row action-dv m-action-dv">
            <input type="hidden" class="m-action"/>
         </div>
         <div class="row action-dv s-action-dv">
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('email_host'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld s-action" name="email_host" placeholder="<?php echo translate('email_host'); ?>" value="<?php echo app_setting('email_host') ?>" tabindex="3" required />
               </div>
            </div>
            <div class="col-12 col-sm-3">
               <div class="form-group">
                  <label><?php echo translate('email_port'); ?> <span class="text-danger">*</span></label>
                  <input type="number" class="form-control action-fld s-action" name="email_port" placeholder="<?php echo translate('email_port'); ?>" value="<?php echo app_setting('email_port') ?>" tabindex="4" required />
               </div>
            </div>
            <div class="col-12 col-sm-3">
               <?php
                  $security_type = array(
                     "none" => translate("none"),
                     "tls" => translate("TLS"),
                     "ssl" => translate("SSL")
                  );
               ?>
               <div class="form-group">
                  <label><?php echo translate('security_type'); ?> <span class="text-danger">*</span></label>
                  <?php echo form_dropdown('email_security_type', $security_type, app_setting('email_security_type','none'),array('class'=>'form-control action-fld s-action select2','required'=>true)); ?>
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('email_user'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld s-action" name="email_user" placeholder="<?php echo translate('email_user'); ?>" value="<?php echo app_setting('email_user') ?>" tabindex="6" required />
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('email_password'); ?> <span class="text-danger">*</span></label>
                  <input type="password" class="form-control action-fld s-action" name="email_password" placeholder="<?php echo translate('email_password'); ?>" value="<?php echo app_setting('email_password') ?>" tabindex="7" required />
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