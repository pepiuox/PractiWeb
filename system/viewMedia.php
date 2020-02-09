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
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = (int) $_GET['id'];
                }
                $row = mysqli_fetch_array($database->query("SELECT * FROM multimedia_gal LEFT JOIN galleries ON multimedia_gal.galId=galleries.idGal WHERE `id` = '$id' "));
                ?>

                <a class="button" href='listMedia.php'>Retornar a la Lista</a> - <a class="button" href='newMedia.php'>Nueva Fila</a> 

                <h3>Vista de multimedia_gal</h3> 

                <div class='col_full'> 
                    <div class='col_25_2'><label>Galeria:</label><?php echo $row['gallery']; ?></div> 
                    <div class='col_25_2'><label>Título:</label><?php echo $row['title']; ?></div> 
                    <div class='col_25_2'><label>Imagen:</label><img src="<?php echo $row['image']; ?>" width="220" /></div> 
                    <div class='col_25_2'><label>Descripción:</label><?php echo $row['description']; ?></div> 
                    <div class='col_25_2'><label>Origen:</label>
                        <?php
                        if ($row['source'] == 0) {
                            echo 'youtube';
                        } elseif ($row['source'] == 1) {
                            echo 'vimeo';
                        } else {
                            echo 'daylimotion';
                        }
                        ?>
                    </div> 
                    <div class='col_25_2'><label>Id Video:</label><?php echo $row['idlink']; ?></div>                 
                </div> 
            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
