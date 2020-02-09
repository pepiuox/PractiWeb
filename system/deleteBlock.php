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
                <?php
                $idB = (int) $_GET['idB'];
                $database->query("DELETE FROM `blocks` WHERE `idB` = '$idB' ");
                //echo "Bloque Eliminado.<br /> ";
                header("Location: listBlock.php");
                ?> 

            </div>
            <div class="clear"></div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
