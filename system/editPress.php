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
                    $row = mysqli_fetch_array($database->query("SELECT * FROM `press_gal` WHERE `idPr` = '$idPr' "));

                    if (isset($_POST['submitted'])) {
                        $sql = "UPDATE `press_gal` SET  `galId` =  '{$_POST['galId']}' ,  `image` =  '{$_POST['image']}' , `title` =  '{$_POST['title']}' ,  `subtitle` =  '{$_POST['subtitle']}' ,  `description` =  '{$_POST['description']}' ,  `printing_date` =  '{$_POST['printing_date']}' ,  `type_press` =  '{$_POST['type_press']}'   WHERE `idPr` = '$idPr' ";
                        $database->query($sql) or die($database->error);
                        echo "Publicacion actualizado.<br />";
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    ?>
                    <p>
                        <a class="button" href='listPress.php'>Retornar a la Lista</a> - <a class="button" href='newPress.php'>Nueva Fila</a> 
                    </p>
                    <h3>Editar de Publicacion</h3> 

                    <form action='' method='POST'> 
                        <div class='col_25_2'>
                            <div class='col_full'>
                                <label>Galeria:</label>
                                <select name='galId' id='galId'> 
                                    <?php
                                    $sql1 = "SELECT * FROM galleries WHERE type='3'";
                                    $query1 = $database->query($sql1);
                                    ?>  
                                    <option>-- Seleccione galeria --</option>                            
                                    <?php
                                    while ($rs1 = mysqli_fetch_array($query1)) {
                                        if ($rs1['idGal'] == $row['galId']) {
                                            ?>     
                                            <option value="<?php echo $rs1['idGal']; ?>" selected><?php echo $rs1['gallery']; ?></option>
                                            <?php
                                        } else {
                                            ?>     
                                            <option value="<?php echo $rs1['idGal']; ?>"><?php echo $rs1['gallery']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div> 
                            <div class='col_full'><label>Título:</label><input type='text' name='title' id='title' value='<?php echo $row['title']; ?>' /></div> 
                            <div class='col_full'><label>Sub Título:</label><input type='text' name='subtitle' id='subtitle' value='<?php echo $row['subtitle']; ?>' /></div> 
                        </div> 
                        <div class='col_25_2 last'><label>Imagen:</label>
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
                                <img class="scale" src="<?php echo $row['image']; ?>" />                            
                            </div>
                            <div class='col_full'>
                                <input type="text" name='image' id='image' placeholder="Imagen Url" value='<?php echo $row['image']; ?>' readonly/>                            
                                <input type="button" id="imageUpload" value='Seleccionar Imagen' />
                            </div>       

                        </div>                         
                        <div class='col_full'><label>Descripción:</label><textarea name='description' id='description'><?php echo $row['description']; ?></textarea></div> 
                        <script>
                            CKEDITOR.replace('description', {
                                filebrowserBrowseUrl: 'elfinder/elfinder.html',
                                filebrowserImageBrowseUrl: 'elfinder/elfinder.html',
                                filebrowserUploadUrl: 'elfinder/elfinder.html',
                                filebrowserImageUploadUrl: 'elfinder/elfinder.html',
                                imageUploadUrl: 'elfinder/elfinder.html'
                            });
                        </script>
                        <div class='col_25_2'><label>Fecha de publicacion:</label><input type='text' name='printing_date' id='printing_date' value='<?php echo $row['printing_date']; ?>' /></div> 
                        <div class='col_25_2 last'><label>Tipo de publicacion:</label>
                            <select name='type_press' id='type_press'>
                                <?php
                                $acti = array("Entrevista", "Articulo", "Catalogo");
                                reset($acti);
                                while (list($key, $val) = each($acti)) {
                                    if ($key == $row['type_press']) {
                                        ?>     
                                        <option value="<?php echo $key; ?>" selected><?php echo $val; ?></option>
                                        <?php
                                    } else {
                                        ?>     
                                        <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                        <?php
                                    }
                                }
                                ?>     
                            </select>
                        </div> 
                        <div class='col_full'><input class="button" type='submit' value='Editar Publicacion' /><input type='hidden' value='1' name='submitted' /></div> 
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
