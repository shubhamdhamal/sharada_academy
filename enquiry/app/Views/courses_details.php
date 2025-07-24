<div class="main-content">
  <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/course-bg.jpg') ?>">
    <div class="container pt-120 pb-60">
      <div class="section-content">
        <div class="row">
          <div class="col-md-6">
            <h2 class="text-theme-colored2 font-36"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
            <ol class="breadcrumb text-left mt-10 white">
              <li><a href="<?php echo home_site_url() ?>"><?php echo translate('home') ?></a></li>
              <li><?php echo translate('courses') ?></li>
              <li class="active"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container mt-30 mb-30 pt-30 pb-30">
      <div class="row">
        <div class="col-md-12">
          <div class="single-service">
            <div class="text-center">
              <img class="img-fluid" src="<?php echo uploads_url($course->image) ?>" alt="<?php echo $course->name; ?>">
            </div>
            <h3 class="text-uppercase mt-30 mb-10"><?php echo $course->name; ?></h3>
              <div class="double-line-bottom-theme-colored-2 mt-10"></div>
            <p><?php echo $course->description; ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>