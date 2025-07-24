<div class="main-content">
        <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/course-bg.jpg') ?>">
            <div class="container pt-120 pb-60">
            <div class="section-content">
                <div class="row">
                <div class="col-md-6">
                    <h2 class="text-white font-36"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
                    <ol class="breadcrumb text-left mt-10 white">
                        <li><a href="<?php echo home_site_url() ?>"><?php echo translate('home') ?></a></li>
                        <li><a href="<?php echo home_site_url('gallery') ?>"><?php echo translate('gallery') ?></a></li>
                        <li class="active"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
                    </ol>
                </div>
                </div>
            </div>
            </div>
        </section>
    <?php if(isset($gallery_details) && !empty($gallery_details)){ ?>
        <section>
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="gallery-isotope default-animation-effect grid-3 gutter-small clearfix" data-lightbox="gallery">
                                  <?php $i=0; $images = json_decode($gallery_details->images); 
                                     if(!empty($images)){ foreach ($images as $ikey => $val) { ?>
                                        <div class="gallery-item">
                                            <a href="<?php echo uploads_url($val); ?>" data-lightbox="gallery-item" title="Title Here 1"><img src="<?php echo uploads_url($val); ?>" alt=""></a>
                                        </div>
                              <?php } } ?>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>


  
  <!-- end main-content -->
</div>


