<div class="modal d-block pos-static">
   <div class="modal-dialog modal-dialog-scrollable" role="document">
      <?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$page_action,'id'=>$id)); ?>
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"><?php echo translate($page_title) ?></h5>
               <button aria-label="Close" class="btn-close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-12 col-sm-12">
                     <div class="form-group">
                        <label><?php echo translate('plugin_file'); ?> <span class="text-danger">*</span></label>
                        <input type="file" class="form-control example-file-input-custom" name="plugin_file" placeholder="<?php echo translate('plugin_file'); ?>" tabindex="1" autofocus required />
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary mr-1" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" tabindex="4"><i data-feather='save'></i> <?php echo translate('upload'); ?></button>
               <button type="button" class="btn btn-secondary close-popup" tabindex="5"><?php echo translate('cancel'); ?></button>
            </div>
         </div>
      <?php echo form_close(); ?>
   </div>
</div>