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
                if (isset($_GET['idVd']) && !empty($_GET['idVd'])) {
                    $idVd = (int) $_GET['idVd'];
                }
                $row = mysqli_fetch_array($database->query("SELECT * FROM `videos` WHERE `idVd` = '$idVd' "));
                ?>
                <p>
                    <a class='button' href='listVideos.php'>Retornar a la Lista</a> - <a class='button' href='newVideos.php'>Nueva Video</a> 
                </p>
                <h3>Vista de videos</h3> 

                <div class='col_full'> 
                    <div class=''><label>Paginá:</label><?php echo $row['pageId']; ?></div> 
                    <div class=''><label>Título:</label><?php echo $row['title']; ?></div> 
                    <div class=''><label>Imagen:</label><?php echo $row['image']; ?></div> 
                    <div class=''><label>Descripción:</label><?php echo $row['description']; ?></div> 
                    <div class=''><label>Origen:</label><?php echo $row['source']; ?></div> 
                    <div class=''><label>Id Video:</label><?php echo $row['idlink']; ?></div> 
                    <div class=''><label>Activo:</label><?php echo $row['active']; ?></div> 
                </div> 
            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
