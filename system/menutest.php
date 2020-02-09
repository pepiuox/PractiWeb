<?php
if (isset($_POST["submit"])) {
    $id_ary = explode(",", $_POST["row_order"]);
    for ($i = 1; $i < count($id_ary); $i++) {
        $database->query("UPDATE page SET pos='" . $i . "' WHERE id=" . $id_ary[$i]);
    }
}
?>
<link href="<?php echo B_URL; ?>system/css/sortablemenu.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo B_URL; ?>system/js/sortablemenu.js" type="text/javascript"></script>
<style> 
    #sortable-row { list-style: none; margin: 0px; padding: 0px; }
    #sortable-row a{display: block; color:#F0F0F0;}
    #sortable-row li li a{display: block; color:#7C91A5;}
    #sortable-row li { margin-bottom:2px; padding-left:10px; background-color:#7C91A5;cursor:move;}
    #sortable-row li li { margin-bottom:2px; padding-left:10px; background-color:#EEEEEE;cursor:move;}
    .btnSave{padding: 10px 20px;background-color: #09F;border: 0;color: #FFF;cursor: pointer;margin-left:40px;}  
    #sortable-row li.ui-state-highlight { height: 1.0em; background-color:#F0F0F0;border:#ccc 2px dotted;}
</style>
<script>
    $(function () {
        $("#sortable-row").sortable({
            placeholder: "ui-state-highlight"
        });
    });

    function saveOrder() {
        var selectedLanguage = new Array();
        $('ul#sortable-row li').each(function () {
            selectedLanguage.push($(this).attr("id"));
        });
        document.getElementById("row_order").value = selectedLanguage;
    }
</script>
<div>
    <form name="frmQA" method="POST" />
    <h4 class='title' id='title0'>Ordene el menu si es necesario.</h4>
    <input type = "hidden" name="row_order" id="row_order" /> 
    <ul id="sortable-row" class="topnav">
        <ul class='space first-space' id='space'>
        <?php

        function mmenu($parent) {
            global $database;
            $menu = "";
            $result = $database->query("SELECT id, language, pos, title, link, image, parent, sort FROM page WHERE parent='$parent' ORDER BY pos");
            while ($rmen = $result->fetch_array()) {
                $menu .= "  <li id='{$rmen['id']}'><a href='editPage.php?id={$rmen['id']}&lng={$rmen['language']}'>" . $rmen['title'] . "</a>\n";
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
    <input type="submit" class="btnSave" name="submit" value="Guardar orden" onClick="saveOrder();" />
</form> 
</div>