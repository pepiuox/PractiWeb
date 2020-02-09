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
                    <a class="button" href='newBlock.php'>Agregar Nuevo Bloque</a> 
                </p>
                <h3>Lista de bloques </h3>
                <?php
                echo "<table border=1 >";
                echo "<thead>";
                echo "<tr class=title>";
                echo "<th><b>Bloque</b></th>";
                echo "<th><b>Activo</b></th>";
                echo "<th><b>Página</b></th>";
                echo "<th></th><th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $result = $database->query("SELECT * FROM `blocks` LEFT JOIN `type_blocks` ON blocks.blockId = type_blocks.id LEFT JOIN (SELECT id AS npage , title FROM page)`page` ON blocks.pageId=page.npage");
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr>";
                    echo "<td valign='top'>" . $row['type_block'] . "</td>";
                    echo "<td valign='top'>";
                    if ($row['active'] == 1) {
                        echo 'Si';
                    } else {
                        echo 'No';
                    }
                    echo "</td>";
                    echo "<td valign='top'>" . $row['title'] . "</td>";
                    echo "<td valign='top'><a href=editBlock.php?idB={$row['idB']}>Editar</a></td><td><a href=deleteBlock.php?idB={$row['idB']}>Eliminar</a></td> ";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr class=title>";
                echo "<th><b>Bloque</b></th>";
                echo "<th><b>Activo</b></th>";
                echo "<th><b>Página</b></th>";
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