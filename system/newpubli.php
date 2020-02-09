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
                        $sql = "INSERT INTO `press_gal` ( `galId` ,  `image`,  `title` ,  `subtitle` ,  `description` ,  `printing_date` ,  `type_press`  ) VALUES(  '$id' ,  '{$_POST['image']}' , '{$_POST['title']}' ,  '{$_POST['subtitle']}' ,  '{$_POST['description']}' ,  '{$_POST['printing_date']}' ,  '{$_POST['type_press']}'  ) ";
                        $database->query($sql) or die($database->error);
                        echo "Fila Agregada.<br />";
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    ?>
                    <p>
                        <a class="button" href='listPress.php'>Retornar a la Lista</a> 
                    </p>
                    <h3>Agregar a Publicación</h3> 

                    <form action='' method='POST'>  
                        <div class='col_25_2'><label>Imagen:</label>
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
                        <div class='col_25_2'><label>Título:</label><input type='text' name='title' id='title'/></div> 
                        <div class='col_25_2 last'><label>SubTítulo:</label><input type='text' name='subtitle' id='subtitle'/></div> 
                        <div class='col_full'><label>Descripción:</label><textarea name='description' id='description'></textarea></div> 
                        <div class='col_25_2'><label>Fecha de publicación:</label><input type='text' name='printing_date' id='printing_date'/></div> 
                        <div class='col_25_2 last'><label>Tipo de publicación:</label>                    
                            <select name='type_press' id='type_press'>
                                <?php
                                $acti = array("Entrevista", "Articulo", "Catalogo");
                                reset($acti);
                                while (list($key, $val) = each($acti)) {
                                    ?>     
                                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                    <?php
                                }
                                ?>     
                            </select>
                        </div> 
                        <div class='col_full'><input type='submit' value='Agregar Publicacion' /><input type='hidden' value='1' name='submitted' /></div> 
                        <div class="clear"></div>
                    </form> 
                    <?php
                }
                ?>
            </div>
            <div class="clear"></div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
