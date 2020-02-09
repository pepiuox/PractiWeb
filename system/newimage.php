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
                    $row = mysqli_fetch_array($database->query("SELECT * FROM `galleries` WHERE `idGal` = '$id' "));
                    if (isset($_POST['submitted'])) {
                        $sql = "INSERT INTO `image_gal` ( `galId` ,  `image` ,  `caption_en` ,  `link`   ) VALUES(  '{$id}' ,  '{$_POST['image']}' ,  '{$_POST['caption_en']}' ,  '{$_POST['link']}'   ) ";
                        $database->query($sql) or die($database->error);
                        echo "Fila Agregada.";
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    ?>
                    <p>
                        <a class="button" href='listGal.php'>Retornar a Galerias</a> - <a class="button"  href='listImg.php'>Retornar a Imagenes</a> 
                    </p>
                    <h3>Agregar Imagenes a <?php echo $row['gallery']; ?></h3> 

                    <form action='' method='POST'>                 
                        <div class='col_25_2'><label>Image:</label>
                            <script src="<?php echo SYST; ?>js/jquery.popupwindow.js" type="text/javascript"></script> 
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#imageUpload').on('click', function (event) {
                                        event.preventDefault();
                                        $.popupWindow('elfinder2/elfinder.html', {
                                            height: 420,
                                            width: 750
                                        });
                                    });
                                });

                                function processFile(file) {
                                    $('#picture').html('<img src="' + file + '" />');
                                    $('#image').val(file);
                                }
                            </script> 
                            <div id="picture">
                                <span>No hay imagen? Utilice el botón para seleccionar una!</span>
                            </div>
                            <div class="col_full">
                                <input type="text" name='image' id='image' placeholder="Imagen Url" readonly />
                                <input type="button" id="imageUpload" value='Seleccionar Imagen' />
                            </div>

                        </div> 
                        <div class="col_25_2 last">
                            <div class='col_full'><label>Descripción:</label><textarea name='caption_en' id='caption_en'></textarea></div> 
                            <div class='col_full'><label>Link:</label><input type='text' name='link' id='link'/></div>                         
                        </div>
                        <div class='col_full'><input type='submit' value='Agregar Imagen' /><input type='hidden' value='1' name='submitted' /></div> 
                        <div class="clear"></div>
                    </form> 
                <?php } ?>
            </div>
            <div class="clear"></div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
