<div class='col_full'>
    <?php
    if (isset($_POST['editMenuPageS'])) {
        $sql = "UPDATE `page` SET  `menu` =  '{$_POST['mmenu']}' WHERE `id` = `$bid` ";
        $database->query($sql) or die($database->error);
        echo "Menu Editado.<br />";
        echo '<meta http-equiv="refresh" content="0">';
    }
    $row = mysqli_fetch_array($database->query("SELECT * FROM `page` WHERE `id` = '$bid' "));
    ?>
    <form action='' method='POST'>             
        <select name='mmenu' id='mmenu'>                             
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
        <div class='col_full'><input class="button" type='submit' value='Editar Menu' /><input type='hidden' value='1' name='editMenuPageS' /></div> 
        <div class="clear"></div>
    </form>
</div>