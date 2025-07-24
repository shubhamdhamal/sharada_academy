<div class="modal d-block pos-static">
   <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
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
                              <td class="text-center" colspan="2">
                                 <?php
                                 echo '<img alt="' . get_column_value(TBL_CATEGORY, array('id' => $id), 'name') . '" class="radius image-delay" src="' . uploads_url('loader.gif') . '" data-src="' . uploads_url(get_column_value(TBL_CATEGORY, array('id' => $id), 'image', uploads_url('default.png'))) . '">';
                                 ?>
                              </td>
                           </tr>
                           <tr>
                              <th><?php echo translate('name'); ?></th>
                              <td><?php echo get_column_value(TBL_CATEGORY, array('id' => $id), 'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('parent'); ?></th>
                              <td><?php echo get_category_path_name_string(get_column_value(TBL_CATEGORY, array('id' => $id), 'path')); ?></td>
                           </tr>
                           <?php $status = get_column_value(TBL_CATEGORY, array('id' => $id), 'is_active'); ?>
                           <tr>
                              <th><?php echo translate('status'); ?></th>
                              <td><span class="badge bg-<?php echo $status == '1' ? 'success' : 'danger' ?>"><?php echo $status == '1' ? translate('active') : translate('inactive') ?></span></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('created_by'); ?></th>
                              <td><?php echo get_crud_user_details(get_column_value(TBL_CATEGORY, array('id' => $id), 'created_by'), 'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('created_on') ?></th>
                              <td><?php echo utc_to_local_datetime(get_column_value(TBL_CATEGORY, array('id' => $id), 'created_on')); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('updated_by') ?></th>
                              <td><?php echo get_crud_user_details(get_column_value(TBL_CATEGORY, array('id' => $id), 'updated_by'), 'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('updated_on') ?></td>
                              <td><?php echo utc_to_local_datetime(get_column_value(TBL_CATEGORY, array('id' => $id), 'updated_on')); ?></td>
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