<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div class='container'> 
        <div class="col_m_3">
            <h3>Páginas</h3>
            <?php include 'editmenu.php'; ?> 
        </div>
        <div class='col_m_9 last'>
            <?php
            if (isset($_POST['submitted'])) {
                $sql = "INSERT INTO `videos` ( `pageId` ,  `title` ,  `image` ,  `description_en` ,  `description_es`,  `source` ,  `idlink` ,  `active`  ) VALUES(  '{$_POST['pageId']}' ,  '{$_POST['title']}' ,  '{$_POST['image']}' ,  '{$_POST['description_en']}',  '{$_POST['description_es']}' ,  '{$_POST['source']}' ,  '{$_POST['idlink']}' ,  '{$_POST['active']}'  ) ";
                $database->query($sql) or die($database->error);
                echo "Video Agregada.<br />";
                echo '<meta http-equiv="refresh" content="0">';
            }
            ?>
            <p>
                <a class='button' href='listVideos.php'>Retornar a la Lista</a> 
            </p>
            <h3>Agregar Video</h3> 

            <form action='' method='POST'> 
                <div class='col_25_2'><label>Imagen:</label>
                    <script src="<?php echo SYST; ?>js/jquery.popupwindow.js" type="text/javascript"></script> 
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#imageUpload').on('click', function (event) {
                                event.preventDefault();
                                $.popupWindow('elfinder/elfinder.html', {
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
                    <div class='col_full'>
                        <input type="text" name='image' id='image' placeholder="Imagen Url" readonly />
                        <input type="submit" id="imageUpload" value='Seleccionar Imagen' />
                    </div>                        
                </div> 
                <div class='col_25_2 last'>
                    <div class='col_full'><label>Paginá:</label>
                        <?php
                        $stp1 = "SELECT * FROM page";
                        $quertp1 = $database->query($stp1);
                        ?> 
                        <select name='pageId' id='pageId'/>                             
                        <option>-- Selecciona Página -- </option>
                        <?php
                        while ($tp1 = mysqli_fetch_array($quertp1)) {
                            ?>     
                            <option value="<?php echo $tp1['id']; ?>"><?php echo $tp1['title']; ?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div> 
                    <div class='col_full'><label>Título:</label><input type='text' name='title' id='title'/></div>                 
                    <div class='col_full'><label>Descripción EN:</label><textarea name='description_en' id='description_en'></textarea></div> 
                    <div class='col_full'><label>Descripción ES:</label><textarea name='description_es' id='description_es'></textarea></div> 
                    <div class='col_full'><label>Origen:</label>
                        <select name='source' id='source'>
                            <?php
                            $acti = array("youtube", "vimeo", "daylimotion");
                            reset($acti);
                            while (list($key, $val) = each($acti)) {
                                ?>     
                                <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                <?php
                            }
                            ?>     
                        </select>
                    </div> 
                    <div class='col_full'><label>Id Video:</label><input type='text' name='idlink' id='idlink'/></div> 
                    <div class='col_full'>
                        <label>Activo:</label>
                        <select name='active' id='active'>
                            <?php
                            $acti = array("No", "Si");
                            reset($acti);
                            while (list($key, $val) = each($acti)) {
                                ?>     
                                <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                <?php
                            }
                            ?>     
                        </select>
                    </div>
                </div> 
                <div class='col_full'><input type='submit' value='Agregar Video' /><input type='hidden' value='1' name='submitted' /></div> 
                <div class="clear"></div>
            </form> 

        </div>
        <div class="clear"></div>
    </div>
    <?php
}
include 'footer.php';
?> 
