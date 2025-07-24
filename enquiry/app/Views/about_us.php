<div class="main-content">
    <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/tour.jpg'); ?>">
      <div class="container pt-120 pb-60">
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-6">
              <h2 class="text-theme-colored2 font-36"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
              <ol class="breadcrumb text-left mt-10 white">
                <li><a href="<?php echo home_site_url() ?>"><?php echo translate('home') ?></a></li>
                <li class="active"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
              </ol>
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
                        <img class="img-fullwidth maxwidth500" src="<?php echo home_assets_url('images/sharda-academy.png'); ?>" alt="about-us">
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30">About <span class="text-theme-colored2">Sharda Academy</span></h2>
                        <div class="double-line-bottom-theme-colored-2"></div>
                        <p>We provide best education under Integrated Course for th, th th ScienceCollege coaching under one roof. Std.th th Science Board and JEENEETMHT CET Entrance Exams. st to th Regular batches for Mathematics, Science, English, SSTMarathiEnglishSemi English Medium for SSCCBSE board</p>
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
                        <p><span class="pe-7s-check"></span>To Provide an environment to improve the self understanding and compete with the world with an excellent growth</p>
                        <p><span class="pe-7s-check"></span>To teach the students with an innovative ideas to make them Interest in the subjects</p>
                        <p><span class="pe-7s-check"></span>To motivate students by providing new facilities to crack the JEE/NEET/MHT-CET/KVPY</p>
                        <p><span class="pe-7s-check"></span>To focus on the concept clarity through advanced and fundamental teaching techniques</p>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fullwidth maxwidth500" src="<?php echo home_assets_url('images/mission.png'); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="reservation" class="parallax layer-overlay overlay-theme-colored-9" data-bg-img="<?php echo home_assets_url('images/register.png') ?>" data-parallax-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-8 sm-text-center">
                    <h3 class="text-white mt-30 mb-0">Get a Free online Registration</h3>
                    <h2 class="text-theme-colored2 font-54 mt-0">Register Now!</h2>
                    <p class="text-gray-darkgray font-15 pr-90 pr-sm-0 mb-sm-60">Lorem ipsum dolor sit amet, consectetur
                        adipisicing elit. Aperiam suscipit fugiat sint totam soluta assumenda quasi reprehenderit, quas. Natus
                        voluptatibus perferendis repellendus provident? Amet rerum quis odio voluptas dolorem placeat soluta sit
                        officiis odit velit! Nihil qui placeat quibusdam, voluptates voluptatum et.</p>
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
                                <h2 data-animation-duration="2000" data-value="675" class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
                                <h5 class="text-white text-uppercase">Approved Courses</h5>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                            <div class="funfact">
                                <i class="pe-7s-users mb-20 text-theme-colored2"></i>
                                <h2 data-animation-duration="2000" data-value="675" class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
                                <h5 class="text-white text-uppercase">Certified Teachers</h5>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                            <div class="funfact">
                                <i class="pe-7s-study mb-20 text-theme-colored2"></i>
                                <h2 data-animation-duration="2000" data-value="1248" class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
                                <h5 class="text-white text-uppercase">Graduate Students</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-50 mt-0 bg-dark-transparent-2 inquiry_result text-center" >
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
                                        <input placeholder="Phone" id="reservation_phone" name="phone" class="form-control" required="" aria-required="true" type="text" pattern="^[6-9]\d{9}$" inputmode="numeric" maxlength="10" >
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
                                                <?php if(app_setting('captcha_status','off')!='off'){ ?>
                                                    <?php $captcha_type = app_setting('captcha_status','default'); ?>
                                                        <?php if($captcha_type=='default'){ ?>
                                                            <div class="form-group text-start">
                                                                <?php echo form_label(translate('captcha').' <span class="text-danger">*</span>', 'captcha'); ?>
                                                                <small class="text-muted font-10"><i>(<?php echo translate('click_on_image_to_regenerate_new_captcha'); ?>)</i></small>
                                                                <div class="d-flex">
                                                                    <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 col-6">
                                                                        <?php echo form_input('captcha_token','',['class'=>'form-control','placeholder'=>translate('enter_captcha'),'id'=>'txt_inquiry_captcha','data-parsley-errors-container'=>'#error_captcha','autocomplete'=>'off','required'=>"required"],'text');?>
                                                                    </div>
                                                                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 col-6">
                                                                        <img src="<?php echo get_captcha('default', 'inquiry_captcha')->img; ?>" id="inquiry_captcha" class="img-responsive cursor-pointer referesh-captcha" alt="<?php echo translate('default_captcha') ?>" data-toggle="tooltip" data-placement="top" title="<?php echo translate('click_to_regenerate_new_captcha'); ?>">
                                                                    </div>
                                                                </div>
                                                                <span id="error_captcha"></span>
                                                            </div>
                                                        <?php }else if($captcha_type=='gv2'){ ?>
                                                            <div class="form-group text-start">
                                                                <?php echo get_captcha($captcha_type, 'inquiry_captcha'); ?>
                                                                <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>    
                                                                <script>
                                                                    var onloadCallback = function() {
                                                                        var grcid = 'inquiry_captcha';
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
                       <?php echo form_close();?>
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
                                    <img class="img-fullwidth"  alt="<?php echo $value->name ?>" src="<?php echo app_file_exists( uploads_url($value->image),uploads_url('profile/default.png')); ?>">
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
                                    <p class="hidden-md">
                                    <?php  $teacher = json_decode($value->specialisation); ?>
                                    <?php if(!empty($teacher)){ foreach ($teacher as $ikey => $val) { echo get_column_value(TBL_SPECIALISATION,array('id'=>$val),'name'); } } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
                    <p class="font-16 text-white mb-20">We provides always our best industrial solution for our clientsand
                        always try to <br> achieve our client's trust and satisfaction. </p>
                    <a href="https://storage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" class="popup-youtube"  data-lightbox-gallery="youtube-video"><i class="fa fa-play-circle text-theme-colored2 play-btn"></i></a>
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
                            <h2 class="text-uppercase title">What <span class="text-theme-colored2">People </span>Say</h2>
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
  </div>
  <?php if(app_setting('captcha_status','off')!='off'){ ?>
        <?php $captcha_type = app_setting('captcha_status','default'); ?>
        <?php $details = app_setting('captcha_details');
        $details = json_decode($details); ?>
        <script>
            function regenerate_captcha(){
                <?php if($captcha_type=='default'){ ?>
                    $.post('<?php echo home_site_url('api/web') ?>',{action:'generate_captcha', type:'inquiry_captcha'},function(data) {
                        if(data.status){
                            $("#inquiry_captcha").attr('src',data.details);
                            $("#txt_inquiry_captcha").val('');
                        }
                    });
                <?php }else if($captcha_type=='gv2'){ ?>
                    var grcid = 'inquiry_captcha';
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