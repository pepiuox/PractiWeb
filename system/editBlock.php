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
                if (isset($_GET['idB'])) {
                    $idB = (int) $_GET['idB'];
                    if (isset($_POST['submitted'])) {

                        $sql = "UPDATE `blocks` SET  `blockId` =  '{$_POST['blockId']}' ,  `active` =  '{$_POST['active']}' ,  `pageId` =  '{$_POST['pageId']}'   WHERE `idB` = '$idB' ";
                        $database->query($sql) or die($database->error);
                        echo "Bloque Editado.<br />";
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    $row = mysqli_fetch_array($database->query("SELECT * FROM `blocks` WHERE `idB` = '$idB' "));
                    ?>
                    <p>
                        <a class="button" href='listBlock.php'>Retornar a la Lista</a> - <a class="button" href='newBlock.php'>Nuevo Bloque</a> 
                    </p>

                    <form action='' method='POST'> 
                        <div class="col_full"><label>Bloque:</label>
                            <label>Tipo de Bloque:</label>
                            <?php
                            $stp1 = "SELECT * FROM type_blocks";
                            $quertp1 = $database->query($stp1);
                            ?> 
                            <select name='blockId' id='blockId'/>                                     
                            <?php
                            while ($tp1 = mysqli_fetch_array($quertp1)) {
                                if ($tp1['id'] == $row['blockId']) {
                                    ?>     
                                    <option value="<?php echo $tp1['id']; ?>" selected><?php echo $tp1['type_block']; ?></option>
                                    <?php
                                } else {
                                    ?>     
                                    <option value="<?php echo $tp1['id']; ?>"><?php echo $tp1['type_block']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                            </select>  
                        </div> 
                        <div class="col_full"><label>Activo:</label>
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
                        <div class="col_full"><label>Página:</label>
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
                        <div class="col_full"><input type='submit' value='Editar Bloque' /><input type='hidden' value='1' name='submitted' /></div> 
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
