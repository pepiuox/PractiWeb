$(document).ready(function () {
    function imageLoaded() {
        var w = $(this).width();
        var h = $(this).height();
        var parentW = $(this).parent().width();
        var parentH = $(this).parent().height();
        var rW = w / parentW;
        var rH = h / parentH;

//console.log(w + '-' + h + '-' + parentW + '-' + parentH);
        if (w > parentW) {
            $(this).css('left', '0px');
            $(this).css('top', -($(this).height() - parentH) / 2);
            $(this).css('width', parentW).css('height', 'auto');
        } else if (w < parentW) {
            $(this).css('left', '0px');
            $(this).css('width', parentW).css('height', 'auto');
            $(this).css('top', -($(this).height() - parentH) / 2);
        }
        if (h > parentH) {
            $(this).css('top', '0px');
            $(this).css('left', -($(this).width() - parentW) / 2);
            $(this).css('height', parentH).css('width', 'auto');
        } else if (h < parentH) {
            $(this).css('left', '0px');
            $(this).css('height', parentH).css('width', 'auto');
            $(this).css('top', -($(this).width() - parentW) / 2);
        }
        return false;
    }
    $('.mySlides img').each(function () {
        if (this.complete) {
            imageLoaded.call(this);
        } else {
            $(this).one('load resize', imageLoaded);
        }
    });


    $("img.scale").imageScale({
        rescaleOnResize: true
    });
    // 
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
        $('li.previewImage' + currentImage).hide();
        $('a.thumbnailsimage' + currentImage).removeClass("active");
        currentImage--;
        if (currentImage === 0) {
            currentImage = imagesTotal;
        }

        $('a.thumbnailsimage' + currentImage).addClass("active");
        $('li.previewImage' + currentImage).show();
        startCounter(currentImage);
        return false;
    }
    $('a.previousSlideArrow').click(function (e) {
        e.preventDefault();
        prev();
    });
    // ============================

    // NEXT ARROW CODE
    function next() {
        $('li.previewImage' + currentImage).hide();
        $('a.thumbnailsimage' + currentImage).removeClass("active");
        currentImage++;
        if (currentImage === imagesTotal + 1) {
            currentImage = 1;
        }

        $('a.thumbnailsimage' + currentImage).addClass("active");
        $('li.previewImage' + currentImage).show();
        startCounter(currentImage);
        return false;
    }
    $('a.nextSlideArrow').click(function (e) {

        next();
        e.preventDefault();
    });
    // BULLETS CODE                

    function changeImage(n) {
        $('li.previewImage' + currentImage).hide();
        currentImage = n;
        $('li.previewImage' + n).show();
        $('.galleryThumbnails a').removeClass("active");
        $('.thumbnailsimage' + currentImage).addClass("active");
        $(".galleryThumbnailsContainer").hide();
        $(".galleryPreviewContainer").show();
        $(".square").hide();
        $(".boxes").show();
        startCounter(n);
        return false;
    }
    // ============================    

    $('.thumbSlides').click(function (e) {

        var newImage = $('.thumbSlides').index(this) + 1;
        changeImage(newImage);
        $(".galleryThumbnailsContainer").hide();
        $(".galleryPreviewContainer").show();
        $(".square").hide();
        $(".boxes").show();
        startCounter(newImage);
        e.preventDefault();
    });
    //$(".galleryContent").hide();

    // Listen for click of prev icon
    $(".prev").click(function (e) {

        prev();
        e.preventDefault();
    });
    // Listen for click of next icon
    $(".next").click(function (e) {

        next();
        e.preventDefault();
    });
    $(".boxes").click(function (e) {

        clearInterval(IntID);
        $(".galleryPreviewContainer").hide();
        $(".galleryThumbnailsContainer").show();
        $(".square").show();
        $(".boxes").hide();
        return false;
        e.preventDefault();
    });
    $(".galleryPreviewContainer").hide();
    // Listen for click of boxes icon
    $(".boxes").hide();

    $(".square").click(function (e) {

        $(".galleryThumbnailsContainer").hide();
        $(".galleryPreviewContainer").show();
        $(".square").hide();
        $(".boxes").show();
        return false;
        e.preventDefault();
    });
    $("#gboxes img").click(function (e) {

        $(".boxes").show();
        $(".square").hide();
        currentImg();
        var nowIm = $('#gboxes img').index(this) + 1;
        if (nowIm <= total) {
            countImage(nowIm);
            $(".slider .slideImg").eq(nowIm - 1).fadeIn(1000);
        }
        $(".gallerybox").toggle("fast");
        $(".slider").toggle("fast");
        return false;
        e.preventDefault();
    });

});
