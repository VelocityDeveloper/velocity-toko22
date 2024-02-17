jQuery(function($) {
    $( ".tombols" ).click(function() {
        $("#searchform2").toggle();
        $(".tombols").toggleClass( "collapsed" );
    });

    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
        if (scroll >= 200) {
            $(".scroll-header").addClass("fixedHeader");
        } else {
            $(".scroll-header").removeClass("fixedHeader");
        }
    });
});