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
		        "plugins/parsley/parsley.css"
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
							<h4 class="text-center"><?php echo translate('unlock_your_account'); ?></h4>
							<?php echo form_open(admin_site_url('auth/crud'), array('class'=>'data-parsley-validate auth-unlock-form mt-2', 'method'=>'post'), array('action'=>'unlock')); ?>
								<div class="form-group text-left">
	                                <label><?php echo translate('TOTP'); ?> <span class="text-danger">*</span></label>
	                                <input type="text" class="form-control" id="totp" name="totp" placeholder="<?php echo translate('TOTP'); ?>" tabindex="1" autocomplete="off" autofocus required />
	                            </div>
	                            <?php if($user->authentication_type!='f'){ ?>
	                            	<?php if(app_setting('captcha_status','off')!='off'){ ?>
		                            	<?php $captcha_type = app_setting('captcha_type','default'); ?>
	                                    <?php if($captcha_type=='default'){ ?>
	                                        <div class="form-group text-left">
	                                            <label><?php echo translate('captcha'); ?> <span class="text-danger">*</span></label>
	                                            <small class="text-muted"><i>(<?php echo translate('click_on_image_to_regenerate_new_captcha'); ?>)</i></small>
	                                            <div class="d-flex">
	                                                <input type="text" class="form-control" id="txt_unlock_captcha" name="captcha_token" placeholder="<?php echo translate('captcha'); ?>" tabindex="3" data-parsley-errors-container="#error_captcha" autocomplete="off" required />
	                                                <img src="<?php echo get_captcha('default', 'unlock_captcha')->img; ?>" id="unlock_captcha" class="img-responsive cursor-pointer referesh-captcha" alt="<?php echo translate('default_captcha') ?>" data-toggle="tooltip" data-placement="top" title="<?php echo translate('click_to_regenerate_new_captcha'); ?>">
	                                            </div>
	                                            <span id="error_captcha"></span>
	                                        </div>
	                                    <?php }else if($captcha_type=='grcv2'){ ?>
	                                        <div class="form-group text-left">
	                                            <?php echo get_captcha($captcha_type, 'unlock_captcha'); ?>
	                                            <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>    
	                                            <script>
	                                                var onloadCallback = function() {
	                                                    var grcid = 'unlock_captcha';
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
                                <?php } ?>
                                <?php if($user->authentication_type=='f'){ ?>
                                	<div id="recaptcha-container" style="display: none;"></div>
                                <?php } ?>
								<button type="<?php echo $user->authentication_type!='f' ? 'submit' : 'button' ?>" class="btn ripple btn-main-primary btn-block <?php echo $user->authentication_type=='f' ? 'btn-unlock' : '' ?>" tabindex="4" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>"><?php echo translate('unlock'); ?></button>
							<?php echo form_close(); ?>
							<div class="mt-3 text-center">
								<p class="mb-1"><a href="<?php echo admin_site_url('auth/logout'); ?>"><?php echo translate('forgot_TOTP'); ?>?</a></p>
								<p class="mb-0"><?php echo translate("contact_with_your_admin"); ?></p>
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
		<?php if($user->authentication_type!='f'){ ?>
			<?php if(app_setting('captcha_status','off')!='off'){ ?>
	        	<?php $captcha_type = app_setting('captcha_type','default'); ?>
	        	<?php $details = app_setting('captcha_details');
	    		$details = json_decode($details); ?>
	            <script>
	                function regenerate_captcha(){
	                    <?php if($captcha_type=='default'){ ?>
	                        $.post('<?php echo admin_site_url('auth/generate-captcha') ?>',{action:'captcha', type:'unlock_captcha'},function(data) {
	                            if(data.status){
	                                $("#unlock_captcha").attr('src',data.details);
	                                $("#txt_unlock_captcha").val('');
	                            }
	                        });
	                    <?php }else if($captcha_type=='grcv2'){ ?>
	                        var grcid = 'unlock_captcha';
	                        $("#txt_captch_error_"+grcid).val('');
	                        grecaptcha.reset();
	                    <?php }else if($captcha_type=='grcv3'){ ?>
	                	    grecaptcha.ready(function() {
		                        grecaptcha.execute('<?php echo $details->captcha_site_key ?>', {action: 'unlock'}).then(function(token) {
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
        <?php } ?>
        <?php if($user->authentication_type=='f'){ ?>
        	<?php 
        		$firebase_status = app_setting('firebase_status','off');
		      	$firebase_details = app_setting('firebase_details','[]');
		      	$firebase_details = !empty(json_decode($firebase_details)) ? json_decode($firebase_details) : array();
		   	?>
        	<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase.js"></script>
	        <script>
	        	$( document ).ready(function() {
				    send_otp();
				});
				const firebaseConfig = {
					apiKey: "<?php echo $firebase_status=='on' && isset($firebase_details->api_key) ? $firebase_details->api_key : ''; ?>",
					authDomain: "<?php echo $firebase_status=='on' && isset($firebase_details->auth_domain) ? $firebase_details->auth_domain : ''; ?>",
					projectId: "<?php echo $firebase_status=='on' && isset($firebase_details->project_id) ? $firebase_details->project_id : ''; ?>",
					storageBucket: "<?php echo $firebase_status=='on' && isset($firebase_details->storage_bucket) ? $firebase_details->storage_bucket : ''; ?>",
					messagingSenderId: "<?php echo $firebase_status=='on' && isset($firebase_details->messaging_sender_id) ? $firebase_details->messaging_sender_id : ''; ?>",
					appId: "<?php echo $firebase_status=='on' && isset($firebase_details->app_id) ? $firebase_details->app_id : ''; ?>"
				};
				firebase.initializeApp(firebaseConfig);
				function send_otp(){
			    	window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
			        	'size': 'invisible',
			        	'callback': function(response) { /*reCAPTCHA solved, allow signInWithPhoneNumber.*/ },
			        	'expired-callback': function() { /*Response expired. Ask user to solve reCAPTCHA again.*/ }
			        });
			        var cverify=window.recaptchaVerifier;
			        firebase.auth().signInWithPhoneNumber("<?php echo '+'.$user->country_code.$user->mobile_no ?>",cverify).then(function(response){
			        	window.confirmationResult=response;
			        }).catch(function(error){
			            console.log(error);
			        })
			   	}
				$('body').on('click', '.btn-unlock', function (e) { 
			        e.preventDefault();
			        var obj = $(this);
			        var form = obj.closest('form');
			        if($('.data-parsley-validate').length){
			            if (!$(form).parsley().validate()) {
			                return false;
			            }
			        }
			        var otp = $("#totp").val();
			        confirmationResult.confirm(otp).then(function(response){
			           	var token = response.user.xa;
			            if(token!=null && token!=undefined && token!=""){
							$.post(form.attr('action'),form.serialize()+'&token='+token+'&provider=phone',function(data){
						    	show_notification(data.type,data.message,data.title);
				                if(data.status){
				                    if (typeof data.url!= "undefined") {
				                        window.location.href = data.url;
				                    }
				                }
						  	});
				        }
			       	}).catch(function(error){
			           	show_notification('error','<?php echo translate('invalid_TOTP') ?>','<?php echo translate('unlock') ?>');
			        })
			    });
			</script>
		<?php } ?>
	</body>
</html>