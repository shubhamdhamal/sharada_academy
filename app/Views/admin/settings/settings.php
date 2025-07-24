<?php
    $permissions = user_setting('permissions');
    $tabs = array();

    $temp = array();
    $temp['name'] = translate('basic');
    $temp['icon'] = 'fe fe-settings';
    $temp['text'] = 'primary';
    $tabs['basic'] = $temp;

    $temp = array();
    $temp['name'] = translate('pop_up');
    $temp['icon'] = 'fe fe-image';
    $temp['text'] = 'secondary';
    $tabs['pop_up'] = $temp;

    $temp = array();
    $temp['name'] = translate('captcha');
    $temp['icon'] = 'fe fe-target';
    $temp['text'] = 'secondary';
    $tabs['captcha'] = $temp;

    $temp = array();
    $temp['name'] = translate('theme');
    $temp['icon'] = 'fa fa-paint-brush';
    $temp['text'] = 'success';
    $tabs['theme'] = $temp;

    $temp = array();
    $temp['name'] = translate('PWA');
    $temp['icon'] = 'fa fa-mobile';
    $temp['text'] = 'warning';
    $tabs['pwa'] = $temp;

    $temp = array();
    $temp['name'] = translate('application');
    $temp['icon'] = 'fa fa-desktop';
    $temp['text'] = 'info';
    $tabs['application'] = $temp;
    
    $temp = array();
    $temp['name'] = translate('e_-Mail');
    $temp['icon'] = 'fe fe-mail';
    $temp['text'] = 'pink';
    $tabs['email'] = $temp;

    $temp = array();
    $temp['name'] = translate('firebase');
    $temp['icon'] = 'fe fe-user';
    $temp['text'] = 'green';
    $tabs['firebase'] = $temp;

    $temp = array();
    $temp['name'] = translate('payment_gateway');
    $temp['icon'] = 'fe fe-credit-card';
    $temp['text'] = 'danger';
    $tabs['payment_gateway'] = $temp;

    $temp = array();
    $temp['name'] = translate('SEO');
    $temp['icon'] = 'fe fe-battery-charging';
    $temp['text'] = 'success';
    $tabs['seo'] = $temp;

    $temp = array();
    $temp['name'] = translate('license');
    $temp['icon'] = 'fa fa-key';
    $temp['text'] = 'yellow';
    $tabs['license'] = $temp;

    $temp = array();
    $temp['name'] = translate('updates');
    $temp['icon'] = 'fe fe-refresh-ccw';
    $temp['text'] = 'info';
    $tabs['updates'] = $temp;
?>
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard') ?>"><?php echo translate('dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo admin_site_url('settings') ?>"><?php echo translate('settings') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $tabs[$tab]['name'] ?></li>
        </ol>
    </div>
</div>
<div class="row ">
    <div class="col-lg-6 col-xl-3">
        <div class="card custom-card">
            <div class="card-body">
                <div class="list-group list-group-transparent mb-0 file-manager file-manager-border">
                    <h4><?php echo translate('settings') ?></h4>
                    <?php foreach ($tabs as $key => $value) { if(empty($permissions) || (isset($permissions['settings'][$key]) || isset($permissions['settings'][strtoupper($key)]) || isset($permissions['settings'][strtolower($key)]))){ $active = $tab==strtolower($key) ? 'active' : ''; ?>
                        <div class="settings-tab <?php echo $active ?>">
                            <a href="<?php  echo admin_site_url('settings').'?tab='.$key ?>"
                                class="list-group-item  d-flex align-items-center px-0 border-top">
                                <i class="<?php echo $value['icon'] ?> fs-18 me-2 text-<?php echo $value['text'] ?> p-2"></i><?php echo $value['name'] ?>
                            </a>
                        </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-9">
        <div class="row row-sm">
            <?php if(array_key_exists(strtolower($tab), $tabs) && (empty($permissions) || (isset($permissions['settings'][$tab]) || isset($permissions['settings'][strtoupper($tab)]) || isset($permissions['settings'][strtolower($tab)])))){
                echo admin_view($module_name.'/template-'.strtolower($tab),$page_data);
            }else{ ?>
                <div class="alert alert-danger mg-b-0" role="alert">
                    <strong><?php echo translate("ops._the_page_you_are_looking_for_doesn't_exit..."); ?></strong>
                    <br/><?php echo translate('you_may_have_mistyped_the_address_or_the_page_may_have_moved.'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>