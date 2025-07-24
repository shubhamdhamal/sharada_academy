<div class="modal d-block pos-static">
  <div class="modal-dialog modal-dialog-scrollable2 modal-lg" role="document">
    <?php echo form_open(admin_site_url('faculty/crud'), array('class' => 'data-parsley-validate', 'method' => 'post', 'data-block_form' => 'true'), array('action' => $page_action, 'id' => encode_string($id))); ?>
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><?php echo translate($page_title) ?></h6>
        <button aria-label="Close" class="btn-close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo app_file_manager('image', 'image', 1, get_column_value(TBL_FACULTY, array('id' => $id), 'image', 'default.png')); ?>
            </div>
          </div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label><?php echo translate('name'); ?> <span class="tx-danger">*</span></label>
                  <input class="form-control" name="name" placeholder="<?php echo translate('enter_name'); ?>" type="text" tabindex="1" value="<?php echo get_column_value(TBL_FACULTY, array('id' => $id), 'name'); ?>" required>
                </div>
              </div>
              <?php
              $faculty_list = array(
                ''   => translate("select"),
                '1'  => translate("active"),
                '0'  => translate("inactive")
              );
              ?>
              <div class="col-md-4">
                <div class="form-group">
                  <label><?php echo translate('status'); ?> <span class="tx-danger">*</span></label>
                  <?php echo form_dropdown('is_active', $faculty_list, get_column_value(TBL_FACULTY, array('id' => $id), 'is_active'), array('class' => 'form-control select2-modal', 'required' => true, 'tabindex' => '2', 'data-parsley-errors-container' => '#error_status')); ?>
                  <span id="error_status"></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label><?php echo translate('position'); ?> <span class="tx-danger">*</span></label>
                  <input class="form-control" name="position" placeholder="<?php echo translate('enter_position'); ?>" type="text" tabindex="2" value="<?php echo get_column_value(TBL_FACULTY, array('id' => $id), 'position'); ?>" required>
                </div>
              </div>
              <?php
              $details = get_column_value(TBL_FACULTY, array('id' => $id), 'details', '[]');
              $details = json_decode($details);
              ?>
              <div class="col-md-12">
                <?php
                $specialisation_list = array();
                if (isset($specialisation) && !empty($specialisation)) {
                  foreach ($specialisation as $key => $value) {
                    $specialisation_list[$value->id] = $value->name;
                  }
                }
                ?>
                <div class="form-group">
                  <label><?php echo translate('specialization'); ?></label>
                  <?php echo form_dropdown('specialisation[]', $specialisation_list, json_decode(get_column_value(TBL_FACULTY, array('id' => $id), 'specialisation', '[]')), array('class' => 'form-control select2-modal', 'multiple' => true, 'tabindex' => '3', 'data-parsley-errors-container' => '#error_specialistion', 'style' => 'width:100%;')); ?>
                  <span id="error_specialistion"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label><?php echo translate('SEO_description'); ?></label>
              <textarea class="form-control" name="seo_description" placeholder="<?php echo translate('SEO_description'); ?>" tabindex="5"><?php echo get_column_value(TBL_FACULTY, array('id' => $id), 'seo_description'); ?></textarea>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label><?php echo translate('SEO_keywords'); ?></label>
              <input type="text" data-role="tagsinput" class="form-control" name="seo_keywords" placeholder="<?php echo translate('SEO_keywords'); ?>" value="<?php echo get_column_value(TBL_FACULTY, array('id' => $id), 'seo_keywords'); ?>" tabindex="6" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label><?php echo translate('short_description'); ?></label>
              <textarea class="form-control" name="short_description" placeholder="<?php echo translate('enter_short_description'); ?>" type="text" tabindex="5"><?php echo get_column_value(TBL_FACULTY, array('id' => $id), 'short_description'); ?></textarea>
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
    function responsive_filemanager_callback(field_id) {
      var url = $('#' + field_id).val();
      $('#img_' + field_id).attr('src', url);
    }
    $(document).ready(function() {
      init_select2modal();
    });
  </script>
</div>