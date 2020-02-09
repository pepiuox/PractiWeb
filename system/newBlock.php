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
                    $sql = "INSERT INTO `blocks` ( `blockId` ,  `active` ,  `pageId`  ) VALUES(  '{$_POST['blockId']}' ,  '{$_POST['active']}' ,  '{$_POST['pageId']}'  ) ";
                    $database->query($sql) or die($database->error);
                    echo "Bloque Agregado.<br />";
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>

                <form action='' method='POST'> 
                    <div class="col_full"><label>Tipo de Bloque:</label>
                        <?php
                        $stp1 = "SELECT * FROM type_blocks";
                        $quertp1 = $database->query($stp1);
                        ?> 
                        <select name='blockId' id='blockId'/>                                     
                        <?php
                        while ($tp1 = mysqli_fetch_array($quertp1)) {
                            ?>     
                            <option value="<?php echo $tp1['id']; ?>"><?php echo $tp1['type_block']; ?></option>
                            <?php
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
                                ?>     
                                <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                <?php
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
                                ?>     
                                <option value="<?php echo $rp1['id']; ?>"><?php echo $rp1['title']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div> 
                    <div class="col_full"><input type='submit' value='Agregar Bloque' /><input type='hidden' value='1' name='submitted' /></div> 
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