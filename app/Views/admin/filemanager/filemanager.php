<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
        </ol>
    </div>
    <div class="btn btn-list"></div>
</div>
<div class="row sidemenu-height">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card custom-card">
            <div class="card-body">
                <iframe src="<?php echo base_url('filemanager/dialog.php?akey='.get_filemanager_key(user_setting('admin_id'))); ?>" title="<?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?>" style="width: 100%;height: 400px;"></iframe>

            </div>
        </div>
    </div>
</div>