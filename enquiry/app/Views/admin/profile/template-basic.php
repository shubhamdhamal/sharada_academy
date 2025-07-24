<div class="tab-pane <?php echo isset($is_tab_active) && $is_tab_active==true ? 'active' : ''; ?>" id="<?php echo $tab_name ?>">
   <?php echo form_open(admin_site_url('profile/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab_name)); ?>
      <div class="row">
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('username'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control" placeholder="<?php echo translate('username'); ?>" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'username'); ?>" readonly disabled/>
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('name'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control" name="name" placeholder="<?php echo translate('name'); ?>" tabindex="1" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'name'); ?>" autofocus required />
            </div>
         </div>
      </div>
      <div class="row">
         <?php /*<div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('mobile_no'); ?> <span class="text-danger">*</span></label><br/>
               <input type="tel" class="form-control mobile_no" name="mobile_no" placeholder="<?php echo translate('mobile_no'); ?>" tabindex="2" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'mobile_no'); ?>" data-parsley-errors-container="#error_mobile_no" required />
               <input type="hidden" name="country_code" id="country_code" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'country_code'); ?>" required />
               <span id="error_mobile_no"></span>
            </div>
         </div>*/ ?>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('mobile_no'); ?> <span class="text-danger">*</span></label><br/>
               <input type="tel" class="form-control mobile_no" name="mobile_no" placeholder="<?php echo translate('mobile_no'); ?>" tabindex="2" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'mobile_no'); ?>" data-parsley-errors-container="#error_mobile_no" required />
               <input type="hidden" name="country_code" id="country_code" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'country_code'); ?>" required />
               <span id="error_mobile_no"></span>
            </div>
         </div>

         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('email_id'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control" name="email_id" placeholder="<?php echo translate('email_id'); ?>" tabindex="3" value="<?php echo get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'email_id'); ?>" required />
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12"><hr/></div>
         <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary mt-2 mr-1" tabindex="4" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>"><i data-feather='save'></i> <?php echo translate('save'); ?></button>
         </div>
      </div>
   <?php echo form_close(); ?>
   <script type="text/javascript">
      var input = document.querySelector(".mobile_no");
      <?php if(get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'country_code')!=''){ ?>
         var iti = window.intlTelInput(input, {
            initialCountry: "IN",
            separateDialCode: true,
            nationalMode: true,
            setCountry: 'iso2',
            utilsScript: "<?php echo admin_js_url('plugins/intl-tel-input/js/utils.js'); ?>",
         });
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
      input.addEventListener("countrychange", function() {
         $("#country_code").val(iti.getSelectedCountryData().dialCode);
      });
      window.ParsleyValidator.addValidator('mnvalidator',function (value, requirement) {
          return iti.isValidNumber();
      }, 3);
   </script>
</div>