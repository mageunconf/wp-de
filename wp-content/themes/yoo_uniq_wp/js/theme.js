/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

(function(UI, $){

    var obj;

    UI.on('afterready.uk.dom', function(e, name, obj){

        var nav_height = $('.tm-navbar[data-uk-sticky]').outerHeight();

        if (nav_height) {
            $('a[href^="#"]').each(function(){
                obj = $(this).data('smoothScroll');

                if (obj) {
                    obj.options.offset = nav_height;
                }
            });
        }
    });


    $(function() {

        var config = $('html').data('config') || {};
        // Social buttons
        $('article[data-permalink]').socialButtons(config);

    });

})(UIkit, jQuery)
