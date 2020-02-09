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
                    <a class='button' href='listMedia.php'>Retornar a la Lista</a> - <a class="button" href='newMedia.php'>Nuevo multimedia</a> 
                </p>
                <h3>Eliminado de Multimedia</h3> 

                <?php
                $id = (int) $_GET['id'];
                $database->query("DELETE FROM `multimedia_gal` WHERE `id` = '$id' ");
                echo ($database->affected_rows) ? "Fila Eliminada.<br /> " : "No se Elimino.<br /> ";
                ?> 

            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
