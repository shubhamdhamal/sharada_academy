// Please see documentation at https://docs.microsoft.com/aspnet/core/client-side/bundling-and-minification
// for details on configuring this project to bundle and minify static web assets.

// Write your JavaScript code.

$(document).ready(function () {
    if($("#homePageDefaultModal").length){
        $("#homePageDefaultModal").modal('show');
    }
    var owl = $('.owl-carousel');
    $('#recruiters .recruiters-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
    $('#recruiters .recruiters-carousel .owl-stage').addClass("d-flex align-items-center");
    $(".owl-nav").addClass("d-none");
    owl.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY > 0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 30) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    //  TESTIMONIALS CAROUSEL HOOK
    $('#customers-testimonials').owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 0,
        autoplay: true,
        dots: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1170: {
                items: 3
            }
        }
    });

    if (window.location.pathname == '/') {

        // Counter starts on scroll
        var a = 0;
        $(window).scroll(function () {
            var offset = $(this).scrollTop();
            var oTop = $('.counterSec').offset().top - window.innerHeight
            if (a == 0 && offset > oTop) {
                $('.counter-value').each(function () {
                    $(this).prop('Counter', 0).animate({
                        Counter: $(this).text()
                    }, {
                        duration: 4000,
                        easing: 'swing',
                        step: function (now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
                });
                a = 1;
            }
        });

    }
    activePageNavTabsUsingUrl();
});

const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});
function activePageNavTabsUsingUrl() {
    $('button.nav-link[data-bs-toggle="pill"][type="button"]').removeClass('active');
    if (window.location.search && params.activeTab) {
        $(`button.nav-link[data-bs-target="#${params.activeTab}"]`).click();
        $(`button.nav-link[data-bs-target="#${params.activeTab}"]`).addClass('active');
    } else {
        $($(`button.nav-link[data-bs-target="#${params.activeTab}"]`)[0]).click();
        $(`button.nav-link[data-bs-target="#${params.activeTab}"]`).addClass('active');
    }
}
//about jspm founder secretary scroll
AOS.init()
