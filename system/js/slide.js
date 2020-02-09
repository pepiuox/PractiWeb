$(function () {
    $("img.scale").imageScale({
        rescaleOnResize: true
    });
});



$(document).ready(function () {
    $("#loadimage").hide();
    
    function ImageL() {
        $('.mSlides img').each(function () {
            var iW = 0;
            var iH = 0;
            var cW = $('.mSlides').width();
            var cH = $('#loadimage').height();
            var radioC = cW / cH;

            iW = $(this).width();
            iH = $(this).height();
            var radio = iW / iH;

            if (iH < cH) {
                if (radio > radioC) {
                    $(this).attr({'width': cW + 'px', 'heigth': cW / radio + 'px'});

                    if (cW !== iW) {
                        $(this).css({'margin-top': '0px'});
                        var newPosL = (cW - iW) / 2;
                        $(this).css({'margin-left': newPosL + 'px'});
                    } else {
                        var newPosT = (cH - iH) / 2;
                        $(this).css({'margin-top': newPosT + 'px'});
                        $(this).css({'margin-left': '0px'});
                    }
                    if (iH === cH) {

                    } else {

                    }
                    $('.infodata').html('1a W:' + iW);
                    $('.infoimage').html('1a H:' + iH);
                } else {
                    $(this).attr({'width': cH * radio + 'px', 'heigth': cH + 'px'});
                    var newPosL = (cW - (cH * radio)) / 2;
                    $(this).css({'margin-top': '0px', 'margin-left': newPosL + 'px'});
                    $('.infodata').html('1b W:' + iW);
                    $('.infoimage').html('1b H:' + iH);
                }
            } else {
                if (radio < radioC) {
                    $(this).attr('heigth', cH + 'px');
                    $(this).attr('width', cH * radio + 'px');
                    var newPosL = (cW - (cH * radio)) / 2;
                    $(this).css('margin-top', '0px');
                    $(this).css('margin-left', newPosL + 'px');
                    $('.infodata').html('2a W:' + iW);
                    $('.infoimage').html('2a H:' + iH);
                } else {
                    $(this).attr('width', cW + 'px');
                    $(this).attr('heigth', cW / radio + 'px');
                    var newPosT = (cH - (cW / radio)) / 2;
                    $(this).css('margin-left', '0px');
                    $(this).css('margin-top', newPosT + 'px');
                    $('.infodata').html('2b W:' + iW);
                    $('.infoimage').html('2b H:' + iH);
                }
            }
        });
    }

    $(".imglink").mouseenter(function () {
        $(".galleryContainer").fadeOut(500).hide();
        $("#loadimage").fadeIn(500).show();
        var imagen = $(this).attr('data-src'); //Find Image Name
        $(".mSlides img").attr('src', imagen).load(ImageL);
    });
    $("ul.topnav li a").mouseleave(function () {
        $("#loadimage").fadeOut(500).hide();
        $(".galleryContainer").fadeIn(500).show();
        ;
        $('.mSlides img').attr('src', '').removeAttr('width').removeAttr('heigth').removeAttr("style");
    });

});

$(function () {

    // INIT Variables
    var IntID;
    var total = $(".galleryPreviewImage").find("li").length;
    var imagesTotal = total;
    var currentImage = 1;

    $('a.thumbnailsimage' + currentImage).addClass("active");

    // SET WIDTH for THUMBNAILS CONTAINER

    function startCounter(n) {
        $(".count").html(n + "/" + total);
    }
    startCounter(currentImage);


    // PREVIOUS ARROW CODE
    function prev() {
        $('li.previewImage' + currentImage).fadeOut(500).hide();
        $('a.thumbnailsimage' + currentImage).removeClass("active");

        currentImage--;

        if (currentImage === 0) {
            currentImage = imagesTotal;
        }

        $('a.thumbnailsimage' + currentImage).addClass("active");
        $('li.previewImage' + currentImage).fadeIn(500).show();
        startCounter(currentImage);
        return false;
    }
    $('a.previousSlideArrow').click(function () {
        prev();
    });
    // ============================

    // NEXT ARROW CODE
    function next() {
        $('li.previewImage' + currentImage).fadeOut(500).hide();
        $('a.thumbnailsimage' + currentImage).removeClass("active");

        currentImage++;

        if (currentImage === imagesTotal + 1) {
            currentImage = 1;
        }

        $('a.thumbnailsimage' + currentImage).addClass("active");
        $('li.previewImage' + currentImage).fadeIn(500).show();
        startCounter(currentImage);
        return false;
    }
    $('a.nextSlideArrow').click(function () {
        next();
    });
    // ============================
    /*
     function callEvent(n) {
     $('.thumbnailsimage' + n).click(function () {
     changeImage(n);
     });
     }*/
    // BULLETS CODE                

    function changeImage(n) {
        clearInterval(IntID);
        $('li.previewImage' + currentImage).fadeOut(500).hide();
        currentImage = n;
        $('li.previewImage' + n).fadeIn(500).show();
        $('.galleryThumbnails a').removeClass("active");
        $('a.thumbnailsimage' + currentImage).addClass("active");
        $(".galleryThumbnailsContainer").hide();
        $(".galleryPreviewContainer").show();
        $(".square").hide();
        $(".boxes").show();
        startCounter(n);
        return false;
    }
    // ============================

    // AUTOMATIC CHANGE SLIDES
    function autoChangeSlides() {
        $('li.previewImage' + currentImage).fadeOut(500).hide();
        $('a.thumbnailsimage' + currentImage).removeClass("active");
        currentImage++;
        if (currentImage === imagesTotal + 1) {
            currentImage = 1;
        }
        $('a.thumbnailsimage' + currentImage).addClass("active");
        $('li.previewImage' + currentImage).fadeIn(500).show();

        startCounter(currentImage);
    }
    IntID = setInterval(autoChangeSlides, 4000);

    $(".captionImag").hide();
    $(".galleryPreviewArrows").mouseenter(function () {
        $(".captionImag").toggle();
        return false;
    });
    $(".galleryPreviewArrows").mouseleave(function () {
        $(".captionImag").toggle();
        return false;
    });
    $(".galleryPreviewArrows").mouseover(function () {
        var Hm = $('.mySlides').height();
        var Wm = $('.mySlides').width();
        var Hi = $('.mySlides img:visible').height();
        var ntop = (((Hm - Hi) / 2) + Hi) - 30;
        $(".captionImag:visible").css({'top': ntop + 'px'});
        return false;
    });
     $(".galleryContent").hide();
    $(".info").click(function () {
        $(".desHide").toggle();
        $(".desShow").toggle();
        $(".galleryContent").toggle();
        return false;
    });
    $(".desHide").hide();
    $(".desShow").click(function () {
        $(".desHide").toggle();
        $(".desShow").toggle();
        $(".galleryContent").toggle();
        return false;
    });
    $(".desHide").click(function () {
        $(".desHide").toggle();
        $(".desShow").toggle();
        $(".galleryContent").toggle();
        return false;
    });
    // Listen for click of prev icon
    $(".prev").click(function () {
        prev();
    });
    $(".play").hide();
    // Listen for click of play icon
    $(".play").click(function () {
        IntID = setInterval(autoChangeSlides, 4000);
        $(".pause").show();
        $(".play").hide();
        return false;
    });
    // Listen for click of pause icon
    $(".pause").click(function () {
        clearInterval(IntID);
        $(".play").show();
        $(".pause").hide();
        return false;
    });   
    $(".stopSlideArrow").click(function () {
        clearInterval(IntID);
        $(".play").show();
        $(".stopSlideArrow").hide();
        return false;
    });
    // Listen for click of pause icon    
    // Listen for click of next icon
    $(".next").click(function () {
        next();
    });
});