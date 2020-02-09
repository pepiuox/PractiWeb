<?php
//and open the template in the editor.
//   Created on : 08/07/2016, 09:05:35 PM
//   Author     : PePiuoX
?>
<!DOCTYPE html>
<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:website="http://ogp.me/ns/website" lang="en-US" itemscope itemtype="http://schema.org/WebPage" >
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />         
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="apple-mobile-web-app-capable" content="yes" />   
        <!-- Start icon devices compatibility -->        
        <link rel="shortcut icon" href="<?php echo B_URL; ?>system/img/favicon.ico"/>
        <link rel="icon" sizes="16x16 32x32 64x64" href="<?php echo B_URL; ?>system/img/favicon.ico"/>
        <link rel="icon" type="image/png" sizes="196x196" href="<?php echo B_URL; ?>system/img/favicon-192.png"/>
        <link rel="icon" type="image/png" sizes="160x160" href="<?php echo B_URL; ?>system/img/favicon-160.png"/>
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo B_URL; ?>system/img/favicon-96.png"/>
        <link rel="icon" type="image/png" sizes="64x64" href="<?php echo B_URL; ?>system/img/favicon-64.png"/>
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo B_URL; ?>system/img/favicon-32.png"/>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo B_URL; ?>system/img/favicon-16.png"/>
        <link rel="apple-touch-icon" href="<?php echo B_URL; ?>system/img/favicon-57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo B_URL; ?>system/img/favicon-114.png"/>
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo B_URL; ?>system/img/favicon-72.png"/>
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo B_URL; ?>system/img/favicon-144.png"/>
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo B_URL; ?>system/img/favicon-60.png"/>
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo B_URL; ?>system/img/favicon-120.png"/>
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo B_URL; ?>system/img/favicon-76.png"/>
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo B_URL; ?>system/img/favicon-152.png"/>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo B_URL; ?>system/img/favicon-180.png"/>

        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo B_URL; ?>system/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="<?php echo B_URL; ?>system/img/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo B_URL; ?>system/img/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo B_URL; ?>system/img/manifest.json">
        <link rel="mask-icon" href="<?php echo B_URL; ?>system/img/safari-pinned-tab.svg" color="#30778b">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="<?php echo B_URL; ?>system/img/mstile-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <meta name="msapplication-TileColor" content="#FFFFFF"/>
        <meta name="msapplication-TileImage" content="<?php echo B_URL; ?>system/img/favicon-144.png"/>
        <meta name="msapplication-config" content="<?php echo B_URL; ?>system/img/browserconfig.xml"/>
        <!-- End icon devices compatibility -->  
        <!-- Start SEO / SEM -->
        <link rel="canonical" href="<?php echo $url; ?>"/>
        <meta property="og:site_name" content="<?php echo SITE_NAME; ?>"/>
        <meta property="og:title" content="<?php echo $ttlp; ?>"/>
        <meta property="og:url" content="<?php echo $url; ?>"/>
        <meta property="og:image" content="<?php echo $imgp; ?>" />
        <meta property="og:description" content="<?php echo description; ?>" /> 
        <meta property="og:type" content="website"/>
        <meta property="og:locale:alternate" content="en_EN" />
        <meta property="og:locale:alternate" content="es_ES" />
        <meta property="fb:admins" content="<?php echo FACEBOOKID; ?>" /> 
        <meta itemprop="name" content="<?php echo $ttlp; ?>"/>
        <meta itemprop="url" content="<?php echo $url; ?>"/>
        <meta name="twitter:site" content="<?php echo TWITTER; ?>">
        <meta name="twitter:title" content="<?php echo $ttlp; ?>"/>
        <meta name="twitter:url" content="<?php echo $url; ?>"/>
        <meta name="twitter:card" content="summary"/>       
        <meta name="twitter:creator" content="<?php echo CREATOR; ?>">
        <meta name="twitter:image" content="<?php echo IMG_PAGE; ?>"> 
        <meta name="keywords" content="<?php echo keywords; ?>" />
        <meta name="description" content="<?php echo description; ?>" />
        <!-- End SEO / SEM -->
        <title><?php echo SITE_NAME; ?></title>
        <link href="<?php echo B_URL; ?>system/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo B_URL; ?>system/css/theme.css" rel="stylesheet" type="text/css"/>       
        <link href="<?php echo B_URL; ?>system/css/columnal.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato|Noto+Sans|Open+Sans|Source+Sans+Pro|Titillium+Web" rel="stylesheet" />                       

        <style> .logo img{
                width:100%;
                height:auto;
            }
        </style>        
        <script src="<?php echo B_URL; ?>system/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo B_URL; ?>system/js/jquery.fullscreen-min.js"></script>  
        <script>
            var fooHeight = $("body > footer.fixed").outerHeight(true);
            // Apply the height to the body
            $("body").css("margin-bottom", fooHeight + "px");
        </script>
        <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }

            $(window).on("load, resize", function () {
                var viewportWidth = $(window).width();
                if (viewportWidth < 768) {
                    $("div").find("sidebar").css("position", "relative");
                    $(".sidebar").removeClass("sidebar").addClass("sidebar-normal");
                }
                if (viewportWidth > 768) {
                    $("div").find("sidebar").css("position", "fixed");
                    $(".sidebar-normal").removeClass("sidebar-normal").addClass("sidebar");
                }
            });
        </script>
        <?php
        if ($session->logged_in && $session->isAdmin()) {
            ?>               
            <style>
                /* The Modal (background) */
                .modal {
                    display: none; /* Hidden by default */
                    position: fixed; /* Stay in place */
                    z-index: 1000; /* Sit on top */
                    padding-top: 100px; /* Location of the box */
                    left: 0;
                    top: 0;
                    width: 100%; /* Full width */
                    height: 100%; /* Full height */
                    overflow: auto; /* Enable scroll if needed */
                    background-color: rgb(0,0,0); /* Fallback color */
                    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                }

                /* Modal Content */
                .modal-content {
                    position: fixed;                        
                    width: 440px;
                    height: 200px;                        
                    background: #ffffff;
                    margin: auto;
                    padding: 0;
                    border: 1px solid #888;
                    -webkit-border-radius: 10px;
                    -moz-border-radius: 10px;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
                    -webkit-animation-name: animatetop;
                    -webkit-animation-duration: 0.4s;
                    animation-name: animatetop;
                    animation-duration: 0.4s
                }

                /* Add Animation */
                @-webkit-keyframes animatetop {
                    from {top:-300px; opacity:0} 
                    to {top:0; opacity:1}
                }

                @keyframes animatetop {
                    from {top:-300px; opacity:0}
                    to {top:0; opacity:1}
                }

                /* The Close Button */
                .close {
                    background-color: #1583CC;
                    color: white;
                    float: right;
                    padding: 4px 10px 6px 10px;
                    font-size: 14px;
                    font-weight: normal;
                    -webkit-border-radius: 6px;
                    -moz-border-radius: 6px;
                    border-radius: 6px;
                }

                .close:hover,
                .close:focus {
                    color: #000;
                    text-decoration: none;
                    cursor: pointer;
                }

                .modal-body {
                    width: 420px;
                    height: 180px;
                    background-color: #ffffff;
                    margin: 10px;
                    padding: 10px;                                               
                }

            </style>                                
            <?php
        }

        $scrBlocks = $database->query("SELECT id, type_block,idB, blockID, active, pageId FROM type_blocks, blocks WHERE type_blocks.id=blocks.blockId  AND active='1' AND pageId ='$bid'");
        $sblock = $scrBlocks->fetch_array();
        if (!empty($sblock['pageId'])) {
            require 'blocks/' . $sblock['type_block'] . '/script-' . $sblock['type_block'] . '.php';
        }
        ?>                
    </head>
    <body class="loading">
        
            <?php
            if ($session->logged_in && $session->isAdmin()) {
                include 'header-admin.php';
            }
            ?> 