<?php echo form_open(admin_site_url('settings/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab)); ?>
   <div class="card custom-card">
      <div class="card-header custom-card-header">
         <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('basic') ?></h5>
         <div class="card-options">
            <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
         </div>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-12 col-sm-4">
               <div class="form-group">
                  <?php
                     echo form_label(translate('app_title').' <span class="text-danger">*</span>', 'app_title');
                     echo form_input('app_title',app_setting('app_title'),['class'=>'form-control','placeholder'=>translate('enter_app_title'),'required'=>"required"],'text');
                  ?>
               </div>
            </div>
            <div class="col-12 col-sm-4">
               <div class="form-group">
                  <?php
                     echo form_label(translate('app_short_title').' <span class="text-danger">*</span>', 'app_short_title');
                     echo form_input('app_short_title',app_setting('app_short_title'),['class'=>'form-control','placeholder'=>translate('enter_app_short_title'),'required'=>"required"],'text');
                  ?>
               </div>
            </div>
            <div class="col-12 col-sm-4">
               <?php
                  $lang = array();
                  foreach ($language as $key => $value) {
                     $lang[$value->slug] = $value->name;
                  }
               ?>
               <div class="form-group">
                  <?php 
                     echo form_label(translate('app_language').' <span class="text-danger">*</span>', 'app_language');
                     echo form_dropdown('app_language', $lang, app_setting('app_language'),array('class'=>'form-control select2','required'=>true));
                  ?>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12 col-sm-4">
               <?php $timezone = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
               <div class="form-group">
                  <?php
                     echo form_label(translate('app_timezone').' <span class="text-danger">*</span>', 'app_timezone');
                     echo form_dropdown('app_timezone', $timezone, app_setting('app_timezone'),array('class'=>'form-control select2','required'=>true));
                  ?>
               </div>
            </div>
            <?php
               $date_format = array (
                  'Y-m-d'  => "(YYYY-MM-DD)     &nbsp; ".date('Y-m-d'), 
                  'Y.m.d'  => "(YYYY.MM.DD)     &nbsp; ".date('Y.m.d'),
                  'Y/m/d'  => "(YYYY/MM/DD)     &nbsp; ".date('Y/m/d'),
                  'd/m/Y'  => "(DD/MM/YYYY)     &nbsp; ".date('d/m/Y'),
                  'd-m-Y'  => "(DD-MM-YYYY)     &nbsp; ".date('d-m-Y'),
                  'd-M-Y'  => "(DD-MMM-YYYY)    &nbsp; ".date('d-M-Y'),
                  'M d, Y' => "(MMM DD, YYYY)   &nbsp; ".date('M d, Y'),
                  'F d, Y' => "(MMMM DD, YYYY)  &nbsp; ".date('F d, Y')
               );
            ?>
            <div class="col-12 col-sm-4">
               <div class="form-group">
                  <?php
                     echo form_label(translate('app_date_format').' <span class="text-danger">*</span>', 'app_date_format');
                     echo form_dropdown('app_date_format', $date_format, app_setting('app_date_format'),array('class'=>'form-control select2','required'=>true));
                  ?>
               </div>
            </div>
            <?php
               $timeobj=strtotime('23:59:59');
               $time_format=array (
                  'H:i:s'     => "24 H (HH:MM:SS)      &nbsp; ".date('H:i:s',$timeobj), 
                  'H:i'       => "24 H (HH:MM)         &nbsp; ".date('H:i',$timeobj),
                  'h:i:s A'   => "12 H (HH:MM:SS PM)   &nbsp; ".date('h:i:s A',$timeobj),
                  'h:i A'     => "12 H (HH:MM PM)      &nbsp; ".date('h:i A',$timeobj),
               );
            ?>
            <div class="col-12 col-sm-4">
               <div class="form-group">
                  <?php
                     echo form_label(translate('app_time_format').' <span class="text-danger">*</span>', 'app_time_format');
                     echo form_dropdown('app_time_format', $time_format, app_setting('app_time_format'),array('class'=>'form-control select2','required'=>true));
                  ?>
               </div>
            </div>
            <div class="col-12 col-sm-12">
               <div class="form-group">
                  <?php
                     echo form_label(translate('app_footer_credit').' <span class="text-danger">*</span>', 'app_footer_credit');
                     echo form_textarea('app_footer_credit',app_setting('app_footer_credit'),['class'=>'form-control','placeholder'=>translate('enter_app_footer_credit'),'required'=>"required","rows"=>2],'text');
                  ?>
               </div>
            </div>
         </div>
         <hr/>
         <div class="row">
            <div class="col-12 col-sm-4">
               <label class="custom-switch">
                  <span class="custom-switch-description"><?php echo translate('disable_password_reset'); ?></span>
                  &nbsp;&nbsp;
                  <input type="checkbox" name="app_disable_password_reset" class="custom-switch-input"  <?php echo app_setting('app_disable_password_reset','off')=='on' ? 'checked' : ''; ?>>
                  <span class="custom-switch-indicator"></span>
               </label>
            </div>
            <div class="col-12 col-sm-8">
               <small class="text-muted"><i><?php echo translate("registration_of_user._if_you_disable_this_then_user_can't_reset_password"); ?></i></small>
            </div>
         </div>
         <hr/>
         <div class="row">
            <div class="col-12 col-sm-4">
               <label class="custom-switch">
                  <span class="custom-switch-description"><?php echo translate('maintenance_mode'); ?></span>
                  &nbsp;&nbsp;
                  <input type="checkbox" name="app_maintenance_mode" class="custom-switch-input"  <?php echo app_setting('app_maintenance_mode','off')=='on' ? 'checked' : ''; ?>>
                  <span class="custom-switch-indicator"></span>
               </label>
            </div>
            <div class="col-12 col-sm-8">
               <small class="text-muted"><i><?php //echo translate("registration_of_user._if_you_disable_this_then_user_can't_reset_password"); ?></i></small>
            </div>
         </div>
         <hr/>
         <div class="row">
            <div class="col-12 col-sm-4">
               <label class="custom-switch">
                  <span class="custom-switch-description"><?php echo translate('disable_registration'); ?></span>
                  &nbsp;&nbsp;
                  <input type="checkbox" name="app_disable_registration" class="custom-switch-input"  <?php echo app_setting('app_disable_registration','off')=='on' ? 'checked' : ''; ?>>
                  <span class="custom-switch-indicator"></span>
               </label>
            </div>
            <div class="col-12 col-sm-8">
               <small class="text-muted"><i><?php echo translate("registration_of_user._if_you_disable_this_then_visitor_can't_register"); ?></i></small>
            </div>
         </div>
         <hr/>
         <div class="row">
            <div class="col-12 col-sm-4">
               <label class="custom-switch">
                  <span class="custom-switch-description"><?php echo translate('disable_google_font'); ?></span>
                  &nbsp;&nbsp;
                  <input type="checkbox" name="app_disable_google_font" class="custom-switch-input"  <?php echo app_setting('app_disable_google_font','off')=='on' ? 'checked' : ''; ?>>
                  <span class="custom-switch-indicator"></span>
               </label>
            </div>
            <div class="col-12 col-sm-8">
               <small class="text-muted"><i><?php echo translate("if_you_enable_it,_google_font_won't_load_in_site"); ?></i></small>
            </div>
         </div>
         <div class="row">
            <div class="col-12"><hr/></div>
            <div class="col-12 text-center">
               <?php echo form_button(['content' => translate('save'),'type'=>'submit','class'=>'btn ripple btn-main-primary','data-loading-text'=>"<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> ".translate('please_wait...')]); ?>
            </div>
         </div>
      </div>
   </div>
<?php echo form_close(); ?>