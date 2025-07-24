<div class="tab-pane <?php echo isset($is_tab_active) && $is_tab_active==true ? 'active' : ''; ?>" id="<?php echo $tab_name ?>">
   <?php echo form_open(admin_site_url('profile/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab_name)); ?>
      <div class="row">
         <div class="col-12 col-sm-2">
            <label><?php echo translate('TOTP_type'); ?> <span class="text-danger">*</span></label>
         </div>
         <div class="col-12 col-sm-10">
            <div class="row">
               <div class="col-6 col-sm-3">
                  <label class="rdiobox"><input type="radio" class="action-field" name="authentication_type" data-parsley-errors-container="#error_authentication_type" data-action="d" value="default" required checked> <span><?php echo translate('default'); ?></span></label>
               </div>
               <div class="col-6 col-sm-3">
                  <label class="rdiobox"><input type="radio" class="action-field" name="authentication_type" data-parsley-errors-container="#error_authentication_type" data-action="g" value="google" required> <span><?php echo translate('google'); ?></span></label>
               </div>
               <div class="col-6 col-sm-3">
                  <label class="rdiobox"><input type="radio" class="action-field" name="authentication_type" data-parsley-errors-container="#error_authentication_type" data-action="m" value="message" required> <span><?php echo translate('message'); ?></span></label>
               </div>
               <?php if(app_setting('firebase_status','off')=='on'){ ?>
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="authentication_type" data-parsley-errors-container="#error_authentication_type" data-action="f" value="firebase" required> <span><?php echo translate('firebase'); ?></span></label>
                  </div>
               <?php } ?>
               <span id="error_authentication_type"></span>
            </div>
         </div>
      </div>
      <hr/>
      <div class="row action-dv d-action-dv">
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('TOTP'); ?> <span class="text-danger">*</span></label>
               <input type="number" class="form-control action-fld d-action" id="totp" name="totp" placeholder="<?php echo translate('TOTP'); ?>" tabindex="2" data-parsley-minlength="6" data-parsley-maxlength="6" required />
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('confirm_TOTP'); ?> <span class="text-danger">*</span></label>
               <input type="number" class="form-control action-fld d-action" name="confirm_totp" placeholder="<?php echo translate('confirm_TOTP'); ?>" tabindex="3" data-parsley-equalto="#totp" data-parsley-equalto-message="<?php echo translate('this_value_should_be_the_same_as_TOTP') ?>" required />
            </div>
         </div>
      </div>
      <div class="row action-dv g-action-dv">
         <div class="col-12 col-sm-6 text-center">
            <?php
               $secret = isset(get_auth_qr()->secret) && get_auth_qr()->secret!='' ? get_auth_qr()->secret : '';
               $image = isset(get_auth_qr()->image) && get_auth_qr()->image!='' ? get_auth_qr()->image : '';
            ?>
            <img class="img-thumbnail" src="<?php echo $image; ?>" style="height:128px;cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo translate('use_the_google_authenticator_app_to_scan_the_QR_code'); ?>"/>
            <p><small class="text-muted"><i><?php echo translate('use_the_google_authenticator_app_to_scan_the_QR_code'); ?></i></small></p>
            <input type="hidden" name="gsecret" value="<?php echo $secret ?>">
         </div>
         <div class="col-12 col-sm-6">
            <div class="col-12 col-sm-12">
               <div class="form-group">
                  <label><?php echo translate('TOTP'); ?> <span class="text-danger">*</span></label>
                  <input type="number" class="form-control action-fld g-action" id="gtotp" name="gtotp" placeholder="<?php echo translate('TOTP'); ?>" tabindex="4" required />
               </div>
            </div>
            <div class="col-12 col-sm-12">
               <div class="form-group">
                  <label><?php echo translate('confirm_TOTP'); ?> <span class="text-danger">*</span></label>
                  <input type="number" class="form-control action-fld g-action" name="confirm_gtotp" placeholder="<?php echo translate('confirm_TOTP'); ?>" tabindex="5" data-parsley-equalto="#gtotp" data-parsley-equalto-message="<?php echo translate('this_value_should_be_the_same_as_TOTP') ?>" required />
               </div>
            </div>
         </div>
      </div>
      <div class="row action-dv m-action-dv">
         <div class="col-12 col-sm-6">
            <div class="row">
               <div class="col-12 col-sm-6">
                  <?php
                     $mode = array (
                        ''  => translate('select'),
                        'email'  => translate('E-Mail'),
                        'sms'    => translate('SMS'),
                        'both'   => translate('both_(E-Mail_&_SMS)')
                     );
                  ?>
                  <div class="form-group">
                     <label><?php echo translate('OTP_mode'); ?> <span class="text-danger">*</span></label>
                     <?php echo form_dropdown('mode', $mode, '',array('class'=>'form-control action-fld m-action','required'=>true)); ?>
                  </div>
               </div>
               <div class="col-12 col-sm-6">
                  <?php
                     $length=array (
                        ''   => translate('select'),
                        '4'   => translate('4_digit'),
                        '6'   => translate('6_digit'),
                        '8'   => translate('8_digit'),
                     );
                  ?>
                  <div class="form-group">
                     <label><?php echo translate('OTP_length'); ?> <span class="text-danger">*</span></label>
                     <?php echo form_dropdown('length', $length, '',array('class'=>'form-control action-fld m-action','required'=>true)); ?>
                  </div>
               </div>
               <div class="col-12 col-sm-6">
                  <?php
                     $type=array (
                        ''   => translate('select'),
                        'alpha'     => translate('alphabetic'),
                        'alnum'     => translate('alphanumeric'),
                        'numeric'   => translate('numeric'),
                        'nozero'   => translate('numeric_without_zero'),
                     );
                  ?>
                  <div class="form-group">
                     <label><?php echo translate('OTP_type'); ?> <span class="text-danger">*</span></label>
                     <?php echo form_dropdown('type', $type, '',array('class'=>'form-control action-fld m-action','required'=>true)); ?>
                  </div>
               </div>
               <div class="col-12 col-sm-6">
                  <label>&nbsp;</label>
                  <button type="button" class="btn ripple btn-info btn-block btn-send-2fa-otp" tabindex="8" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" data-url="<?php echo admin_site_url('profile/crud'); ?>" data-action="send_totp_otp"><?php echo translate('send_OTP'); ?></button>
               </div>
            </div>
            <div class="row">
               <div class="col-12 col-sm-12 text-center">
                  <p>
                     <small class="text-muted"><i><?php echo translate('first_send_OTP_and enter_received_OTP'); ?></i></small>
                     <br/>
                     <small class="text-muted"><i><?php echo translate('contact_your_admin_or_supervisor_for_more_details'); ?></i></small>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="col-12 col-sm-12">
               <div class="form-group">
                  <label><?php echo translate('TOTP'); ?> <span class="text-danger">*</span></label>
                  <input type="number" class="form-control action-fld m-action" id="ototp" name="mtotp" placeholder="<?php echo translate('TOTP'); ?>" tabindex="4" required />
               </div>
            </div>
            <div class="col-12 col-sm-12">
               <div class="form-group">
                  <label><?php echo translate('confirm_TOTP'); ?> <span class="text-danger">*</span></label>
                  <input type="number" class="form-control action-fld m-action" name="confirm_mtotp" placeholder="<?php echo translate('confirm_TOTP'); ?>" tabindex="5" data-parsley-equalto="#mtotp" data-parsley-equalto-message="<?php echo translate('this_value_should_be_the_same_as_TOTP') ?>" required />
               </div>
            </div>
         </div>
      </div>
      <?php if(app_setting('firebase_status','off')=='on'){ ?>
         <div class="row action-dv f-action-dv">
            <div class="col-12 col-sm-6">
               <div class="row">
                  <div class="col-12 col-sm-12">
                     <?php
                        $mode = array (
                           ''  => translate('select'),
                           //'email'  => translate('E-Mail'),
                           'sms'    => translate('SMS'),
                           //'both'   => translate('both_(E-Mail_&_SMS)')
                        );
                     ?>
                     <div class="form-group">
                        <label><?php echo translate('OTP_mode'); ?> <span class="text-danger">*</span></label>
                        <?php echo form_dropdown('mode', $mode, '',array('class'=>'form-control action-fld f-action','required'=>true)); ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="col-12 col-sm-12 text-center">
                  <p>
                     <small class="text-muted"><i><?php echo translate('contact_your_admin_or_supervisor_for_more_details'); ?></i></small>
                  </p>
               </div>
            </div>
         </div>
      <?php } ?>
      <div class="row">
         <div class="col-12"><hr/></div>
         <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary mt-2 mr-1" tabindex="4" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>"><i data-feather='save'></i> <?php echo translate('save'); ?></button>
         </div>
      </div>
   <?php echo form_close(); ?>
</div>