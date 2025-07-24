<div class="main-content">
<section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/tour.jpg'); ?>">
  <div class="container pt-120 pb-60">
    <div class="section-content">
      <div class="row">
        <div class="col-md-6">
          <h2 class="text-white font-36"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
          <ol class="breadcrumb text-left mt-10 white">
            <li><a href="<?php echo home_site_url() ?>"><?php echo translate('home') ?></a></li>
            <li><?php echo translate('blog') ?></li>
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
            <div class="col-md-9">
                <div class="blog-posts single-post">
                    <article class="post clearfix mb-0">
                        <div class="entry-header">
                            <div class="post-thumb thumb"> <img src="<?php echo uploads_url($blog_details->image); ?>" alt="<?php echo $blog_details->name ?>" class="img-responsive img-fullwidth"> </div>
                        </div>
                        <div class="entry-content">
                        <div class="entry-meta media no-bg no-border mt-15 pb-20">
                            <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                            <ul>
                                <li class="font-16 text-white font-weight-600"><?php echo date('d', strtotime($blog_details->created_on)); ?></li>
                                <li class="font-12 text-white text-uppercase"><?php echo date('M', strtotime($blog_details->created_on)); ?></li>
                            </ul>
                            </div>
                            <div class="media-body pl-15">
                            <div class="event-content pull-left flip">
                                <h3 class="entry-title text-white text-uppercase pt-0 mt-0"><a href="javascript:void(0);"><?php echo $blog_details->name ?></a></h3>
                            </div>
                            </div>
                        </div>
                            <p class="mb-15"><?php echo $blog_details->description ?></p>
                        </div>
                    </article>
                    <div class="tagline p-0 pt-20 mt-5">
                        <div class="row">
                        <div class="col-md-8">
                            <ul class="styled-icons icon-circled m-0">
                                <li><a href="#" data-bg-color="#3A5795"><i class="fa fa-facebook text-white"></i></a></li>
                                <li><a href="#" data-bg-color="#55ACEE"><i class="fa fa-twitter text-white"></i></a></li>
                                <li><a href="#" data-bg-color="#A11312"><i class="fa fa-google-plus text-white"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="share text-right flip">
                            <p><i class="fa fa-share-alt text-theme-colored"></i> Share</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $latest_blogs = $Crud_model->get_data(TBL_BLOG,array('is_active'=>'1'),array(),array('order'=>'desc'),3); ?>
            <div class="col-md-3">
                <div class="sidebar sidebar-left mt-sm-30">
                    <?php if(isset($latest_blogs) && !empty($latest_blogs)) { ?>
                        <div class="widget">
                            <h5 class="widget-title line-bottom">Last Blogs</h5>
                            <div class="latest-posts">
                                <?php foreach ($latest_blogs as $ikey => $ival) { ?>    
                                    <article class="post media-post clearfix pb-0 mb-10">
                                        <a class="post-thumb" href=""><img src="<?php echo uploads_url($ival->image); ?>" alt="<?php echo $ival->name ?>"></a>
                                        <div class="post-right">
                                            <h5 class="post-title mt-0"><a href="<?php echo home_site_url('blog/'.$ival->slug) ?>"><?php echo $ival->name ?></a></h5>
                                            <p><?php echo $ival->short_description ?></p>
                                        </div>
                                    </article>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>