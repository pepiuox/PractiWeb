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
                    <a class='button' href='newMedia.php'>Agregar Nueva Multimedia</a> 
                </p>
                <h3>Lista de Multimedia</h3>

                <?php
                echo "<table border=1 cellpadding=0 cellspacing=0 >";
                echo "<thead>";
                echo "<tr class=title>";
                echo "<th><b>Galeria</b></th>";
                echo "<th><b>Nombre</b></th>";
                echo "<th><b>Origen</b></th>";
                echo "<th><b>Id Video</b></th>";
                echo "<th></th><th></th><th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $result = $database->query("SELECT * FROM multimedia_gal LEFT JOIN galleries ON multimedia_gal.galId=galleries.idGal") or trigger_error($database->error);
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr>";
                    echo "<td valign='top'>" . $row['gallery'] . "</td>";
                    echo "<td valign='top'>" . $row['name'] . "</td>";
                    echo "<td valign='top'>";
                    if ($row['source'] == 0) {
                        echo 'youtube';
                    } elseif ($row['source'] == 1) {
                        echo 'vimeo';
                    } else {
                        echo 'daylimotion';
                    }
                    echo "</td>";
                    echo "<td valign='top'>" . $row['idlink'] . "</td>";
                    echo "<td valign='top'><a href='viewMedia.php?id={$row['id']}'>Vista</a></td><td valign='top'><a href='editMedia.php?id={$row['id']}'>Editar</a></td><td><a href='deleteMedia.php?id={$row['id']}'>Eliminar</a></td> ";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr class=title>";
                echo "<th><b>Galeria</b></th>";
                echo "<th><b>Nombre</b></th>";
                echo "<th><b>Origen</b></th>";
                echo "<th><b>Id Video</b></th>";
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
