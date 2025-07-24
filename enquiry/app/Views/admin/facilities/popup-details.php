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
                              <td colspan="2"><?php echo '<img alt="'.get_column_value(TBL_FACILITIES,array('id'=>$id),'name').'" class="radius image-delay" src="'.uploads_url('loader.gif').'" data-src="'.uploads_url(get_column_value(TBL_FACILITIES,array('id'=>$id),'image',uploads_url('default.png'))).'">'; ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('name'); ?></th>
                              <td><?php echo get_column_value(TBL_FACILITIES,array('id'=>$id),'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('short_description') ?></th>
                              <td><?php echo get_column_value(TBL_FACILITIES,array('id'=>$id),'short_description'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('SEO_description') ?></th>
                              <td><?php echo get_column_value(TBL_FACILITIES,array('id'=>$id),'seo_description'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('SEO_keywords') ?></th>
                              <td>
                                 <?php $keywords = get_column_value(TBL_FACILITIES,array('id'=>$id),'seo_keywords'); $keywords = explode(",",$keywords); if(!empty($keywords)){foreach ($keywords as $keyword) { echo '<span class="badge bg-primary">'.$keyword.'</span>'; } } ?>
                              </td>
                           </tr>
                           <tr>
                              <td colspan="2">
                                 <strong><?php echo translate('description') ?></strong><br/><hr/>
                                 <?php echo get_column_value(TBL_FACILITIES,array('id'=>$id),'description'); ?>
                              </td>
                           </tr>
                           <?php $i=0; $images = json_decode(get_column_value(TBL_FACILITIES,array('id'=>$id),'images')); ?>
                           <?php if(!empty($images)){ ?>
                              <tr>
                                 <td colspan="2">
                                    <strong><?php echo translate('images') ?></strong><br/><hr/>
                                    <div class="demo-avatar-group d-flex">
                                       <?php foreach ($images as $key => $value) { ?>
                                          <div class="main-img-user avatar-xl my-2 ">
                                             <a data-fancybox="images" data-src="<?php echo uploads_url($value); ?>">
                                                <img alt="images" class="radius cursor-pointer image-delay" src="<?php echo uploads_url('loader.gif') ?>" data-src="<?php echo uploads_url($value); ?>">
                                             </a>
                                          </div>
                                       <?php } ?>
                                    </div>
                                 </td>
                              </tr>
                           <?php } ?>
                           <?php $status = get_column_value(TBL_FACILITIES,array('id'=>$id),'is_active'); ?>
                           <tr>
                              <th><?php echo translate('status'); ?></th>
                              <td><span class="badge bg-<?php echo $status=='1' ? 'success' : 'danger' ?>"><?php echo $status=='1' ? translate('active') : translate('inactive') ?></span></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('created_by'); ?></th>
                              <td><?php echo get_crud_user_details(get_column_value(TBL_FACILITIES,array('id'=>$id),'created_by'),'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('created_on') ?></th>
                              <td><?php echo utc_to_local_datetime(get_column_value(TBL_FACILITIES,array('id'=>$id),'created_on')); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('updated_by') ?></th>
                              <td><?php echo get_crud_user_details(get_column_value(TBL_FACILITIES,array('id'=>$id),'updated_by'),'name'); ?></td>
                           </tr>
                           <tr>
                              <th><?php echo translate('updated_on') ?></td>
                              <td><?php echo utc_to_local_datetime(get_column_value(TBL_FACILITIES,array('id'=>$id),'updated_on')); ?></td>
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