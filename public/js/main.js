$(document).ready(function () {

    // TOP Menu Sticky
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $("#sticky-header").removeClass("sticky");
            $("#back-top").addClass("fade-in");
        } else {
            $("#sticky-header").addClass("sticky");
            $("#back-top").addClass("fade-in");
        }
    });


    $(window).on("scroll", function () {
        if ($(window).scrollTop() + $(window).height() - 100 >= $(".recepie_area").offset().top) {
            $('.recipe_img').css('animation','spin 3s')
        }
    })

    $(window).on('load', function (){

        if ($(window).scrollTop() + $(window).height() - 100 >= $(".recepie_area").offset().top) {
            $('.recipe_img').css('animation','spin 3s')
        }

        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $("#sticky-header").removeClass("sticky");
            $("#back-top").addClass("fade-in");
        } else {
            $("#sticky-header").addClass("sticky");
            $("#back-top").addClass("fade-in");
        }
    });

});

