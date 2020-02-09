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
                    $sql = "INSERT INTO `my_info` ( `first_name` ,  `last_name` ,  `age` ,  `gender` ,  `description_en` ,  `description_es` ,  `image` ,  `active`  ) VALUES( ,  '{$_POST['first_name']}' ,  '{$_POST['last_name']}' ,  '{$_POST['age']}' ,  '{$_POST['gender']}' ,  '{$_POST['description']}' ,  '{$_POST['image']}' ,  '{$_POST['active']}'  ) ";
                    $database->query($sql) or die($database->error);
                    echo "Fila Agregada.<br />";
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>
                <p>
                    <a class='button' href='listPro.php'>Retornar a la Lista</a> 
                </p>
                <h3>Agregar a Perfil</h3> 

                <form action='' method='POST'>                 
                    <div class='col_25_2'><label>Nombres:</label><br /><input type='text' name='first_name' id='first_name'/></div> 
                    <div class='col_25_2 last'><label>Apellidos:</label><br /><input type='text' name='last_name' id='last_name'/></div> 
                    <div class='col_25_2'><label>Edad:</label><br /><input type='text' name='age' id='age'/></div> 
                    <div class='col_25_2 last'><label>Genero:</label><br /><input type='text' name='gender' id='gender'/></div> 
                    <div class='col_full'><label>Descripcion Ingles:</label><br /><textarea name='description_en' id='description_en'></textarea>
                        <script>
                            CKEDITOR.replace('description_en', {
                                filebrowserBrowseUrl: 'elFinder/elfinder.html'
                            });
                        </script></div> 
                    <div class='col_full'><label>Descripcion Español:</label><br /><textarea name='description_es' id='description_es'></textarea>
                        <script>
                            CKEDITOR.replace('description_es', {
                                filebrowserBrowseUrl: 'elFinder/elfinder.html'
                            });
                        </script>
                    </div> 
                    <div class='col_25_2'><label>Imagen:</label><br /><input type='text' name='image' id='image'/></div> 
                    <div class='col_25_2 last'><label>Activo:</label><br />
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
                    <div class='col_full'><input type='submit' value='Agregar Fila' /><input type='hidden' value='1' name='submitted' /></div> 
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
