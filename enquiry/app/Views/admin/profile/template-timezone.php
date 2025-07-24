<div class="tab-pane <?php echo isset($is_tab_active) && $is_tab_active==true ? 'active' : ''; ?>" id="<?php echo $tab_name ?>">
   <?php echo form_open(admin_site_url('profile/crud'), array('class'=>'data-parsley-validate', 'method'=>'post','data-block_form'=>'true'), array('action'=>$tab_name)); ?>
      <div class="row">
         <div class="col-12 col-sm-12">
            <?php
               $tzlist = array();
               $tz = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
               if(isset($tz) && !empty($tz)){ foreach ($tz as $key => $value) { $tzlist[$value] = $value; } }
            ?>
            <div class="form-group">
               <label><?php echo translate('timezone'); ?> <span class="text-danger">*</span></label>
               <?php echo form_dropdown('timezone', $tzlist, get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'timezone'),array('class'=>'form-control select2','required'=>true)); ?>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12 col-sm-6">
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
            <div class="form-group">
               <label><?php echo translate('date_format'); ?> <span class="text-danger">*</span></label>
               <?php echo form_dropdown('date_format', $date_format, get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'date_format'),array('class'=>'form-control select2','required'=>true)); ?>
            </div>
         </div>
         <div class="col-12 col-sm-6">
            <?php
               $timeobj=strtotime('23:59:59');
               $time_format=array (
                  'H:i:s'     => "24 H (HH:MM:SS)      &nbsp; ".date('H:i:s',$timeobj), 
                  'H:i'       => "24 H (HH:MM)         &nbsp; ".date('H:i',$timeobj),
                  'h:i:s A'   => "12 H (HH:MM:SS PM)   &nbsp; ".date('h:i:s A',$timeobj),
                  'h:i A'     => "12 H (HH:MM PM)      &nbsp; ".date('h:i A',$timeobj),
               );
            ?>
            <div class="form-group">
               <label><?php echo translate('time_format'); ?> <span class="text-danger">*</span></label>
               <?php echo form_dropdown('time_format', $time_format, get_column_value(TBL_ADMIN,array('id'=>user_setting('user_id')),'time_format'),array('class'=>'form-control select2','required'=>true)); ?>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12"><hr/></div>
         <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary mt-2 mr-1" tabindex="4" data-loading-text="<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> <?php echo translate('please_wait...'); ?>"><i data-feather='save'></i> <?php echo translate('save'); ?></button>
         </div>
      </div>
   <?php echo form_close(); ?>
</div>