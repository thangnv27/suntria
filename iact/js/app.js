function dangkyActive(){
    $( "#td-tab" ).tabs("option", "active", $("#td-tab li").length - 1);
}
// Run
jQuery(function($){
    
    i18n.init({
        lng: lang,
        fallbackLng: lang,
        detectLngQS: "lang",
        resGetPath: themeUrl + '/locales/__lng__/__ns__.json',
        resPostPath: themeUrl + '/locales/add/__lng__/__ns__'
    },
    function(t) {
        // translate 
        $("body.i18n").i18n();

    // programatical access
    //                var appName = t("app.name");
    }
    );
    
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('#toTop').fadeIn();
        } else if($(this).width() >= 1200){
            $('#toTop').fadeOut();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $("#toTop").click(function(){
        scrollToElement("#header"); 
    });

    // jQuery placeholder for IE
    $("input, textarea").placeholder();
    $('.post-item .pitem-excerpt').expander({
        slicePoint: 480,
        expandText: 'Xem chi tiết +',
        userCollapseText: 'Thu gọn +',
        expandEffect: 'show',
        expandSpeed: 0,
        collapseEffect: 'hide',
        collapseSpeed: 0
    });
    $(".read-more a").attr('data-i18n', 'link.more');
    $(".read-less a").attr('data-i18n', 'link.collapse');
    $("a.home").attr('data-i18n', 'link.home');
    //    Tab tuyen dung
    $( "#td-tab" ).tabs();

    if(window.location.hash == '#td-reginfo'){
        dangkyActive();
    }
    $("#td-tab a[href='#td-reginfo']").each(function(){
        $(this).click(function(){
            dangkyActive();
            return false;
        });
    });
    $('.product-hot').bxSlider({
        mode: 'vertical',
        auto: true,
        captions: false,
        controls: false,
        pager: false
    });
    if($(".product-images li").length > 1){
        var slider = $('.product-images').bxSlider({
            nextText: '',
            prevText: '',
            mode: 'fade',
            auto: true,
            controls:true,
            pager: false,
            onSlideAfter:function(){
                slider.startAuto();
            }
        });
    }
    
    

//    if($(".product-children li").length > 1){
//        $('.product-children').jcarousel({
//            //                auto: 1,
//            wrap: 'circular',
//            scroll: 1
//        });
//    }
    if($(".product-children li").length > 1){
        $('.product-children').carouFredSel({
            auto: true,
            prev: '#prev2',
            next: '#next2',
            mousewheel: false,
            swipe: {
                onMouse: true,
                onTouch: false
            },
            scroll : {
                items           : 1,
                duration        : 800,                         
                pauseOnHover    : true
            }
        });
    }
    
    $(".menucat li.menu-item-has-children").each(function(index){
        $(this).hoverIntent({
            over: function(){
                $(".menucat li .sub-menu").eq(index).slideDown('slow');
            },
            out: function(){
                $(".menucat li .sub-menu").eq(index).slideUp('slow');
            }
        });
    });
    
    /* toggle nav */
    $("#mobile-menu").on("click", function() {
        $("#mobile-menu ul:first").slideToggle().css('display', 'inline-block');
        $(this).toggleClass("active");
    });
    
    $(".iconmenu").on("click", function() {
        $(".menutop ul:first").slideToggle().css('display', 'block');
        $(this).toggleClass("active");
    });
    
    $(window).resize(function(){
        //        alert($(this).width());
        if($(this).width() >= 963){
            $(".menutop").show();
            $(".menutop ul:first").show();
            $("#mobile-menu").hide();
        }else if($(this).width() >= 800){
            $(".menutop").show();
            $(".menutop ul:first").hide();
            $("#mobile-menu").hide();
        }else if($(this).width() >= 750){
            $(".menutop").show();
            $("#mobile-menu").hide();
            $(".menutop ul:first").hide();
        }else {
            $(".menutop").hide();
            $("#mobile-menu").show();
        }
        
        
    });
    
    
});