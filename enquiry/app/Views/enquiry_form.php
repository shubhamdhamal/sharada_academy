<div class="main-content"> 
    <section id="home" class="divider parallax layer-overlay overlay-dark-9" data-bg-img="http://placehold.it/1920x820">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container pb-100">
            <div class="row">
              <div class="col-md-6 col-md-push-3 course_result">
                <div class="text-center mb-30"><a href="<?php echo home_site_url() ?>" class=""><img alt="<?php echo app_setting('app_title'); ?>" src="<?php echo uploads_url('logo.png'); ?>" class="img-fit" width="40%"></a></div>
                <div class="bg-lightest border-1px p-25">
                  <h4 class="text-theme-colored text-uppercase m-0">ENQUIRY FORM FOR MHT-CET/NEET CRASH COURSE</h4>
                  <div class="line-bottom mb-30"></div>
                    <?php echo form_open(home_site_url('api/web'), array('class' => 'data-parsley-validate mt-30', 'method' => 'post', 'id' => 'appointment_form'), array('action' => 'couser_enquiry')); ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group mb-10">
                                    <label><strong><?php echo translate('student_name') ?></strong></label><span class="text-danger"> * </span>
                                    <input name="name" class="form-control" type="text" required="" placeholder="<?php echo translate('enter_student_name') ?>" aria-required="true">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-10">
                                    <label><strong><?php echo translate('student_email_id') ?></strong></label>
                                    <input name="email_id" class="form-control email" type="email" placeholder="<?php echo translate('enter_student_email') ?>">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-10">
                                    <label><strong><?php echo translate('student_mobile_no') ?></strong></label><span class="text-danger"> * </span>
                                    <input name="student_mobile_no" class="form-control required" type="text" pattern="^[6-9]\d{9}$" inputmode="numeric" maxlength="10" placeholder="<?php echo translate('enter_student_mobile_no') ?>" aria-required="true" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-10">
                                    <label><strong><?php echo translate('parent_mobile_no') ?></strong></label><span class="text-danger"> * </span>
                                    <input name="parent_mobile_no" class="form-control required" type="text" pattern="^[6-9]\d{9}$" inputmode="numeric" maxlength="10" placeholder="<?php echo translate('enter_parent_mobile_no') ?>" aria-required="true" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-20">
                                    <label><strong><label><strong><?php echo translate('willing_to_take_admission_for_crash_course') ?></strong></label></strong></label><span class="text-danger"> * </span>
                                    <select name="crash_course" class="form-control required" data-parsley-errors-container ="#error_course" required>
                                        <option value="">Select course</option>
                                        <option value="0">MHT-CET</option>
                                        <option value="1">NEET</option>
                                        <option value="2">Both</option>
                                    </select>
                                    <span id="error_course"></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-20">
                                    <label><strong><label><strong><?php echo translate('group_subjects') ?></strong></label></strong></label><span class="text-danger"> * </span>
                                    <select name="group" class="form-control required" data-parsley-errors-container ="#error_group" required>
                                        <option value="">Select Group</option>
                                        <option value="0">PCM</option>
                                        <option value="1">PCB</option>
                                        <option value="2">Both</option>
                                    </select>
                                    <span id="error_group"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-10">
                            <label><strong><label><strong><?php echo translate('address') ?></strong></label></strong></label><span class="text-danger">*</span>
                            <textarea name="address" class="form-control required"  placeholder="<?php echo translate('enter_address') ?>" rows="5" aria-required="true" required></textarea>
                        </div>
                        <div class="form-group mb-20">
                        <?php if(app_setting('captcha_status','off')!='off'){ ?>
                            <?php $captcha_type = app_setting('captcha_status','default'); ?>
                            <?php if($captcha_type=='default'){ ?>
                                    <div class="form-group text-start">
                                        <?php echo form_label(translate('captcha').' <span class="text-danger">*</span>', 'captcha'); ?>
                                        <small class="text-muted font-10"><i>(<?php echo translate('click_on_image_to_regenerate_new_captcha'); ?>)</i></small>
                                        <div class="d-flex">
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 col-9">
                                            <?php
                                                echo form_input('captcha_token','',['class'=>'form-control','placeholder'=>translate('enter_captcha'),'id'=>'txt_course_captcha','data-parsley-errors-container'=>'#error_captcha','autocomplete'=>'off','required'=>"required"],'text');
                                            ?>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                            <img src="<?php echo get_captcha('default','course_captcha')->img; ?>" id="course_captcha" height="50px;" class="img-responsive cursor-pointer referesh-captcha" alt="<?php echo translate('default_captcha') ?>" data-toggle="tooltip" data-placement="top" title="<?php echo translate('click_to_regenerate_new_captcha'); ?>">
                                        </div>
                                        </div>
                                        <span id="error_captcha"></span>
                                    </div>
                                <?php }else if($captcha_type=='gv2'){ ?>
                                    <div class="form-group text-start">
                                        <?php echo get_captcha($captcha_type, 'course_captcha'); ?>
                                        <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>    
                                        <script>
                                            var onloadCallback = function() {
                                                var grcid = 'course_captcha';
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
                        <div class="form-group mb-0 mt-60">
                            <button type="submit" class="btn btn-dark btn-theme-colored btn-lg btn-block" data-loading-text="Please wait...">Submit</button>
                        </div>
                    <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php if(app_setting('captcha_status','off')!='off'){ ?>
    <?php $captcha_type = app_setting('captcha_status','default'); ?>
    <?php $details = app_setting('captcha_details');
    $details = json_decode($details); ?>
    <script>
        function regenerate_captcha(){
            <?php if($captcha_type=='default'){ ?>
                $.post('<?php echo home_site_url('api/web') ?>',{action:'generate_captcha', type:'course_captcha'},function(data) {
                    if(data.status){
                        $("#course_captcha").attr('src',data.details);
                        $("#txt_course_captcha").val('');
                    }
                });
            <?php }else if($captcha_type=='gv2'){ ?>
                var grcid = 'course_captcha';
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