'use strict';

var APP = APP || {};

APP.config =  {
    updateUrl: '?controller=slide&action=get&id=%d',
    maxIdleSeconds: 45
};


APP.Slide = function(id) {
    this.id = id;
    this.init(id);
};

APP.Slide.prototype = {
    registerEvents: function() {
        console.log('Register events for slide - ' + this.id);
        var self = this;
        $(this.$refresh).on('click', function(e) {
            e.preventDefault();
            APP.ajax.updateSlide(self);
        });
    },
    refreshContent: function() {
        console.log('Refresh slider content with id - ' +  this.id );
        APP.ajax.updateSlide(this);
    },
    init: function(id) {
        console.log('Init/reinit slide - ' + this.id);
        var $allContent = APP.$allSlides.filter('[data-id='+id+']');
        this.$content = $allContent.find('.slide__content');
        this.$date = $allContent.find('.slide__date');
        this.$loader = $allContent.find('.slide__loader');
        this.$refresh = $allContent.find('.slide__refresh');

        this.registerEvents();
    }
};


APP.common = {
    init: function() {
        APP.$allSlides =  $('.slide');

        APP.$fotorama = $('.fotorama-frame')
            .on('fotorama:ready', function (e, fotorama) {
            for (var i in fotorama.data) {
                var data = fotorama.data[i];
                console.log('Add frame with id = ' + data.id);
                data.slide = new APP.Slide(data.id);
            }
            console.log('Add frame init complete. Total frames:');
            console.log(fotorama.data);
        }).on('fotorama:showend', function(e, fotorama) {
            if (fotorama.activeFrame.slide) {
                fotorama.activeFrame.slide.init(fotorama.activeFrame.id);

                // update previous slide
                var index = fotorama.activeIndex;
                var nextIndex = index ==0 ? fotorama.data.length-1 : index-1;
                console.log('index to update - ' + nextIndex);

                fotorama.data[nextIndex].slide.refreshContent();
            }

            // update idle timeout
            APP.idle = 0;
        }).fotorama();

        APP.fotorama = APP.$fotorama.data('fotorama');

        this.monitorActivity();
    },

    monitorActivity: function() {
        APP.idle = 0;
        var int = window.setInterval(function(){
            APP.idle++;
            console.log(APP.idle);
            if (APP.idle > APP.config.maxIdleSeconds) {
                console.log('idle time on more then max idls - starts autoplay');
                APP.fotorama.startAutoplay();
            }
        }, 1000);
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

