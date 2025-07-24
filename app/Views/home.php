<div class="main-content">
    <?php /* <section class="mt-4" id="home">
        <?php if (isset($slider) && !empty($slider)) { ?>
            <div class="container-fluid p-0">
                <div id="rev_slider_home_wrapper" class="rev_slider_wrapper" data-alias="news-gallery34" style="margin:0px auto; background-color:#ffffff; padding:0px; margin-top:0px; margin-bottom:0px;">
                    <div id="rev_slider_home" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
                        <ul>
                            <?php foreach ($slider as $key => $value) { ?>
                                <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/home/images/sharda-academy.png" data-rotate="0" data-fstransition="fade" data-saveperformance="off" data-title="Web Show" data-description="">
                                    <img src="<?php echo uploads_url($value->image); ?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                    <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0" id="slide-1-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="normal" data-transform_idle="o:1;" data-start="500" data-basealign="slide" data-responsive_offset="on"></div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section> */ ?>
    <section id="home">
        <?php if (isset($slider) && !empty($slider)) { ?>
            <div class="container-fluid p-0">
                <div id="rev_slider_home_wrapper" class="rev_slider_wrapper" data-alias="news-gallery34" style="margin:0px auto; background-color:#ffffff; padding:0px; margin-top:0px; margin-bottom:0px;">
                    <div id="rev_slider_home" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
                        <ul>
                            <?php $i = 0;
                            foreach ($slider as $key => $value) {
                                $i++; ?>
                                <li data-index="rs-<?php echo $i ?>" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?php echo uploads_url($value->image); ?>" data-rotate="0" data-fstransition="fade" data-saveperformance="off" data-title="Web Show" data-description="">
                                    <img src="<?php echo uploads_url($value->image); ?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                    <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0 " id="slide-<?php echo $i ?>-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="500" data-basealign="slide" data-responsive_offset="on" style="z-index: 5;background-color:rgba(0, 0, 0, 0);border-color:rgba(0, 0, 0, 0);">
                                    </div>
                                    <div class="tp-caption tp-resizeme rs-parallaxlevel-0 text-white text-uppercase font-roboto-slab font-weight-700" id="slide-<?php echo $i ?>-layer-2" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['195','195','160','170']" data-fontsize="['58','48','42','36']" data-lineheight="['70','60','50','45']" data-fontweight="['800','700','700','700']" data-textalign="['center','center','center','center']" data-width="['700','650','600','420',320]" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="600" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; font-weight:700;"> <span class="text-theme-colored2"></span>
                                    </div>
                                    <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="slide-<?php echo $i ?>-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['275','260','220','220']" data-fontsize="['16','16',18',16']" data-lineheight="['24','24','24','24']" data-fontweight="['400','400','400','400']" data-textalign="['center','center','center','center']" data-width="['800','650','600','460']" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="700" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap;">
                                    </div>
                                    <div class="tp-caption rs-parallaxlevel-0" id="slide-<?php echo $i ?>-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['350','330','290','290']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:0;y:0;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="  btn-flat text-white font-weight-600 pl-30 pr-30 mr-15" href="#"></a>
                                        <a class=" btn-transparent btn-bordered  btn-flat font-weight-600 pl-30 pr-30" href="#"></a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="tp-bannertimer tp-bottom" style="height: 5px; background-color: rgba(255, 255, 255, 0.2);">
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <section class="divider bg-silver-deep">
        <div class="container pt-50 pb-60">
            <div class="row">
                <div class="col-xs-12f col-sm-6 col-md-4 mb-sm-30">
                    <div class="feature-box text-center">
                        <div class="feature-icon">
                            <img src="<?php echo home_assets_url('images/icons/graduate.png'); ?>" alt="">
                        </div>
                        <div class="feature-title">
                            <h3>Best Teaching Methodology</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 mb-sm-30">
                    <div class="feature-box text-center">
                        <div class="feature-icon">
                            <img src="<?php echo home_assets_url('images/icons/book.png'); ?>" alt="">
                        </div>
                        <div class="feature-title">
                            <h3>Modern Book Library</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="feature-box text-center">
                        <div class="feature-icon">
                            <img src="<?php echo home_assets_url('images/icons/parents.png'); ?>" alt="">
                        </div>
                        <div class="feature-title">
                            <h3>Parent Teacher Interaction</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pb-20">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fullwidth maxwidth500" src="<?php echo home_assets_url('images/sharda-academy.png'); ?>" alt="">
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30">About <span class="text-theme-colored2">Sharada Academy</span></h2>
                        <div class="double-line-bottom-theme-colored-2"></div>
                        <p>
                            "SHARADA ACADEMY" was started in 2008 with a goal to help students who aspire to take admission for Engineering in IIT/NIT/IIIT/VIT and admission for Medical in AIIMS/Government medical colleges & many others.
                            We focus on providing teaching of the highest standards to the students to empower them to qualify IIT-JEE/NEET/MH-CET/CUET and various other competitive examinations with flying colours.
                            Our genesis lies in exploring the hidden talents of the students and to provide personalized coaching for the best performance.
                        </p>
                        <a href="<?php echo home_site_url('about-us'); ?>" style="background-color: #9e335b"class="btn btn-colored text-white btn-theme-colored2  btn-lg pl-40 pr-40 mt-15">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pb-70">
            <div class="section-content">
                <div class="row">
                <div class="col-md-6">
                        <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30">Our <span class="text-theme-colored2">Mission</span></h2>
                        <div class="double-line-bottom-theme-colored-2"></div>
                        <p><span class="pe-7s-check"></span>To provide an environment to improve the self-understanding and compete with the world with an excellent growth.</p>
                        <p><span class="pe-7s-check"></span>To provide teaching facilities to fulfil and achieve demands in IITs and medical field.</p>
                        <p><span class="pe-7s-check"></span>To introduce the concept of smart class for JEE / NEET for enhanced undrestanding and concept clarity.</p>
                         <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30">Our <span class="text-theme-colored2">Vision</span></h2>
                        <div class="double-line-bottom-theme-colored-2"></div>
                        <p><span class="pe-7s-check"></span>Putting the honest efforts with devotion and dedication to achieve the goals of the students and make them superior in values, scientific approach and technology.</p>
                     
                        <a href="<?php echo home_site_url('about-us'); ?>" class="btn btn-colored btn-theme-colored2 text-white btn-lg pl-40 pr-40 mt-15"  style="background-color: #9e335b">Read More</a>
                        </div>
                    <div class="col-md-6">
                        <img class="img-fullwidth maxwidth500" src="<?php echo home_assets_url('images/mission.png'); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container pt-0 pb-0">
            <div class="row text-center">
                <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30" style="padding-bottom: 20px;">Our <span class="text-theme-colored2"> Formula For Success</span></h2>
                <div class="col-sm-4">
                    <div class="icon-box iconbox-border iconbox-theme-colored p-40">
                        <a href="#" class="icon icon-gray icon-bordered icon-circled icon-border-effect effect-circled ">
                            <i class="pe-7s-paper-plane " style="font-size: 40px;"></i>
                        </a>
                        <h4 class="icon-box-title" style="font-weight: 600;">PLAN</h4>
                        <div class="text-left">
                            <p class="text-gray"><i class="fa fa-circle"></i> Relevant study material</p>
                            <p class="text-gray"><i class="fa fa-circle"></i> Well framed assignments</p>
                            <p class="text-gray"><i class="fa fa-circle"></i> Time management skill</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="icon-box iconbox-border iconbox-theme-colored p-40">
                        <a href="#" class="icon icon-gray icon-bordered icon-circled icon-border-effect effect-circled ">
                            <i class="pe-7s-note2" style="font-size: 40px;"></i>
                        </a>
                        <h4 class="icon-box-title" style="font-weight: 600;"> TECHNIQUES</h4>
                        <div class="text-left">
                            <p class="text-gray"><i class="fa fa-circle "></i> Intensive class room study</p>
                            <p class="text-gray"><i class="fa fa-circle"></i> Shaping the fundamentals of students</p>
                            <p class="text-gray"><i class="fa fa-circle"></i> Right environment</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="icon-box iconbox-border iconbox-theme-colored p-40 text-theme-colored2">
                        <a href="#" class="icon icon-gray icon-bordered icon-circled icon-border-effect effect-circled ">
                            <i class="pe-7s-graph1" style="font-size: 40px;"></i>
                        </a>
                        <h4 class="icon-box-title" style="font-weight: 600;">ANALYSIS</h4>
                        <div class="text-left">
                            <p class="text-gray"><i class="fa fa-circle"></i> Test series and discussion</p>
                            <p class="text-gray"><i class="fa fa-circle"></i> Doubt classes</p>
                            <p class="text-gray"><i class="fa fa-circle"></i> Feedback to parent</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (isset($course) && !empty($course)) { ?>
        <section id="courses" class="bg-silver-deep">
            <div class="container pb-40">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-uppercase title">Popular <span class="text-theme-colored2">Courses</span></h2>
                            <p class="text-uppercase mb-0">Choose Your Desired Course</p>
                            <div class="double-line-bottom-theme-colored-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <?php foreach ($course as $key => $value) { ?>
                            <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                                <a href="<?php echo home_site_url('courses/' . $value->slug) ?>">
                                    <div class="card pb-2">
                                        <img class="img" src="<?php echo uploads_url($value->image); ?>" alt="<?php echo $value->name ?>" style="height:350px;object-fit: cover;">
                                        <div class="card-header">
                                            <a href="<?php echo home_site_url('courses/' . $value->slug) ?>">
                                                <h4><?php echo $value->name; ?></h4>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
        </section>
    <?php } ?>
    <section id="reservation" class="parallax layer-overlay overlay-theme-colored-9" data-bg-img="<?php echo home_assets_url('images/register.png') ?>" data-parallax-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-8 sm-text-center">
                    <h3 class="text-white mt-30 mb-0">Get a Free online Registration</h3>
                    <h2 class="text-theme-colored2 font-54 mt-0">Inquiry Now!</h2>
                    <p class="text-gray-darkgray font-15 pr-90 pr-sm-0 mb-sm-60">"SHARADA ACADEMY" was started in 2008 with a goal to help students who aspire to take admission for Engineering in IIT/NIT/IIIT/VIT and admission for Medical in AIIMS/Government medical colleges & many others. We focus on providing teaching of the highest standards to the students to empower them to qualify IIT-JEE/NEET/MH-CET/CUET and various other competitive examinations with flying colours.</p>
                    <div class="row mt-30 sm-text-center">
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                            <div class="funfact">
                                <i class="pe-7s-smile mb-20 text-theme-colored2"></i>
                                <h2 data-animation-duration="2000" data-value="754" class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
                                <h5 class="text-white text-uppercase">Happy Students</h5>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                            <div class="funfact">
                                <i class="pe-7s-notebook mb-20 text-theme-colored2"></i>
                                <h2 data-animation-duration="500" data-value="5+" class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
                                <h5 class="text-white text-uppercase">Approved Courses</h5>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                            <div class="funfact">
                                <i class="pe-7s-users mb-20 text-theme-colored2"></i>
                                <h2 data-animation-duration="500" data-value="12+" class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
                                <h5 class="text-white text-uppercase">Certified Teachers</h5>
                            </div>
                        </div>
                        <?php /*<div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                            <div class="funfact">
                                <i class="pe-7s-study mb-20 text-theme-colored2"></i>
                                <h2 data-animation-duration="2000" data-value="1248" class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
                                <h5 class="text-white text-uppercase">Graduate Students</h5>
                            </div>
                        </div>*/ ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-50 mt-0 bg-dark-transparent-2 inquiry_result text-center">
                        <h3 class="title-pattern mt-0"><span class="text-white">Request <span class="text-theme-colored2">Information</span></span></h3>
                        <?php echo form_open(home_site_url('api/web'), array('class' => 'data-parsley-validate mt-2  reservation-form mt-20', 'method' => 'post', 'id' => 'inquiry-form'), array('action' => 'inquiry')); ?>
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="form-group mb-20">
                                    <input placeholder="Enter Name" id="reservation_name" name="name" required="" class="form-control" aria-required="true" type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-20">
                                    <input placeholder="Phone" id="reservation_phone" name="phone" class="form-control" required="" aria-required="true" type="text" pattern="^[6-9]\d{9}$" inputmode="numeric" maxlength="10">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-20">
                                    <?php if (!empty($course)) { ?>
                                        <div class="styled-select">
                                            <select id="person_select" name="course" class="form-control" required="">

                                                <option value="">Choose Course</option>
                                                <?php foreach ($course as $key => $value) { ?>
                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?>
                                                    <?php } ?></option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea placeholder="Enter Message" rows="3" class="form-control required" name="message" id="form_message" aria-required="true"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <?php if (app_setting('captcha_status', 'off') != 'off') { ?>
                                            <?php $captcha_type = app_setting('captcha_status', 'default'); ?>
                                            <?php if ($captcha_type == 'default') { ?>
                                                <div class="form-group text-start">
                                                    <?php echo form_label(translate('captcha') . ' <span class="text-danger">*</span>', 'captcha'); ?>
                                                    <small class="text-muted font-10"><i>(<?php echo translate('click_on_image_to_regenerate_new_captcha'); ?>)</i></small>
                                                    <div class="d-flex">
                                                        <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 col-6">
                                                            <?php echo form_input('captcha_token', '', ['class' => 'form-control', 'placeholder' => translate('enter_captcha'), 'id' => 'txt_inquiry_captcha', 'data-parsley-errors-container' => '#error_captcha', 'autocomplete' => 'off', 'required' => "required"], 'text'); ?>
                                                        </div>
                                                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 col-6">
                                                            <img src="<?php echo get_captcha('default', 'inquiry_captcha')->img; ?>" id="inquiry_captcha" class="img-responsive cursor-pointer referesh-captcha" alt="<?php echo translate('default_captcha') ?>" data-toggle="tooltip" data-placement="top" title="<?php echo translate('click_to_regenerate_new_captcha'); ?>">
                                                        </div>
                                                    </div>
                                                    <span id="error_captcha"></span>
                                                </div>
                                            <?php } else if ($captcha_type == 'gv2') { ?>
                                                <div class="form-group text-start">
                                                    <?php echo get_captcha($captcha_type, 'inquiry_captcha'); ?>
                                                    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>
                                                    <script>
                                                        var onloadCallback = function() {
                                                            var grcid = 'inquiry_captcha';
                                                            grecaptcha.render(grcid, {
                                                                /*hl : "<?php //echo $header_setting->captcha_lang 
                                                                        ?>",*/
                                                                callback: function(response) {
                                                                    $("#txt_captch_error_" + grcid).val('validate');
                                                                },
                                                                expiredCallback: function(response) {
                                                                    $("#txt_captch_error_" + grcid).val('');
                                                                },
                                                                errorCallback: function(response) {
                                                                    $("#txt_captch_error_" + grcid).val('');
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                </div>
                                            <?php } else if ($captcha_type == 'gv3') { ?>
                                                <?php $details = app_setting('captcha_details');
                                                $details = json_decode($details); ?>
                                                <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $details->site ?>"></script>
                                                <input type="hidden" name="g-recaptcha-response" class="captcha-token" value="">
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 p-0">
                            <div class="form-group mb-0 mt-10">
                                <button type="submit" name="submit" class="btn btn-colored btn-theme-colored2 text-white btn-lg btn-block" data-loading-text="Please wait..."><?php echo translate('submit'); ?></button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <script type="text/javascript">
                        $("#reservation_form").validate({
                            submitHandler: function(form) {
                                var form_btn = $(form).find('button[type="submit"]');
                                var form_result_div = '#form-result';
                                $(form_result_div).remove();
                                form_btn.before('&amp;lt;div id="form-result" class="alert alert-success" role="alert" style="display: none;"&amp;gt;&amp;lt;/div&amp;gt;');
                                var form_btn_old_msg = form_btn.html();
                                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                $(form).ajaxSubmit({
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.status == 'true') {
                                            $(form).find('.form-control').val('');
                                        }
                                        form_btn.prop('disabled', false).html(form_btn_old_msg);
                                        $(form_result_div).html(data.message).fadeIn('slow');
                                        setTimeout(function() {
                                            $(form_result_div).fadeOut('slow')
                                        }, 6000);
                                    }
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
</div>
</section>
<section>
    <div class="container pb-50">
        <div class="section-content">
            <?php if (isset($announcements) && !empty($announcements)) { ?>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-uppercase line-bottom-theme-colored-2 mt-0 line-height-1"><i class="fa fa-calendar mr-10"></i>Upcoming <span class="text-theme-colored2">Events</span></h3>
                        <?php foreach ($announcements as $key => $value) { ?>
                            <article>
                                <div class="event-block">
                                    <div class="event-date text-center">
                                        <ul class="text-white font-18 font-weight-600">
                                            <li class="border-bottom"><?php echo date('d', strtotime($value->date)); ?></li>
                                            <li class=""><?php echo date('M', strtotime($value->date)); ?></li>
                                        </ul>
                                    </div>
                                    <div class="event-meta border-1px pl-40">
                                        <div class="event-content pull-left flip">
                                            <h4 class="event-title media-heading font-roboto-slab font-weight-700"><a href="#"><?php echo $value->name; ?></a></h4>
                                            <!-- <span class="mb-10 text-gray-darkgray mr-10"><i class="fa fa-clock-o mr-5 text-theme-colored2"></i> at 5.00 pm - 7.30 pm</span>
                                                <span class="text-gray-darkgray"><i class="fa fa-map-marker mr-5 text-theme-colored2"></i> 25
                                                    Newyork City</span> -->
                                            <p class="mt-5"><?php echo $value->short_description; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-uppercase line-bottom-theme-colored-2 line-height-1 mt-0 mt-sm-30">Why Us <span class="text-theme-colored2">?</span></h3>
                        <!-- <div class="panel-group accordion-stylished-left-border accordion-icon-filled accordion-no-border accordion-icon-left accordion-icon-filled-theme-colored2" id="accordion6" role="tablist" aria-multiselectable="true"> -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Predefined yearly planner (Course plan)
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Best teaching methodology
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Well experienced and result producing faculty team
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Module wise study material for each topic for each subject
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Module wise multiple revision test systems with micro analysis
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Library facility
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Dount clearance with individual counseling
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Personal mentor for every students
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Constant motivation to the students
                                </h6>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headin1">
                                <h6 class="panel-title"><span class="pe-7s-check"></span>
                                    Parent teacher interaction
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <?php } ?>
    </div>
    </div>
</section>
<?php if (isset($faculty) && !empty($faculty)) { ?>
    <section id="team" class="bg-silver-deep">
        <div class="container pb-40">
            <div class="section-title">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-uppercase title">Qualified <span class="text-theme-colored2">Teachers</span></h2>
                        <p class="text-uppercase mb-0">We Have Highly Qualified Teachers</p>
                        <div class="double-line-bottom-theme-colored-2"></div>
                    </div>
                </div>
            </div>
            <div class="row mtli-row-clearfix">
                <?php foreach ($faculty as $key => $value) { ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="team-members border-bottom-theme-colored2px text-center maxwidth400 mb-30">
                            <div class="team-thumb">
                                <img class="img-fullwidth" alt="<?php echo $value->name ?>" src="<?php echo app_file_exists(uploads_url($value->image), uploads_url('profile/default.png')); ?>">
                                <div class="team-overlay"></div>
                                <ul class="styled-icons team-social icon-sm">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-details">
                                <h4 class="text-uppercase text-theme-colored font-weight-600 m-5"><?php echo $value->name; ?></h4>
                                <h6 class="text-gray font-13 font-weight-400 line-bottom-centered mt-0"><?php echo $value->position; ?></h6>
                                <p class="hidden-md"><?php echo $value->short_description; ?></p>
                                <p class="hidden-md"><?php $teacher = json_decode($value->specialisation); ?>
                                    <?php if (!empty($teacher)) {
                                        foreach ($teacher as $ikey => $val) {
                                            echo get_column_value(TBL_SPECIALISATION, array('id' => $val), 'name');
                                        }
                                    } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>
<?php if (isset($gallery) && !empty($gallery)) { ?>
    <section id="gallery">
        <div class="container">
            <div class="section-title">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-uppercase title">Campus <span class="text-theme-colored2">Gallery</span></h2>
                        <p class="text-uppercase mb-0">See our gallery pictures</p>
                        <div class="double-line-bottom-theme-colored-2"></div>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div id="grid" class="gallery-isotope default-animation-effect grid-4 gutter clearfix">
                            <?php foreach ($gallery as $key => $value) { ?>
                                <div class="gallery-item select1">
                                    <div class="thumb">
                                        <img class="img-fullwidth" src="<?php echo uploads_url($value->image); ?>" alt="<?php echo $value->name ?>">
                                        <div class="overlay-shade"></div>
                                        <div class="icons-holder">
                                            <div class="icons-holder-inner">
                                                <div class="styled-icons icon-sm icon-bordered icon-circled icon-theme-colored2">
                                                    <a href="<?php echo home_site_url('gallery/' . $value->slug) ?>"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php /*<section class="parallax divider layer-overlay overlay-theme-colored-9" data-bg-img="<?php echo home_assets_url('images/tour.jpg'); ?>" data-parallax-ratio="0.4">
        <div class="container pt-60 pb-90">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="text-white text-uppercase font-46 font-weight-700 mb-10">Let's have a <span class="text-theme-colored2">Campus</span> Tour</h2>
                    <p class="font-16 text-white mb-20">We provides always our best industrial solution for our clientsand
                        always try to <br> achieve our client's trust and satisfaction. </p>
                    <a href="https://www.youtube.com/watch?v=kt-4lJs_8fE" data-lightbox-gallery="youtube-video"><i class="fa fa-play-circle text-theme-colored2 play-btn"></i></a>
                </div>
            </div>
        </div>
    </section>*/ ?>
<section class="parallax divider layer-overlay overlay-theme-colored-9" data-bg-img="<?php echo home_assets_url('images/tour.jpg'); ?>" data-parallax-ratio="0.4">
    <div class="container pt-60 pb-90">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-white text-uppercase font-46 font-weight-700 mb-10">Let's have a <span class="text-theme-colored2">Campus</span> Tour</h2>
                <p class="font-16 text-white mb-20">We provides always our best solution for our student always try to <br> achieve our student's trust and satisfaction. </p>
                <?php /*<a href="https://storage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" class="popup-youtube" data-lightbox-gallery="youtube-video"><i class="fa fa-play-circle text-theme-colored2 play-btn"></i></a>
                 <a href="javascript:void(0);" class="popup-youtube" data-lightbox-gallery="youtube-video"><i class="fa fa-play-circle text-theme-colored2 play-btn"></i></a>*/ ?>
            </div>
        </div>
    </div>
</section>
<?php if (isset($testimonial) && !empty($testimonial)) { ?>
    <section class="bg-silver-deep">
        <div class="container pt-70 pb-30">
            <div class="section-title">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-uppercase title">Our <span class="text-theme-colored2">Testimonial</span></h2>
                        <p class="text-uppercase mb-0">Student and Parents Opinion</p>
                        <div class="double-line-bottom-theme-colored-2"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-30">
                    <div class="owl-carousel-2col boxed" data-dots="true">
                        <?php foreach ($testimonial as $key => $value) { ?>
                            <div class="item">
                                <div class="testimonial pt-10">
                                    <div class="thumb pull-left mb-0 mr-0">
                                        <img class="img-thumbnail img-circle" alt="" src="<?php echo uploads_url($value->image); ?>" width="110">
                                    </div>
                                    <div class="testimonial-content">
                                        <h4 class="mt-0 font-weight-300"><?php echo $value->short_description; ?></h4>
                                        <h5 class="mt-10 font-16 mb-0"><?php echo $value->name; ?></h5>
                                        <h6 class="mt-5"><?php echo $value->position; ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php if (isset($home_blog) && !empty($home_blog)) { ?>
    <section id="blog">
        <div class="container pb-40">
            <div class="section-title">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-uppercase title">Latest <span class="text-theme-colored2">Blogs </span></h2>
                        <p class="text-uppercase mb-0">See All Time Latest Blogs</p>
                        <div class="double-line-bottom-theme-colored-2"></div>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel-3col owl-nav-top" data-nav="true">
                            <?php foreach ($home_blog as $key => $value) { ?>
                                <div class="item">
                                    <article class="post clearfix mb-30">
                                        <div class="entry-header">
                                            <div class="post-thumb thumb">
                                                <img src="<?php echo uploads_url($value->image); ?>" alt="" class="img-responsive img-fullwidth">
                                            </div>
                                            <div class="entry-date media-left text-center flip bg-theme-colored border-top-theme-colored2-3px pt-5 pr-15 pb-5 pl-15">
                                                <ul>
                                                    <li class="font-16 text-white font-weight-600"><?php echo date('d', strtotime($value->created_on)); ?></li>
                                                    <li class="font-12 text-white text-uppercase"><?php echo date('M', strtotime($value->created_on)); ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="entry-content p-15">
                                            <div class="entry-meta media no-bg no-border mt-0 mb-10">
                                                <div class="media-body pl-0">
                                                    <div class="event-content pull-left flip">
                                                        <h4 class="entry-title text-white text-uppercase font-weight-600 m-0 mt-5"><a href="<?php echo home_site_url('blog/' . $value->slug) ?>"><?php echo $value->name; ?></a></h4>
                                                        <ul class="list-inline">
                                                            <li><i class="fa fa-user-o mr-5 text-theme-colored2"></i>By <?php echo get_crud_user_details($value->created_by, 'name'); ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-5"><?php echo $value->short_description; ?></p>
                                            <a class="btn btn-default btn-flat font-12 mt-10 ml-5" href="<?php echo home_site_url('blog/' . $value->slug) ?>">View Details</a>
                                        </div>
                                    </article>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php if (app_setting('captcha_status', 'off') != 'off') { ?>
    <?php $captcha_type = app_setting('captcha_status', 'default'); ?>
    <?php $details = app_setting('captcha_details');
    $details = json_decode($details); ?>
    <script>
        function regenerate_captcha() {
            <?php if ($captcha_type == 'default') { ?>
                $.post('<?php echo home_site_url('api/web') ?>', {
                    action: 'generate_captcha',
                    type: 'inquiry_captcha'
                }, function(data) {
                    if (data.status) {
                        $("#inquiry_captcha").attr('src', data.details);
                        $("#txt_inquiry_captcha").val('');
                    }
                });
            <?php } else if ($captcha_type == 'gv2') { ?>
                var grcid = 'inquiry_captcha';
                $("#txt_captch_error_" + grcid).val('');
                grecaptcha.reset();
            <?php } else if ($captcha_type == 'gv3') { ?>
                grecaptcha.ready(function() {
                    grecaptcha.execute('<?php echo $details->site ?>', {
                        action: 'login'
                    }).then(function(token) {
                        if ($(".captcha-token").length) {
                            $(".captcha-token").each(function() {
                                $(this).val(token);
                            });
                        }
                    });
                });
            <?php } ?>
        }
    </script>
    <?php if ($captcha_type == 'gv3') { ?>
        <script>
            $(document).ready(function() {
                regenerate_captcha();
            });
        </script>
    <?php } ?>
<?php } ?>
<section class="clients bg-theme-colored2 ">
    <div class="container pt-10 pb-10">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel-4col  transparent text-center ">
                    <div class="item"> <a href="#"><img src="<?php echo home_assets_url('images/image1.png'); ?>" style="border-radius: 25px;" alt="<? echo $value->name ?>"></a></div>
                    <div class="item"> <a href="#"><img src="<?php echo home_assets_url('images/image2.png'); ?>" alt="<? echo $value->name ?>"></a></div>
                    <div class="item"> <a href="#"><img src="<?php echo home_assets_url('images/image3.png'); ?>" alt="<? echo $value->name ?>"></a></div>
                    <div class="item"> <a href="#"><img src="<?php echo home_assets_url('images/image4.png'); ?>" alt="<? echo $value->name ?>"></a></div>
                    <div class="item"> <a href="#"><img src="<?php echo home_assets_url('images/image5.png'); ?>" alt="<? echo $value->name ?>"></a></div>
                    <div class="item"> <a href="#"><img src="<?php echo home_assets_url('images/image6.png'); ?>" alt="<? echo $value->name ?>"></a></div>
                    <div class="item"> <a href="#"><img src="<?php echo home_assets_url('images/image7.png'); ?>" alt="<? echo $value->name ?>"></a></div>
                    <div class="item"> <a href="#"><img src="<?php echo home_assets_url('images/image8.png'); ?>" alt="<? echo $value->name ?>"></a></div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>