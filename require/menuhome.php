<!-- menu home -->
<script type="text/javascript" src="<?php echo B_URL; ?>system/js/scriptbreaker-multiple-accordion-1.js"></script>
<script language="JavaScript">
    $(document).ready(function () {
        $(".topnav").accordion({
            accordion: true,
            speed: 500
        });
    });
</script>
<script language="JavaScript">
    $(document).ready(function () {
        $('.topnav li.has-children ul').hide();
        var accordionsMenu = $('.topnav');

        if (accordionsMenu.length > 0) {

            accordionsMenu.each(function () {
                var accordion = $(this);
                //detect change in the input[type="checkbox"] value
                accordion.on('change', 'input[type="checkbox"]', function () {
                    var checkbox = $(this);
                    console.log(checkbox.prop('checked'));
                    (checkbox.prop('checked')) ? checkbox.siblings('ul').attr('style', 'display:none;').slideDown(300) : checkbox.siblings('ul').attr('style', 'display:block;').slideUp(300);
                });
            });
        }
    });
</script>
<!-- menu home -->
<div class="menu">
    <ul class="topnav">
        <?php

        function mmenu($parent) {
            global $database;
            $menu = "";
            $mUrl = $_SERVER['HTTP_HOST'];
            $language = $_SESSION['language'];
            $result = $database->query("SELECT id, language, title, link, image, parent, sort FROM page WHERE parent='$parent' AND language = '$language' AND active='1' ORDER BY pos");

            while ($row = $result->fetch_array()) {
                if ($row['id'] == '1') {
                    $menu .= "  <li>";
                } else {
                    if ($row['parent'] > 0) {
                        $res = $database->query("SELECT id, link FROM page WHERE id='$par'");
                        $rom = $res->fetch_assoc();
                        $pr = $rom['link'];
                        $menu .= "  <li><a href='http://" . $mUrl . '/' . $pr . '/' . $row['link'] . "/'";
                    } else {
                        $menu .= "  <li><a href='http://" . $mUrl . '/' . $row['link'] . "/'";
                        if ($row['image'] != '#') {
                            $menu .= " data-src='" . $row['image'] . "'";
                        }
                    }
                }
                $menu .= ">" . $row['title'] . "</a>\n";
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