<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div class='container'> 
        <main class="main">
            <div class="col_m_3">
                <h3>Páginas</h3>
                <?php include 'editmenu.php'; ?> 
            </div>
            <div class='col_m_9 last'>
                <p>
                    <a class="button" href='newType.php'>Agregar Nuevo Tipo de Página</a> 
                </p>
                <h3>Lista de Tipos de Página</h3>

                <?php
                echo "<table border=1 cellpadding=0 cellspacing=0 >";
                echo "<thead>";
                echo "<tr class=title>";
                echo "<th><b>Id</b></th>";
                echo "<th><b>Tipo de Página</b></th>";
                echo "<th></th><th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $result = $database->query("SELECT * FROM `type_page`") or trigger_error($database->error);
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr>";
                    echo "<td valign='top'>" . $row['id'] . "</td>";
                    echo "<td valign='top'>" . $row['type_page'] . "</td>";
                    echo "<td valign='top'><a href='editType.php?id={$row['id']}'>Editar</a></td><td><a href='deleteType.php?id={$row['id']}'>Eliminar</a></td> ";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr class=title>";
                echo "<th><b>Id</b></th>";
                echo "<th><b>Tipo de Página</b></th>";
                echo "<th></th><th></th>";
                echo "</tr>";
                echo "</tfoot>";
                echo "</table>";
                ?> 
            </div>
            <div class="clear"></div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
