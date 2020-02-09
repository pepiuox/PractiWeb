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
                    $sql = "INSERT INTO `galleries` ( `gallery` ,  `name` ,  `type` ,  `description` ,  `pageId`,  `active`  ) VALUES(  '{$_POST['gallery']}' ,  '{$_POST['name']}' ,  '{$_POST['type']}' ,  '{$_POST['description']}' ,  '{$_POST['pageId']}' ,  '{$_POST['active']}'  ) ";
                    $database->query($sql) or die($database->error);
                    echo "Imagen Agregada.<br />";
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>
                <p>
                    <a class="button" href='listGal.php'>Retornar a la Lista</a> 
                </p>
                <h3>Agregar una Galeria</h3> 

                <form action='' method='POST'> 
                    <div class='col_25_2'>
                        <label>Nombre de galleria:</label>
                        <input type='text' name='gallery' id='gallery'/>
                    </div>  
                    <div class='col_25_2 last'>
                        <label>Nombre:</label>
                        <input type='text' name='name' id='name'/>
                    </div>                
                    <div class='col_25_2'>
                        <label>Tipo de galeria:</label>                   
                        <?php
                        $stpg = "SELECT * FROM type_gallery";
                        $querg = $database->query($stpg);
                        ?> 
                        <select name='type' id='type'>                             
                            <option>-- Selecciona tipo -- </option>
                            <?php
                            while ($tpg = mysqli_fetch_array($querg)) {
                                ?>     
                                <option value="<?php echo $tpg['idTG']; ?>"><?php echo $tpg['type_gallery']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div> 
                    <div class='col_full'><label>Descripción:</label>
                        <textarea name='description' id='description'></textarea>
                        <script>
                            CKEDITOR.replace('description', {
                                filebrowserBrowseUrl: 'elfinder/elfinder.html',
                                filebrowserImageBrowseUrl: 'elfinder/elfinder.html',
                                filebrowserUploadUrl: 'elfinder/elfinder.html',
                                filebrowserImageUploadUrl: 'elfinder/elfinder.html',
                                imageUploadUrl: 'elfinder/elfinder.html'
                            });
                        </script>
                    </div>           
                    <div class='col_25_2'><label>Página de visualización:</label>                    
                        <?php
                        $sqp1 = "SELECT * FROM page";
                        $queryp1 = $database->query($sqp1);
                        ?> 
                        <select name='pageId' id='pageId'>                            
                            <option>Selecciona una página </option>
                            <?php
                            while ($rp1 = mysqli_fetch_array($queryp1)) {
                                ?>     
                                <option value="<?php echo $rp1['id']; ?>"><?php echo $rp1['title']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div> 
                    <div class='col_25_2 last'><label>Activo:</label>
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
                    <div class='col_full'><input type='submit' value='Agregar Galeria' /><input type='hidden' value='1' name='submitted' /></div> 
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
