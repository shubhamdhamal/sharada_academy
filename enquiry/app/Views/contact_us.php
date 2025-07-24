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
    <section class="divider">
    <div class="container pt-50 pb-70">
        <div class="row pt-10">
        <div class="col-md-5">
            <h4 class="mt-0 mb-30 line-bottom-theme-colored-2 ">Find Our Location</h4>
            <iframe width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=500&amp;hl=en&amp;q=+(sharada+academy+baramati)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
        <div class="col-md-7 contact_result text-center">
            <h4 class="mt-0 mb-30 line-bottom-theme-colored-2 ">Interested in discussing?</h4>
            <?php echo form_open(home_site_url('api/web'), array('class' => 'data-parsley-validate mt-2  reservation-form mt-20', 'method' => 'post', 'id' => 'contact-form'), array('action' => 'contact')); ?>
                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group mb-30">
                        <input id="form_name" name="name" class="form-control" type="text" placeholder="Enter Name" required>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group mb-30">
                        <input id="form_email" name="email" class="form-control required email" type="email" placeholder="Enter Email" required>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group mb-30">
                        <input id="form_subject" name="subject" class="form-control required" type="text" placeholder="Enter Subject" required>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group mb-30">
                        <input id="form_phone" name="phone" class="form-control" type="text" placeholder="Enter Phone" pattern="^[6-9]\d{9}$" inputmode="numeric" maxlength="10" required>
                    </div>
                    </div>
                </div>
                <div class="form-group mb-30">
                    <textarea id="form_message" name="message" class="form-control required" rows="7" placeholder="Enter Message" required></textarea>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <?php if(app_setting('captcha_status','off')!='off'){ ?>
                        <?php $captcha_type = app_setting('captcha_status','default'); ?>
                        <?php if($captcha_type=='default'){ ?>
                                <div class="form-group text-start">
                                    <?php echo form_label(translate('captcha').' <span class="text-danger">*</span>', 'captcha'); ?>
                                    <small class="text-muted"><i>(<?php echo translate('click_on_image_to_regenerate_new_captcha'); ?>)</i></small>
                                    <div class="d-flex">
                                    <div class="col-lg-9 col-md- col-sm-9">
                                        <?php
                                            echo form_input('captcha_token','',['class'=>'form-control','placeholder'=>translate('enter_captcha'),'id'=>'txt_contact_captcha','data-parsley-errors-container'=>'#error_captcha','autocomplete'=>'off','required'=>"required"],'text');
                                        ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <img src="<?php echo get_captcha('default', 'contact_captcha')->img; ?>" id="contact_captcha" class="img-responsive cursor-pointer referesh-captcha" alt="<?php echo translate('default_captcha') ?>" data-toggle="tooltip" data-placement="top" title="<?php echo translate('click_to_regenerate_new_captcha'); ?>">
                                    </div>
                                    </div>
                                    <span id="error_captcha"></span>
                                </div>
                            <?php }else if($captcha_type=='gv2'){ ?>
                                <div class="form-group text-start">
                                    <?php echo get_captcha($captcha_type, 'contact_captcha'); ?>
                                    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>    
                                    <script>
                                        var onloadCallback = function() {
                                            var grcid = 'contact_captcha';
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
                <div class="form-group">
                    <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
                        <button type="submit" name="submit" class="btn btn-flat btn-theme-colored2 bg-hover-theme-colored mr-5"
                    data-loading-text="Please wait...">Send your message</button>
                    <button type="reset" class="btn btn-flat  bg-hover-theme-colored btn-primary ">Reset</button>
                </div>
            <?php echo form_close() ?>
        </div>
        </div>
        <div class="row mt-60">
            <div class="col-sm-12 col-md-4">
                <div class="contact-info text-center bg-silver-light border-1px pt-60 pb-60">
                <i class="fa fa-phone font-36 mb-10 text-theme-colored2"></i>
                <h4>Call Us</h4>
                <h6 class="text-gray"><a class="text-gray" href="tel: +91 9271585443">+91 9271585443</a></h6>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="contact-info text-center bg-silver-light border-1px pt-60 pb-60">
                <i class="fa fa-map-marker font-36 mb-10 text-theme-colored2"></i>
                <h4>Address</h4>
                <h6 class="text-gray">
                    Near Bank of Maharashtra, opp. V.P. College, Maharashtra Industrial Development Corporation Area, Baramati, Maharashtra 413133</h6>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="contact-info text-center bg-silver-light border-1px pt-60 pb-60">
                <i class="fa fa-envelope font-36 mb-10 text-theme-colored2"></i>
                <h4>Email</h4>
                    <h6 class="text-gray">
                        <a class="text-gray" href="mailto: info@sharadaacademy.com">info@sharadaacademy.com</a> 
                    </h6>
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
                    $.post('<?php echo home_site_url('api/web') ?>',{action:'generate_captcha', type:'contact_captcha'},function(data) {
                        if(data.status){
                            $("#contact_captcha").attr('src',data.details);
                            $("#txt_contact_captcha").val('');
                        }
                    });
                <?php }else if($captcha_type=='gv2'){ ?>
                    var grcid = 'contact_captcha';
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
    </section>
</div>