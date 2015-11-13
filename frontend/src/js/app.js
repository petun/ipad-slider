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

