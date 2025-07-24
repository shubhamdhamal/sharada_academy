<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab)); ?>
   <div class="card custom-card">
      <div class="card-header custom-card-header">
         <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('firebase') ?></h5>
         <div class="card-options">
            <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
         </div>
      </div>
      <div class="card-body">
         <div class="row">
         <div class="col-12 col-sm-2">
            <label><?php echo translate('firebase'); ?> <span class="text-danger">*</span></label>
         </div>
         <?php $firebase_status = app_setting('firebase_status','off'); ?>
         <div class="col-12 col-sm-10">
            <div class="row">
               <div class="col-6 col-sm-3">
                  <label class="rdiobox"><input type="radio" class="action-field" name="firebase_status" data-parsley-errors-container="#error_firebase_status" data-action="o" value="off" <?php echo $firebase_status=='off' ? 'checked' : '' ?> required> <span><?php echo translate('off'); ?></span></label>
               </div>
               <div class="col-6 col-sm-3">
                  <label class="rdiobox"><input type="radio" class="action-field" name="firebase_status" data-parsley-errors-container="#error_firebase_status" data-action="d" value="on" <?php echo $firebase_status=='on' ? 'checked' : '' ?> required> <span><?php echo translate('on'); ?></span></label>
               </div>
               <span id="error_firebase_status"></span>
            </div>
         </div>
      </div>
      <hr/>
      <?php 
         $details = app_setting('firebase_details','[]');
         $details = !empty(json_decode($details)) ? json_decode($details) : array();
      ?>
      <div class="row action-dv o-action-dv">
         <input type="hidden" class="o-action"/>
      </div>
      <div class="row action-dv d-action-dv">
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('API_key'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action" name="firebase[api_key]" placeholder="<?php echo translate('API_key'); ?>" value="<?php echo $firebase_status=='on' && isset($details->api_key) ? $details->api_key : ''; ?>" tabindex="2" required />
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('auth_domain'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action" name="firebase[auth_domain]" placeholder="<?php echo translate('auth_domain'); ?>" value="<?php echo $firebase_status=='on' && isset($details->auth_domain) ? $details->auth_domain : ''; ?>" tabindex="3" required />
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('project_id'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action" name="firebase[project_id]" placeholder="<?php echo translate('project_id'); ?>" value="<?php echo $firebase_status=='on' && isset($details->project_id) ? $details->project_id : ''; ?>" tabindex="4" required />
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('storage_bucket'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action" name="firebase[storage_bucket]" placeholder="<?php echo translate('storage_bucket'); ?>" value="<?php echo $firebase_status=='on' && isset($details->storage_bucket) ? $details->storage_bucket : ''; ?>" tabindex="5" required />
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('messaging_sender_id'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action" name="firebase[messaging_sender_id]" placeholder="<?php echo translate('messaging_sender_id'); ?>" value="<?php echo $firebase_status=='on' && isset($details->messaging_sender_id) ? $details->messaging_sender_id : ''; ?>" tabindex="6" required />
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('app_id'); ?> <span class="text-danger">*</span></label>
               <input type="text" class="form-control action-fld d-action" name="firebase[app_id]" placeholder="<?php echo translate('app_id'); ?>" value="<?php echo $firebase_status=='on' && isset($details->app_id) ? $details->app_id : ''; ?>" tabindex="8" required />
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