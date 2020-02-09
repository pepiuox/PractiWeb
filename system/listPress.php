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
                <a class="button" href='newPress.php'>Nueva Publicacion</a> 

                <h3>Lista de Publicaciones</h3> 

                <?php
                echo "<table border=1 cellpadding=0 cellspacing=0 >";
                echo "<thead>";
                echo "<tr class=title>";
                echo "<th><b>Galeria</b></th>";
                echo "<th><b>Título</b></th>";
                echo "<th><b>Sub Título</b></th>";
                echo "<th><b>Fecha de publicacion</b></th>";
                echo "<th><b>Tipo de publicacion</b></th>";
                echo "<th></th><th></th><th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $result = $database->query("SELECT * FROM `press_gal`, `galleries` WHERE press_gal.galId=galleries.idGal") or trigger_error($database->error);
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr>";
                    echo "<td valign='top'>" . $row['gallery'] . "</td>";
                    echo "<td valign='top'>" . $row['title'] . "</td>";
                    echo "<td valign='top'>" . $row['subtitle'] . "</td>";
                    echo "<td valign='top'>" . $row['printing_date'] . "</td>";
                    echo "<td valign='top'>";
                    if ($row['type_press'] == 0) {
                        echo "Entrevista";
                    } else if ($row['type_press'] == 1) {
                        echo "Articulo";
                    } else {
                        echo "Catalogo";
                    }
                    echo "</td>";
                    echo "<td valign='top'><a href='viewPress.php?idPr={$row['idPr']}'>Vista</a></td><td valign='top'><a href='editPress.php?idPr={$row['idPr']}'>Editar</a></td><td><a href='deletePress.php?idPr={$row['idPr']}'>Eliminar</a></td> ";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr class=title>";
                echo "<th><b>Galeria</b></th>";
                echo "<th><b>Título</b></th>";
                echo "<th><b>Sub Título</b></th>";
                echo "<th><b>Fecha de publicacion</b></th>";
                echo "<th><b>Tipo de publicacion</b></th>";
                echo "<th></th><th></th><th></th>";
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
