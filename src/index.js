$(document).ready(function(){
    const $burger = $(".header__burger span"),
        $nav = $(".header__menu"),
        $header = $('header'),
        $body = $("body"),
        $headerLink = $(".header__menu a");


    $burger.on("click", function(event) {
        $burger.toggleClass("active");
        $nav.toggleClass("active");
        $body.toggleClass("fixed-page");
    });  



    function scrollAnim(param) {
        param.on("click", function(e) {
            const target = $(this).attr("href");
            $("html, body").animate({ scrollTop: $(target).offset().top - 100 }, 800);
            $nav.removeClass("active");
            $burger.removeClass("active");
            $body.removeClass("fixed-page");

        });
    }

    if(!$('body').hasClass('home')){
        const home  = $('.header__logo a').attr('href');
        const links = $("#menu-header a[href^='#']");
        Object.entries(links)
            .forEach(item => {
                let link = home + item[1].hash;
            item[1].hash !== undefined ?  item[1].href = link  : 'no';
            if(item[1].hash == '#contact') {
                item[1].href = '#contact';
            }

        });
      
        
    }
   

    document.body.scrollTop = 0;

    var windowScrolled = false;
    $(document).one('ready scroll hashchange', function(e) {
      if(windowScrolled != false || location.hash.length == 0) return;
  
      e.preventDefault();
  
      var currentName = location.hash.substr(1);
      var el = $('#' + currentName+', [name='+currentName+']');
  
      if(el.length > 0)
      {
        $('body, html').animate({
          scrollTop: el.offset().top - 100
        }, 3000);
  
        windowScrolled = true;
      }
  
    });


    const scrollItems = [$headerLink, $('.choose-sets-item'), $('a[data-target="#new"]'), $('.new__content_newses a'), ];
    scrollItems.forEach(el=>{
        scrollAnim(el);
    });
   
    $(window).on('scroll', function (e) {
        if($(window).scrollTop() > 20) {
            $header.addClass('fixed');
            $('.arrowUp').addClass('active');
        } else {
            $header.removeClass('fixed');
            $('.arrowUp').removeClass('active');
        }
    }) 
	    if(!$('body').hasClass('home')){
        const home  = $('.header__logo a').attr('href');
        const links = $("#menu-header a[href^='#']");
        Object.entries(links)
            .forEach(item => {
                let link = home + item[1].hash;
            item[1].hash !== undefined ?  item[1].href = link  : 'no';
            if(item[1].hash == '#contact') {
                item[1].href = '#contact';
            }

        });
      
        
    }

    $(".sale__slider").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        dots: true,
        swipeToSlide: true,
        focusOnSelect: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.rolly__categories').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: true,
        arrows: false,
        swipeToSlide: true,
        responsive: [
            {
                breakpoint:1205,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint:1025,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 380,
                settings: {
                    slidesToShow: 1
                }
            },
        ]
    });

    if($('.rolly__categories_item').hasClass('slick-current')) {
        $('.slick-current').children().removeClass('btn__transparent').addClass('btn__primary'); 
    } 

    let $dataStart = $('.slick-current').children('a').attr('data-cat');

    function hideShow(params) {
        $('.rolls__wrap').hide();
        $('.rolls__wrap.cat_' + $dataStart).show();
    }
    hideShow();

    $('.rolly__categories').on('click', function (e) {
        e.preventDefault();
        if($(e.target).parent().hasClass('slick-current')) {
            $(e.target).addClass('btn__primary').removeClass('btn__transparent'); 
            if($(e.target).parent().siblings().children().hasClass('btn__primary')) {
                $(e.target).parent().siblings().children().removeClass('btn__primary').addClass('btn__transparent');
            }
        } 

        if(e.target.tagName !== "A") return false; 
        $dataStart = $(e.target).attr('data-cat');
        hideShow();
        $("html, body").animate({ scrollTop: $(e.target).offset().top - 150  }, 300);
    })
   

    let $close = [ $('.popup__overlay'),$('.popup__close')]

    $close.forEach(event => {
        event.on("click",function () {
            $('.popup').removeClass('active');
            $body.removeClass("fixed-page");
        });
    });

    $('body').on('click', '.btn__popup', function(e) {
        e.preventDefault();
        $('.popup').addClass('active');
        $('.popup__body_content-title').html($(this).attr('data-title'));
        $('.popup__body_content-description').html($(this).attr('data-exc'));
        $('.popup__body_content-price').html($(this).attr('data-price'));
        $("#myImageID").attr("src", $(this).attr('data-image'));
        $('.add_to_cart_btn').attr('data-id',$(this).data('id'))
        
        $body.addClass("fixed-page");
    }) 

    if($(".categories__wrap").length > $(".category").attr('data-c')) {
        $(".categories__more_btn").remove();
    };
    
   
    function removeBtn(params) {
        $(params).each(function (i,e) {
            $cat_child = $(this).children().children('.categories').children();
            $btn = $(this).children().children('.category__more').children();
            if($cat_child.length > $(e).attr('data-c')) {
                $btn.remove();
            };
        });
    }
    
    removeBtn($('.category'));

	$(".category__more_btn").on("click", function (e) {
        e.preventDefault();
        $(this).css('display', 'none');

        let $target = $(e.target).parents().siblings().children('.categories__wrap:last-child');
        const cat_slug = $(this).data('cat_slug');
        $btn = $(this).parent().children('.box');
       
		$.ajax({
			type: 'post',
			url: localizedObject.ajaxurl,
			data: 'action=ajax_more&cat_slug=' + cat_slug,
            beforeSend: function (response) {
                $btn.addClass("loader");
            },
            complete: function (response) {
                $btn.removeClass("loader");
            },
            success: function(response) {
                $(response).insertAfter( $target);
                 removeBtn($('.category'));
            },
            error: function (jqXhr, textStatus, errorMessage) {
                $btn.addClass("error").append('Something went wrong');
            }
			
		});

	});

    $(document).on("click", ".add_to_cart_btn", function (e) {
        e.preventDefault();

        let $this_btn = $(this),
            $form = $this_btn.parent("form.cart"),
            id = $this_btn.data("id"),
            product_qty = $form.find("input[name='quantity']").val() || 1,
            product_id = $form.find("input[name='product_id']").val() || id,
            variation_id = $form.find("input[name='variation_id']").val() || 0;
            
        let data = {
            action: "woocommerce_ajax_add_to_cart",
            product_id: product_id,
            product_sku: "",
            quantity: product_qty,
            variation_id: variation_id,
        };

        $(document.body).trigger("adding_to_cart", [$this_btn, data]);
        $this_btn.removeClass(".added_to_cart");
        $box = $(this).parent().siblings('.box');
        $.ajax({
            type: "post",
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            
            beforeSend: function (response) {
                $box.addClass("loader");
            },
            complete: function (response) {
                $box.removeClass("loader");
            },
            success: function (response) {
                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    $(document.body).trigger("added_to_cart", [response.fragments, response.cart_hash, $this_btn]);
                }
                
            },
        });

        return false;

    });

    $('.arrowUp').on("click", function() {
        $("html, body").animate({ scrollTop: 0 }, 800);
    });


    $('body').on('click', '.cart-qty.plus, .cart-qty.minus', function(e) {
        e.preventDefault();
        const input = $(this).parent().find('.input-text.qty.text');
        const input_val = parseInt(input.val());
        if ($(this).hasClass('plus')) {
            input.val(input_val + 1);
            input.attr('value',input_val + 1)
        }
        else {
            const new_val = input_val - 1;
            if (new_val > 0) {
                input.val(input_val - 1);
                input.attr('value',input_val - 1)
            }
        }
        input.trigger("change");
    });    

    function preHeaderDisplay(params) {
        $(window).on('scroll', function (e) {
            if($(window).scrollTop() === 0) {
                $('.header__pre').slideDown();
            } else {
                $('.header__pre').slideUp();
            }
        }) 
    }

    preHeaderDisplay();

        //check to see if the submited cookie is set, if not check if the popup has been closed, if not then display the popup
    if( getCookie('popupCookie') != 'submited'){ 
    $('.cookies').css("display", "block").hide().fadeIn(2000);
    }



    $('a.submit').click(function(){
    $('.cookies').fadeOut();
    //sets the coookie to five minutes if the popup is submited (whole numbers = days)
    setCookie( 'popupCookie', 'submited', 7 );
    });

    function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
    }

    function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
});