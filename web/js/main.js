'use strict';

var APP = APP || {};

APP.config =  {
    updateUrl: '?controller=slide&action=get&id=%d'
};


APP.Slide = function(id) {
    this.id = id;
    var $allContent = APP.$allSlides.filter('[data-id='+id+']');
    this.$content = $allContent.find('.slide__content');
    this.$date = $allContent.find('.slide__date');
    this.$loader = $allContent.find('.slide__loader');
    this.$refresh = $allContent.find('.slide__refresh');

    this.registerEvents();
};

APP.Slide.prototype = {
    registerEvents: function() {
        var self = this;
        $(this.$refresh).on('click', function(e) {
            e.preventDefault();
            APP.ajax.updateSlide(self);
        });
    }
};


APP.common = {
    init: function() {
        APP.$fotorama = $('.fotorama-frame').on('fotorama:ready', function (e, fotorama) {
            //todo foreach all frames in fotorama// add slide to every data
        }).fotorama();




        APP.SlideCollection = {};
        APP.$allSlides =  $('.slide');

        APP.$allSlides.each(function(i, e) {
            var id = $(e).data('id');
            APP.SlideCollection[id] =  new APP.Slide(id);
        });
    }
};

APP.ajax = {
    updateSlide: function(slide) {
        slide.$loader.addClass('-loading');
        $.ajax({
            url: APP.config.updateUrl.replace("%d", slide.id),
            method : 'get',
            dataType: 'json',
            success: function(r) {
                console.log(r.refresh_date);
                slide.$loader.removeClass('-loading');
                slide.$date.text(r.refresh_date);
                slide.$content.html(r.html);
            }
        });
    }
};


jQuery(function( $) {
    'use strict';


    $(function () {
        APP.common.init();

        /*var lastIndex = -1;

        var $fotorama = $('.fotorama');
        $fotorama.on('fotorama:showend', function(e, fotorama, extra){
            lastIndex = fotorama.activeFrame.i;
        });

        $fotorama.on('fotorama:show', function(e, fotorama, extra){
            var currentIndex = fotorama.activeFrame.i;
            if (currentIndex < lastIndex) {
                window.location.reload();
            }
            console.log('current - ' + currentIndex + ' last ' + lastIndex);
        });

        $fotorama.fotorama();*/

        /*$
            // Listen to the events
            .on('fotorama:ready ' +           // Fotorama is fully ready
            'fotorama:show ' +            // Start of transition to the new frame
            'fotorama:showend ' +         // End of the show transition
            'fotorama:load ' +            // Stage image of some frame is loaded
            'fotorama:error ' +           // Stage image of some frame is broken
            'fotorama:startautoplay ' +   // Slideshow is started
            'fotorama:stopautoplay ' +    // Slideshow is stopped
            'fotorama:fullscreenenter ' + // Fotorama is fullscreened
            'fotorama:fullscreenexit ' +  // Fotorama is unfullscreened
            'fotorama:loadvideo ' +       // Video iframe is loaded
            'fotorama:unloadvideo',       // Video iframe is removed
            function (e, fotorama, extra) {
                console.log('## ' + e.type);
                console.log('active frame', fotorama.activeFrame);
                console.log('additional data', extra);
            }
        )
            // Initialize fotorama manually
            .fotorama();*/
    });
});