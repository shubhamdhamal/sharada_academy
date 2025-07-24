<div class="main-content">
    <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/tour.jpg'); ?>">
        <div class="container pt-120 pb-60">
            <div class="section-content">
            <div class="row">
                <div class="col-md-6">
                <h2 class="text-theme-colored2 font-36"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
                <ol class="breadcrumb text-left mt-10 white">
                    <li><a href="<?php echo home_site_url() ?>"><?php echo translate('home') ?></a></li>
                    <li class="active"><?php echo translate('blog') ?></li>
                </ol>
                </div>
            </div>
            </div>
        </div>
    </section>
    <?php if (isset($blogs) && !empty($blogs)) { ?>
    <section>
        <div class="container pt-70 pb-40">
            <div class="section-content">
                <div class="row multi-row-clearfix">
                    <?php foreach ($blogs as $key => $val) { ?>
                        <div class="col-sm-6 col-md-4">
                            <article class="post clearfix mb-30">
                                <div class="entry-header">
                                <div class="post-thumb thumb">
                                    <img src="<?php echo uploads_url($val->image); ?>" alt="<?php echo $val->name ?>" class="img-responsive img-fullwidth">
                                </div>
                                <div
                                    class="entry-date media-left text-center flip bg-theme-colored border-top-theme-colored2-3px pt-5 pr-15 pb-5 pl-15">
                                    <ul>
                                        <li class="font-16 text-white font-weight-600"><?php echo date('d', strtotime($val->created_on)); ?></li>
                                        <li class="font-12 text-white text-uppercase"><?php echo date('M', strtotime($val->created_on)); ?></li>
                                    </ul>
                                </div>
                                </div>
                                <div class="entry-content p-15">
                                <div class="entry-meta media no-bg no-border mt-0 mb-10">
                                    <div class="media-body pl-0">
                                    <div class="event-content pull-left flip">
                                        <h4 class="entry-title text-white text-uppercase font-weight-600 m-0 mt-5"><a href="<?php echo home_site_url('blog/'.$val->slug) ?>"><?php echo $val->name ?></a></h4>
                                        <ul class="list-inline">
                                            <li><i class="fa fa-user-o mr-5 text-theme-colored2"></i>By <?php echo get_crud_user_details($val->created_by,'name'); ?></li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                    <p class="mt-5"></p>
                                    <a class="btn btn-default btn-flat font-12 mt-10 ml-5" href="<?php echo home_site_url('blog/'.$val->slug) ?>"><?php echo translate('view_details') ?></a>
                                </div>
                            </article>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
</div>