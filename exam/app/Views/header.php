<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <?php if(app_setting('seo_author')!=''){ ?>
        <meta name="author" content="<?php echo app_setting('seo_author'); ?>">
    <?php } ?>
    <?php if(app_setting('seo_visit_after')!=''){ ?>
        <meta name="revisit-after" content="<?php echo app_setting('seo_visit_after'); ?> days">
    <?php } ?>
    <?php if(app_setting('seo_description')!=''){ ?>
        <meta name="description" content="<?php echo app_setting('seo_description'); ?>">
    <?php } ?>
    <?php if(app_setting('seo_keywords')!=''){ ?>
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
        "css/colors/theme-skin-color-set1.css",
        "css/custom.css"
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
        <header id="header" class="header"></header>
    