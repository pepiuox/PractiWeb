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
                    $row = mysqli_fetch_array($database->query("SELECT * FROM `multimedia_gal` WHERE `id` = '$id' "));
                    if (isset($_POST['submitted'])) {
                        $sql = "UPDATE `multimedia_gal` SET  `galId` =  '{$_POST['galId']}' ,  `name` =  '{$_POST['name']}' ,  `image` =  '{$_POST['image']}' ,  `description_en` =  '{$_POST['description_en']}' ,,  `description_es` =  '{$_POST['description_es']}'  `source` =  '{$_POST['source']}' ,  `idlink` =  '{$_POST['idlink']}' WHERE `id` = '$id' ";
                        $database->query($sql) or die($database->error);
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    ?>

                    <a class="button" href='listMedia.php'>Retornar a la Lista</a> - <a class="button" href='newMedia.php'>Nuevo Multimedia</a> 

                    <h3>Editar de multimedia</h3> 

                    <form action='' method='POST'> 
                        <div class='col_25_2'><label>Galeria:</label>
                            <select name='galId' id='galId'> 
                                <?php
                                $sql1 = "SELECT * FROM galleries WHERE type='2'";
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
                        <div class='col_25_2 last'>                        
                            <label>Título:</label><input type='text' name='name' id='name' value='<?php echo $row['name']; ?>' />
                        </div>
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
                                <img class="scale" src="<?php echo $row['image']; ?>" />                            
                            </div>
                            <span>No hay imagen? Utilice el botón para seleccionar una!</span>
                            <div class="col_full">
                                <input type="text" name='image' id='image' placeholder="Imagen Url" value='<?php echo $row['image']; ?>' readonly />
                                <input type="button" id="imageUpload" value='Seleccionar Imagen' />
                            </div>
                        </div>                    
                        <div class='col_25_2 last'>    
                            <div class='col_full'><label>Descripción EN:</label>
                                <textarea name='description_en' id='description_en'><?php echo $row['description_en']; ?></textarea>
                            </div> 
                            <div class='col_full'><label>Descripción ES:</label>
                                <textarea name='description_en' id='description_es'><?php echo $row['description_es']; ?></textarea>
                            </div> 
                            <div class='col_full'><label>Origen:</label>                        
                                <select name='source' id='source'>
                                    <?php
                                    $acti = array("youtube", "vimeo", "daylimotion");
                                    reset($acti);
                                    while (list($key, $val) = each($acti)) {
                                        if ($row['source'] == $key) {
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
                            <div class='col_full'><label>Id Video:</label><input type='text' name='idlink' id='idlink' value='<?php echo $row['idlink']; ?>' /></div> 
                        </div>
                        <div class='col_full'><input type='submit' value='Editar Fila' /><input type='hidden' value='1' name='submitted' /></div> 
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
