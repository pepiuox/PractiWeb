$(function () {
    $("img.scale").imageScale({
        rescaleOnResize: true
    });
    

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
    $('a.previousSlideArrow').click(function () {
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
    $('a.nextSlideArrow').click(function () {
        next();
    });

    // BULLETS CODE                

    function changeImage(n) {
        $('li.previewImage' + currentImage).hide();
        currentImage = n;
        $('li.previewImage' + n).show();
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

    $('.thumbSlides').click(function () {
        var newImage = $(this).index() + 1;
        changeImage(newImage);
        $(".galleryThumbnailsContainer").hide();
        $(".galleryPreviewContainer").show();
        $(".square").hide();
        $(".boxes").show();
        startCounter(newImage);
    });
    //$(".galleryContent").hide();
    
    // Listen for click of prev icon
    $(".prev").click(function () {
        prev();
    });

    $(".boxes").hide();

    // Listen for click of next icon
    $(".next").click(function () {
        next();
    });
    $(".galleryPreviewContainer").hide();
    // Listen for click of boxes icon
    
    $(".boxes").click(function () {
        clearInterval(IntID);
        $(".galleryPreviewContainer").hide();
        $(".galleryThumbnailsContainer").show();
        $(".square").show();
        $(".boxes").hide();
        return false;
    });
    $(".square").click(function () {
        $(".galleryThumbnailsContainer").hide();
        $(".galleryPreviewContainer").show();
        $(".square").hide();
        $(".boxes").show();
        return false;
    });
    $("#gboxes img").click(function () {
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
    });
});