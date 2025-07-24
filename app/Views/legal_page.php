<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>
<section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="<?php echo home_assets_url('images/tour.jpg'); ?>">
        <div class="container pt-120 pb-60">
            <div class="section-content">
            <div class="row">
                <div class="col-md-6">
                <h2 class="text-white font-36"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
                <ol class="breadcrumb text-left mt-10 white">
                    <li><a href="<?php echo home_site_url() ?>"><?php echo translate('home') ?></a></li>
                    <li class="active"><?php echo translate('Terms and Condistion') ?></li>
                </ol>
                </div>
            </div>
            </div>
        </div>
    </section>
<section class="mb-4">
    <div class="container">
        <div class="p-4 bg-white rounded shadow-sm overflow-hidden mw-100 text-left"><?php echo $page->description ?></div>
    </div>
</section>