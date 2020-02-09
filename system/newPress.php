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
                if (isset($_POST['submitted'])) {
                    $sql = "INSERT INTO `press_gal` ( `galId` ,  `image` , `title` ,  `subtitle` ,  `description` ,  `printing_date` ,  `type_press`  ) VALUES(  '{$_POST['galId']}' ,  '{$_POST['image']}',  '{$_POST['title']}' ,  '{$_POST['subtitle']}' ,  '{$_POST['description']}' ,  '{$_POST['printing_date']}' ,  '{$_POST['type_press']}'  ) ";
                    $database->query($sql) or die($database->error);
                    echo "Publicacion Agregada.<br />";
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>
                <p>
                    <a class="button" href='listPress.php'>Retornar a la Lista</a> 
                </p>
                <h3>Agregar a Publicacion</h3> 

                <form action='' method='POST'>  
                    <div class='col_25_2'><label>Galeria:</label>
                        <?php
                        $sql1 = "SELECT * FROM galleries WHERE type = '3'";
                        $query1 = $database->query($sql1);
                        ?>                    
                        <select name='galId' id='galId'>  
                            <option>Selecciona una galeria</option>                        
                            <?php while ($rs1 = mysqli_fetch_array($query1)) { ?>                                    
                                <option value="<?php echo $rs1['id']; ?>"><?php echo $rs1['gallery']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
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
                            <span>No hay imagen? Utilice el botón para seleccionar una!</span>
                        </div>
                        <div class="col_full">
                            <input type="text" name='image' id='image' placeholder="Imagen Url" readonly />
                            <input type="button" id="imageUpload" value='Seleccionar Imagen' />
                        </div>                    
                    </div> 
                    <div class='col_25_2'><label>Título:</label><input type='text' name='title' id='title'/></div> 
                    <div class='col_25_2 last'><label>Sub Título:</label><input type='text' name='subtitle' id='subtitle'/></div> 
                    <div class='col_full'><label>Descripción:</label><textarea name='description' id='description'></textarea></div> 
                    <div class='col_25_2'><label>Fecha de publicacion:</label><input type='text' name='printing_date' id='printing_date'/></div> 
                    <div class='col_25_2 last'><label>Tipo de publicacion:</label>
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

            </div>
            <div class="clear"></div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 