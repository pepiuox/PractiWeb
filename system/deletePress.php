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
                    <a class="button" href='listPress.php'>Retornar a la Lista</a> - <a class="button" href='newPress.php'>Nueva Fila</a> 
                </p>
                <h3>Eliminado de Publicacion</h3> 

                <?php
                $idPr = (int) $_GET['idPr'];
                $database->query("DELETE FROM `press_gal` WHERE `idPr` = '$idPr' ");
                echo ($database->affected_rows) ? "Publicacion Eliminada.<br /> " : "No se Elimino.<br /> ";
                ?> 

            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
