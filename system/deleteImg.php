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
                    <a class="button" href='listImg.php'>Retornar a la Lista</a> - <a class="button" href='newImg.php'>Nueva Fila</a> 
                </p>
                <h3>Eliminado de image_gal</h3> 

                <?php
                $id = (int) $_GET['id'];
                $database->query("DELETE FROM `image_gal` WHERE `id` = '$id' ");
                echo "Imagen Eliminada.<br /> ";
                ?> 

            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
