$(function () {

    'use strict';

    var $image = $('#image');
    var croppingData = {};

    $('#crop-btn').click(function () {
        croppingData = $image.cropper("getCroppedCanvas");
        $('.image-data').html(croppingData);
        $('#cropped-image').val(croppingData.toDataURL());
    });
});

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploaded-image").files[0]);
    oFReader.onload = function (oFREvent) {
        $('#crop-btn').show();
        $("#image").cropper('destroy');
        document.getElementById("image").src = oFREvent.target.result;
        $("#image").cropper();
    };
}
