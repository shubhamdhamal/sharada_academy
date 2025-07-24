<!DOCTYPE html>
<html lang="<?php echo app_setting('app_language','en') ?>">
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
		<link rel="icon" href="<?php echo uploads_url('favicon.png'); ?>" type="image/x-icon"/>
		<title><?php echo isset($page_title) && $page_title!='' ? translate($page_title).' - ' : '' ?><?php echo app_setting('app_title'); ?><?php echo app_setting('seo_title')!='' ? ' | '.app_setting('seo_title') : ''; ?></title>
		<?php if(app_setting('app_pwa_status')=='on'){ ?>
            <link rel="manifest" href="<?php echo home_site_url('manifest.json') ?>"></link>
            <meta name="theme-color" content="<?php echo app_setting('app_primary_color'); ?>">
            <link type="text/javascript" href="<?php echo home_site_url('pwa.js') ?>"></link>
        <?php } ?>
		<?php 
			$rtl = app_setting("app_rtl","off") == "on" ? '.rtl' : '';
			$css_files = array(
				"root.css",
		        "plugins/bootstrap/css/bootstrap".$rtl.".min.css",
		        //"plugins/flag-icon-css/css/flag-icon.min.css",
		        "css/icons.css",
		        "css/style.css",
		        "css/skins.css",
		        "css/dark-style.css",
		        "css/boxed.css",
		        "plugins/notify/css/notify.css",
		        "plugins/parsley/parsley.css",
		        "plugins/parsley/parsley.css",
		        "css/custom.css"
		    );
			$js_files = array(
			    "plugins/jquery/jquery.min.js",
			    "plugins/bootstrap/popper.min.js",
				"plugins/bootstrap/js/bootstrap.min.js",
				"plugins/perfect-scrollbar/perfect-scrollbar.min.js",
				"plugins/notify/js/notify.min.js",
				"plugins/parsley/parsley.min.js",
				"js/custom.js",
				"js/external.js",
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
	<body class="main-body <?php echo app_setting("app_rtl","off") == "on" ? 'rtl' : 'ltr' ?> <?php echo app_setting("app_layout","full") == "boxed" ? 'layout-boxed' : '' ?> login-img">
		<div id="global-loader">
			<img src="<?php echo uploads_url('loader.gif'); ?>" class="loader-img" alt="<?php echo translate('loader'); ?>">
		</div>
		<div class="page main-signin-wrapper">
			<div class="row text-center ps-0 pe-0 ms-0 me-0">
				<div class=" col-xl-4 col-lg-4 col-md-4 d-block mx-auto">
					<div class="text-center mb-2">
						<a  href="<?php echo admin_site_url(); ?>">
                            <img src="<?php echo uploads_url('logo.png'); ?>" class="header-brand-img" alt="<?php echo app_setting('app_title'); ?>">
                            <img src="<?php echo uploads_url('logo-light.png'); ?>" class="header-brand-img theme-logos" alt="<?php echo app_setting('app_title'); ?>">
                        </a>
					</div>
					<div class="card custom-card">
						<div class="card-body pd-45">
							<h4 class="text-center"><?php echo translate('signin_to_your_account'); ?></h4>
							<?php echo form_open(admin_site_url('auth/crud'), array('class'=>'data-parsley-validate auth-login-form mt-2', 'method'=>'post'), array('action'=>'login')); ?>
								<div class="form-group text-start">
									<?php
										echo form_label(translate('username').' <span class="text-danger">*</span>', 'username');
										echo form_input('username','',['class'=>'form-control','placeholder'=>translate('enter_your_username'),'required'=>"required"],'text');
									?>
								</div>
								<div class="form-group text-start">
									<?php
										echo form_label(translate('password').' <span class="text-danger">*</span>', 'password');
										echo form_password('password','',['class'=>'form-control','placeholder'=>translate('enter_your_password'),'required'=>"required"]);
									?>
								</div>
								<?php if(app_setting('captcha_status','off')!='off'){ ?>
	                            	<?php $captcha_type = app_setting('captcha_status','default'); ?>
                                    <?php if($captcha_type=='default'){ ?>
                                        <div class="form-group text-start">
                                        	<?php echo form_label(translate('captcha').' <span class="text-danger">*</span>', 'captcha'); ?>
                                        	<small class="text-muted"><i>(<?php echo translate('click_on_image_to_regenerate_new_captcha'); ?>)</i></small>
                                            <div class="d-flex">
                                            	<?php
                                            		echo form_input('captcha_token','',['class'=>'form-control','placeholder'=>translate('enter_captcha'),'id'=>'txt_login_captcha','data-parsley-errors-container'=>'#error_captcha','autocomplete'=>'off','required'=>"required"],'text');
												?>
                                                <img src="<?php echo get_captcha('default', 'login_captcha')->img; ?>" id="login_captcha" class="img-responsive cursor-pointer referesh-captcha" alt="<?php echo translate('default_captcha') ?>" data-toggle="tooltip" data-placement="top" title="<?php echo translate('click_to_regenerate_new_captcha'); ?>">
                                            </div>
                                            <span id="error_captcha"></span>
                                        </div>
                                    <?php }else if($captcha_type=='gv2'){ ?>
                                        <div class="form-group text-start">
                                            <?php echo get_captcha($captcha_type, 'login_captcha'); ?>
                                            <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>    
                                            <script>
                                                var onloadCallback = function() {
                                                    var grcid = 'login_captcha';
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
                                    <?php }else if($captcha_type=='gv3'){ ?>
                                    	<?php $details = app_setting('captcha_details');
    									$details = json_decode($details); ?>
                                    	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $details->site ?>"></script>
                                        <input type="hidden" name="g-recaptcha-response" class="captcha-token" value="">
                                    <?php } ?>
                                <?php } ?>
								<?php echo form_button(['content' => translate('sign_in'),'type'=>'submit','class'=>'btn ripple btn-main-primary btn-block','data-loading-text'=>"<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> ".translate('please_wait...')]); ?>
							<?php echo form_close(); ?>
							<?php if(app_setting('app_disable_password_reset','off')=='off' || app_setting('app_disable_registration','on')=='off'){ ?>
								<div class="mt-3 text-center">
									<?php if(app_setting('app_disable_password_reset','off')=='off'){ ?>
										<p class="mb-1"><a href="<?php echo admin_site_url('auth/forgot-password'); ?>"><?php echo translate('forgot_password'); ?>?</a></p>
									<?php } ?>
									<?php if(app_setting('app_disable_registration','on')=='off'){ ?>
										<p class="mb-0"><?php echo translate("don't_have_an_account"); ?>? <a href="<?php echo admin_site_url('auth/register'); ?>"><?php echo translate('create_an_account'); ?></a></p>
									<?php } ?>
								</div>
							<?php } ?>
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
		<?php if(app_setting('captcha_status','off')!='off'){ ?>
        	<?php $captcha_type = app_setting('captcha_status','default'); ?>
        	<?php $details = app_setting('captcha_details');
    		$details = json_decode($details); ?>
            <script>
                function regenerate_captcha(){
                    <?php if($captcha_type=='default'){ ?>
                        $.post('<?php echo home_site_url('api/web') ?>',{action:'generate_captcha', type:'login_captcha'},function(data) {
                            if(data.status){
                                $("#login_captcha").attr('src',data.details);
                                $("#txt_login_captcha").val('');
                            }
                        });
                    <?php }else if($captcha_type=='gv2'){ ?>
                        var grcid = 'login_captcha';
                        $("#txt_captch_error_"+grcid).val('');
                        grecaptcha.reset();
                    <?php }else if($captcha_type=='gv3'){ ?>
                	    grecaptcha.ready(function() {
	                        grecaptcha.execute('<?php echo $details->site ?>', {action: 'login'}).then(function(token) {
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
            <?php if($captcha_type=='gv3'){ ?>
            	<script>
            		$(document).ready(function() {
				    	regenerate_captcha();
					});
	            </script>
        	<?php } ?>
        <?php } ?>
	</body>
</html>