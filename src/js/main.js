// Get the video
var video = document.getElementById("myVideo");
var video_block = jQuery('.video_block');
var btn = document.getElementById("maVideoBtn");
function myFunction() {
    if (video.paused) {
        video.play();
        // btn.innerHTML = "Pause";
    } else {
        video.pause();
        // btn.innerHTML = "Play";
    }
}

$(document).ready(function () {
    $(video_block).mousemove(function (e) {
        var xPos = e.pageX - $(this).position().left;
        var yPos = e.pageY - $(this).position().top;
        $(btn).css('left', xPos + 'px').css('top', yPos + 'px');
    });
}); 


$('.checkbox-custom input:checkbox').change(function () {
    if ($(this).is(":checked")) {
        $('.checkbox-custom label').addClass("active");
    } else {
        $('.checkbox-custom label').removeClass("active");
    }
});




var $video = $("#video_click"), 
    mousedown = false;

$video.click(function () {
    if (this.paused) {
        this.play();
        return false;
    }
    jQuery('.video_play').fadeOut();
    return true;
});

$video.on('mousedown', function () {
    mousedown = true;
});

$(window).on('mouseup', function () {
    mousedown = false;
});

$video.on('play', function () {
    $video.attr('controls', '');
    jQuery('.video_play').fadeOut();
});

$video.on('pause', function () {
    if (!mousedown) {
        $video.removeAttr('controls');
        jQuery('.video_play').fadeIn();
    }
});



$("input, textarea").focus(function () {
    $(this).closest('.field').addClass('active');
}).blur(function () {
    if (!$(this).val().trim().length) {
        $(this).closest('.field').removeClass('active');
    }
});




$(document).ready(function ($) {
    
    if ($.cookie('noPreloader')) {
        $('.preloader').hide();
        $('#page').addClass('show');
    }
    else {
            loader();
            function loader(_success) {
                var obj = document.querySelector('.preloader'),
                    body = document.querySelector('body'),
                    inner = document.querySelector('.preloader_inner'),
                    page = document.querySelector('#page');
                obj.classList.add('show');
                body.classList.remove('loaded');
                page.classList.remove('show');
                var w = 0,
                    t = setInterval(function () {
                        w = w + 1;
                        inner.textContent = w + '%';
                        jQuery('.preloader_line').css({ width: w + "%" }); 

                        if (w === 100) {
                            obj.classList.remove('show');
                            page.classList.add('show');
                            clearInterval(t);
                            w = 0;
                            if (_success) {
                                return _success();
                            }
                        }
                    }, 20);
            }
        // and now we create 1 year cookie
        $.cookie('noPreloader', true, { path: '/', expire: 365 });
    }
});









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
    if (jQuery(this).scrollTop() > 1) {
        jQuery('#header').addClass('fixed');
    } else {
        jQuery('#header').removeClass('fixed');
    }
});



jQuery(document).ready(function () {
    jQuery('button.da-modal').click(function () {
        const modal_id = jQuery(this).attr('data-name');
        jQuery('.da-modal-open-bg').addClass("open").fadeIn();
        jQuery("#" + modal_id).addClass("open");
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




// Cache selectors
var lastId,
    topMenu = $(".pageNav"),
    headerHeight = $('#header#header').height(),
    adminBarHeight = $('#wpadminbar').height(),
    topMenuHeight = topMenu.outerHeight() + adminBarHeight + headerHeight,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function () {
        var item = $($(this).attr("href"));
        if (item.length) {
            return item;
        }
    });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function (e) {
    var href = $(this).attr("href"),
        offsetTop = href === "#" ? 0 : $(href).offset().top - topMenuHeight + 1;
    $('html, body').stop().animate({
        scrollTop: offsetTop
    }, 300);
    e.preventDefault();
});

// Bind to scroll
$(window).scroll(function () {
    var fromTop = $(this).scrollTop() + topMenuHeight;
    var cur = scrollItems.map(function () {
        if ($(this).offset().top < fromTop)
            return this;
    });
    cur = cur[cur.length - 1];
    var id = cur && cur.length ? cur[0].id : "";

    if (lastId !== id) {
        lastId = id;
        menuItems
            .parent().removeClass("active")
            .end().filter("[href='#" + id + "']").parent().addClass("active");
    }
});






const sliderProductss = jQuery('.productSliderCat').length;
if (sliderProductss >= 1) {
    var swiperProducts = new Swiper('.productSliderCat', {
        slidesPerView: 1.3,
        spaceBetween: 20, 
        scrollbar: {
            el: '#products .js-swiper-scrollbar',
            draggable: true,
            snapOnRelease: true,
            // dragSize: "20px"
        },
        breakpoints: {
            640: {
                slidesPerView: 1.3,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
                loop: true,
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
}


const sliderDrinks = jQuery('.drinksSlider').length;
if (sliderDrinks >= 1) {
    var swiperDrinks = new Swiper('.drinksSlider', {
        slidesPerView: 1.5,
        spaceBetween: 30,
        // slidesPerGroup: 3,
        scrollbar: {
            el: '#drinks .js-swiper-scrollbar',
            draggable: true,
            snapOnRelease: true,
            // dragSize: "20px"
        },
        breakpoints: {
            640: {
                slidesPerView: 1.7,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
                loop: true,
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
}


const sliderAcc = jQuery('.accSlider').length;
if (sliderAcc >= 1) {
    var swiperaccSlider = new Swiper('.accSlider', {
        slidesPerView: 1.5,
        spaceBetween: 30,
        // slidesPerGroup: 3,
        scrollbar: {
            el: '#accessories .js-swiper-scrollbar',
            draggable: true,
            snapOnRelease: true,
            // dragSize: "20px"
        },
        breakpoints: {
            640: {
                slidesPerView: 1.7,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
                loop: true,
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
}



const sliderproductAfter = jQuery('.prodAfterSlider').length;
if (sliderproductAfter >= 1) {
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
}

const sliderReviews = jQuery('.reviewsSlider').length;
if (sliderReviews >= 1) {
    var reviewsSlider = new Swiper('.reviewsSlider', {
        slidesPerView: 1.3,
        spaceBetween: 30,
        loop: true,
        scrollbar: {
            el: '#reviews .js-swiper-scrollbar',
            draggable: true,
            snapOnRelease: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 1.3,
                spaceBetween: 30
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 60
            },
        },
        pagination: {
            el: '#reviews .pagination',
            clickable: true,
            type: 'fraction'
        },
        navigation: {
            nextEl: '#reviews .button-next',
            prevEl: '#reviews .button-prev'
        },
    });
}


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
        mySwiper = new Swiper('.team-content', {
            slidesPerView: "1.3",
            spaceBetween: 30,
            // pagination
            pagination: '.swiper-pagination',
            paginationClickable: true,

        });
    };
    breakpoint.addListener(breakpointChecker);
    breakpointChecker();
})();




const sliderClients = jQuery('.clients_slider').length;
if (sliderClients >= 1) {
    var clientsSlider = new Swiper('.clients_slider', {
        slidesPerView: 1.5,
        spaceBetween: 30,
        // slidesPerGroup: 3,
        loop: true,
        // loopFillGroupWithBlank: true,
        breakpoints: {
            640: {
                slidesPerView: 1.7,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 60,
                loop: true,
            },
        },
        pagination: {
            el: '#our_clients .pagination',
            clickable: true,
            type: 'fraction',
        },
        navigation: {
            nextEl: '#our_clients .button-next',
            prevEl: '#our_clients .button-prev',
        },
    });
}


const sliderBlog = jQuery('.blogSlider').length;
if (sliderBlog >= 1) {
    var blogSlider = new Swiper('.blogSlider', {
        slidesPerView: 1.3,
        spaceBetween: 30,
        scrollbar: {
            el: '#articles .js-swiper-scrollbar',
            draggable: true,
            snapOnRelease: true,
            // dragSize: "20px"
        },
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
}


const sliderPosts = jQuery('.postsSlider').length;
if (sliderPosts >= 1) {
    var postsSlider = new Swiper('.postsSlider', {
        slidesPerView: 1.3,
        spaceBetween: 50,
        initialSlide: 1,
        scrollbar: {
            el: '#posts .js-swiper-scrollbar',
            draggable: true,
            snapOnRelease: true,
            // dragSize: "20px"
        },
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
                loop: true,
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
}

// For form section
jQuery('.formnav > ul > li > a').click(function (event) {
    jQuery(this).closest('li').toggleClass('active');
    return false;
});

$('.formnav input:checkbox').change(function () {
    if ($(this).is(":checked")) {
        $(this).closest('label').addClass("active");
    } else {
        $(this).closest('label').removeClass("active");
    }
});

jQuery('.value-prod > li').click(function (event) {
    jQuery(this).closest('li').toggleClass('active');
    return false;
});

jQuery('.colors-prod > li').click(function (event) {
    jQuery(this).closest('li').toggleClass('active');
    return false;
});


jQuery('.pageNav > ul > li').click(function (event) {
    jQuery('.pageNav > ul > li').removeClass('active');
    jQuery(this).addClass('active');
    // return false;
});



// jQuery(document).ready(function () {
//     $('.productItem').on('click', 'button.ls-modal', function () {
//         const page_link = document.location.href;
//         const page_title = document.getElementsByTagName("title")[0].innerHTML;
//         const product_name = jQuery(this).closest('.productItem').find('h4.product_title').text();
//         jQuery('.link-page_input').val(page_link);
//         jQuery('.title-page_input').val(page_title);
//         jQuery('.product-name_input').val(product_name);
//     });
// });

// For form info
jQuery(function () {
    var has_single_class = jQuery('main').hasClass('product-page');
    if (has_single_class == true) {

        const productName = jQuery('.productName.desktop > h3').text();
        const page_link = document.location.href;

        jQuery('input.product-name').val(productName);
        jQuery('input.product-link').val(page_link);

        jQuery('ul.value-prod > li').click(function () {
            const text = jQuery(this).text();
            const val = jQuery('input.value-prod').val((i, v) => v.trim() == "" ? text : [v, text]).val();
        });


        jQuery('ul.colors-prod > li').click(function () {
            const productColor = jQuery(this).children('span').attr('title');
            const productColorStyle = jQuery(this).children('span').attr('style');
            jQuery('input.color-prod').val(productColor);
            jQuery('input.color-prod-style').val(productColorStyle);
        });
    }
});




// FullScreen menu
console.clear();

const app = (() => {
    let body;
    let menu;
    let menuItems;

    const init = () => {
        body = document.querySelector('body');
        menu = document.querySelector('.btn-menu');
        menuItems = document.querySelectorAll('.nav-menu__list-item');

        applyListeners();
    }

    const applyListeners = () => {
        menu.addEventListener('click', () => toggleClass(body, 'nav-active'));
    }

    const toggleClass = (element, stringClass) => {
        if (element.classList.contains(stringClass))
            element.classList.remove(stringClass);
        else
            element.classList.add(stringClass);
    }

    init();
})();







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
    speed: 800,
    lazy: {
        loadPrevNext: true,
    },
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
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
    scrollbar: {
        el: '.productSlider .js-swiper-scrollbar',
        draggable: true,
        snapOnRelease: true,
        // dragSize: "20px"
    },
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