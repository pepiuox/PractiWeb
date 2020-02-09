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
                    if (isset($_POST['submitted'])) {
                        $sql = "UPDATE `image_gal` SET  `galId` =  '{$_POST['galId']}' ,  `image` =  '{$_POST['image']}' ,  `caption_en` =  '{$_POST['caption_en']}' ,  `caption_es` =  '{$_POST['caption_es']}', `paypal_code` =  '{$_POST['paypal_code']}', `link` =  '{$_POST['link']}'  WHERE `id` = '$id' ";
                        $database->query($sql) or die($database->error);
                        printf("Imagen Editada.\n", $database->affected_rows);
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    $row = mysqli_fetch_array($database->query("SELECT * FROM `image_gal` WHERE `id` = '$id' "));
                    ?>
                    <p>
                        <a class="button" href='listImg.php'>Retornar a la Lista</a> - <a class="button" href='newImg.php'>Nueva Imagen</a> 
                    </p>
                    <h3>Editar de Imagen para galeria</h3> 

                    <form action='' method='POST'> 
                        <div class="col_25_2">   
                            <div class='col_full'><label>Galeria:</label>
                                <select name='galId' id='galId'> 
                                    <?php
                                    $sql1 = "SELECT * FROM galleries";
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
                            <div class='col_full'><label>Codigo Paypal:</label><textarea name='paypal_code' id='paypal_code'><?php echo $row['paypal_code']; ?></textarea></div>
                            <div class='col_full'><label>Link:</label><input type='text' name='link' id='link' value='<?php echo $row['link']; ?>' /></div>                         
                        </div>
                        <div class='col_25_2 last'><label>Imagen de página:</label>
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
                            <span>Selecciona una imagen si desea cambiar la imagen? Utilice el botón para seleccionar una!</span>
                            <div class="col_full">
                                <input type="text" name='image' id='image' value='<?php echo $row['image']; ?>' readonly />
                                <input type="button" id="imageUpload" value='Seleccionar Imagen' />
                            </div>                        
                        </div>   

                        <div class='col_full'><label>Descripción EN:</label><textarea name='caption_en' id='caption_en'><?php echo $row['caption_en']; ?></textarea>                                                          
                            <script>
                                CKEDITOR.replace('caption_en', {
                                    filebrowserBrowseUrl: 'elfinder/elfinder.html',
                                    filebrowserImageBrowseUrl: 'elfinder/elfinder.html',
                                    filebrowserUploadUrl: 'elfinder/elfinder.html',
                                    filebrowserImageUploadUrl: 'elfinder/elfinder.html',
                                    imageUploadUrl: 'elfinder/elfinder.html'
                                });
                            </script>
                        </div> 
                        <div class='col_full'><label>Descripción ES:</label><textarea name='caption_es' id='caption_es'><?php echo $row['caption_es']; ?></textarea>
                            <script>
                                CKEDITOR.replace('caption_es', {
                                    filebrowserBrowseUrl: 'elfinder/elfinder.html',
                                    filebrowserImageBrowseUrl: 'elfinder/elfinder.html',
                                    filebrowserUploadUrl: 'elfinder/elfinder.html',
                                    filebrowserImageUploadUrl: 'elfinder/elfinder.html',
                                    imageUploadUrl: 'elfinder/elfinder.html'
                                });
                            </script>
                        </div>
                        <div class='col_full'><input type='submit' value='Editar Imagen' /><input type='hidden' value='1' name='submitted' /></div> 
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
