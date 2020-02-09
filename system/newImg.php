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
                    $sql = "INSERT INTO `image_gal` ( `galId` ,  `image` ,  `caption_en` ,`caption_es` ,`paypal_code`,  `link`   ) VALUES(  '{$_POST['galId']}' ,  '{$_POST['image']}' ,  '{$_POST['caption_en']}',  '{$_POST['caption_es']}' ,'{$_POST['paypal_code']}',  '{$_POST['link']}'   ) ";
                    $database->query($sql) or die($database->error);
                    echo "Imagen Agregada.<br />\n";
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>
                <p>
                    <a class="button" href='listImg.php'>Retornar a la Lista</a> 
                </p>
                <h3>Agregar una Imagen</h3> 

                <form action='' method='POST'> 
                    <div class="col_25_2">
                        <div class='col_full'><label>Galeria:</label>               
                            <?php
                            $sql1 = "SELECT * FROM galleries WHERE type = '1'";
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
                        <div class='col_full'><label>Codigo Paypal:</label><textarea name='paypal_code' id='paypal_code'></textarea></div>
                        <div class='col_full'><label>Link:</label><input type='text' name='link' id='link'/></div>                     
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
                            <img class="scale" src="" />                        
                        </div>
                        <span>No hay imagen? Utilice el botón para seleccionar una!</span>
                        <div class="col_full">
                            <input type="text" name='image' id='image' placeholder="Imagen Url" readonly />
                            <input type="button" id="imageUpload" value='Seleccionar Imagen' />
                        </div>                       
                    </div>                     
                    <div class='col_full'><label>Descripción EN:</label><textarea name='caption_en' id='caption_en'></textarea>
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
                    <div class='col_full'><label>Descripción ES:</label><textarea name='caption_es' id='caption_es'></textarea>
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
                    <div class='col_full'><input type='submit' value='Agregar Imagen' /><input type='hidden' value='1' name='submitted' /></div> 
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
