<?php $license = get_license_info(); ?>
<?php if(isset($license->status) && !$license->status){ ?>
    <?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab)); ?>
        <div class="card custom-card">
            <div class="card-header custom-card-header">
                <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('license') ?></h5>
                <div class="card-options">
                    <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                           <label><?php echo translate('license_key'); ?> <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="license_key" placeholder="<?php echo translate('license_key'); ?>" tabindex="1" required/>
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
<?php }else{ ?>
    <div class="card custom-card">
        <div class="card-header custom-card-header">
            <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('license_information') ?></h5>
            <div class="card-options">
                <button class="btn btn-danger btn-license btn-sm" data-url="<?php echo admin_site_url('settings/crud'); ?>" data-action="remove_license"><i class='fa fa-trash'></i> <?php echo translate('remove_license'); ?></button>
                <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover mg-b-0">
                            <tbody>
                                <tr>
                                    <th><?php echo translate('status'); ?></th>
                                    <td><?php echo isset($license->status) && $license->status ? translate('active') : translate('in_active'); ?></td>
                                </tr>
                                <tr>
                                    <th><?php echo translate('key'); ?></th>
                                    <td><?php echo isset($license->key) && $license->key!='' ? $license->key : ''; ?></td>
                                </tr>
                                <tr>
                                    <th><?php echo translate('message'); ?></th>
                                    <td><?php echo isset($license->message) && $license->message!='' ? $license->message : ''; ?></td>
                                </tr>
                                <tr>
                                    <th><?php echo translate('expire_on'); ?></th>
                                    <td><?php echo isset($license->expire_on) && $license->expire_on!='' ? $license->expire_on : ''; ?></td>
                                </tr>
                                <tr>
                                    <th><?php echo translate('host'); ?></th>
                                    <td><?php echo isset($license->host) && $license->host!='' ? $license->host : ''; ?></td>
                                </tr>
                                <tr>
                                    <th><?php echo translate('support'); ?></th>
                                    <td><?php echo isset($license->support) && $license->support!='' ? $license->support : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $( document ).ready(function() {
            $('body').on('click', '.btn-license', function (e) {
                var obj = $(this);
                swal({
                    title: "<?php echo translate('are_you_sure_?') ?>",
                    text: "<?php echo translate('you_will_not_be_able_to_revert_this!') ?>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    showLoaderOnConfirm: true,
                    confirmButtonText: "<?php echo translate('yes,_remove_it!') ?>",
                    cancelButtonText: "<?php echo translate('no,_cancel_it!') ?>",
                    closeOnConfirm: false
                },
                function(isConfirm) {
                  if (isConfirm) {
                    $.post(obj.data('url'),{action:obj.data('action')},function(data) {
                        swal.close();
                        show_notification(data.type,data.message,data.title);
                        if (typeof data.url!= "undefined") {
                            window.location.href = data.url;
                        }
                    });
                  }
                });
            });
        });
    </script>
<?php } ?>