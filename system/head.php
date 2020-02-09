<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="grey" />

<title><?php echo SITE; ?></title>
<!--[if lt IE 8]>
        <script src ="http://ie7-js.googlecode.com/svn/version/2.1(beta2)/IE8.js"></script>
<![endif]-->	
<script src="<?php echo B_URL; ?>system/js/jquery.min.js" type="text/javascript"></script>
<link href="<?php echo B_URL; ?>system/css/columnal.css" rel="stylesheet" type="text/css"/>                   
<link href="<?php echo B_URL; ?>system/css/meanmenu.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo B_URL; ?>system/css/foundation.min.css" rel="stylesheet" type="text/css"/>        
<script src="<?php echo B_URL; ?>system/js/vendor/foundation.min.js" type="text/javascript"></script>
<script src="<?php echo B_URL; ?>system/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
    CKEDITOR.replace('content',
            {
                filebrowserBrowseUrl: '/browser/browse.php',
                filebrowserUploadUrl: '/uploader/upload.php'
            });

    CKEDITOR.replace('content', {toolbar: 'MyToolbar'});
</script>
<script>
    //(set the floating bar)            
    $(function () {

        var menu = $('#headm'),
                pos = menu.offset();

        $(window).scroll(function () {
            if ($(this).scrollTop() > pos.top + menu.height() && menu.hasClass('default')) {
                menu.fadeOut('fast', function () {
                    $(this).removeClass('default').addClass('fixed').fadeIn('fast');
                });
            } else if ($(this).scrollTop() <= pos.top && menu.hasClass('fixed')) {
                menu.fadeOut('fast', function () {
                    $(this).removeClass('fixed').addClass('default').fadeIn('fast');
                });
            }
        });

    });
</script> 
<script>
    $(document).ready(function () {
        $('#thfloat').fixedHeaderTable({
            footer: true,
            cloneHeadToFoot: true,
            altClass: 'odd',
        });
    });
</script>
<script langauge="javascript">
    var counter = 0;
    window.setInterval("refreshDiv()", 4000);
    function refreshDiv() {
        document.getElementById("tlist").innerHTML;
    }
</script>
<script>
    $(document).ready(function () {
        // Get all the elements with class inputMaxLength and add maxlength attribute to them
        $("input").attr('maxlength', '100');
    });
</script>
<script>
    function UpdateTableHeaders() {
        $(".persist-area").each(function () {

            var el = $(this),
                    offset = el.offset(),
                    scrollTop = $(window).scrollTop(),
                    floatingHeader = $(".floatingHeader", this)

            if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
                floatingHeader.css({
                    "visibility": "visible"
                });
            } else {
                floatingHeader.css({
                    "visibility": "hidden"
                });
            }
            ;
        });
    }

// DOM Ready      
    $(function () {

        var clonedHeaderRow;

        $(".persist-area").each(function () {
            clonedHeaderRow = $(".persist-header", this);
            clonedHeaderRow
                    .before(clonedHeaderRow.clone())
                    .css("width", clonedHeaderRow.width())
                    .addClass("floatingHeader");

        });

        $(window)
                .scroll(UpdateTableHeaders)
                .trigger("scroll");

    });
</script>
