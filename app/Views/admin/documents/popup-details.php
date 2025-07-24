<div class="modal d-block pos-static">
   <div class="modal-dialog" role="document">
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
                              <td><?php echo get_column_value(TBL_DOCUMENTS,array('id'=>$id),'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('URL'); ?></th>
                              <td><?php echo get_column_value(TBL_DOCUMENTS,array('id'=>$id),'url'); ?></td>
                           </tr>
                           <?php $type = get_column_value(TBL_DOCUMENTS,array('id'=>$id),'type'); 
                            switch ($type) {
                              case '1':
                                  $doc_type = 'Library';
                                break;
                              case '2':
                                  $doc_type = 'Gym';
                                break;
                              case '3':
                                  $doc_type = 'Arts';
                                break;
                                case '4':
                                  $doc_type = 'Commerce';
                                break;
                                case '5':
                                  $doc_type = 'Science';
                                break;
  
                              default:
                                $doc_type = 'unknow';
                            }
                           ?>
                           <tr>
                              <th><?php echo translate('type'); ?></th>
                              <td><span><?php echo $doc_type; ?></span></td>
                           </tr>
                           <?php $status = get_column_value(TBL_DOCUMENTS,array('id'=>$id),'is_active'); ?>
                           <tr>
                              <th><?php echo translate('status'); ?></th>
                              <td><span class="badge bg-<?php echo $status=='1' ? 'success' : 'danger' ?>"><?php echo $status=='1' ? translate('active') : translate('inactive') ?></span></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('created_by'); ?></th>
                              <td><?php echo get_crud_user_details(get_column_value(TBL_DOCUMENTS,array('id'=>$id),'created_by'),'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('created_on') ?></th>
                              <td><?php echo utc_to_local_datetime(get_column_value(TBL_DOCUMENTS,array('id'=>$id),'created_on')); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('updated_by') ?></th>
                              <td><?php echo get_crud_user_details(get_column_value(TBL_DOCUMENTS,array('id'=>$id),'updated_by'),'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('updated_on') ?></td>
                              <td><?php echo utc_to_local_datetime(get_column_value(TBL_DOCUMENTS,array('id'=>$id),'updated_on')); ?></td>
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