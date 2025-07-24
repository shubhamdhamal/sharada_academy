<div class="page-header">
	<div>
		<h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
			<li class="breadcrumb-item"><a href="<?php echo admin_site_url('gallery'); ?>"><?php echo translate('gallery'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
		</ol>
	</div>
    <div class="btn btn-list">
    <a class="btn ripple btn-primary" href="<?php echo admin_site_url('gallery'); ?>"><i class="fe fe-list ml-2"></i> <?php echo translate('list') ?></a>
    </div>
</div>
<div class="row sidemenu-height">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card custom-card">
            <div class="card-body">
                <?php echo form_open(admin_site_url('gallery/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true','enctype'=>'multipart/form-data','data-multipart'=>'true'), array('action'=>$page_action)); ?>
                    <div class="row">
                        <div class="col-12 col-sm-12 text-center">
                            <ul class="list-group sortable">
                                <?php if(isset($gallery) && !empty($gallery)){ foreach ($gallery as $key => $value) { ?>
                                    <li class="list-group-item d-flex align-items-center draggable">
                                        <a data-fancybox="order" data-src="<?php echo uploads_url($value->image) ?>" data-caption="<?php echo $value->name ?>">
                                            <img alt="<?php echo $value->name ?>" class="wd-40 radius mg-e-15 cursor-pointer image-delay" src="<?php echo uploads_url('loader.gif') ?>" data-src="<?php echo uploads_url($value->image) ?>">
                                        </a>
                                        <div>
                                            <h6 class="tx-13 tx-inverse tx-semibold mg-b-0"><?php echo $value->name ?></h6>
                                            <span class="d-block tx-11 text-muted"><?php echo $value->short_description ?></span>
                                            <input type="hidden" name="order[]" value="<?php echo encode_string($value->id); ?>">
                                        </div>
                                    </li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12 col-sm-12 text-center">
                            <button type="submit" class="btn ripple btn-submit btn-primary" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>" tabindex="7"><?php echo translate('submit'); ?></button>
                            <a class="btn ripple btn-secondary" href="<?php echo admin_site_url('gallery') ?>"><?php echo translate('close'); ?></a>
                        </div>
                    </div>
                <?php echo form_close(); ?>
			</div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".sortable").sortable({
            connectWith: '.data-draggable',
            items: '.draggable',
            revert: true,
            placeholder: 'data-draggable-placeholder',
            forcePlaceholderSize: true,
            opacity: 0.77,
            cursor: 'move'
        });
    });
</script>