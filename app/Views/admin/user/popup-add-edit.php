<div class="modal d-block pos-static">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
   <?php echo form_open(admin_site_url('user/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$page_action,'id'=>encode_string($id))); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title"><?php echo translate($page_title) ?></h6>
          <button aria-label="Close" class="btn-close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-sm-4">
              <div class="row">
                 <div class="col-12 col-sm-12">
                    <div class="form-group">
                       <label><?php echo translate('username'); ?> <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" data-parsley-type="alphanum" name="username" placeholder="<?php echo translate('username'); ?>" tabindex="1" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>$id),'username'); ?>" autofocus required />
                    </div>
                 </div>
                 <div class="col-12 col-sm-12">
                    <div class="form-group">
                       <label><?php echo translate('name'); ?> <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" name="name" placeholder="<?php echo translate('name'); ?>" tabindex="2" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>$id),'name'); ?>" required />
                    </div>
                 </div>
                 <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label><?php echo translate('mobile_no'); ?> <span class="text-danger">*</span></label><br/>
                        <input type="tel" class="form-control mobile_no" name="mobile_no" pattern="^[6-9]\d{9}$" data-parsley-pattern-message="<?php echo translate('enter_valid_mobile_number'); ?>" placeholder="<?php echo translate('mobile_no'); ?>" tabindex="2" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>$id),'mobile_no'); ?>" data-parsley-errors-container="#error_mobile_no" required />
                        <input type="hidden" name="country_code" id="country_code" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>$id),'country_code','91'); ?>" required />
                        <span id="error_mobile_no"></span>
                     </div>
                 </div>
              </div>
            </div>
            <div class="col-12 col-sm-4">
              <div class="row">
                 <div class="col-12 col-sm-12">
                    <div class="form-group">
                       <label><?php echo translate('e_-Mail_address'); ?> <span class="text-danger">*</span></label>
                       <input type="email" class="form-control" name="email_id" placeholder="<?php echo translate('e_-Mail_address'); ?>" tabindex="4" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>$id),'email_id'); ?>" autofocus required />
                    </div>
                 </div>
                 <?php 
                     $rlist = array();
                     $rlist[''] = translate('select');
                     if(isset($role_list) && !empty($role_list)){
                        foreach ($role_list as $key => $value) {
                           $rlist[$value->id] = $value->name;
                        }
                     }
                 ?>
                 <div class="col-12 col-sm-12">
                    <div class="form-group">
                       <label><?php echo translate('role'); ?> <span class="text-danger">*</span></label>
                       <?php echo form_dropdown('role_id', $rlist, get_column_value(TBL_ADMIN,array('id'=>$id),'role_id'),array('class'=>'form-control select2-modal','required'=>true, 'tabindex' => '5', 'data-parsley-errors-container'=>"#error_role_id")); ?>
                       <span id="error_role_id"></span>
                    </div>
                 </div>
                  <?php 
                    $status_list = array (
                      ''   => translate("select"), 
                      '1'  => translate("active"), 
                      '0'  => translate("inactive")
                    );
                  ?>
                 <div class="col-12 col-sm-12">
                    <div class="form-group">
                       <label><?php echo translate('status'); ?> <span class="text-danger">*</span></label>
                       <?php echo form_dropdown('is_active', $status_list, get_column_value(TBL_ADMIN,array('id'=>$id),'is_active'),array('class'=>'form-control select2-modal','required'=>true, 'tabindex' => '6', 'data-parsley-errors-container'=>"#error_status")); ?>
                       <span id="error_status"></span>
                    </div>
                 </div>
              </div>
            </div>
            <div class="col-12 col-sm-4">
              <div class="row">
                <div class="col-12 col-sm-12 text-center">
                  <?php $profile_image = get_column_value(TBL_ADMIN,array('id'=>$id),'profile_image'); ?>
                  <?php $profile_image = $profile_image!='' ? uploads_url('profile/default.png') : $profile_image; ?>
                  <img class="app-image-input img-thumbnail" data-name="user_profile" data-show-delete="true" src="<?php echo app_file_exists($profile_image,uploads_url('profile/default.png')); ?>" style="height: 230px;width: 230px;"/>
                  <p><small class="text-muted"><i><?php echo translate('click_on_the_image_to_change').'<br/>'.translate('best_size_is_400px_X_400px'); ?></i></small></p>
                </div>
              </div>
            </div>
          </div>          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn ripple btn-submit btn-primary" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" tabindex="7"><?php echo translate('submit'); ?></button>
          <button class="btn ripple close-popup btn-secondary" type="button"><?php echo translate('close'); ?></button>
        </div>
      </div>
   <?php echo form_close(); ?>
  </div>
  <script type="text/javascript">
      $(document).ready(function () {
         init_select2modal();
      });
      var input = document.querySelector(".mobile_no");
      <?php if(get_column_value(TBL_ADMIN,array('id'=>$id),'country_code')!=''){ ?>
         var iti = window.intlTelInput(input, {
            initialCountry: "IN",
            separateDialCode: true,
            nationalMode: true,
            setCountry: 'iso2',
            utilsScript: "<?php echo admin_js_url('plugins/intl-tel-input/js/utils.js'); ?>",
         });
         $("#country_code").val(<?php echo get_column_value(TBL_ADMIN,array('id'=>$id),'country_code') ?>);
      <?php }else{ ?>
         var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            nationalMode: true,
            geoIpLookup: function(success, failure) {
               $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                  var countryCode = (resp && resp.country) ? resp.country : "in";
                  success(countryCode);
               });
            },
            utilsScript: "<?php echo admin_js_url('plugins/intl-tel-input/js/utils.js'); ?>",
         });
      <?php } ?>
      $(".mobile_no").val(input.value.replace(/\s/g, ""));
      input.addEventListener("countrychange", function() {
         $("#country_code").val(iti.getSelectedCountryData().dialCode);
      });
      window.ParsleyValidator.addValidator('mnvalidator',function (value, requirement) {
         return iti.isValidNumber();
      }, 3);
   </script>
</div>