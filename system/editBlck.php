<div class='col_full'> 
    <?php
    if (isset($_POST['editBlockS'])) {
        $sql = "UPDATE `blocks` SET  `blockId` =  '{$_POST['blockId']}' ,  `active` =  '{$_POST['active']}'   WHERE `idB` = '$idB' AND `pageId` = `$bid` ";
        $database->query($sql) or die($database->error);
        echo "Bloque Editadao.";
        echo '<meta http-equiv="refresh" content="0">';
    }
    $row = mysqli_fetch_array($database->query("SELECT * FROM `blocks`, `type_blocks` WHERE `pageId` = '$bid' "));
    ?>     
    <form action='<?php $_PHP_SELF; ?>' method='POST'> 
        <div class='col_25_2'>
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
        <div class='col_25_2 last'><label>Activar o Desactivar:</label>
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
        <div class='col_full'><input class="button" type='submit' value='Editar Bloque' /><input type='hidden' value='1' name='editBlockS' /></div> 
        <div class="clear"></div>
    </form>     
</div>