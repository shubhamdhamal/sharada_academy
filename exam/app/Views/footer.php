<footer id="footer" class="footer bg-black-111">
    <div class="container p-20">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0"><?php echo translate('copyright') ?> © <?php echo date('Y') ?> <?php echo app_setting('app_title'); ?> <?php echo app_setting('app_footer_credit'); ?></p>
        </div>
      </div>
    </div>
</footer>
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