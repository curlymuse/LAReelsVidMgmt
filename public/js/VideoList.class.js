var VideoList = Class.extend({

    url_category_update: '',
    url_puhlic_update: '',

    init: function(params) {
        var _class = this;
        _class.url_category_update = params.url_category_update;
        _class.url_public_update = params.url_public_update;
        _class.setupEvents();
        _class.populateCats();
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
        $('.public-button').on('click', function(){
            _class.updatePublicStatus($(this).attr('data-video-id'));
        });
    },

    populateCats: function() {
        $.each($('.cat-set'), function(i, el){
            var ids = $.parseJSON($(el).attr('data-orig-cats'));
            $.each(ids, function(j, id) {
                $(el).find('.cat-button[data-category-id="'+id+'"]')
                    .addClass('active')
                    .addClass('btn-info');
            });
        });
    },

    updatePublicStatus: function(videoId) {
        var _class = this;
        var data = {videoId: videoId};
        $.ajax(_class.url_public_update,{
            method: 'POST',
            data: data,
            success: _class._bind(_class, _class.cb_updatePublicStatus)
        });
    },

    updatePublicStatusView: function(videoId, isPublic) {
        var button = $('#pub_'+videoId);
        if (isPublic) {
            button.html('Public');
            button.removeClass('btn-danger').addClass('btn-success');
        } else {
            button.html('Private');
            button.removeClass('btn-success').addClass('btn-danger');
        }
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
            .html('Saved');
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
    },

    cb_updatePublicStatus: function(obj) {
        var _class = this;
        _class.updatePublicStatusView(obj.videoId, obj.is_public);
    },

    _bind: function(context, method) {
        return function () {
            return method.apply(context, arguments);
        }
    }

});
