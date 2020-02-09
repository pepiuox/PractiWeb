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
                    <a class='button' href='listPro.php'>Retornar a la Lista</a> - <a class='button' href='newPro.php'>Nueva Fila</a> 
                </p>
                <h3>Eliminado de profile</h3> 

                <?php
                $idPro = (int) $_GET['idPro'];
                $database->query("DELETE FROM `my_info` WHERE `idPro` = '$idPro' ");
                echo ($database->affected_rows) ? "Fila Eliminada.<br /> " : "No se Elimino.<br /> ";
                ?> 

            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
