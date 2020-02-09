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

                if ($_POST['starpage'] == 1) {
                    //$qr = mysqli_fetch_array($database->query("SELECT * FROM `page` WHERE `starpage` = '1' "));

                    $st = "UPDATE `page` SET `starpage` = '0' WHERE `starpage` = '1'";
                    $database->query($st) or die($database->error);
                }
                $posrt = $_POST['parent'];
                if ($posrt > 0) {
                    $st = "UPDATE `page` SET `sort` = '1' WHERE `id` = '$posrt'";
                }
                $sql = "INSERT INTO `page` ( `language` , `title` ,  `link` ,  `image` ,  `type` ,  `menu` ,  `content` ,  `starpage` ,  `parent` ,  `sort` ,  `active`  ) VALUES( '{$_POST['language']}' , '{$_POST['title']}' ,  '{$_POST['link']}' ,  '{$_POST['image']}' ,  '{$_POST['type']}' ,  '{$_POST['menu']}' ,  '{$_POST['content']}' ,  '{$_POST['starpage']}' ,  '{$_POST['parent']}' ,  '{$_POST['sort']}' ,  '{$_POST['active']}'  ) ";
                $database->query($sql) or die($database->error);
                $lastId = $database->insert_id;
                echo "Página Agregada.";
                if ($database->query($sql) === TRUE) {
                    $sql1 = "INSERT INTO `blocks` ( `blockId` ,  `active` ,  `pageId`  ) VALUES(  '{$_POST['blockId']}' ,  '{$_POST['active']}' ,  '$lastId'  ) ";
                    $database->query($sql1) or die($database->error);
                    echo "Bloque Agregado.<br />";
                }
                if ($_POST['copypage'] == 1) {
                    if ($_POST['language'] == 1) {
                        $sql = "INSERT INTO `page` ( `language` , `title` ,  `link` ,  `image` ,  `type` ,  `menu` ,  `content` ,  `starpage` ,  `parent` ,  `sort` ,  `active`  ) VALUES( '2' , '{$_POST['title']}' ,  '{$_POST['link']}' ,  '{$_POST['image']}' ,  '{$_POST['type']}' ,  '{$_POST['menu']}' ,  '{$_POST['content']}' ,  '{$_POST['starpage']}' ,  '{$_POST['parent']}' ,  '{$_POST['sort']}' ,  '{$_POST['active']}'  ) ";
                        $database->query($sql) or die($database->error);
                        $lastId1 = $database->insert_id;
                        echo "Página Copiada.";
                        $sql1 = "INSERT INTO `blocks` ( `blockId` ,  `active` ,  `pageId`  ) VALUES(  '{$_POST['blockId']}' ,  '{$_POST['activeb']}' ,  '$lastId1'  ) ";
                        $database->query($sql1) or die($database->error);
                        echo "Bloque Agregado.<br />";
                    } else {
                        $sql = "INSERT INTO `page` ( `language` , `title` ,  `link` ,  `image` ,  `type` ,  `menu` ,  `content` ,  `starpage` ,  `parent` ,  `sort` ,  `active`  ) VALUES( '1' , '{$_POST['title']}' ,  '{$_POST['link']}' ,  '{$_POST['image']}' ,  '{$_POST['type']}' ,  '{$_POST['menu']}' ,  '{$_POST['content']}' ,  '{$_POST['starpage']}' ,  '{$_POST['parent']}' ,  '{$_POST['sort']}' ,  '{$_POST['active']}'  ) ";
                        $database->query($sql) or die($database->error);
                        $lastId1 = $database->insert_id;
                        echo "Página Copiada.";
                        $sql1 = "INSERT INTO `blocks` ( `blockId` ,  `active` ,  `pageId`  ) VALUES(  '{$_POST['blockId']}' ,  '{$_POST['activeb']}' ,  '$lastId1'  ) ";
                        $database->query($sql1) or die($database->error);
                        echo "Bloque Agregado.<br />";
                    }
                }
                echo '<meta http-equiv="refresh" content="0">';
            }
            ?>
            <p>
                <a class="button" href='listPage.php'>Retornar a la Lista</a> 
            </p>
            <h3>Agregar una página</h3> 

            <form action='' method='POST'> 
                <div class='col_25_2'><label>Título:</label><input type='text' name='title' id='title'tabindex='1' autofocus/>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#title').keyup(function () {
                                var titl = $('#title').val().split(" ").join("-").toLowerCase();
                                $("#link").val(titl);
                            });
                        });
                    </script> 
                </div> 
                <div class='col_25_2 last'><label>Link de página:</label><input type='text' name='link' id='link'/></div>                 
                <div class='col_25_2'><label>Imagen de página:</label>                    
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
                    <div class='col_full'>
                        <input type="text" name='image' id='image' placeholder="Imagen Url" readonly />
                        <input type="button" id="imageUpload" value='Seleccionar Imagen' />
                    </div>                        
                </div>                  
                <div class='col_25_2 last'>
                    <div class="col_full">
                        <label>Idioma de página:</label>
                        <?php
                        $sqpl = "SELECT * FROM language";
                        $querypl = $database->query($sqpl);
                        ?> 
                        <select name='language' id='language'>                                                        
                            <?php
                            while ($rpl = mysqli_fetch_array($querypl)) {
                                ?>     
                                <option value="<?php echo $rpl['id']; ?>"><?php echo $rpl['version']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col_full">
                        <label>Copiar página:</label>
                        <select name='copypage' id='starpage'>
                            <?php
                            $spti = array("No", "Si");
                            reset($spti);
                            while (list($key, $val) = each($spti)) {
                                ?>     
                                <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                <?php
                            }
                            ?>     
                        </select> 
                    </div>
                    <div class="col_full">
                        <label>Tipo de página:</label> 
                        <script type="text/javascript">
                            function getval(sel) {
                                var value = $('#type option:selected').val();
                                if (value > 0) {
                                    $("#chng").show();
                                } else {
                                    $("#chng").hide();
                                }
                            }
                        </script>
                        <?php
                        $stp1 = "SELECT * FROM type_page";
                        $quertp1 = $database->query($stp1);
                        ?> 
                        <select name='type' id='type'/>                             
                        <option> -- Selecciona tipo -- </option>
                        <?php
                        while ($tp1 = mysqli_fetch_array($quertp1)) {
                            ?>     
                            <option value="<?php echo $tp1['id']; ?>"><?php echo $tp1['type_page']; ?></option>
                            <?php
                        }
                        ?>
                        </select>   
                    </div>
                    <div class='col_full'>
                        <label>Tipo de menu:</label>
                        <?php
                        $sqpm = "SELECT * FROM type_menu";
                        $querypm = $database->query($sqpm);
                        ?> 
                        <select name='menu' id='menu'>                            
                            <option> --Selecciona menu -- </option>
                            <?php
                            while ($rpm = mysqli_fetch_array($querypm)) {
                                ?>     
                                <option value="<?php echo $rpm['id']; ?>"><?php echo $rpm['type_menu']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div> 
                </div>
                <div class='col_25_1'>
                    <div id='chng'>
                        <label>Contenido y/o Descripción:</label>
                        <textarea name='content' id='content'></textarea>
                        <script>
                            CKEDITOR.replace('content', {
                                filebrowserBrowseUrl: 'elfinder/elfinder.html',
                                filebrowserImageBrowseUrl: 'elfinder/elfinder.html',
                                filebrowserUploadUrl: 'elfinder/elfinder.html',
                                filebrowserImageUploadUrl: 'elfinder/elfinder.html',
                                imageUploadUrl: 'elfinder/elfinder.html'
                            });
                        </script>
                    </div>
                </div>                 
                <div class='col_25_2'><label>Página de inicio:</label>
                    <select name='starpage' id='starpage'>
                        <?php
                        $spti = array("No", "Si");
                        reset($spti);
                        while (list($key, $val) = each($spti)) {
                            ?>     
                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                            <?php
                        }
                        ?>     
                    </select> 
                </div>
                <div class='col_25_2 last'><label>Página padre:</label>
                    <?php
                    $sqp1 = "SELECT * FROM page";
                    $queryp1 = $database->query($sqp1);
                    ?> 
                    <select name='parent' id='parent'>                            
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

                <div class='col_25_2'><label>Tiene páginas hijo?:</label>
                    <select name='sort' id='sort'>
                        <?php
                        $opti = array("No", "Si");

                        reset($opti);

                        while (list($key, $val) = each($opti)) {
                            ?>     
                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                            <?php
                        }
                        ?>                                                  
                    </select>
                </div> 

                <div class='col_25_2 last'><label>Página Activa:</label>
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

                <div class="col_25_2"><label>Tipo de Bloque:</label>
                    <?php
                    $stpb = "SELECT * FROM type_blocks";
                    $quertpb = $database->query($stpb);
                    ?> 
                    <select name='blockId' id='blockId'/>                                     
                    <?php
                    while ($tpb = mysqli_fetch_array($quertpb)) {
                        ?>     
                        <option value="<?php echo $tpb['id']; ?>"><?php echo $tpb['type_block']; ?></option>
                        <?php
                    }
                    ?>
                    </select>  
                </div> 
                <div class="col_25_2 last"><label>Bloque Activo:</label>
                    <select name='activeb' id='activeb'>
                        <?php
                        $actib = array("No", "Si");
                        reset($actib);
                        while (list($key, $val) = each($actib)) {
                            ?>     
                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                            <?php
                        }
                        ?>     
                    </select>
                </div> 

                <div class='col_full'><input type='submit' value='Agregar Página' /><input type='hidden' value='1' name='submitted' /></div> 
                <div class="clear"></div>
            </form> 
        </div>
        <div class="clear"></div>
    </div>
    <?php
}
include 'footer.php';
?> 
