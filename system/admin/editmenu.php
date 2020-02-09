<link href="<?php echo B_URL; ?>system/css/sortablemenu.css" rel="stylesheet" type="text/css"/>
<div class="menu">
    <ul class="topnav">
        <?php

        function mmenu($parent) {
            global $database;
            $menu = "";
            $result = $database->query("SELECT id, title, link, image, parent, sort FROM page WHERE parent='$parent'");
            
            while ($rmen = $result->fetch_array()) {
                $menu .= "  <li><a href='../editPage.php?id={$rmen['id']}'>" . $rmen['title'] . "</a>\n";
                if ($rmen['sort'] == 1) {
                    $menu .= "   <ul>\n" . mmenu($rmen['id']);
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