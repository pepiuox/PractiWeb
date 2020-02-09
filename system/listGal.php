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
                    <a class="button" href='newGal.php'>Agregar Nueva galleries</a> 
                </p>
                <h3>Lista de galleries </h3>
                <style>
                    table a{
                        cursor: pointer;
                    }
                </style>
                <?php
                echo "<table border=1 cellpadding=0 cellspacing=0 >";
                echo "<thead>";
                echo "<tr class=name>";
                echo "<th><b>Galeria</b></th>";
                echo "<th><b>Nombre</b></th>";
                echo "<th><b>Tipo</b></th>";
                echo "<th><b>Contenido</b></th>";
                echo "<th><b>Página</b></th>";
                echo "<th><b>Activo</b></th>";
                echo "<th></th><th></th><th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $result = $database->query("SELECT * FROM `galleries` LEFT JOIN `type_gallery` ON galleries.type=type_gallery.idTG  LEFT JOIN (SELECT id, title AS npage FROM page)`page`  ON galleries.pageID=page.id") or trigger_error($database->error);
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr>";
                    echo "<td valign='top'>" . $row['gallery'] . "<br />";
                    if ($row['type'] == 1) {
                        echo "<a class='button' href='newimage.php?id={$row['idGal']}'>Agregar Imagenes</a>";
                    } else if ($row['type'] == 2) {
                        echo "<a class='button' href='newmultimedia.php?id={$row['idGal']}'>Agregar Multimedia</a>";
                    } else {
                        echo "<a class='button' href='newpubli.php?id={$row['idGal']}'>Agregar Publicaciones</a>";
                    }
                    echo "</td>";
                    echo "<td valign='top'>" . $row['name'] . "</td>";
                    echo "<td valign='top'>" . $row['type_gallery'] . "</td>";
                    echo "<td valign='top'>";
                    if ($row['type'] == 1) {
                        echo "<a href='listGalImg.php?gal={$row['idGal']}'>";
                    } elseif ($row['type'] == 2) {
                        echo "<a href='listGalMedia.php?gal={$row['idGal']}'>";
                    } else {
                        echo "<a href='listGalPress.php?gal={$row['idGal']}'>";
                    }
                    echo "Ver contenido</a></td>";
                    echo "<td valign='top'>" . $row['npage'] . "</td>";
                    echo "<td valign='top'>";
                    if ($row['active'] == 1) {
                        echo 'Si';
                    } else {
                        echo 'No';
                    }
                    echo "</td>";
                    echo "<td valign='top'><a href='" . B_URL . "index.php?page={$row['id']}' target='_blank'>Vista</a></td><td valign='top'><a href='editGal.php?id={$row['idGal']}'>Editar</a></td><td><a href='deleteGal.php?id={$row['idGal']}'>Eliminar</a></td> ";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr class=name>";
                echo "<th><b>Galeria</b></th>";
                echo "<th><b>Nombre</b></th>";
                echo "<th><b>Tipo</b></th>";
                echo "<th><b>Contenido</b></th>";
                echo "<th><b>Página</b></th>";
                echo "<th><b>Activo</b></th>";
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
