$(function () {
   
    var ws = $(window).width();
    if (ws > 768) {
        $('.mySlides').each(function () {
            var nW = ($(window).width() / 2) - 60;
            var nH = nW / 1.5;
            $(this).css({
                'width': nW,
                'height': nH
            });
        });
    } else {
        $('.mySlides').each(function () {
            var nW = $(window).width() - 60;
            var nH = nW / 1.5;
            $(this).css({
                'width': nW,
                'height': nH
            });
        });
    }
    $('.mySlides').find('img').each(function () {

        var ddH = $('.mySlides').height();
        var ddW = $('.mySlides').width();
        var rdD = ddW / ddH;

        var img_height = $(this).height();
        var img_width = $(this).width();
        var rdI = img_width / img_height;

        if (img_width > img_height) {
            var iH = ddW / rdI;
            //IMAGE IS SHORTER THAN CONTAINER HEIGHT
            $(this).css({
                'width': ddW,
                'height': iH,
                'margin-left': '0px'
            });
            var newMargin = (ddH - iH) / 2;
            //CENTER IT VERTICALLY

            $(this).css({
                'margin-top': newMargin
            });

        } else {
            var iW = ddH / rdI;
            $(this).css({
                'width': iW,
                'height': ddH,
                'margin-top': '0px'
            });
            //CENTER IT HORIZONTALLY
            var newMargin = (ddW - iW) / 2;
            $(this).css({
                'margin-left': newMargin
            });
        }

    });

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
    $('.previousSlideArrow').click(function (e) {
        prev();
        e.preventDefault();
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
    $('.nextSlideArrow').click(function (e) {
        next();
        e.preventDefault();
    });

    // BULLETS CODE                

    function changeImage(n) {
        $('li.previewImage' + currentImage).hide();
        currentImage = n;
        $('li.previewImage' + n).show();
        $('.galleryThumbnails a').removeClass("active");
        $('a.thumbnailsimage' + currentImage).addClass("active");
        $(".galleryPreviewContainer").show();
        $(".square").hide();
        $(".boxes").show();
        startCounter(n);
        return false;
    }
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

    $('.arrows').hide();
    // ============================    
    $('.galleryPreviewArrows').mouseover(function () {
        $('.arrows').show();
    });
    $('.galleryPreviewArrows').mouseout(function () {
        $('.arrows').hide();
    });

    $('.thumbSlides').click(function (e) {
        e.preventDefault();
        var newImage = $(this).index() + 1;
        changeImage(newImage);
        startCounter(newImage);
    });

    // Listen for click of prev icon

    $(".playSlideArrow").hide();
    $(".stopSlideArrow").click(function (e) {

        clearInterval(IntID);
        $(".playSlideArrow").show();
        $(".stopSlideArrow").hide();
        return false;
        e.preventDefault();
    });
    $(".playSlideArrow").click(function (e) {

        IntID = setInterval(autoChangeSlides, 4000);
        $(".stopSlideArrow").show();
        $(".playSlideArrow").hide();
        return false;
        e.preventDefault();
    });
});
