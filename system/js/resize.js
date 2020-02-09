/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
window.addEventListener("resize", updateImageSize);
$(window).resize(function (evt) {
    var img = $('.mSlides img');
    var width = img.width();
    var height = img.height();
    var ratio = img.width() / img.height();
    if (ratio >= 1) {
        img.css({
            'min-width': '100%',
            'margin-top': ((img.parent().height() - height) / 2) + 'px'
        });
    } else {
        img.css({
            'min-height': '100%',
            'margin-left': ((img.parent().width() - width) / 2) + 'px'
        });
    }
    updateImageSize();
});
$(document).ready(function () {
    $('.mSlides img').each(function () {
        var img = $(this);
        fitimg(img);
        img.parent().resize(function () {
            fitimg(img);
        });
    });

    function fitimg(img) {
        var ratio = 0;
        var width = img.width();
        var height = img.height();

        ratio = width / height;
        if (ratio <= 1) {
            img.css({
                'min-width': '100%',
                'margin-top': ((img.parent().height() - height) / 2) + 'px'
            });
        } else {
            img.css({
                'min-height': '100%',
                'margin-left': ((img.parent().width() - width) / 2) + 'px'
            });
        }
    }


});
function updateImageSize() {
    $(".mSlides").each(function () {
        var ratio_cont = $(this).width() / $(this).height();
        var $img = $(this).find("img");
        var ratio_img = $img.width() / $img.height();
        if (ratio_cont > ratio_img)
        {
            $img.css({"width": "100%", "height": "auto"});
        } else if (ratio_cont < ratio_img)
        {
            $img.css({"width": "auto", "height": "100%"});
        }
    });
}
