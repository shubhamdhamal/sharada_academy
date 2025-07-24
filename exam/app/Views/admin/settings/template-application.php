<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$tab)); ?>
   <div class="card custom-card">
      <div class="card-header custom-card-header">
         <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('application') ?></h5>
         <div class="card-options">
            <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
         </div>
      </div>
      <div class="card-body">
         <div class="row">
            <?php 
               $front_page_access_list = array (
                  ''   => translate("select"), 
                  'on'  => translate("allow"), 
                  'off'  => translate("deney")
               );
            ?>
            <div class="col-12 col-sm-6">
               <div class="form-group text-left">
                  <label><?php echo translate('front_page_access'); ?> <span class="tx-danger">*</span></label>
                  <?php echo form_dropdown('front_page_access', $front_page_access_list, app_setting('front_page_access','off'),array('class'=>'form-control select2','required'=>true, 'tabindex' => '2', 'data-parsley-errors-container'=>"#error_front_page_access")); ?>
                  <span id="error_front_page_access"></span>
               </div>
            </div>
            <?php 
               $maintenance_mode_list = array (
                  ''   => translate("select"), 
                  'on'  => translate("on"), 
                  'off'  => translate("off")
               );
            ?>
            <div class="col-12 col-sm-6">
               <div class="form-group text-left">
                  <label><?php echo translate('maintenance_mode'); ?> <span class="tx-danger">*</span></label>
                  <?php echo form_dropdown('app_maintenance_mode', $maintenance_mode_list, app_setting('app_maintenance_mode','off'),array('class'=>'form-control select2','required'=>true, 'tabindex' => '2', 'data-parsley-errors-container'=>"#error_app_maintenance_mode")); ?>
                  <span id="error_app_maintenance_mode"></span>
               </div>
            </div>
            <?php 
               $app_maintenance_mode_details = app_setting('app_maintenance_mode_details','[]');
               $app_maintenance_mode_details = !empty(json_decode($app_maintenance_mode_details)) ? json_decode($app_maintenance_mode_details) : array();
            ?>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('maintenance_mode_mobile'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="app_maintenance_mode_details[mobile_no]" placeholder="<?php echo translate('email_maintenance_mode_mobile_no'); ?>" value="<?php echo isset($app_maintenance_mode_details->mobile_no) ? $app_maintenance_mode_details->mobile_no : '' ?>" tabindex="2" required />
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('maintenance_mode_email'); ?> <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="app_maintenance_mode_details[email_id]" placeholder="<?php echo translate('email_maintenance_mode_email_id'); ?>" value="<?php echo isset($app_maintenance_mode_details->email_id) ? $app_maintenance_mode_details->email_id : '' ?>" tabindex="3" required />
               </div>
            </div>
         </div>
         <hr/>
         <div class="row">
            <div class="col-12 col-sm-2">
               <label><?php echo translate('app_translator'); ?> <span class="text-danger">*</span></label>
            </div>
            <?php $app_translator = app_setting('app_translator','d'); ?>
            <div class="col-12 col-sm-10">
               <div class="row">
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox cursor-pointer"><input type="radio" name="app_translator" data-parsley-errors-container="#error_app_translator" value="d" <?php echo $app_translator=='d' ? 'checked' : '' ?> required> <span><?php echo translate('default'); ?></span></label>
                  </div>
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox cursor-pointer"><input type="radio" name="app_translator" data-parsley-errors-container="#error_app_translator" value="g" <?php echo $app_translator=='g' ? 'checked' : '' ?> required> <span><?php echo translate('google'); ?></span></label>
                  </div>
                  <span id="error_app_translator"></span>
               </div>
            </div>
         </div>
         <hr/>
         <div class="row">
            <?php
               $page_list = array();
               $page_list[0] = translate('no_page');
               if(isset($page) && !empty($page)){ foreach ($page as $key => $value) {
                  $page_list[$value->id] = $value->name;
               } }
            ?>
            <div class="col-12 col-sm-6 text-left">
               <div class="form-group">
                  <label><?php echo translate('terms_and_conditions_page'); ?> <span class="text-danger">*</span></label>
                  <?php echo form_dropdown('terms_and_conditions_page', $page_list, app_setting('terms_and_conditions_page'),array('class'=>'form-control select2','required'=>true, 'data-parsley-errors-container'=>"#error_terms_and_conditions_page")); ?>
                  <span id="error_terms_and_conditions_page"></span>
               </div>
            </div>
            <div class="col-12 col-sm-6 text-left">
               <div class="form-group">
                  <label><?php echo translate('return,_refund_and_cancellation_policy_page'); ?> <span class="text-danger">*</span></label>
                  <?php echo form_dropdown('return_refund_and_cancellation_policy_page', $page_list, app_setting('return_refund_and_cancellation_policy_page'),array('class'=>'form-control select2','required'=>true, 'data-parsley-errors-container'=>"#error_return_refund_and_cancellation_policy_page")); ?>
                  <span id="error_return_refund_and_cancellation_policy_page"></span>
               </div>
            </div>
            <div class="col-12 col-sm-6 text-left">
               <div class="form-group">
                  <label><?php echo translate('privacy_policy_page'); ?> <span class="text-danger">*</span></label>
                  <?php echo form_dropdown('privacy_policy_page', $page_list, app_setting('privacy_policy_page'),array('class'=>'form-control select2','required'=>true, 'data-parsley-errors-container'=>"#error_privacy_policy_page")); ?>
                  <span id="error_privacy_policy_page"></span>
               </div>
            </div>
            <div class="col-12 col-sm-6 text-left">
               <div class="form-group">
                  <label><?php echo translate('disclaimer_page'); ?> <span class="text-danger">*</span></label>
                  <?php echo form_dropdown('disclaimer_page', $page_list, app_setting('disclaimer_page'),array('class'=>'form-control select2','required'=>true, 'data-parsley-errors-container'=>"#error_disclaimer_page")); ?>
                  <span id="error_disclaimer_page"></span>
               </div>
            </div>
         </div>
         <hr/>
         <div class="row">
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('custom_CSS_-_before'); ?> &lt;/head&gt;</label>
                  <textarea class="form-control" name="header_custom_script" rows="5" placeholder="<style>&#10;...&#10;</style>"><?php echo app_setting('header_custom_script') ?></textarea>
                  <small class="text-muted"><i><?php echo translate("write_CSS_with"); ?>&lt;style&gt;<?php echo translate("tag"); ?></i></small>
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('custom_JS_-_before'); ?> &lt;/body&gt;</label>
                  <textarea class="form-control" name="footer_custom_script" rows="5" placeholder="<script>&#10;...&#10;</script>"><?php echo app_setting('footer_custom_script') ?></textarea>
                  <small class="text-muted"><i><?php echo translate("write_script_with"); ?>&lt;script&gt;<?php echo translate("tag"); ?></i></small>
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