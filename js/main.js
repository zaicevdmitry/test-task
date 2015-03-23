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
});

jQuery(document).ready(function() {
    jQuery('.d-carousel .carousel').jcarousel({
        scroll: 1
    });
});
