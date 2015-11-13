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