<footer id="footer" class="footer bg-black-111">
    <div class="container p-20">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0"><?php echo translate('copyright') ?> © <?php echo date('Y') ?> <?php echo app_setting('app_title'); ?> <?php echo app_setting('app_footer_credit'); ?></p>
        </div>
      </div>
    </div>
</footer>
<?php /*if(isset($is_inquiry) && $is_inquiry!=''){ ?>
  <footer id="footer" class="footer bg-black-111">
    <div class="container p-20">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0"><?php echo translate('copyright') ?> © <?php echo date('Y') ?> <?php echo app_setting('app_title'); ?> <?php echo app_setting('app_footer_credit'); ?></p>
        </div>
      </div>
    </div>
  </footer>
<?php }else{?>
  <footer id="footer" class="footer" data-bg-color="#212331">
    <div class="container pt-70 pb-40">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <img class="mt-5 mb-20" alt="" src="<?php echo home_assets_url('images/logo.png'); ?>">
                    <ul class="styled-icons icon-sm icon-bordered icon-circled clearfix mt-10">
                        <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-vk"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored-2">Useful Links</h4>
                    <ul class="angle-double-right list-border ">
                        <li><a href="<?php echo home_site_url(); ?>" class="text-white">Home</a></li>
                        <li><a href="<?php echo home_site_url('about-us'); ?>"class="text-white">About Us</a></li>
                        <li><a href="<?php echo home_site_url('courses'); ?>"class="text-white">Courses</a></li>
                        <li><a href="<?php echo home_site_url('gallery'); ?>"class="text-white">Gallery</a></li>
                        <li><a href="<?php echo home_site_url('blog'); ?>"class="text-white">Blog</a></li>
                    </ul>
                </div>
            </div>
            <?php $blog = $Crud_model->get_data(TBL_BLOG,array('is_active'=>'1'),array(),array('order'=>'asc'),3); ?>
            <?php if(isset($blog) && !empty($blog)){ ?>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored-2">Top Blogs</h4>
                    <div class="latest-posts">
                        <?php foreach($blog as $key => $value){ ?>
                            <article class="post media-post clearfix pb-0 mb-10">
                                <a class="post-thumb" href="<?php echo home_site_url('blog/'.$value->slug) ?>"><img src="<?php echo uploads_url($value->image); ?>" alt=""></a>
                                <div class="post-right">
                                  
                                    <h5 class="post-title mt-0 mb-5"><a href="<?php echo home_site_url('blog/'.$value->slug) ?>"><?php echo $value->name; ?></a></h5>
                                    <p class="post-date mb-0 font-12"><?php echo date("M d, Y", strtotime($value->created_on)); ?></p>
                                </div>
                            </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-sm-6 col-md-3 "><div class="widget dark ">
                <h4 class="widget-title line-bottom-theme-colored-2">Get In Touch</h4>
                <p>  <i class="fa fa-map-marker font-20 text-theme-colored2 mr-5 "></i><a href="https://maps.app.goo.gl/ta1rsQf5xkaHLtjJ9" target="_blank" class="text-white">Near Bank of Maharashtra, opp. V.P. College, Maharashtra Industrial Development Corporation Area, Baramati, Maharashtra 413133
                  </a>
                </p>
              <ul class="list-inline mt-5">
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored2 mr-5 "></i> <a class="text-white"
                    href="tel: +91 9271585443">+91 9271585443</a> </li>
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored2 mr-5"></i> <a class="text-white" href="mailto: info@sharadaacademy.com">info@sharadaacademy.com</a> </li>
              </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom" data-bg-color="#2b2d3b">
        <div class="container pt-20 pb-20">
            <div class="row">
                <div class="col-md-6 text-white">
                    <p class="font-12  m-0 sm-text-center"><?php echo translate('copyright') ?> © <?php echo date('Y') ?> <?php echo app_setting('app_title'); ?> <?php echo app_setting('app_footer_credit'); ?></p>
                </div>
                <div class="col-md-6 text-right">
                    <div class="widget no-border m-0">
                        <ul class="list-inline sm-text-center mt-5 font-12 ">
                        <?php $page_name = get_column_value(TBL_PAGES,array('id'=>app_setting('terms_and_conditions_page'),'is_active'=>'1'),'name');?> 
                        <?php if($page_name!=''){ ?> 
                          <li><a class="text-white" href="<?php echo home_site_url('terms-and-conditions') ?>"><?php echo translate('terms_&_conditions') ?></li><li>|</li>
                        <?php } ?> 
                        <?php $page_name = get_column_value(TBL_PAGES,array('id'=>app_setting('return_refund_and_cancellation_policy_page'),'is_active'=>'1'),'name');?> 
                        <?php if($page_name!=''){ ?> 
                          <li><a  class="text-white"href="<?php echo home_site_url('return-refund-and-cancellation-policy') ?>"><?php echo translate('return,_refund_and_cancellation_policy') ?></li><li>|</li>
                        <?php } ?> 
                        <?php $page_name = get_column_value(TBL_PAGES,array('id'=>app_setting('privacy_policy_page'),'is_active'=>'1'),'name');?> 
                        <?php if($page_name!=''){ ?> 
                          <li><a class="text-white" href="<?php echo home_site_url('privacy-policy') ?>"><?php echo translate('privacy_policy') ?></li><li>|</li>
                        <?php } ?> 
                        <?php $page_name = get_column_value(TBL_PAGES,array('id'=>app_setting('disclaimer_page'),'is_active'=>'1'),'name');?> 
                        <?php if($page_name!=''){ ?> 
                          <li><a class="text-white"href="<?php echo home_site_url('disclaimer') ?>"><?php echo translate('disclaimer') ?></li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php }*/ ?>
<a class="scrollToTop" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a>
</div>
<?php
$js_files = array(
     "js/fancybox.js",
     "js/revolution-slider/js/extensions/revolution.extension.actions.min.js",
     "js/revolution-slider/js/extensions/revolution.extension.carousel.min.js",
     "js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js",
     "js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js",
     "js/revolution-slider/js/extensions/revolution.extension.migration.min.js",
     "js/revolution-slider/js/extensions/revolution.extension.navigation.min.js",
     "js/revolution-slider/js/extensions/revolution.extension.parallax.min.js",
     "js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js",
     "js/revolution-slider/js/extensions/revolution.extension.video.min.js",
     "js/custom.js"
);
load_home_js($js_files);
?>
  <script type="text/javascript">
    var tpj = jQuery;
    var revapi34;
    tpj(document).ready(function () {
      if (tpj("#rev_slider_home").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_home");
      } else {
        revapi34 = tpj("#rev_slider_home").show().revolution({
          sliderType: "standard",
          jsFileLocation: "<?php echo home_assets_url('js/revolution-slider/js') ?>",
          sliderLayout: "fullwidth",
          dottedOverlay: "none",
          delay: 5000,
          navigation: {
            keyboardNavigation: "on",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            onHoverStop: "on",
            touch: {
              touchenabled: "on",
              swipe_threshold: 75,
              swipe_min_touches: 1,
              swipe_direction: "horizontal",
              drag_block_vertical: false
            }
            ,
            arrows: {
              style: "zeus",
              enable: true,
              hide_onmobile: true,
              hide_under: 600,
              hide_onleave: true,
              hide_delay: 200,
              hide_delay_mobile: 1200,
              tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
              left: {
                h_align: "left",
                v_align: "center",
                h_offset: 30,
                v_offset: 0
              },
              right: {
                h_align: "right",
                v_align: "center",
                h_offset: 30,
                v_offset: 0
              }
            },
            bullets: {
              enable: true,
              hide_onmobile: true,
              hide_under: 600,
              style: "metis",
              hide_onleave: true,
              hide_delay: 200,
              hide_delay_mobile: 1200,
              direction: "horizontal",
              h_align: "center",
              v_align: "bottom",
              h_offset: 0,
              v_offset: 30,
              space: 5,
              tmp: '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span>'
            }
          },
          viewPort: {
            enable: true,
            outof: "pause",
            visible_area: "100%"
          },
          responsiveLevels: [1240, 1024, 778, 480,320],
          gridwidth: [1320, 1320, 1320, 1320, 1320],
          gridheight: [600, 600, 600, 600, 600],
          lazyType: "none",
          parallax: {
            type: "scroll",
            origo: "enterpoint",
            speed: 400,
            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
          },
          shadow: 0,
          spinner: "off",
          stopLoop: "off",
          stopAfterLoops: -1,
          stopAtSlide: -1,
          shuffle: "off",
          autoHeight: "off",
          hideThumbsOnMobile: "off",
          hideSliderAtLimit: 0,
          hideCaptionAtLimit: 0,
          hideAllCaptionAtLilmit: 0,
          debugMode: false,
          fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false,
          }
        });
      }
    }); /*ready*/
  </script>
</body>
</html>