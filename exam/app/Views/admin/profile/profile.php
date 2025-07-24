<div class="page-header">
	<div>
		<h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
		</ol>
	</div>
</div>
<div class="row sidemenu-height">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
        <div class="card custom-card">
            <div class="card-body">
                <?php echo form_open(admin_site_url('profile/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>'profile_image')); ?>
                	<div class="row">
	                    <div class="col-12 col-sm-12 text-center">
	                      	<img class="app-image-input img-thumbnail" data-name="profile_image" src="<?php echo user_setting('profile_image'); ?>" style="height:128px;cursor:pointer;" data-bs-toggle="tooltip" data-placement="top" title="<?php echo translate('click_on_the_image_to_change'); ?>"/>
	                      	<p><small class="text-muted"><i><?php echo translate('click_on_the_image_to_change').' '.translate('best_size_is_400px_X_400px'); ?></i></small></p>
	                    </div>
                  	</div>
					<div class="row">
						<div class="col-12 col-sm-12 text-center"><hr/>
							<div class="form-group">
								<button type="submit" class="btn ripple btn-primary btn-block" tabindex="1" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>"><?php echo translate('update'); ?></button>
								<?php if(user_setting('profile_image')!=uploads_url('profile/default.png')){ ?>
								<button type="button" class="btn ripple btn-danger btn-block btn-remove-profile-picture" tabindex="2" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" data-url="<?php echo admin_site_url('profile/crud'); ?>" data-action="remove_profile"><?php echo translate('remove'); ?></button>
								<?php } ?>
							</div>
						</div>
					</div>
                <?php echo form_close(); ?>
			</div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="card custom-card main-content-body-profile">
            <nav class="nav main-nav-line">
                <a class="nav-link active" data-bs-toggle="tab" href="#basic"><?php echo translate('basic_details'); ?></a>
                <a class="nav-link" data-bs-toggle="tab" href="#timezone"><?php echo translate('timezone'); ?></a>
                <?php if(get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'authentication_status','0')=='1'){ ?>
                    <a class="nav-link" data-bs-toggle="tab" href="#disable_authentication"> <?php echo translate('two-Factor_authentication_(2FA)'); ?></a>
                <?php }else{ ?>
                    <a class="nav-link" data-bs-toggle="tab" href="#security"> <?php echo translate('two-Factor_authentication_(2FA)'); ?></a>
                <?php } ?>
            </nav>
            <div class="card-body tab-content h-100">
                <?php echo admin_view($module_name.'/template-basic',array('tab_name'=>'basic','is_tab_active'=>true)); ?>
                <?php echo admin_view($module_name.'/template-timezone',array('tab_name'=>'timezone','is_tab_active'=>false)); ?>
                <?php if(get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'authentication_status','0')=='1'){
                    echo admin_view($module_name.'/template-disable_authentication',array('tab_name'=>'disable_authentication','is_tab_active'=>false));
                }else{
                    echo admin_view($module_name.'/template-security',array('tab_name'=>'security','is_tab_active'=>false));
                } ?>
            </div>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $('body').on('click', '.btn-remove-profile-picture', function (e) {
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
                    $.post(obj.data('url'),{action:obj.data('action')},function(data) {
                        show_notification(data.type,data.message,data.title);
                        if(data.status){
                            if (typeof data.url!= "undefined") {
                                window.location.href = data.url;
                            }
                        }
                    });
                });
              }
            });
        });
    });
</script>