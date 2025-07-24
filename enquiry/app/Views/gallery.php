<div class="main-content">
    <section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/tour.jpg'); ?>">
        <div class="container pt-120 pb-60">
            <div class="section-content">
            <div class="row">
                <div class="col-md-6">
                <h2 class="text-theme-colored2 font-36"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
                <ol class="breadcrumb text-left mt-10 white">
                    <li><a href="<?php echo home_site_url() ?>"><?php echo translate('home') ?></a></li>
                    <li class="active"><?php echo translate('gallery') ?></li>
                </ol>
                </div>
            </div>
            </div>
        </div>
    </section>
    <?php if (isset($gallery) && !empty($gallery)) { ?>
    <section>
        <div class="container pt-70 pb-40">
            <div class="section-content">
                <div class="row multi-row-clearfix">
                <?php foreach ($gallery as $key => $val) { ?>
                    <div class="col-sm-6 col-md-4">
                        <article class="post clearfix mb-30">
                            <div class="entry-header">
                                <div class="post-thumb thumb">
                                    <a class="btn btn-default btn-flat" href="<?php echo home_site_url('gallery/'.$val->slug) ?>">
                                        <img src="<?php echo app_file_exists(uploads_url($val->image),uploads_url('default.png')) ; ?>" style="height: 310px;width:310px" alt="<?php echo $val->name ?>" class="img-responsive img-fullwidth">
                                    </a>
                                </div>
                            </div><h3 class="text-theme-colored2 text-center mt-5"><?php echo $val->name ?></h3></div>
                        </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
</div>