$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});

$(function () {
    'use strict';

    var url = '/imageupload';

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        singleFileUploads: true,
        maxFileSize: 999000,
        previewMaxWidth: 300,
        previewMaxHeight: 300,
        previewCrop: false
    }).on('fileuploadadd', function (e, data) {

        $('#progress').fadeIn();
        data.context = $('<div class="fileinfo"><div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                .append($('<span/>').text(file.name));
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {

        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        console.log(data.files);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
    }).on('fileuploadprogressall', function (e, data) {

        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {

        $('#files').empty();
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var currentTime = (new Date()).getTime();
                $('#files').append("<div id='testimage'><img id='image' src='" + file.url + "?" + currentTime + "' /></div>");
                
                // reset the progress bar
                $('#progress').fadeOut();
                setTimeout(function () {
                    $('#progress .progress-bar').css('width', 0);
                }, 500);

            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {

        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    });
});