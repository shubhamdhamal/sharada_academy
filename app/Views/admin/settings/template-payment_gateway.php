<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab)); ?>
   <div class="card custom-card">
      <div class="card-header custom-card-header">
         <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('payment_gateway') ?></h5>
         <div class="card-options">
            <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
         </div>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-12 col-sm-3">
               <label><?php echo translate('payment_gateway'); ?> <span class="text-danger">*</span></label>
            </div>
            <?php $payment_gateway_type = app_setting('payment_gateway_status','off'); ?>
            <div class="col-12 col-sm-9">
               <div class="row">
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="payment_gateway_type" data-parsley-errors-container="#error_payment_gateway_status" data-action="o" value="off" <?php echo $payment_gateway_type=='off' ? 'checked' : '' ?> required> <span><?php echo translate('off'); ?></span></label>
                  </div>
                  <div class="col-6 col-sm-3">
                     <label class="rdiobox"><input type="radio" class="action-field" name="payment_gateway_type" data-parsley-errors-container="#error_payment_gateway_status" data-action="rp" value="razorpay" <?php echo $payment_gateway_type=='razorpay' ? 'checked' : '' ?> required> <span><?php echo translate('razorpay'); ?></span></label>
                  </div>
                  <span id="error_payment_gateway_status"></span>
               </div>
            </div>
         </div>
         <hr/>
         <?php 
            $details = app_setting('payment_gateway_details','[]');
            $details = !empty(json_decode($details)) ? json_decode($details) : array();
         ?>
         <div class="row action-dv o-action-dv">
            <input type="hidden" class="o-action"/>
         </div>
         <div class="row action-dv rp-action-dv">
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('key_ID'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld rp-action is_required" name="payment_gateway[key_id]" placeholder="<?php echo translate('key_ID'); ?>" value="<?php echo $payment_gateway_type=='razorpay' && isset($details->key_id) ? $details->key_id : ''; ?>" tabindex="2" required />
               </div>
            </div>
            <div class="col-12 col-sm-6">
               <div class="form-group">
                  <label><?php echo translate('secret'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld rp-action is_required" name="payment_gateway[secret]" placeholder="<?php echo translate('secret'); ?>" tabindex="3" value="<?php echo $payment_gateway_type=='razorpay' && isset($details->secret) ? $details->secret : ''; ?>" required />
               </div>
            </div>
            <div class="col-12 col-sm-8">
               <div class="form-group">
                  <label><?php echo translate('webhook_URL'); ?></label>
                  <div class="input-group">
                     <input class="form-control rounded-start-0" value="<?php echo site_url('autoscript/webhook/razorpay'); ?>" type="text" readonly>
                     <span class="input-group-btn">
                        <button class="btn ripple btn-primary app-copy-btn rounded-start-0" title="<?php echo translate('copy_webhook_URL') ?>" data-clipboard-text="<?php echo site_url('autoscript/webhook/razorpay'); ?>" type="button">
                           <span class="input-group-btn"><i class="fa fa-clipboard"></i></span>
                        </button>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-4">
               <div class="form-group">
                  <label><?php echo translate('webhook_secret'); ?> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control action-fld rp-action" name="payment_gateway[wh_secret]" placeholder="<?php echo translate('webhook_secret'); ?>" value="<?php echo $payment_gateway_type=='razorpay' && isset($details->wh_secret) ? $details->wh_secret : ''; ?>" tabindex="5" required />
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