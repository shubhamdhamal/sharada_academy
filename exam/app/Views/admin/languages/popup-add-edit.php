<div class="modal d-block pos-static">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <?php echo form_open(admin_site_url('languages/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$page_action,'id'=>encode_string($id))); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title"><?php echo translate($page_title) ?></h6>
          <button aria-label="Close" class="btn-close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="row">
               <div class="col-12 col-sm-12">
                    <div class="form-group">
                       <label><?php echo translate('name'); ?> <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" name="name" placeholder="<?php echo translate('name'); ?>" tabindex="1" value="<?php echo get_column_value(TBL_LANGUAGE,array('id'=>$id),'name'); ?>" autofocus required />
                    </div>
                 </div>
                 <div class="col-12 col-sm-12">
                    <div class="form-group">
                       <label><?php echo translate('slug'); ?> <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" data-parsley-type="alphanum" name="slug" placeholder="<?php echo translate('slug'); ?>" tabindex="2" value="<?php echo get_column_value(TBL_LANGUAGE,array('id'=>$id),'slug'); ?>" required />
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
                       <?php echo form_dropdown('is_active', $status_list, get_column_value(TBL_LANGUAGE,array('id'=>$id),'is_active'),array('class'=>'form-control select2-modal','required'=>true, 'tabindex' => '6', 'data-parsley-errors-container'=>'#error_status')); ?>
                       <span id="error_status"></span>
                    </div>
                 </div>
              </div>
            </div>      
            <div class="col-12 col-sm-6">
              <div class="row">
                <div class="col-12 col-sm-12 text-center"><br/><br/><br/>
                  <?php $flag = get_column_value(TBL_LANGUAGE,array('id'=>$id),'flag'); ?>
                  <?php $flag = $flag!='' ? app_file_exists($flag,uploads_url('default.png')) : uploads_url('default.png'); ?>
                  <img class="app-image-input img-thumbnail" data-name="flag" data-show-delete="true" src="<?php echo $flag; ?>" style="height: 64px;width: 64px;"/>
                  <p><small class="text-muted"><i><?php echo translate('click_on_the_image_to_change').'<br/>'.translate('best_size_is_64px_X_64px'); ?></i></small></p>
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
  </script>
</div>