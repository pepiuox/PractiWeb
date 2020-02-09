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
            <div class='col_full'> 
                <p>
                    <a class="button" href='listType.php'>Retornar a la Lista</a> - <a class="button" href='newType.php'>Nueva Fila</a> 
                </p>
                <h3>Eliminado de type_page</h3> 

                <?php
                $id = (int) $_GET['id'];
                $database->query("DELETE FROM `type_page` WHERE `id` = '$id' ");
                echo ($database->affected_rows) ? "Fila Eliminada.<br /> " : "No se Elimino.<br /> ";
                ?> 

            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
