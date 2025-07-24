<div class="modal d-block pos-static">
   <div class="modal-dialog" user="document">
      <div class="modal-content modal-content-demo shadow">
         <div class="modal-header">
            <h6 class="modal-title"><?php echo translate($page_title) ?></h6>
            <button aria-label="Close" class="btn-close close-popup" type="button"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover mg-b-0">
                        <tbody>
                           <tr>
                              <th><?php echo translate('name'); ?></th>
                              <td><?php echo get_column_value(TBL_EXAM_REGISTRATION,array('id'=>$id),'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('student_phone_no'); ?></th>
                              <td><?php echo get_column_value(TBL_EXAM_REGISTRATION,array('id'=>$id),'student_mobile_no'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('school_name'); ?></th>
                              <td><?php echo get_column_value(TBL_EXAM_REGISTRATION,array('id'=>$id),'school_name'); ?></td>
                           </tr>
                           <?php $crash_course = get_column_value(TBL_EXAM_REGISTRATION,array('id'=>$id),'crash_course');
                                switch($crash_course) {
                                    case 0:
                                        $course = 'MHT-CET';
                                        break;
                                    case 1:
                                        $course = 'NEET';
                                        break;
                                    case 2:
                                        $course = 'JEE';
                                        break;
                                    default:
                                        $course = 'Unknown';
                                } ?>
                           <tr>
                              <th><?php echo translate('carsh_course'); ?></th>
                              <td><?php echo $course; ?></td>
                           </tr>
                           <?php $medium = get_column_value(TBL_EXAM_REGISTRATION,array('id'=>$id),'medium');
                                switch($medium) {
                                    case 0:
                                        $gp = 'English';
                                        break;
                                    case 1:
                                        $gp = 'Semi English';
                                        break;
                                    case 2:
                                        $gp = 'Marathi';
                                        break;
                                    default:
                                        $gp = 'Unknow';
                                } ?>
                           <tr>
                              <th><?php echo translate('medium'); ?></th>
                              <td><?php echo $gp; ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('address'); ?></th>
                              <td><?php echo get_column_value(TBL_EXAM_REGISTRATION,array('id'=>$id),'address'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('created_on') ?></th>
                              <td><?php echo utc_to_local_datetime(get_column_value(TBL_EXAM_REGISTRATION,array('id'=>$id),'created_on')); ?></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button class="btn ripple close-popup btn-secondary" type="button"><?php echo translate('close'); ?></button>
         </div>
      </div>
   </div>
</div>