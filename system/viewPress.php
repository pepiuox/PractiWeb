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
                if (isset($_GET['idPr']) && !empty($_GET['idPr'])) {
                    $idPr = (int) $_GET['idPr'];
                }
                $row = mysqli_fetch_array($database->query("SELECT * FROM `press_gal`, `galleries` WHERE press_gal.galId=galleries.idGal AND `idPr` = '$idPr' "));
                ?>
                <p>
                    <a class="button" href='listPress.php'>Retornar a la Lista</a> - <a class="button" href='newPress.php'>Nueva Publicacion</a> 
                </p>
                <h3>Vista de Publicacion</h3> 

                <div class='col_full'>                 
                    <div class='col_full'><label>Galeria:</label><?php echo $row['gallery']; ?></div> 
                    <div class='col_full'><label>imagen:</label><img src="<?php echo $row['image']; ?>" width="220" /></div> 
                    <div class='col_25_2'><label>Título:</label><?php echo $row['title']; ?></div> 
                    <div class='col_25_2 last'><label>Sub Título:</label><?php echo $row['subtitle']; ?></div> 
                    <div class='col_full'><label>Descripción:</label><?php echo $row['description']; ?></div> 
                    <div class='col_25_2'><label>Fecha de publicacion:</label><?php echo $row['printing_date']; ?></div> 
                    <div class='col_25_2 last'><label>Tipo de publicacion:</label>
                        <?php
                        if ($row['type_press'] == 0) {
                            echo "Entrevista";
                        } else if ($row['type_press'] == 1) {
                            echo "Articulo";
                        } else {
                            echo "Catalogo";
                        }
                        ?>
                    </div> 
                </div> 
            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
