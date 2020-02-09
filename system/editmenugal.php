<ul class="topnav">
    <?php

    function mmenu($parent) {
        global $database;
        $menu = "";
        $result = $database->query("SELECT id, gallery, link, parent, pageId FROM galleries WHERE parent='$parent'");
        $burl = B_URL;
        while ($rmen = $result->fetch_array()) {
            $menu .= "  <li><a href='editGal.php?id={$rmen['id']}'";
            if ($rmen['image'] != '#') {
                $menu .= " data-src='" . $burl . $rmen['folder'] . "/" . $rmen['image'] . "'";
            }
            $menu .= ">" . $rmen['gallery'] . "</a>\n";
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