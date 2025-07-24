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
		        "plugins/magnific/magnific.css",
		        "plugins/fancybox/fancybox.css",
		        "plugins/fancybox/panzoom.css",
		        "plugins/notify/css/notify.css",
		        "plugins/parsley/parsley.css",
		        "css/custom.css"
		    );
		    if(isset($page_css) && !empty($page_css)){
		    	foreach ($page_css as $css) {
		    		array_push($css_files,$css);
		    	}
		    }
			$js_files = array(
				"root.js",
			    "plugins/jquery/jquery.min.js",
			    "plugins/bootstrap/popper.min.js",
				"plugins/bootstrap/js/bootstrap.min.js",
				"plugins/perfect-scrollbar/perfect-scrollbar.min.js",
				"plugins/sidemenu/sidemenu.js",
				"plugins/notify/js/notify.min.js",
				"plugins/parsley/parsley.min.js",
				"js/sticky.js",
				"plugins/magnific/magnific.min.js",
				"plugins/fancybox/fancybox.umd.js",
				"plugins/sweet-alert/sweetalert.min.js",
				"plugins/select2/select2.min.js",
				"plugins/notify/js/notify.min.js",
				"plugins/parsley/parsley.min.js",
				"js/custom.js",
				"js/external.js"
			);
			if(isset($page_js) && !empty($page_js)){
		    	foreach ($page_js as $js) {
		    		array_push($js_files,$js);
		    	}
		    }
			load_admin_css($css_files);
			load_admin_js($js_files);
		?>
		<?php $languages = get_all_languages(); ?>
		<?php if(count($languages)>1){ ?>
			<?php if (app_setting('app_translator','d')=='g') { ?>
				<?php $all_langs = array(); foreach ($languages as $key => $value) { $all_langs[] = $value->slug; } ?>
				<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				<script type="text/javascript">
					function googleTranslateElementInit() {
						new google.translate.TranslateElement({pageLanguage: 'en' , includedLanguages : '<?php echo implode(',', $all_langs) ?>'}, 'google_translate_element');
					}
				</script>
			<?php } ?>
		<?php } ?>
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
	<body class="main-body <?php echo app_setting("menubar","left")=='top' ? 'horizontal-hover' : '' ?> <?php echo app_setting("app_rtl","off") == "on" ? 'rtl' : 'ltr' ?> <?php echo app_setting("app_layout","full") == "boxed" ? 'layout-boxed' : '' ?>">
		<div id="global-loader">
			<img src="<?php echo uploads_url('loader.gif'); ?>" class="loader-img" alt="<?php echo translate('loader'); ?>">
		</div>
		<div class="page">
			<div class="main-header side-header sticky">
				<div class="container-fluid main-container">
					<div class="main-header-left sidemenu">
						<a class="main-header-menu-icon" href="" id="mainSidebarToggle"><span></span></a>
					</div>
					<a class="main-header-menu-icon  horizontal d-lg-none" href="" id="mainNavShow"><span></span></a>
					<div class="main-header-left horizontal">
						<a class="main-logo" href="<?php echo admin_site_url(); ?>">
							<img src="<?php echo uploads_url('logo.png'); ?>" class="header-brand-img desktop-logo" alt="<?php echo app_setting('app_title'); ?>">
							<img src="<?php echo uploads_url('logo-light.png'); ?>" class="header-brand-img desktop-logo theme-logo" alt="<?php echo app_setting('app_title'); ?>">
						</a>
					</div>
					<div class="main-header-right">
						<button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto collapsed" type="button"
							data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
							aria-controls="navbarSupportedContent-4" aria-expanded="false"
							aria-label="Toggle navigation"> <span class="navbar-toggler-icon fe fe-more-vertical "></span>
						</button>
						<div class="navbar navbar-expand-lg navbar-collapse responsive-navbar p-0">
							<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
								<ul class="nav nav-item header-icons navbar-nav-right ms-auto">
									<?php if(app_setting('front_page_access')=='on'){ ?>
										<li>
											<a class="nav-link icon" href="<?php echo home_site_url(); ?>" target="_blank">
												<i class="fe fe-home"></i>
											</a>
										</li>
									<?php } ?>
									<div class="dropdown  d-flex">
										<a class="nav-link icon theme-layout nav-link-bg layout-setting">
											<span class="dark-layout"><i class="fe fe-moon"></i></span>
											<span class="light-layout"><i class="fe fe-sun"></i></span>
										</a>
									</div>
									<?php /*<li class="dropdown main-header-notification">
										<a class="nav-link icon" href="">
											<i class="fe fe-bell"></i>
											<span class="pulse bg-danger"></span>
										</a>
										<div class="dropdown-menu">
											<div class="header-navheading">
												<p class="main-notification-text">You have 1 unread notification<span
														class="badge bg-pill badge-primary ms-3">View all</span></p>
											</div>
											<div class="main-notification-list">
												<a href="view-mail.html" class="media new">
													<div class="main-img-user online"><img alt="avatar"
															src="../assets/img/users/5.jpg"></div>
													<div class="media-body">
														<p>Congratulate <strong>Olivia James</strong> for New template
															start</p>
														<span>Oct 15 12:32pm</span>
													</div>
												</a>
												<a href="view-mail.html" class="media">
													<div class="main-img-user"><img alt="avatar"
															src="../assets/img/users/2.jpg">
													</div>
													<div class="media-body">
														<p><strong>Joshua Gray</strong> New Message Received</p>
														<span>Oct 13
															02:56am</span>
													</div>
												</a>
												<a href="view-mail.html" class="media">
													<div class="main-img-user online"><img alt="avatar"
															src="../assets/img/users/3.jpg"></div>
													<div class="media-body">
														<p><strong>Elizabeth Lewis</strong> added new schedule realease
														</p><span>Oct
															12 10:40pm</span>
													</div>
												</a>
											</div>
											<div class="dropdown-footer">
												<a href="mail-inbox.html">View All Notifications</a>
											</div>
										</div>
									</li>*/ ?>
									<?php $languages = get_all_languages(); ?>
						            <?php if(count($languages)>1){ ?>
										<?php if (app_setting('app_translator','d')=='g') { ?>
											<div id="google_translate_element"></div>
										<?php }else{ ?>
											<li class="dropdown main-header-notification">
												<?php $selected_language = get_active_language(); ?>
												<a class="main-img-user" href=""><img alt="<?php echo $selected_language->name ?>" src="<?php echo app_file_exists(uploads_url($selected_language->flag),uploads_url('default.png')) ?>"></a>
												<div class="dropdown-menu">
													<div class="main-notification-list">
														<?php foreach ($languages as $key => $value) { if($selected_language->slug!=$value->slug){ ?>
															<div class="media new change-language" data-url="<?php echo admin_site_url('api/change-language') ?>" href="javascript:void(0);" data-language="<?php echo $value->slug ?>">
																<div class="main-img-user online"><img alt="avatar" src="<?php echo app_file_exists(uploads_url($value->flag),uploads_url('default.png')); ?>"></div>
																<div class="media-body">
																	<p><strong><?php echo $value->name ?></strong></p><span><?php echo translate('click_to_activate_this_language'); ?></span>
																</div>
															</div>
														<?php } } ?>
													</div>
												</div>
											</li>
										<?php } ?>
									<?php } ?>
									<li class="dropdown main-profile-menu">
										<a class="main-img-user" href=""><img alt="<?php echo user_setting('user_name'); ?>" src="<?php echo user_setting('profile_image'); ?>"></a>
										<div class="dropdown-menu">
											<div class="header-navheading">
												<h6 class="main-notification-title"><?php echo user_setting('user_name'); ?></h6>
												<p class="main-notification-text"><?php echo user_setting('role_name'); ?></p>
											</div>
											<a class="dropdown-item border-top" href="<?php echo admin_site_url('profile'); ?>">
						                        <i class="fe fe-user"></i> <?php echo translate('profile_&_account_settings'); ?>
						                    </a>
						                    <a class="dropdown-item border-top popup-page" href="<?php echo admin_site_url('profile/page/change-password'); ?>">
						                        <i class="fe fe-lock"></i> <?php echo translate('change_password'); ?>
						                    </a>
						                    <?php if(user_setting('authentication_status')){ ?>
						                        <a class="dropdown-item border-top" href="<?php echo admin_site_url('auth/lock'); ?>">
						                            <i class="fe fe-lock"></i> <?php echo translate('lock'); ?>
						                        </a>
						                    <?php } ?>
						                    <a class="dropdown-item" href="<?php echo admin_site_url('auth/logout'); ?>">
						                        <i class="fe fe-power"></i> <?php echo translate('sign_out'); ?>
						                    </a>
										</div>
									</li>
									<?php /*<li class="dropdown header-settings">
										<a href="#" class="nav-link icon" data-bs-toggle="sidebar-right"
											data-bs-target=".sidebar-right">
											<i class="fe fe-align-right"></i>
										</a>
									</li>*/ ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="main-sidebar main-sidemenu main-sidebar-sticky side-menu">
				<div class="sidemenu-logo">
					<a class="main-logo" href="<?php echo admin_site_url(); ?>">
						<img src="<?php echo uploads_url('logo.png'); ?>" class="header-brand-img desktop-logo" alt="<?php echo app_setting('app_title'); ?>">
						<img src="<?php echo uploads_url('favicon.png'); ?>" class="header-brand-img icon-logo" alt="<?php echo app_setting('app_title'); ?>">
						<img src="<?php echo uploads_url('logo-light.png'); ?>" class="header-brand-img desktop-logo theme-logo"
							alt="<?php echo app_setting('app_title'); ?>">
						<img src="<?php echo uploads_url('favicon.png'); ?>" class="header-brand-img icon-logo theme-logo"
							alt="<?php echo app_setting('app_title'); ?>">
					</a>
				</div>
				<div class="main-sidebar-body">
					<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
						fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
						<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
					</svg></div>
					<ul class="nav hor-menu">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo admin_site_url('dashboard'); ?>"><i class="fe fe-airplay"></i><span class="sidemenu-label"><?php echo translate('dashboard'); ?></span></a>
						</li>
						<?php
							$permissions = user_setting('permissions');
							
							$menu = array();
							$menu['slider'] = 'sliders';
							$menu['course'] = 'graduation-cap';
							$menu['announcements'] = 'bell';
							$menu['specialization'] = 'book';
							$menu['faculty'] = 'users';
							$menu['gallery'] = 'calendar';
							$menu['testimonial'] = 'quote-left';
							$menu['blog'] = 'newspaper-o';
							$menu['filemanager'] = 'folder-open';
							$menu['user'] = 'user';
							$menu['role'] = 'key';
							$menu['pages'] = 'file';
							$menu['languages'] = 'language';
							$menu['settings'] = 'cog';
						?>
						<?php
						foreach ($menu as $key => $value) { if(empty($permissions) || isset($permissions[strtolower($key)])){ ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo admin_site_url(str_replace('_', '-', strtolower($key))) ?>">
									<i class="fa fa-<?php echo $value ?>"></i>
									<span class="sidemenu-label"><?php echo translate($key) ?></span>
								</a>
							</li>
						<?php } } ?>	
						
						<?php if (empty($permissions) || isset($permissions['user_inquiry'])) { ?>
							<li class="nav-item">
								<a class="nav-link with-sub" href=""><i class="fa fa-envelope"></i>
									<span class="sidemenu-label"><?php echo translate('user_inquiry') ?></span><i class="angle fe fe-chevron-right"></i>
								</a>
								<ul class="nav-sub">
									<?php if (empty($permissions) || isset($permissions['user_inquiry']['inquiry'])) { ?>
										<li class="nav-sub-item">
											<a class="nav-sub-link" href="<?php echo admin_site_url('user-inquiry/inquiry') ?>"><?php echo translate('inquiry') ?></a>
										</li>
									<?php } ?>
									<?php if (empty($permissions) || isset($permissions['user_inquiry']['contact_us'])) { ?>
										<li class="nav-sub-item">
											<a class="nav-sub-link" href="<?php echo admin_site_url('user-inquiry/contact-us') ?>"><?php echo translate('contact') ?></a>
										</li>
									<?php } ?>
									<?php if (empty($permissions) || isset($permissions['user_inquiry']['course_enquiry'])) { ?>
										<li class="nav-sub-item">
											<a class="nav-sub-link" href="<?php echo admin_site_url('user-inquiry/course-enquiry') ?>"><?php echo translate('course_enquiry') ?></a>
										</li>
									<?php } ?>
									<?php if (empty($permissions) || isset($permissions['user_inquiry']['exam_registration'])) { ?>
										<li class="nav-sub-item">
											<a class="nav-sub-link" href="<?php echo admin_site_url('user-inquiry/exam-registration') ?>"><?php echo translate('exam_registration') ?></a>
										</li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>	
					</ul>
					<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
						width="24" height="24" viewBox="0 0 24 24">
						<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
					</svg></div>
				</div>
			</div>
			<div class="main-content side-content pt-0">
				<div class="side-app">
				  	<div class="main-container container-fluid">