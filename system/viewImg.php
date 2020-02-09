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
                $row = mysqli_fetch_array($database->query("SELECT * FROM `image_gal` LEFT JOIN galleries ON image_gal.galId=galleries.idGal WHERE `id` = '$id' "));
                ?>
                <p>
                    <a class="button" href='listImg.php'>Retornar a la Lista</a> - <a class="button" href='newImg.php'>Nueva Imagen</a> 
                </p>
                <h3>Vista de imagenes</h3> 

                <div class='col_full'>    
                    <div class='col_25_2'>
                        <label>Galeria : <?php echo $row['gallery']; ?></label>                                  
                    </div>
                    <div class='col_25_2'><label>Imagen:</label>
                        <img src="<?php echo $row['image']; ?>" width="200" />
                    </div>                 
                    <div class='col_25_2'>
                        <label>Descripción:</label>
                        <p>
                            <?php echo $row['caption_en']; ?>    
                        </p>
                    </div> 

                </div> 
            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
