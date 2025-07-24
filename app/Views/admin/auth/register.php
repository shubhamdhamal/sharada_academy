<!DOCTYPE html>
<html lang="<?php echo app_setting("app_language","en") ?>"<?php echo app_setting("is_rtl","off") == "on" ? ' dir="rtl' : '' ?>>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
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
		<link rel="icon" href="<?php echo app_file_exists(uploads_url('favicon.png')); ?>" type="image/x-icon"/>
		<title><?php echo isset($page_title) && $page_title!='' ? translate($page_title).' - ' : '' ?><?php echo app_setting('app_title'); ?><?php echo app_setting('seo_title')!='' ? ' | '.app_setting('seo_title') : ''; ?></title>
		<style>
		    :root{
		        --primary-color : <?php echo app_setting('app_primary_color'); ?>;
		        --primary-color-dark : <?php echo app_setting('app_primary_color_dark'); ?>;
		        --secondary-color : <?php echo app_setting('app_secondary_color'); ?>;
		        --secondary-color-dark : <?php echo app_setting('app_secondary_color_dark'); ?>;
		    }
		</style>
		<?php if(app_setting('app_pwa_status')=='on'){ ?>
            <link rel="manifest" href="<?php echo home_site_url('manifest.json') ?>"></link>
            <meta name="theme-color" content="<?php echo app_setting('app_primary_color'); ?>">
            <script type="text/javascript">
                if ('serviceWorker' in navigator) {
                    navigator.serviceWorker.register('<?php echo home_site_url("service-worker.js") ?>', {
                        scope: '<?php echo strtolower(preg_replace('/index.php.*/', '', $_SERVER['SCRIPT_NAME'])); ?>'
                    }).then(function (registration) {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    }, function (err) {
                        console.log('ServiceWorker registration failed: ', err);
                    });
                }
            </script>
        <?php } ?>
		<?php
			$css_files = array(
		        "plugins/fontawesome-free/css/all.min.css",
		        "plugins/ionicons/css/ionicons.min.css",
		        "plugins/typicons.font/typicons.css",
		        "plugins/feather/feather.css",
		        "plugins/flag-icon-css/css/flag-icon.min.css",
		        "plugins/parsley/parsley.css",
		        "plugins/intl-tel-input/css/intlTelInput.min.css"
		    );
		    if (app_setting("app_rtl","off") == "on") {
		    	array_push($css_files, "css-rtl/style.css");
            	array_push($css_files, "css-rtl/skins.css");
	            array_push($css_files, "css-rtl/dark-style.css");
	            array_push($css_files, "css-rtl/custom-dark-style.css");
	            array_push($css_files, "css-rtl/sidemenu.css");
		        array_push($css_files, "css/rtl.css");
		    }else{
		    	array_push($css_files, "css/style.css");
		    	array_push($css_files, "css/skins.css");
		    	array_push($css_files, "css/dark-style.css");
				array_push($css_files, "css/sidemenu.css");
		    }
		    array_push($css_files, "plugins/toastr/toastr.min.css");
		    array_push($css_files, "css/custom.css");
		    $js_files = array(
			    "plugins/jquery/jquery.min.js",
			    "plugins/bootstrap/js/bootstrap.bundle.min.js",
				"plugins/ionicons/ionicons.js",
				"plugins/perfect-scrollbar/perfect-scrollbar.min.js",
				"plugins/sidemenu/sidemenu.js",
				"plugins/toastr/toastr.min.js",
				"plugins/parsley/parsley.min.js",
				"plugins/intl-tel-input/js/intlTelInput.min.js",
				"js/custom.js",
				"js/external.js"
			);

			load_admin_css($css_files);
			load_admin_js($js_files);
		?>
		<?php if(app_setting('google_analytics_id')!=''){ ?>
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo app_setting('google_analytics_id') ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', "<?php echo app_setting('google_analytics_id') ?>");
            </script>
        <?php } ?>
        <?php if(app_setting('facebook_pixel_id')!=''){ ?>
            <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '<?php echo app_setting('facebook_pixel_id') ?>');
                fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo app_setting('facebook_pixel_id') ?>&ev=PageView&noscript=1"/></noscript>
        <?php } ?>
        <?php if(!empty(json_decode(app_setting('seo_noscript')))){ ?>
            <noscript>
                <?php foreach (json_decode(app_setting('seo_noscript')) as $key => $value) { ?>
                <h1><?php echo $value; ?></h1>
            <?php } ?>
            </noscript>
        <?php } ?>
	</head>
	<body class="main-body">
		<div id="global-loader">
			<img src="<?php echo uploads_url('loader.gif'); ?>" class="loader-img" alt="Loader">
		</div>
		<div class="page main-signin-wrapper">
			<div class="row text-center pl-0 pr-0 ml-0 mr-0">
				<div class="col-lg-4 d-block mx-auto">
					<div class="text-center mb-2">
						<img src="<?php echo uploads_url('logo.png'); ?>" class="header-brand-img desktop-logo" alt="<?php echo app_setting('app_title'); ?>">
						<img src="<?php echo uploads_url('logo-light.png'); ?>" class="header-brand-img desktop-logo theme-logo" alt="<?php echo app_setting('app_title'); ?>">
					</div>
					<div class="card custom-card">
						<div class="card-body">
							<h4 class="text-center"><?php echo translate('register_your_account'); ?></h4>
							<?php echo form_open(admin_site_url('auth/crud'), array('class'=>'data-parsley-validate auth-register-form mt-2', 'method'=>'post'), array('action'=>'register')); ?>
	                            <div class="form-group text-left">
	                                <label><?php echo translate('name'); ?> <span class="text-danger">*</span></label>
	                                <input type="text" class="form-control" name="name" placeholder="<?php echo translate('name'); ?>" tabindex="1" autofocus required />
	                            </div>
								<div class="form-group text-left">
	                                <label><?php echo translate('username'); ?> <span class="text-danger">*</span></label>
	                                <input type="text" class="form-control" name="username" placeholder="<?php echo translate('username'); ?>" tabindex="2" autocomplete="off" required />
	                            </div>
	                            <div class="form-group text-left">
	                                <label><?php echo translate('mobile_no'); ?> <span class="text-danger">*</span></label><br/>
	                                <input type="tel" class="form-control mobile_no" name="mobile_no" placeholder="<?php echo translate('mobile_no'); ?>" tabindex="3" autocomplete="off" data-parsley-errors-container="#error_mobile_no" data-parsley-mnvalidator="mobile_no" required />
	                                <input type="hidden" name="country_code" id="country_code" value="" required />
	                                <span id="error_mobile_no"></span>
	                            </div>
	                            <div class="form-group text-left">
	                                <label><?php echo translate('email_id'); ?> <span class="text-danger">*</span></label>
	                                <input type="email" class="form-control" name="email_id" placeholder="<?php echo translate('email_id'); ?>" tabindex="4" autocomplete="off" required />
	                            </div>
	                            <div class="form-group text-left">
	                                <label><?php echo translate('password'); ?> <span class="text-danger">*</span></label>
	                                <input type="password" class="form-control" name="password" id="password" placeholder="<?php echo translate('new_password'); ?>" tabindex="5" autocomplete="off" required />
	                            </div>
	                            <div class="form-group text-left">
	                                <label><?php echo translate('confirm_password'); ?> <span class="text-danger">*</span></label>
	                                <input type="password" class="form-control" name="confirm_password" placeholder="<?php echo translate('confirm_password'); ?>" tabindex="6" autocomplete="off" data-parsley-equalto="#password" data-parsley-equalto-message="<?php echo translate('this_value_should_be_the_same_as_new_password') ?>" tabindex="6" required />
	                            </div>
	                            <?php if(app_setting('captcha_status','off')!='off'){ ?>
	                            	<?php $captcha_type = app_setting('captcha_type','default'); ?>
                                    <?php if($captcha_type=='default'){ ?>
                                        <div class="form-group text-left">
                                            <label><?php echo translate('captcha'); ?> <span class="text-danger">*</span></label>
                                            <small class="text-muted"><i>(<?php echo translate('click_on_image_to_regenerate_new_captcha'); ?>)</i></small>
                                            <div class="d-flex">
                                                <input type="text" class="form-control" id="txt_register_captcha" name="captcha_token" placeholder="<?php echo translate('captcha'); ?>" tabindex="7" data-parsley-errors-container="#error_captcha" autocomplete="off" required />
                                                <img src="<?php echo get_captcha('default', 'register_captcha')->img; ?>" id="register_captcha" class="img-responsive cursor-pointer referesh-captcha" alt="<?php echo translate('default_captcha') ?>" data-toggle="tooltip" data-placement="top" title="<?php echo translate('click_to_regenerate_new_captcha'); ?>">
                                            </div>
                                            <span id="error_captcha"></span>
                                        </div>
                                    <?php }else if($captcha_type=='grcv2'){ ?>
                                        <div class="form-group text-left">
                                            <?php echo get_captcha($captcha_type, 'register_captcha'); ?>
                                            <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>    
                                            <script>
                                                var onloadCallback = function() {
                                                    var grcid = 'register_captcha';
                                                    grecaptcha.render(grcid,{
                                                        /*hl : "<?php //echo $header_setting->captcha_lang ?>",*/
                                                        callback: function(response) {
                                                            $("#txt_captch_error_"+grcid).val('validate');
                                                        },
                                                        expiredCallback: function(response) {
                                                            $("#txt_captch_error_"+grcid).val('');
                                                        },
                                                        errorCallback: function(response) {
                                                            $("#txt_captch_error_"+grcid).val('');
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    <?php }else if($captcha_type=='grcv3'){ ?>
                                    	<?php $details = app_setting('captcha_details');
    									$details = json_decode($details); ?>
                                    	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $details->captcha_site_key ?>"></script>
                                        <input type="hidden1" name="g-recaptcha-response" class="captcha-token" value="">
                                    <?php } ?>
                                <?php } ?>
								<button type="submit" class="btn ripple btn-main-primary btn-block" tabindex="8" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>"><?php echo translate('register_now'); ?></button>
							<?php echo form_close(); ?>
							<div class="mt-3 text-center">
								<?php if(app_setting('app_disable_password_reset','off')=='off'){ ?>
									<p class="mb-1"><a href="<?php echo admin_site_url('auth/forgot-password'); ?>"><?php echo translate('forgot_password'); ?>?</a></p>
								<?php } ?>
								<p class="mb-0"><?php echo translate('already_have_an_account') ?>?<a href="<?php echo admin_site_url('auth'); ?>"> <?php echo translate('login_to_account'); ?></a></p>
							</div>
						</div>
						<div class="card-footer text-center">
                            <span>
                            	<p><?php echo translate('copyright') ?> © <?php echo date('Y') ?> <?php echo app_setting('app_title'); ?> <?php echo app_setting('app_footer_credit'); ?></p>
                            	<div class="dropdown">
									<?php $languages = get_all_languages(); ?>
					            	<?php if(count($languages)>1){ ?>
										<a class="dropdown-toggle cursor-pointer" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"><i class="fe fe-globe"></i></a>
										<div class="dropdown-menu tx-13">
											<?php $selected_language = get_active_language(); ?>
											<?php foreach ($languages as $key => $value) { if($selected_language->slug!=$value->slug){ ?>
												<a class="dropdown-item change-language" data-url="<?php echo admin_site_url('api/change-language') ?>" href="javascript:void(0);" data-language="<?php echo $value->slug ?>" href="javascript:void(0);"><?php echo $value->name ?></a>
											<?php } } ?>
										</div>
									<?php } ?>
                            		<a class="nav-link icon theme-layout nav-link-bg cursor-pointer layout-setting">
										<span class="dark-layout"><i class="fe fe-moon"></i></span>
										<span class="light-layout"><i class="fe fe-sun"></i></span>
									</a>
								</div>
                            </span>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var input = document.querySelector(".mobile_no");
			var iti = window.intlTelInput(input, {
				initialCountry: "auto",
				separateDialCode: true,
				nationalMode: true,
				geoIpLookup: function(success, failure) {
					$.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
						var countryCode = (resp && resp.country) ? resp.country : "in";
						success(countryCode);
					});
				},
				utilsScript: "<?php echo admin_js_url('plugins/intl-tel-input/js/utils.js'); ?>",
			});
			input.addEventListener("countrychange", function() {
			  	$("#country_code").val(iti.getSelectedCountryData().dialCode);
			});
			window.ParsleyValidator.addValidator('mnvalidator',function (value, requirement) {
			    return iti.isValidNumber();
			}, 3);
		</script>
		<?php if(app_setting('captcha_status','off')!='off'){ ?>
        	<?php $captcha_type = app_setting('captcha_type','default'); ?>
        	<?php $details = app_setting('captcha_details');
    		$details = json_decode($details); ?>
            <script>
                function regenerate_captcha(){
                    <?php if($captcha_type=='default'){ ?>
                        $.post('<?php echo admin_site_url('auth/generate-captcha') ?>',{action:'captcha', type:'register_captcha'},function(data) {
                            if(data.status){
                                $("#register_captcha").attr('src',data.details);
                                $("#txt_register_captcha").val('');
                            }
                        });
                    <?php }else if($captcha_type=='grcv2'){ ?>
                        var grcid = 'register_captcha';
                        $("#txt_captch_error_"+grcid).val('');
                        grecaptcha.reset();
                    <?php }else if($captcha_type=='grcv3'){ ?>
                	    grecaptcha.ready(function() {
	                        grecaptcha.execute('<?php echo $details->captcha_site_key ?>', {action: 'register'}).then(function(token) {
	                            if($(".captcha-token").length){
                                    $(".captcha-token").each(function(){
                                        $(this).val(token);
                                    });
                                }
	                        });
	                    });
                    <?php } ?>
                }
            </script>
        <?php } ?>
	</body>
</html>