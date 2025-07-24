<div class="modal d-block pos-static">
  <div class="modal-dialog modal-dialog-scrollable2 modal-lg" role="document">
    <?php echo form_open(admin_site_url('slider/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$page_action,'id'=>encode_string($id))); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title"><?php echo translate($page_title) ?></h6>
          <button aria-label="Close" class="btn-close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <?php echo app_file_manager('image','image',1,get_column_value(TBL_SLIDER,array('id'=>$id),'image','default.png')); ?>
              </div>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label><?php echo translate('name'); ?> <span class="tx-danger">*</span></label>
                    <input class="form-control" name="name" placeholder="<?php echo translate('enter_name'); ?>" type="text" tabindex="1" value="<?php echo get_column_value(TBL_SLIDER,array('id'=>$id),'name'); ?>" required>
                  </div>
                </div>
                <?php 
                   $slider_list = array (
                     ''   => translate("select"), 
                     '1'  => translate("active"), 
                     '0'  => translate("inactive")
                   );
                ?>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo translate('status'); ?> <span class="tx-danger">*</span></label>
                    <?php echo form_dropdown('is_active', $slider_list, get_column_value(TBL_SLIDER,array('id'=>$id),'is_active'),array('class'=>'form-control select2-modal','required'=>true, 'tabindex' => '2', 'data-parsley-errors-container'=>'#error_status')); ?>
                    <span id="error_status"></span>
                  </div>
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
  <script>
    function responsive_filemanager_callback(field_id){
      var url = $('#'+field_id).val();
      $('#img_'+field_id).attr('src', url);
    }
    $(document).ready(function () {
      init_select2modal();
    });
  </script>
</div>