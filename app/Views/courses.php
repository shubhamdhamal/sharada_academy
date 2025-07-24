<div class="main-content">
      <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/course-bg.jpg') ?>">
        <div class="container pt-120 pb-60">
          <div class="section-content">
            <div class="row">
              <div class="col-md-6">
                <h2 class="text-theme-colored2 font-36"><?php echo translate('courses') ?></h2>
                <ol class="breadcrumb text-left mt-10 white">
                  <li><a href="<?php echo home_site_url() ?>"><?php echo translate('home') ?></a></li>
                  <li class="active"><?php echo translate('courses') ?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php if (isset($course) && !empty($course)) { ?>
        <section id="courses" class="bg-silver-deep">
            <div class="container pb-40">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-uppercase title">Courses <span class="text-theme-colored2">Offered</span></h2>
                            <p class="text-uppercase mb-0">Choose Your Desired Course</p>
                            <div class="double-line-bottom-theme-colored-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <?php foreach ($course as $key => $value) { ?>
                            <div class="col-12 col-lg-4 col-md-4 col-sm-4 ">
                                <a href="<?php echo home_site_url('courses/'.$value->slug) ?>">
                                    <div class="card pb-2">
                                        <img class="img" src="<?php echo uploads_url($value->image); ?>" alt="<?php echo $value->name ?>" style="height:350px;object-fit: cover;">
                                        <div class="card-header">
                                            <a href="<?php echo home_site_url('courses/'.$value->slug) ?>"><h4><?php echo $value->name; ?></h4></a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
        </section>
    <?php } ?>
    <section class="layer-overlay overlay-theme-colored-9" data-bg-img="http://placehold.it/1920x820" data-parallax-ratio="0.7">
    <div class="container pt-90 pb-90">
        <div class="row mt-30">
        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
            <i class="pe-7s-smile mb-20 text-theme-colored2"></i>
            <h2 data-animation-duration="2000" data-value="754"
                class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
            <h5 class="text-white text-uppercase">Happy Students</h5>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
            <i class="pe-7s-notebook mb-20 text-theme-colored2"></i>
            <h2 data-animation-duration="2000" data-value="675"
                class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
            <h5 class="text-white text-uppercase">Approved Courses</h5>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
            <i class="pe-7s-users mb-20 text-theme-colored2"></i>
            <h2 data-animation-duration="2000" data-value="675"
                class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
            <h5 class="text-white text-uppercase">Certified Teachers</h5>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
            <i class="pe-7s-study mb-20 text-theme-colored2"></i>
            <h2 data-animation-duration="2000" data-value="1248"
                class="animate-number text-white font-38 font-weight-400 mt-0 mb-15">0</h2>
            <h5 class="text-white text-uppercase">Graduate Students</h5>
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
                                    <img class="img-fullwidth"  alt="<?php echo $value->name ?>" src="<?php echo app_file_exists( uploads_url($value->image),uploads_url('profile/default.png')); ?>">
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