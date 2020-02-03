jQuery(document).ready(function ($) {

    // Add class in navigation bar

    $(window).scroll(function () {
        var height = $(window).scrollTop();
        if (height > 200) {
            $('.main-navigation').addClass('fixed');
        } else {
            $('.main-navigation').removeClass('fixed');
        }
    });

    // Added class on dropdown menu span

    if ($(document).width() < 1200) {
        var $menu_item = $('.menu-item-has-children');

        $menu_item.append('<span class="caret"></span>');

        $('.caret').click(function () {
            $(this).parent().toggleClass('menu-open').siblings().removeClass('menu-open');
        });
    }

    // To top Java Script

    $(window).scroll(function () {
        var height = $(window).scrollTop();
        if (height >= 200) {
            $('#up-btn').addClass('ayotothetop');
        } else {
            $('#up-btn').removeClass('ayotothetop');
        }
    });
    $('#up-btn').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

    // Click And Dragg Content And Images

    var y, top, down;

    for (let index = 1; index < 4; index++) {

        $('.scroll-' + index).mousedown(function (e) {
            e.preventDefault();
            down = true;
            y = e.pageY;
            top = $(this).scrollTop();
        });

        $('.scroll-' + index).mousemove(function (e) {
            if (down) {
                var scrollY = e.pageY;
                $('.scroll-' + index).scrollTop(top - scrollY + y);
            }
        });

        $('.scroll-' + index).mouseup(function (e) {
            down = false;
        });
    }

    // Image pop up

    $('.thumbnail-pop').click(function () {
        $('.imageapear img').attr('src', this.src);
        $('.imageapear').fadeIn().addClass('show');
        $('.imageapear figure img').addClass('show');
    });


    $(document).click(function (e) {
        if ($(e.target).is('.thumbnail-pop, .imageapear img') === false) {
            $('.imageapear').fadeOut().removeClass('show');
            $('.imageapear figure img').removeClass('show');
        }
    });

    // Remove Content Div From 404 Page

    $('.error404 div').remove('#content');

});