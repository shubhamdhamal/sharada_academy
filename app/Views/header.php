<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <?php if (app_setting('seo_author') != '') { ?>
        <meta name="author" content="<?php echo app_setting('seo_author'); ?>">
    <?php } ?>
    <?php if (app_setting('seo_visit_after') != '') { ?>
        <meta name="revisit-after" content="<?php echo app_setting('seo_visit_after'); ?> days">
    <?php } ?>
    <?php if (app_setting('seo_description') != '') { ?>
        <meta name="description" content="<?php echo app_setting('seo_description'); ?>">
    <?php } ?>
    <?php if (app_setting('seo_keywords') != '') { ?>
        <meta name="keywords" content="<?php echo $this->seo_keywords; ?>">
    <?php } ?>
    <title><?php echo isset($page_title) && $page_title != '' ? translate($page_title) . ' - ' : '' ?><?php echo app_setting('app_title'); ?><?php echo app_setting('seo_title') != '' ? ' | ' . app_setting('seo_title') : ''; ?><?php echo app_setting('seo_title') != '' ? ' | ' . app_setting('seo_title') : ''; ?></title>
    <?php if (app_setting('app_pwa_status') == 'on') { ?>
        <link rel="manifest" href="<?php echo home_site_url('manifest.json') ?>">
        </link>
        <meta name="theme-color" content="<?php echo app_setting('app_color'); ?>">
        <script type="text/javascript">
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('<?php echo home_site_url("service-worker.js") ?>', {
                    scope: '/'
                }).then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
            }
        </script>
    <?php } ?>
    <script>
        var api_url = '<?php echo home_site_url('api/web'); ?>';
    </script>
    <link rel="icon" href="<?php echo uploads_url('favicon.png'); ?>" type="image/x-icon">
    <style>
        :root {
            --primary-color: <?php echo app_setting('app_color'); ?>;
            --primary-color-rgb: <?php echo app_setting('app_color_rgb'); ?>;
            --secondary-color: <?php echo app_setting('app_color_secondary'); ?>;
            --secondary-color-rgb: <?php echo app_setting('app_secondary_color_rgb'); ?>;
        }
    </style>

    <?php
    $css_files = array(
        "css/bootstrap.min.css",
        "css/jquery-ui.min.css",
        "css/animate.css",
        "css/css-plugin-collections.css",
        "css/menuzord-megamenu.css",
        "css/menuzord-skins/menuzord-rounded-boxed.css",
        "css/style-main.css",
        "css/preloader.css",
        "css/custom-bootstrap-margin-padding.css",
        "css/responsive.css",
        "css/style.css",
        "js/revolution-slider/css/settings.css",
        "js/revolution-slider/css/layers.css",
        "js/revolution-slider/css/navigation.css",
        "css/colors/theme-skin-color-set1.css"
    );
    load_home_css($css_files);
    ?>
    <?php
    $js_files = array(
        "js/jquery-2.2.4.min.js",
        "js/jquery-ui.min.js",
        "js/bootstrap.min.js",
        "js/parsley.js",
        "js/jquery-plugin-collection.js",
        "js/revolution-slider/js/jquery.themepunch.tools.min.js",
        "js/revolution-slider/js/jquery.themepunch.revolution.min.js"
    );
    load_home_js($js_files);
    ?>
</head>

<body class="">
    <div id="wrapper" class="clearfix">
        <div id="preloader">
            <div id="spinner">
                <img alt="" src="<?php echo home_assets_url('images/preloaders/5.gif'); ?>">
            </div>
            <?php /*<div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>*/ ?>
        </div>
        <?php if (isset($is_inquiry) && $is_inquiry != '') { ?>
            <header id="header" class="header"></header>
        <?php } else { ?>
            <header id="header" class="header">
                <div class="header-nav">
                    <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
                        <div class="container">
                            <div class="col-lg-12">
                                <div class="col-12 col-xs-3 col-sm-12 col-md-2">
                                    <a class="menuzord-brand pull-left flip pt-5 mt-sm-15 mb-sm-20" href="<?php echo home_site_url(); ?>"><img class="img-responsive" src="<?php echo uploads_url('logo.png'); ?>" alt="<?php echo app_setting('app_title') ?>"></a>
                                </div>
                                <div class="col-12 col-xs-9 col-sm-12 col-md-10">
                                    <nav id="menuzord" class="menuzord default menuzord-responsive">
                                        <ul class="menuzord-menu">
                                            <li class="<?php echo current_url() == home_site_url() ? 'active' : '' ?>"><a href="<?php echo home_site_url(''); ?>">Home</a></li>

                                            <li><a href="javascript:void(0)">About</a>
                                                <ul class="dropdown" style="margin:30px">
                                                <li class="<?php echo current_url() == home_site_url('about-us') ? 'active' : '' ?>">
                                                    <a href="<?php echo home_site_url('about-us'); ?>">About Us</a></li>
                                                    <li <?php echo current_url() == home_site_url('directors-desk') ? 'active' : '' ?>><a href="<?php echo home_site_url('directors-desk'); ?>">Directors Desk</a>     
                                                    </li>
                                                    <li <?php echo current_url() == home_site_url('process') ? 'active' : '' ?>><a href="<?php echo home_site_url('process'); ?>">Our Process</a>     
                                                    </li>
                                                  </ul>
                                            </li>
                                            <li class="<?php echo current_url() == home_site_url('courses') ? 'active' : '' ?>"><a href="<?php echo home_site_url('courses'); ?>">Courses</a></li>
                                            <li class="<?php echo current_url() == home_site_url('faculty') ? 'active' : '' ?>"><a href="<?php echo home_site_url('faculty'); ?>">Faculty</a></li>
                                            <li class="<?php echo current_url() == home_site_url('gallery') ? 'active' : '' ?>"><a href="<?php echo home_site_url('gallery'); ?>">Gallery</a></li>
                                            <li class="<?php echo current_url() == home_site_url('blog') ? 'active' : '' ?>"><a href="<?php echo home_site_url('blog'); ?>">Blog</a></li>
                                            <li class="<?php echo current_url() == home_site_url('contact-us') ? 'active' : '' ?>"><a href="<?php echo home_site_url('contact-us'); ?>">Contact Us</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <?php } ?>