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
                    <a class="button" href='newImg.php'>Agregar Nueva Imagen</a> 
                </p>
                <h3>Lista de Imagenes en Galerias</h3>

                <?php
                echo "<table border=1 cellpadding=0 cellspacing=0 > \n";
                echo "<thead> \n";
                echo "<tr class=title> \n";
                echo "<th><b>Galeria</b></th> \n";
                echo "<th><b>Imagen</b></th>  \n";
                echo "<th></th><th></th><th></th> \n";
                echo "</tr> \n";
                echo "</thead> \n";
                echo "<tbody> \n";
                $result = $database->query("SELECT * FROM `image_gal` LEFT JOIN galleries ON image_gal.galId=galleries.idGal") or trigger_error($database->error);
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr> \n";
                    echo "<td valign='top' style='height:110px'>" . $row['gallery'] . "</td> \n";
                    echo "<td valign='top' style='height:110px'><img src='" . $row['image'] . "' /></td> \n";
                    echo "<td valign='top' style='height:110px'><a href='viewImg.php?id={$row['id']}'>Vista</a></td><td valign='top' style='height:110px'><a href='editImg.php?id={$row['id']}'>Editar</a></td><td style='height:110px'><a href='deleteImg.php?id={$row['id']}'>Eliminar</a></td> \n";
                    echo "</tr> \n";
                }
                echo "</tbody> \n";
                echo "<tfoot> \n";
                echo "<tr class=title> \n";
                echo "<th><b>Galeria</b></th> \n";
                echo "<th><b>Imagen</b></th> \n";
                echo "<th></th><th></th><th></th> \n";
                echo "</tr> \n";
                echo "</tfoot> \n";
                echo "</table> \n";
                ?> 
            </div>
            <div class="clear"></div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
