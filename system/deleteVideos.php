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
                <a class='button' href='listVideos.php'>Retornar a la Lista</a> - <a class='button' href='newVideos.php'>Nueva video</a> 
            </p>
            <h3>Eliminado el video</h3> 

            <?php
            $idVd = (int) $_GET['idVd'];
            $database->query("DELETE FROM `videos` WHERE `idVd` = '$idVd' ");
            echo "Video Eliminado.<br /> ";
            ?> 

        </div>
    </div>
    <?php
}
include 'footer.php';
?> 
