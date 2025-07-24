<div class="tab-pane <?php echo isset($is_tab_active) && $is_tab_active==true ? 'active' : ''; ?>" id="<?php echo $tab_name ?>">
   <?php echo form_open(admin_site_url('profile/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab_name)); ?>
      <div class="row">
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('password'); ?> <span class="text-danger">*</span></label>
               <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo translate('password'); ?>" tabindex="1" required />
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
               <label><?php echo translate('confirm_password'); ?> <span class="text-danger">*</span></label>
               <input type="password" class="form-control" name="confirm_password" placeholder="<?php echo translate('confirm_password'); ?>" tabindex="2" data-parsley-equalto="#password" data-parsley-equalto-message="<?php echo translate('this_value_should_be_the_same_as_password') ?>" required />
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
</div>