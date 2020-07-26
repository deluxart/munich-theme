jQuery('.spoiler > .head').on('click', function(e){
    jQuery('div.spoiler').not(this).children('.cont').stop().slideUp(300);
    jQuery(this).closest('div.spoiler').children('.cont').stop().slideUp(300);
    jQuery('.spoiler > .head').not(this).removeClass('active');
    jQuery('.spoiler > .cont').not(this).removeClass('active');
    jQuery(this).closest('div.spoiler').children('.cont').stop().slideToggle(300).toggleClass('active');
    jQuery(this).toggleClass('active');
    e.preventDefault();
});

// Add tabs
jQuery(document).ready(function(){
    jQuery('.d-tabs > ul > li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('.d-tabs > ul > li').removeClass('active');
        jQuery('.d-tabs .d-content').removeClass('active');
        jQuery(this).addClass('active');
        jQuery("#"+tab_id).addClass('active');
       return false;
    });
});



// Плавный скролл по странице
jQuery(document).ready(function () {
    jQuery('.home a[href*="#"]').on("click", function (e) {
        var anchor = jQuery(this);
        jQuery('html, body').stop().animate({
            scrollTop: jQuery(anchor.attr('href')).offset().top - 60
        }, 777);
        e.preventDefault();
         return false;
    });
});


jQuery(window).scroll(function () {
    var heightHeader = jQuery('#header').height();
    if (jQuery(this).scrollTop() > heightHeader) {
        jQuery('#header').addClass('fixed');
    } else {
        jQuery('#header').removeClass('fixed');
    }
});



// Add modal
jQuery(document).ready(function () {

	jQuery('button.da-modal').click(function () {
	  var modal_id = jQuery(this).attr('data-name');
	  
	  jQuery('.da-modal-open-bg').addClass("open").fadeIn();
	  jQuery("#"+modal_id).addClass("open");
	});

	jQuery('button.closeModal').click(function () {
	    jQuery('.daModal').removeClass('open');
	    jQuery('.da-modal-open-bg').fadeOut();
	});    

	jQuery('.da-modal-open-bg').click(function () {
	    jQuery('.daModal').removeClass('open');
	    jQuery('.da-modal-open-bg').fadeOut();
	});
});



var swiperProducts = new Swiper('.productSlider', {
    slidesPerView: 1.3,
    spaceBetween: 20, 
    loop: true,
    // slidesPerGroup: 3,
    breakpoints: {
        640: {
            slidesPerView: 1.3,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 25,
            centeredSlides: true,
            loop: true,
            loopFillGroupWithBlank: true,
            centeredSlides: true,
        },
    },
    pagination: {
        el: '#products .pagination',
        clickable: true,
        type: 'fraction',
    },
    navigation: {
        nextEl: '#products .button-next',
        prevEl: '#products .button-prev',
    },
});




var swiperDrinks = new Swiper('.drinksSlider', {
    slidesPerView: 1.3,
    spaceBetween: 30,
    // slidesPerGroup: 3,
    loop: true,
    // loopFillGroupWithBlank: true,
    breakpoints: {
        640: {
            slidesPerView: 1.3,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
    pagination: {
        el: '#drinks .pagination',
        clickable: true,
        type: 'fraction',
    },
    navigation: {
        nextEl: '#drinks .button-next',
        prevEl: '#drinks .button-prev',
    },
});




var swiperaccSlider = new Swiper('.accSlider', {
    slidesPerView: 1.3,
    spaceBetween: 30,
    // slidesPerGroup: 3,
    loop: true,
    // loopFillGroupWithBlank: true,
    breakpoints: {
        640: {
            slidesPerView: 1.3,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
    pagination: {
        el: '#accessories .pagination',
        clickable: true,
        type: 'fraction',
    },
    navigation: {
        nextEl: '#accessories .button-next',
        prevEl: '#accessories .button-prev',
    },
});





var productAfter = new Swiper('.prodAfterSlider', {
    slidesPerView: 1.2,
    spaceBetween: 30,
    // slidesPerGroup: 3,
    loop: true,
    // loopFillGroupWithBlank: true,
    breakpoints: {
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
    },
    pagination: {
        el: '.moreProducts .pagination',
        clickable: true,
        type: 'fraction',
    },
    navigation: {
        nextEl: '.moreProducts .button-next',
        prevEl: '.moreProducts .button-prev',
    },
});



var reviewsSlider = new Swiper('.reviewsSlider', {
    slidesPerView: 1.3,
    spaceBetween: 30,
    // slidesPerGroup: 3,
    loop: true,
    // loopFillGroupWithBlank: true,
    breakpoints: {
        640: {
            slidesPerView: 1.3,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 60,
        },
    },
    pagination: {
        el: '#reviews .pagination',
        clickable: true,
        type: 'fraction',
    },
    navigation: {
        nextEl: '#reviews .button-next',
        prevEl: '#reviews .button-prev',
    },
});




var blogSlider = new Swiper('.blogSlider', {
    slidesPerView: 1.3,
    spaceBetween: 30,
    breakpoints: {
        640: {
            slidesPerView: 1.3,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
            
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
        },
    },
    pagination: {
        el: '#articles .pagination',
        clickable: true,
        type: 'fraction',
    },
    navigation: {
        nextEl: '#articles .button-next',
        prevEl: '#articles .button-prev',
    },
});



var postsSlider = new Swiper('.postsSlider', {
    slidesPerView: 1.3,
    spaceBetween: 50,
    
    initialSlide: 1,
    breakpoints: {
        640: {
            slidesPerView: 1.3,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,

        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 20,
            centeredSlides: true,
            // loop: true,
        },
    },
    pagination: {
        el: '#posts .pagination',
        clickable: true,
        type: 'fraction',
    },
    navigation: {
        nextEl: '#posts .button-next',
        prevEl: '#posts .button-prev',
    },
});

// For form section
jQuery('.formnav > ul > li > a').click(function (event) {
    jQuery(this).closest('li').toggleClass('active');
    return false;
});

jQuery('.sizes-prod > li').click(function (event) {
    jQuery('.sizes-prod > li').removeClass('active');
    jQuery(this).closest('li').toggleClass('active');
    return false;
});

jQuery('.colors-prod > li').click(function (event) {
    jQuery('.colors-prod > li').removeClass('active');
    jQuery(this).closest('li').toggleClass('active');
    return false;
});


jQuery('.pageNav > ul > li').click(function (event) {
    jQuery('.pageNav > ul > li').removeClass('active');
    jQuery(this).addClass('active');
    // return false;
});






// For form info
jQuery(function () {
    var has_single_class = jQuery('main').hasClass('product-page');
    if (has_single_class == true) {
        var productColor = jQuery('.colors-prod > li.active span').attr('title');
        var productSize = jQuery('.sizes-prod > li.active').text();

        jQuery('.sizes-prod li').click(function (event) {
            jQuery('input.color-prod').val(productColor);
            jQuery('input.size-prod').val(productSize);
        });
    }
});









// For review section
function AddReadMore() {
    var carLmt = 200;
    var readMoreTxt = " ... <span>Watch all</span>";
    var readLessTxt = " <span>Hide</span>";

    $(".addReadMore").each(function () {
        if ($(this).find(".firstSec").length)
            return;
        var allstr = $(this).text();
        if (allstr.length > carLmt) {
            var firstSet = allstr.substring(0, carLmt);
            var secdHalf = allstr.substring(carLmt, allstr.length);
            var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
            $(this).html(strtoadd);
        }

    });
    $(document).on("click", ".readMore,.readLess", function () {
        $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
    });
}
$(function () {
    AddReadMore();
});







(function () {
    'use strict';
    const breakpoint = window.matchMedia('(min-width:992px)');
    let mySwiper;
    const breakpointChecker = function () {
        if (breakpoint.matches === true) {

            if (mySwiper !== undefined) mySwiper.destroy(true, true);
            return;
        } else if (breakpoint.matches === false) {

            return enableSwiper();

        }

    };

    const enableSwiper = function () {

        mySwiper = new Swiper('.unserSlider', {
            slidesPerView: "1",
            spaceBetween: 30,
            // pagination
            pagination: '.swiper-pagination',
            paginationClickable: true,

        });

    };

    breakpoint.addListener(breakpointChecker);

    breakpointChecker();
})();




var names = [];
$(".home_slider .swiper-wrapper > .swiper-slide").each(function (i) {
    names.push($(this).data("name"));
});

jQuery('.home_slider .swiper-pagination-bullet-active').addClass('progress');
function classAnimate() {
    $(".progress")
        .clearQueue()
        .stop()
        .css(
            { width: '0%' }
        )
        .animate({
            width: "100%"
        }, 3500);
}
var swiper1 = new Swiper('.home_slider', {
    spaceBetween: 30,
    lazy: {
        loadPrevNext: true,
    },
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    // pagination: {
    //     el: '.pag-shoes',
    //     type: 'custom',
    //     paginationClickable: true,
    //     renderCustom: function (swiper, current, total) {
    //         var text = "<span class='pContainer'>";
    //         for (let i = 1; i <= total; i++) {
    //             //alert(total);
    //             if (current == i) {
    //                 text += "<span class='active'>" + names[i - 1] + "</span>";
    //             }
    //             else {
    //                 text += "<span>" + names[i - 1] + "</span>";
    //             }
    //         }
    //         text += "</span>";
    //         return text;
    //     }
    // },
    paginationClickable: true,
    pagination: {
        el: '.pag-shoes',
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="' + className + '"><div class="inner-dot">' + (names[index]) + '</div></span>';
        },
    },
});


// Slider for product page
const galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 23,
    slidesPerView: 6,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
});
const galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 10,
    slidesPerView: 1.3,
    breakpoints: {
        768: {
            slidesPerView: 1,
        },
    },
    navigation: {
        nextEl: '.productSlider .swiper-button-next',
        prevEl: '.productSlider .swiper-button-prev',
    },
    thumbs: {
        swiper: galleryThumbs
    },
    pagination: {
        el: '.productSlider .swiper-pagination',
        type: 'progressbar',
    },
});

// var homeSlider = new Swiper('.home_slider', {
//     pagination: {
//         el: '.pag-shoes',
//         type: 'custom',
//         renderCustom: function (swiper, current, total) {
//             var text = "<span style='background-color:black;padding:20px;'>";
//             var names = [];
//             $(".home_slider .swiper-wrapper .swiper-slide").each(function (i) {
//                 names.push($(this).data("name"));
//             });
//             for (let i = 0; i <= total; i++) {
//                 if (current == i) {
//                     text += "<span style='border-top:1px solid green;margin-right:4px;color:green;padding:10px;'>" + names[i] + "</span>";
//                 } else {
//                     text += "<span style='border-top:1px solid white;margin-right:4px;color:white;padding:10px;'>" + names[i] + "</span>";
//                 }

//             }
//             text += "</span>";
//             return text;
//         }
//     },
// });