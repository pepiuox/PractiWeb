<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div class='container'> 
        <div class="col_m_3">
            <h3>Páginas</h3>
            <?php include 'editmenu.php'; ?> 
        </div>
        <div class='col_m_9 last'> 
            <p>
                <a class='button' href='newVideos.php'>Nuevo Video</a> 
            </p>
            <h3>Lista de videos 

                <?php
                echo "<table border=1 cellpadding=0 cellspacing=0 >";
                echo "<thead>";
                echo "<tr class=title>";
                echo "<th><b>Paginá</b></th>";
                echo "<th><b>Título</b></th>";
                echo "<th><b>Imagen</b></th>";
                echo "<th><b>Origen</b></th>";
                echo "<th><b>Id Video</b></th>";
                echo "<th><b>Activo</b></th>";
                echo "<th></th><th></th><th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $result = $database->query("SELECT * FROM `videos` LEFT JOIN (SELECT id, title AS tp FROM page) `page` ON videos.idVd=page.id") or trigger_error($database->error);
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr>";
                    echo "<td valign='top'>" . $row['tp'] . "</td>";
                    echo "<td valign='top'>" . $row['title'] . "</td>";
                    echo "<td valign='top'><img src='" . $row['image'] . "' width='120px'/></td>";
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
                    echo "<td valign='top'>";
                    if ($row['active'] == 1) {
                        echo 'Si';
                    } else {
                        echo 'No';
                    }
                    echo "</td>";
                    echo "<td valign='top'><a href='" . B_URL . "index.php?page={$row['id']}' target='_blank'>Vista</a></td><td valign='top'><a href='editVideos.php?idVd={$row['idVd']}'>Editar</a></td><td><a href='deleteVideos.php?idVd={$row['idVd']}'>Eliminar</a></td> ";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr class=title>";
                echo "<th><b>Paginá</b></th>";
                echo "<th><b>Título</b></th>";
                echo "<th><b>Imagen</b></th>";
                echo "<th><b>Origen</b></th>";
                echo "<th><b>Id Video</b></th>";
                echo "<th><b>Activo</b></th>";
                echo "<th></th><th></th><th></th>";
                echo "</tr>";
                echo "</tfoot>";
                echo "</table>";
                ?> 
        </div>
        <div class="clear"></div>
    </div>
    <?php
}
include 'footer.php';
?> 
