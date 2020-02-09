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
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id = (int) $_GET['id'];
                $row = mysqli_fetch_array($database->query("SELECT * FROM `page` LEFT JOIN (SELECT idB, blockId, active AS actB, pageId FROM blocks)`blocks` ON page.id = blocks.pageId WHERE `id` = '$id' "));

                $idBl = $row['idB'];
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
                    $sql = "UPDATE `page` SET `language` =  '{$_POST['language']}' , `title` =  '{$_POST['title']}' ,  `link` =  '{$_POST['link']}' ,  `image` =  '{$_POST['image']}' ,  `type` =  '{$_POST['type']}' ,  `menu` =  '{$_POST['menu']}' ,  `content` =  '{$_POST['content']}' ,  `starpage` =  '{$_POST['starpage']}' ,  `parent` =  '{$_POST['parent']}' ,  `sort` =  '{$_POST['sort']}' ,  `active` =  '{$_POST['active']}'   WHERE `id` = '$id' ";
                    $database->query($sql) or die($database->error);
                    echo "Página actualizada.<br />";
                    if ($_POST['copypage'] == 1) {
                        if ($_POST['language'] == 1) {
                            $sql = "INSERT INTO `page` ( `language` , `title` ,  `link` ,  `image` ,  `type` ,  `menu` ,  `content` ,  `starpage` ,  `parent` ,  `sort` ,  `active`  ) VALUES( '2' , '{$_POST['title']}' ,  '{$_POST['link']}' ,  '{$_POST['image']}' ,  '{$_POST['type']}' ,  '{$_POST['menu']}' ,  '{$_POST['content']}' ,  '{$_POST['starpage']}' ,  '{$_POST['parent']}' ,  '{$_POST['sort']}' ,  '{$_POST['active']}'  ) ";
                            $database->query($sql) or die($database->error);
                            $lastId = $database->insert_id;
                            echo "Página Copiada.";
                            $sql1 = "INSERT INTO `blocks` ( `blockId` ,  `active` ,  `pageId`  ) VALUES(  '{$_POST['blockId']}' ,  '{$_POST['activeb']}' ,  '$lastId  ) ";
                            $database->query($sql1) or die($database->error);
                            echo "Bloque Agregado.<br />";
                        } else {
                            $sql = "INSERT INTO `page` ( `language` , `title` ,  `link` ,  `image` ,  `type` ,  `menu` ,  `content` ,  `starpage` ,  `parent` ,  `sort` ,  `active`  ) VALUES( '1' , '{$_POST['title']}' ,  '{$_POST['link']}' ,  '{$_POST['image']}' ,  '{$_POST['type']}' ,  '{$_POST['menu']}' ,  '{$_POST['content']}' ,  '{$_POST['starpage']}' ,  '{$_POST['parent']}' ,  '{$_POST['sort']}' ,  '{$_POST['active']}'  ) ";
                            $database->query($sql) or die($database->error);
                            $lastId = $database->insert_id;
                            echo "Página Copiada.";
                            $sql1 = "INSERT INTO `blocks` ( `blockId` ,  `active` ,  `pageId`  ) VALUES(  '{$_POST['blockId']}' ,  '{$_POST['activeb']}' ,  '$lastId  ) ";
                            $database->query($sql1) or die($database->error);
                            echo "Bloque Agregado.<br />";
                        }
                    }
                    $sql1 = "UPDATE `blocks` SET  `blockId` =  '{$_POST['blockId']}' ,  `active` =  '{$_POST['activeb']}' WHERE  `idB` =  '$idBl'";
                    $database->query($sql1) or die($database->error);
                    echo "Bloque actualizado.<br />";
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>

                <p>
                    <a class="button" href='listPage.php'>Retornar a la Lista</a> - <a class="button" href='newPage.php'>Nueva Página</a> 
                </p>
                <h3>Editar <?php echo $row['title']; ?></h3> 

                <form action='' method='POST'> 
                    <div class='col_25_2'>
                        <label>Título:</label>
                        <input type='text' name='title' id='title' value='<?php echo $row['title']; ?>' />
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('#title').keyup(function () {
                                    var titl = $('#title').val().split(" ").join("-").toLowerCase();
                                    $("#link").val(titl);
                                });
                            });
                        </script> 
                    </div> 
                    <div class='col_25_2 last'>
                        <label>Link de página:</label>
                        <input type='text' name='link' id='link' value='<?php echo $row['link']; ?>' />
                    </div>                     
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
                        <div class='col_full'>
                            <label>Lenguage:</label>
                            <select name='language' id='language'>                                                             
                                <?php
                                $sqpl = "SELECT * FROM language";
                                $quertl = $database->query($sqpl);
                                while ($tpl = mysqli_fetch_array($quertl)) {
                                    if ($tpl['id'] == $row['language']) {
                                        ?>     
                                        <option value="<?php echo $tpl['id']; ?>" selected><?php echo $tpl['version']; ?></option>
                                        <?php
                                    } else {
                                        ?>     
                                        <option value="<?php echo $tpl['id']; ?>"><?php echo $tpl['version']; ?></option>
                                        <?php
                                    }
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
                        <div class='col_full'>
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
                            <select name='type' id='type' onchange="getval(this);">                             
                                <option>-- Selecciona tipo -- </option>
                                <?php
                                while ($tp1 = mysqli_fetch_array($quertp1)) {
                                    if ($tp1['id'] == $row['type']) {
                                        ?>     
                                        <option value="<?php echo $tp1['id']; ?>" selected><?php echo $tp1['type_page']; ?></option>
                                        <?php
                                    } else {
                                        ?>     
                                        <option value="<?php echo $tp1['id']; ?>"><?php echo $tp1['type_page']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>   
                        </div>
                        <div class='col_full'>
                            <label>Tipo de menu:</label>
                            <select name='menu' id='menu'>                             
                                <option> -- Selecciona menu -- </option>
                                <?php
                                $sqpm = "SELECT * FROM type_menu";
                                $quertm = $database->query($sqpm);
                                while ($tpm = mysqli_fetch_array($quertm)) {
                                    if ($tpm['id'] == $row['menu']) {
                                        ?>     
                                        <option value="<?php echo $tpm['id']; ?>" selected><?php echo $tpm['type_menu']; ?></option>
                                        <?php
                                    } else {
                                        ?>     
                                        <option value="<?php echo $tpm['id']; ?>"><?php echo $tpm['type_menu']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class='col_full'>
                        <div id='chng'>
                            <label>Contenido y/o Descripción:</label>
                            <textarea name='content' id='content'><?php echo $row['content']; ?></textarea>
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
                            $spgi = array("No", "Si");
                            reset($spgi);
                            while (list($key, $val) = each($spgi)) {
                                if ($row['starpage'] == $key) {
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
                        </select> </div> 
                    <div class='col_25_2 last'><label>Página padre:</label>
                        <?php
                        $sqp1 = "SELECT * FROM page";
                        $queryp1 = $database->query($sqp1);
                        ?> 
                        <select name='parent' id='parent'>                            
                            <option>Selecciona una página </option>
                            <?php
                            while ($rp1 = mysqli_fetch_array($queryp1)) {
                                if ($rp1['id'] == $row['parent']) {
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
                    <div class='col_25_2'><label>Tiene páginas hijo?:</label>
                        <select name='sort' id='sort'>
                            <?php
                            $opti = array("No", "Si");
                            reset($opti);
                            while (list($key, $val) = each($opti)) {
                                if ($row['sort'] == $key) {
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
                    <div class='col_25_2 last'><label>Página Activa:</label>
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

                    <div class="col_25_2">
                        <label>Bloque:</label>
                        <?php
                        $tpbl = "SELECT * FROM type_blocks";
                        $quertpb = $database->query($tpbl);
                        ?> 
                        <select name='blockId' id='blockId'/>                                     
                        <?php
                        while ($tpb = mysqli_fetch_array($quertpb)) {
                            if ($tpb['id'] == $row['blockId']) {
                                ?>     
                                <option value="<?php echo $tpb['id']; ?>" selected><?php echo $tpb['type_block']; ?></option>
                                <?php
                            } else {
                                ?>     
                                <option value="<?php echo $tpb['id']; ?>"><?php echo $tpb['type_block']; ?></option>
                                <?php
                            }
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
                                if ($row['actB'] == $key) {
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

                    <div class='col_full'>
                        <input class="button" type='submit' value='Editar Página' />
                        <input type="hidden" name="return_url" value="<?php echo $current_url; ?>" />
                        <input type='hidden' value='1' name='submitted' />
                    </div> 
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
