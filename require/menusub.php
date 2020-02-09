<!-- menu sub-->


<script language="JavaScript">
    (function ($) {
        $(document).ready(function () {
            $('.topnav li.has-sub>a').on('click', function () {
                $(this).removeAttr('href');
                var element = $(this).parent('li');
                if (element.hasClass('open')) {
                    element.removeClass('open');
                    element.find('li').removeClass('open');
                    element.find('ul').slideUp();
                } else {
                    element.addClass('open');
                    element.children('ul').slideDown();
                    element.siblings('li').children('ul').slideUp();
                    element.siblings('li').removeClass('open');
                    element.siblings('li').find('li').removeClass('open');
                    element.siblings('li').find('ul').slideUp();
                }
            });

            $('.topnav>ul>li.has-sub>a').append('<span class="holder"></span>');

            (function getColor() {
                var r, g, b;
                var textColor = $('.topnav').css('color');
                textColor = textColor.slice(4);
                r = textColor.slice(0, textColor.indexOf(','));
                textColor = textColor.slice(textColor.indexOf(' ') + 1);
                g = textColor.slice(0, textColor.indexOf(','));
                textColor = textColor.slice(textColor.indexOf(' ') + 1);
                b = textColor.slice(0, textColor.indexOf(')'));
                var l = rgbToHsl(r, g, b);
                if (l > 0.7) {
                    $('.topnav>ul>li>a').css('text-shadow', '0 1px 1px rgba(0, 0, 0, .35)');
                    $('.topnav>ul>li>a>span').css('border-color', 'rgba(0, 0, 0, .35)');
                } else
                {
                    $('.topnav>ul>li>a').css('text-shadow', '0 1px 0 rgba(255, 255, 255, .35)');
                    $('.topnav>ul>li>a>span').css('border-color', 'rgba(255, 255, 255, .35)');
                }
            })();

            function rgbToHsl(r, g, b) {
                r /= 255, g /= 255, b /= 255;
                var max = Math.max(r, g, b), min = Math.min(r, g, b);
                var h, s, l = (max + min) / 2;

                if (max == min) {
                    h = s = 0;
                } else {
                    var d = max - min;
                    s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
                    switch (max) {
                        case r:
                            h = (g - b) / d + (g < b ? 6 : 0);
                            break;
                        case g:
                            h = (b - r) / d + 2;
                            break;
                        case b:
                            h = (r - g) / d + 4;
                            break;
                    }
                    h /= 6;
                }
                return l;
            }
        });
    })(jQuery);

</script>

<div class="pl-4 menu">
    <ul class="topnav" id="myTopnav">
        <li class="iconMenu"><a href="javascript:void(0);" onclick="myFunction()">Menu<span>&#9776;</span></a></li>
            <?php

            function mmenu($parent) {
                global $lng;
                global $database;
                $menu = "";
                $mUrl = $_SERVER['HTTP_HOST'];


                $result = $database->query("SELECT * FROM page WHERE parent='$parent' AND language = '$lng' AND active='1' ORDER BY pos");

                while ($row = $result->fetch_array()) {
                    //permalinke functions                    
                    $par = $row['parent'];
                    if ($row['parent'] > 0) {
                        $res = $database->query("SELECT id, link FROM page WHERE id='$par'");
                        $rom = $res->fetch_assoc();
                        $pr = $rom['link'];
                        $findme = 'http';
                        $pli = strpos($row['link'], $findme);

                        if ($pli === false) {
                            $menu .= "  <li><a href='http://" . $mUrl . '/' . $pr . '/' . $row['link'] . "/'>" . $row['title'] . "</a>\n";
                        } else {
                            $menu .= "<li><a href='" . $row['link'] . "' target='_blank'>" . $row['title'] . "</a>\n";
                        }
                    } else {
                        if ($row['sort'] == 0) {
                            if ($pli === false) {
                                $menu .= "<li><a href='" . $row['link'] . "' target='_blank'>" . $row['title'] . "</a>\n";
                            } else {
                                $menu .= "<li><a href='http://" . $mUrl . '/' . $row['link'] . "/'>" . $row['title'] . "</a>\n";
                            }
                        } else {
                            $menu .= "  <li class='has-sub'><a href='#'>" . $row['title'] . "</a>\n";
                        }
                    }
                    if ($row['sort'] == 1) {
                        $menu .= "   <ul>\n" . mmenu($row['id']);
                        $menu .= "   </ul>\n";
                    }
                    $menu .= "  </li>\n";
                }
                return $menu;
            }

            echo mmenu(0);
            ?>
    </ul> 
</div>