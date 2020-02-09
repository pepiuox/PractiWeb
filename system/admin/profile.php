<?php
include '../include/classes/session.php';
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include '../top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div id="main" class="container">                
        <div class='col_full'>       
            <?php
            if ($session->isAdmin()) {

                if (isset($_POST["submitted"]) && $_POST["submitted"] != "") {

                    $valueCount = count($_POST["info_name"]);
                    for ($i = 0; $i < $valueCount; $i++) {

                        $database->query("UPDATE `my_info` SET  `value` =  '{$_POST['value'][$i]}'   WHERE `info_name` = '{$_POST['info_name'][$i]}' ");
                    }
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>
                <h3>Administrar Perfil</h3> 
                <form action='' method='POST'> 
                    <?php
                    echo "<table border=1 cellpadding=0 cellspacing=0 >";
                    echo "<thead>";
                    echo "<tr class=title>";
                    echo "<th><b>Config / Nombre</b></th>";
                    echo "<th><b>Config / Valor</b></th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    $result = $database->query("SELECT * FROM `my_info`") or trigger_error($database->error);
                    while ($row = $result->fetch_array()) {
                        foreach ($row AS $key => $value) {
                            $row[$key] = stripslashes($value);
                        }

                        echo "<tr>";
                        echo "<td valign='top' widht='30%'><input type='text' name='info_name[]' id='info_name' value='" . $row['info_name'] . "' readonly /></td>";
                        if (strlen($row['value']) > 50) {
                            echo "<td valign='top'><textarea name='value[]' id='" . $row['info_name'] . "'>" . $row['value'] . "</textarea></td>";
                            echo "<script>
                            CKEDITOR.replace('" . $row['info_name'] . "', {
                                filebrowserBrowseUrl: 'elFinder/elfinder.html'
                            });
                        </script>";
                        } else {
                            echo "<td valign='top'><input type='text' name='value[]' id='" . $row['info_name'] . "' value='" . $row['value'] . "' /></td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "<tfoot>";
                    echo "<tr class=title>";
                    echo "<th><b>Config / Nombre</b></th>";
                    echo "<th><b>Config / Valor</b></th>";
                    echo "</tr>";
                    echo "</tfoot>";
                    echo "</table>";
                    ?>
                    <div class='col_full'><input class="button" type='submit' value='Editar Perfil' /><input type='hidden' value='1' name='submitted' /></div> 
                </form> 
            <?php } ?>
        </div>
    </div>
    <?php
} else {
    header("location: http://$bUrl/");
}
include '../footer.php';
?> 
