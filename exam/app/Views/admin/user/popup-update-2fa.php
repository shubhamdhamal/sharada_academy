<div class="modal d-block pos-static">
    <div class="modal-dialog" user="document">
        <div class="modal-content modal-content-demo shadow">
            <?php echo form_open(admin_site_url('user/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$page_action,'id'=>encode_string($id))); ?>
            <div class="modal-header">
                <h6 class="modal-title"><?php echo translate($page_title) ?></h6><button class="close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                   <div class="col-12 col-sm-12">
                        <div class="form-group">
                           <label><?php echo translate('admin_password'); ?> <span class="text-danger">*</span></label>
                           <input type="password" class="form-control form-control-merge" id="admin_password" name="admin_password" tabindex="3" placeholder="<?php echo translate('admin_password'); ?>" required />
                        </div>
                        <p><small class="text-muted"><i><?php echo translate('enter_your_password_to_confirm_your_identity_for_password_reset'); ?></i></small></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn ripple btn-submit btn-primary" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" tabindex="7"><?php echo translate('submit'); ?></button>
                <button class="btn ripple close-popup btn-secondary" type="button"><?php echo translate('close'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>