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
            if (isset($_GET['idVd']) && !empty($_GET['idVd'])) {
                $idVd = (int) $_GET['idVd'];
                if (isset($_POST['submitted'])) {
                    $sql = "UPDATE `videos` SET  `pageId` =  '{$_POST['pageId']}' ,  `title` =  '{$_POST['title']}' ,  `image` =  '{$_POST['image']}' ,  `description_en` =  '{$_POST['description_en']}',  `description_es` =  '{$_POST['description_es']}' ,  `source` =  '{$_POST['source']}' ,  `idlink` =  '{$_POST['idlink']}' ,  `active` =  '{$_POST['active']}'   WHERE `idVd` = '$idVd' ";
                    $database->query($sql) or die($database->error);
                    echo "Video Editado.<br />";
                    echo '<meta http-equiv="refresh" content="0">';
                }
                $row = mysqli_fetch_array($database->query("SELECT * FROM `videos` WHERE `idVd` = '$idVd' "));
                ?>

                <a class='button' href='listVideos.php'>Retornar a la Lista</a> - <a class='button' href='newVideos.php'>Nueva Video</a> 

                <h3>Editar de video</h3> 

                <form action='' method='POST'> 
                    <div class='col_25_2'>
                        <label>Imagen de página:</label>  
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
                    <div class='col_25_2 last'>
                        <div class='col_full'><label>Paginá:</label>
                            <?php
                            $sqp1 = "SELECT * FROM page";
                            $queryp1 = $database->query($sqp1);
                            ?> 
                            <select name='pageId' id='pageId'>                            
                                <option>Selecciona una página </option>
                                <?php
                                while ($rp1 = mysqli_fetch_array($queryp1)) {
                                    if ($rp1['id'] == $row['pageId']) {
                                        ?>     
                                        <option value="<?php echo $rp1['id']; ?>" selected><?php echo $rp1['title']; ?></option>
                                        <?php
                                    } else {
                                        ?>     
                                        <option value="<?php echo $rp1['id']; ?>"><?php echo $rp1['title']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div> 
                        <div class='col_full'><label>Título:</label><input type='text' name='title' id='title' value='<?php echo $row['title']; ?>' /></div>                    
                        <div class='col_full'><label>Descripción EN:</label><textarea name='description_en' id='description_en'><?php echo $row['description_en']; ?></textarea></div> 
                        <div class='col_full'><label>Descripción ES:</label><textarea name='description_es' id='description_es'><?php echo $row['description_es']; ?></textarea></div> 
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
                        <div class='col_full'>
                            <label>Activo:</label>
                            <select name='active' id='active'>
                                <?php
                                $acti = array("No", "Si");

                                reset($acti);

                                while (list($key, $val) = each($acti)) {
                                    if ($row['active'] == $key) {
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
                    </div>
                    <div class='col_full'><input class='button' type='submit' value='Editar Video' /><input type='hidden' value='1' name='submitted' /></div> 
                    <div class="clear"></div>
                </form> 

            <?php } ?> 
        </div>
        <div class="clear"></div>
    </div>
    <?php
}
include 'footer.php';
?> 
