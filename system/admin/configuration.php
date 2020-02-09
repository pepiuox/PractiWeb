<?php
include '../include/classes/session.php';
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include '../top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div id="main" class="container">  
        <div class="col_m_3">
            <h3>Editar Páginas</h3>
            <?php include 'editmenu.php'; ?> 
        </div>
        <div class='col_m_9 last'>              
            <?php
            if ($session->isAdmin()) {
                if (isset($_POST["submitted"]) && $_POST["submitted"] != "") {

                    $valueCount = count($_POST["config_name"]);
                    for ($i = 0; $i < $valueCount; $i++) {

                        $database->query("UPDATE `configuration` SET  `config_value` =  '{$_POST['config_value'][$i]}'   WHERE `config_name` = '{$_POST['config_name'][$i]} ");
                    }
                }
                ?>          
                <h3>Administrar Configuracion</h3> 
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
                    $result = $database->query("SELECT * FROM `configuration`") or trigger_error($database->error);
                    while ($row = $result->fetch_array()) {
                        foreach ($row AS $key => $value) {
                            $row[$key] = stripslashes($value);
                        }
                        echo "<tr>";
                        echo "<td valign='top'><input type='text' name='config_name[]' id='config_name' value='" . $row['config_name'] . "' readonly /></td>";
                        echo "<td valign='top'><input type='text' name='config_value[]' id='config_value' value='" . $row['config_value'] . "' /></td>";
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
                    <div class='col_25_2'><input class="button" type='submit' value='Editar configuracion' /><input type='hidden' value='1' name='submitted' /></div> 
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
