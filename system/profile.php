<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div class="container">
        <main class="main">
            <div class="col_x_3">        
                <h3>Páginas</h3>
                <?php include 'editmenu.php'; ?> 
            </div>
            <div class="col_x_9 last"> 
                <h3>Editar de Perfil Visual</h3> 
                <?php
                $row = mysqli_fetch_array($database->query("SELECT * FROM `my_info` WHERE active = '1' AND `idPro` = '1' "));

                if (isset($_POST["submitted"]) && $_POST["submitted"] != "") {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    $fn = $_POST['first_name'];
                    $ln = $_POST['last_name'];
                    $ag = $_POST['age'];
                    $gd = $_POST['gender'];
                    $dn = $_POST['description_en'];
                    $ds = $_POST['description_es'];
                    $im = $_POST['image'];
                    $ac = $_POST['active'];

                    $sql = "UPDATE `my_info` SET  `first_name` =  '$fn' ,  `last_name` =  '$ln' ,  `age` =  '$ag' ,  `gender` =  '$gd', `description_en` =  '$dn', `description_es` =  '$ds', `image` =  '$im', `active` =  '$ac'  WHERE idPro = '1' ";
                    $database->query($sql);
                    if ($database->connect_errno) {
                        printf("Error en actualizar: %s\n", $database->connect_error);
                        exit();
                    } else {
                        echo 'Se edito el perfil';
                    }
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>                      
                <form action='' method='POST'>                     
                    <div class='col_x_6'>
                        <label>Nombres:</label><input type='text' name='first_name' id='first_name' value='<?php echo $row['first_name']; ?>' />
                        <label>Apellidos:</label><input type='text' name='last_name' id='last_name' value='<?php echo $row['last_name']; ?>' />
                        <label>Edad:</label><input type='text' name='age' id='age' value='<?php echo $row['age']; ?>' />
                        <label>Genero:</label>
                        <select name='gender' id='gender'>
                            <?php
                            $aage = array("Mujer", "Varon");

                            reset($aage);

                            while (list($key, $val) = each($aage)) {
                                if ($row['gender'] == $key) {
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
                        <label>Activar:</label>
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
                    <div class='col_x_6 last'>
                        <label>Imagen:</label>                                 
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

                    <div class='col_full'><label>Descripción personal / Ingles:</label>                                                               
                        <textarea name='description_en' id='description_en'><?php echo $row['description_en']; ?></textarea>
                        <script>
                            CKEDITOR.replace('description_en', {
                                filebrowserBrowseUrl: 'elFinder/elfinder.html'
                            });
                        </script>
                    </div> 
                    <div class='col_full'><label>Descripción personal / Español:</label>                                                               
                        <textarea name='description_es' id='description_es'><?php echo $row['description_es']; ?></textarea>
                        <script>
                            CKEDITOR.replace('description_es', {
                                filebrowserBrowseUrl: 'elFinder/elfinder.html'
                            });
                        </script>
                    </div> 

                    <div class='col_full'><input class="button" type='submit' value='Editar Perfil' /><input type='hidden' value='1' name='submitted' /></div> 
                    <div class="clear"></div>
                </form>   

            </div>            
            <div class="clear"></div>
        </main>
    </div>
<?php } include 'footer.php'; ?>