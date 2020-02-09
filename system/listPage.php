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
                    <a class="button" href='newPage.php'>Agregar Nueva Página</a> 
                </p>
                <h3>Lista de páginas </h3>

                <?php
                echo "<table border=1 cellpadding=0 cellspacing=0 >";
                echo "<thead>";
                echo "<tr class=title>";
                echo "<th><b>Título</b></th>";
                echo "<th><b>Tipo</b></th>";
                echo "<th><b>Inicio</b></th>";
                echo "<th><b>Padre</b></th>";
                echo "<th><b>Sub Paginas</b></th>";
                echo "<th><b>Activo</b></th>";
                echo "<th></th><th></th><th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $result = $database->query("SELECT * FROM `page` LEFT JOIN (SELECT id AS idt, type_page FROM type_page) type_page ON page.type = type_page.idt") or trigger_error($database->error);
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr>";
                    echo "<td valign='top'><b>" . $row['title'] . "</b> - <a class='button' href='subPage.php?id={$row['id']}'>Agregar Sub Página</a></td>";
                    echo "<td valign='top'>" . $row['type_page'] . "</td>";
                    echo "<td valign='top'>";
                    if ($row['starpage'] == 1) {
                        echo 'Si';
                    } else {
                        echo 'No';
                    }
                    echo "</td>";
                    $parnt = $row['parent'];
                    $rowp = mysqli_fetch_array($database->query("SELECT * FROM `page` WHERE `id` = '$parnt' "));
                    if ($row['parent'] == $rowp['id']) {
                        echo "<td valign='top'><b>" . $rowp['title'] . "</b></td>";
                    } else {
                        echo "<td valign='top'>Página principal</td>";
                    }
                    echo "<td valign='top'>";
                    if ($row['sort'] == '1') {
                        echo "<a href='listSubPage.php?id={$row['id']}'>Subpaginas</a>";
                    }
                    echo "</td>";
                    echo "<td valign='top'>";
                    if ($row['active'] == 1) {
                        echo 'Si';
                    } else {
                        echo 'No';
                    }
                    echo "</td>";
                    echo "<td valign='top'><a href='" . B_URL . "index.php?page={$row['id']}' target='_blank'>Vista</a></td><td valign='top'><a href='editPage.php?id={$row['id']}'>Editar</a></td><td><a href='deletePage.php?id={$row['id']}'>Eliminar</a></td> ";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr class=title>";
                echo "<th><b>Título</b></th>";
                echo "<th><b>Tipo</b></th>";
                echo "<th><b>Inicio</b></th>";
                echo "<th><b>Padre</b></th>";
                echo "<th><b>Sub Paginas</b></th>";
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
