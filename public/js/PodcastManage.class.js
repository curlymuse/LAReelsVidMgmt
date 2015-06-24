var PodcastManage = Class.extend({

    url_toggle_publish: '',

    init: function(params) {
        var _class = this;
        _class.url_toggle_publish = params.url_toggle_publish;
        _class.setupPublish();
    },

    setupPublish: function() {
        var _class = this;
        $('.publish-button').on('click', function(){
            _class.updatePublishedStatus($(this).attr('data-podcast-id'));
        });
    },

    updatePublishedStatus: function(id) {
        var _class = this;
        var data = {podcastId: id};
        $.ajax(_class.url_toggle_publish,{
            method: 'POST',
            data: data,
            success: _class._bind(_class, _class.cb_updatePublishedStatus)
        });
    },

    cb_updatePublishedStatus: function(obj) {
        var button = $('#pub_'+obj.podcastId);
        if (obj.isPublished) {
            button.html('Published');
            button.removeClass('btn-danger').addClass('btn-success');
        } else {
            button.html('Unpublished');
            button.removeClass('btn-success').addClass('btn-danger');
        }
    },

    _bind: function(context, method) {
        return function () {
            return method.apply(context, arguments);
        }
    }

});