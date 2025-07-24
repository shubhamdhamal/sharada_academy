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
                              <td><?php echo get_column_value(TBL_INQUIRY,array('id'=>$id),'name'); ?></td>
                           </tr>
                          
                           <tr>
                              <th><?php echo translate('phone_no'); ?></th>
                              <td><?php echo get_column_value(TBL_INQUIRY,array('id'=>$id),'phone'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('course'); ?></th>
                              <td><?php echo get_column_value(TBL_COURSE,array('id'=>get_column_value(TBL_INQUIRY,array('id'=>$id),'course')),'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('message'); ?></th>
                              <td><?php echo get_column_value(TBL_INQUIRY,array('id'=>$id),'message'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('created_on') ?></th>
                              <td><?php echo utc_to_local_datetime(get_column_value(TBL_INQUIRY,array('id'=>$id),'created_on')); ?></td>
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