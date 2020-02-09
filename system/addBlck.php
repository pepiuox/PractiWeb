<div class='col_full'> 
    <?php
    if (isset($_POST['addBlockS'])) {
        $sql = "INSERT INTO `blocks` ( `blockId` ,  `active` ,  `pageId`  ) VALUES(  '{$_POST['blockId']}' ,  '{$_POST['active']}' ,  '$bid'  ) ";
        $database->query($sql) or die($database->error);
        echo "Bloque Agregado.<br />";
    }
    ?>
    <form action='' method='POST'> 
        <div class='col_25_2'>
            <label>Tipo de Bloque:</label>
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
        <div class='col_25_2 last'><label>Activar o Desactivar:</label>
            <select name='active' id='active'/>
            <option value="1">SI</option>
            <option value="0">NO</option>
            </select>
        </div>         
        <div class='col_full'><input class="button" type='submit' value='Agregar Block' /><input type='hidden' value='1' name='addBlockS' /></div> 
    </form> 

</div>        
