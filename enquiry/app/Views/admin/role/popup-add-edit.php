<?php $permissions_array = isset($id) && !empty(json_decode(get_column_value(TBL_ROLE, array('id' => $id), 'permissions'))) ? json_decode(get_column_value(TBL_ROLE, array('id' => $id), 'permissions'), true) : array(); ?>
<div class="modal d-block pos-static">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <?php echo form_open(admin_site_url('role/crud'), array('class' => 'data-parsley-validate', 'method' => 'post', 'data-block_form' => 'true'), array('action' => $page_action, 'id' => encode_string($id))); ?>
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><?php echo translate($page_title) ?></h6>
        <button aria-label="Close" class="btn-close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-<?php echo $id != 1 ? '8' : '12' ?>">
            <div class="form-group text-left">
              <label><?php echo translate('name'); ?> <span class="tx-danger">*</span></label>
              <input class="form-control txt-submit" name="name" placeholder="<?php echo translate('enter_name'); ?>" type="text" tabindex="1" value="<?php echo get_column_value(TBL_ROLE, array('id' => $id), 'name'); ?>" required>
            </div>
          </div>
          <?php if ($id != 1) { ?>
            <?php
            $status_list = array(
              ''   => translate("select"),
              '1'  => translate("active"),
              '0'  => translate("inactive")
            );
            ?>
            <div class="col-md-4">
              <div class="form-group text-left">
                <label><?php echo translate('status'); ?> <span class="tx-danger">*</span></label>
                <?php echo form_dropdown('is_active', $status_list, get_column_value(TBL_ROLE, array('id' => $id), 'is_active'), array('class' => 'form-control select2-modal', 'required' => true, 'tabindex' => '2', 'data-parsley-errors-container' => "#error_status")); ?>
                <span id="error_status"></span>
              </div>
            </div>
          <?php } else { ?>
            <input type="hidden" name="is_active" value="1">
          <?php } ?>
        </div>
        <?php

        $role_data = array();
        $role_data['slider'] = array('list', 'add', 'edit');
        $role_data['blog'] = array('list', 'add', 'edit');
        $role_data['category'] = array('list', 'add', 'edit');
        $role_data['course'] = array('list', 'add', 'edit');
        $role_data['announcements'] = array('list', 'add', 'edit');
        $role_data['faculty'] = array('list', 'add', 'edit');
        $role_data['specialization'] = array('list', 'add', 'edit');
        $role_data['testimonial'] = array('list', 'add', 'edit');
        $role_data['gallery'] = array('list', 'add', 'edit');
        $role_data['pages'] = array('list', 'add', 'edit');
        $role_data['role'] = array('list', 'add', 'edit');
        $role_data['filemanager'] = array('filemanager');
        $role_data['user'] = array('list', 'add', 'edit', 'password', '2FA');
        $role_data['languages'] = array('list', 'add', 'edit', 'delete', 'translation', 'update_translation');
        $role_data['settings'] = array('basic', 'captcha', 'theme', 'PWA', 'application', 'email', 'firebase', 'payment_gateway', 'SEO', 'license', 'updates');
        ?>
        <div class="row">
          <?php foreach ($role_data as $role => $actions) {
            $rname = $role;
            $role = strtolower($role);
            if (isset($permissions[$role]) || empty($permissions)) { ?>
              <div class="col-md-4">
                <div class="card custom-card">
                  <div class="card-header tx-medium tx-white bg-primary"><?php echo translate($rname); ?></div>
                  <div class="card-body">
                    <div class="row">
                      <?php foreach ($actions as $action) {
                        if (isset($permissions[$role][$action]) || empty($permissions)) { ?>
                          <div class="col-md-6">
                            <div class="custom-control custom-checkbox mr-2">
                              <input type="checkbox" class="custom-control-input" id="<?php echo $role ?>_<?php echo $action ?>" name="permissions[<?php echo $role ?>][<?php echo $action ?>]" <?php echo isset($permissions_array[$role][$action]) ? 'checked' : ''; ?> />
                              <label class="custom-control-label" for="<?php echo $role ?>_<?php echo $action ?>"><?php echo translate($action); ?></label>
                            </div>
                          </div>
                      <?php }
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
          <?php }
          } ?>
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
    $(document).ready(function() {
      init_select2modal();
    });
  </script>
</div>