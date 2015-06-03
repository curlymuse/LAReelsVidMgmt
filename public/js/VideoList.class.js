var VideoList = Class.extend({

    url_category_update: '',

    init: function(params) {
        var _class = this;
        _class.url_category_update = params.url_category_update;
        _class.setupEvents();
    },

    setupEvents: function() {
        var _class = this;
        $('.cat-button').on('click', function () {
            var el = $(this);
            var catEl = $(this).parents('.cat-set');
            _class.toggleCategory(el);
            catEl.trigger('needsSave');
        });
        $('.cat-set').on('needsSave', function () {
            var el = $(this);
            if (!el.is('needsSave'))
                _class.needsSave(el);
        });
        $('.cat-set').on('isSaving', function () {
            var el = $(this).closest('.cat-set');
            _class.isSaving(el);
        });
        $('.cat-set').on('finishedSaving', function () {
            var el = $(this);
            _class.finishedSaving(el.attr('data-video-id'));
        });
        $('.statusButton').on('click', function () {
            var el = $(this);
            if (!el.is(':disabled'))
                _class.saveCategories(el.attr('data-video-id'));
        });
    },

    toggleCategory: function(el) {
        if (el.hasClass('active'))
            el.removeClass('btn-info');
        else
            el.addClass('btn-info');
    },

    needsSave: function(el) {
        var _class = this;
        el.addClass('needsSave');
        var statusButton = el.find('.statusButton');
        statusButton.removeClass('btn-success')
            .addClass('btn-danger')
            .prop('disabled', false)
            .html('Click to Save');
    },

    isSaving: function(el) {
        var _class = this;
        el.removeClass('needsSave');
        var statusButton = el.find('.statusButton');
        statusButton.removeClass('btn-danger')
            .addClass('btn-warning')
            .prop('disabled', true)
            .html('Saving...');
    },

    finishedSaving: function(videoID) {
        var _class = this;
        var el = $('#v_'+videoID);
        var statusButton = el.find('.statusButton');
        statusButton.removeClass('btn-warning')
            .addClass('btn-success')
            .prop('disabled', true)
            .html('Synced');
    },

    saveCategories: function(videoID) {
        var _class = this;
        var vidSet = $('#v_'+videoID);
        vidSet.trigger('isSaving');
        var categories = [];
        vidSet.find('.cat-button.active').each(function(i, tEl){
            categories.push($(tEl).attr('data-category-id'));
        });
        var data = {
            videoId: videoID,
            categories: categories
        }
        $.ajax(_class.url_category_update,{
            method: 'POST',
            data: data,
            success: _class.cb_saveCategories
        });
    },

    cb_saveCategories: function(obj) {
        var _class = this;
        var el = $('#v_'+obj.id);
        el.trigger('finishedSaving');
    }

});
