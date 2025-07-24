<div class="modal d-block pos-static">
  <div class="modal-dialog modal-lg" specialization="document">
    <div class="modal-content modal-content-demo shadow">
      <?php echo form_open(admin_site_url('specialization/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$page_action,'id'=>encode_string($id))); ?>
        <div class="modal-header">
          <h6 class="modal-title"><?php echo translate($page_title) ?></h6>
          <button aria-label="Close" class="btn-close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group text-left">
                <label><?php echo translate('name'); ?> <span class="tx-danger">*</span></label>
                <input class="form-control" name="name" placeholder="<?php echo translate('enter_name'); ?>" type="text" tabindex="1" value="<?php echo get_column_value(TBL_SPECIALISATION,array('id'=>$id),'name'); ?>" autocomplete="off" required>
              </div>
            </div>
            <?php 
               $status_list = array (
                 ''   => translate("select"), 
                 '1'  => translate("active"), 
                 '0'  => translate("inactive")
               );
            ?>
            <div class="col-md-4">
              <div class="form-group text-left">
                <label><?php echo translate('status'); ?> <span class="tx-danger">*</span></label>
                <?php echo form_dropdown('is_active', $status_list, get_column_value(TBL_SPECIALISATION,array('id'=>$id),'is_active'),array('class'=>'form-control select2-modal','required'=>true, 'tabindex' => '2','data-parsley-errors-container'=>"#error_status")); ?>
                <span id="error_status"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn ripple btn-submit btn-primary" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" tabindex="3"><?php echo translate('submit'); ?></button>
          <button class="btn ripple close-popup btn-secondary" type="button"><?php echo translate('close'); ?></button>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      init_select2modal();
    });
  </script>
</div>