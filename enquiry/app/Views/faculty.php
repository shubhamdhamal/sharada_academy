<div class="main-content">
  <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/course-bg.jpg') ?>">
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
                                    <img class="img-fullwidth" alt="<?php echo $value->name ?>" src="<?php echo app_file_exists( uploads_url($value->image),uploads_url('profile/default.png')); ?>">
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
</div>