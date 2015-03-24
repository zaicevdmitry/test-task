/**
 * Created by Dima on 18.03.2015.
 */
$(document).ready(function() {
    $('#slide_featured').click(function() {
        $(this).next().slideToggle();
    });

    $('#slide_latest').click(function() {
        $(this).next().slideToggle();
    });

    $('.image').mouseenter(function(){
        $(this).find('.hidden').removeClass("hidden").addClass("show");
    });

    $('.image').mouseleave(function(){
        $(this).find('.show').removeClass("show").addClass("hidden");
    });

    $(window).scroll(function() {
            $('.middle_bg').addClass('stop');
            var top = $(document).scrollTop();
            if(top > 85) {
                $('.middle_bg').addClass('fixed');
                $('.middle_bg').removeClass('stop');
            }else{
                $('.middle_bg').removeClass('fixed');
                $('.middle_bg').addClass('stop');
            }
    });


});

jQuery(document).ready(function() {
    jQuery('.d-carousel .carousel').jcarousel({
        scroll: 1
    });
});




