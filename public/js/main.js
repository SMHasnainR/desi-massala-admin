$(document).ready(function () {

    // TOP Menu Sticky
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
        $("#sticky-header").removeClass("sticky");
        $('#back-top').fadeIn(500);
        } else {
        $("#sticky-header").addClass("sticky");
        $('#back-top').fadeIn(500);
        }
    });


    $(window).on("scroll", function () {

        if ($(window).scrollTop() + $(window).height() - 100 >= $(".recepie_area").offset().top) {

            $('.recepie_thumb').css('animation','spin 3s')

        }

    })

});

