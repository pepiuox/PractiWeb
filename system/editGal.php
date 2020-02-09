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
                        $sql = "UPDATE `galleries` SET  `gallery` =  '{$_POST['gallery']}' ,  `name` =  '{$_POST['name']}' ,  `type` =  '{$_POST['type']}' ,  `description` =  '{$_POST['description']}' ,  `pageId` =  '{$_POST['pageId']}' ,  `active` =  '{$_POST['active']}'   WHERE `idGal` = '$id' ";
                        $database->query($sql) or die($database->error);
                        echo "Galeria Editada.<br />";
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    $row = mysqli_fetch_array($database->query("SELECT * FROM `galleries` WHERE `idGal` = '$id' "));
                    ?>
                    <p>
                        <a class="button" href='listGal.php'>Retornar a la Lista</a> - <a class="button" href='newGal.php'>Nueva Galeria</a> 
                    </p>
                    <h3>Editar <?php echo $row['name']; ?></h3> 

                    <form action='' method='POST'> 
                        <div class='col_25_2'>
                            <label>Nombre de gallery:</label>
                            <input type='text' name='gallery' id='gallery' value='<?php echo $row['gallery']; ?>' />
                        </div>                                        
                        <div class='col_25_2 last'>
                            <label>Nombre:</label>
                            <input type='text' name='name' id='name' value='<?php echo $row['name']; ?>'/>
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
                                    if ($tpg['idTG'] == $row['type']) {
                                        ?>     
                                        <option value="<?php echo $tpg['idTG']; ?>" selected><?php echo $tpg['type_gallery']; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $tpg['idTG']; ?>"><?php echo $tpg['type_gallery']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class='col_full'><label>Descripción:</label>
                            <textarea name='description' id='description'><?php echo $row['description']; ?></textarea> 
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
                        <div class='col_25_2 last'><label>Activo:</label>
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
                        <div class='col_full'><input type='submit' value='Editar Galeria' /><input type='hidden' value='1' name='submitted' /></div> 
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
