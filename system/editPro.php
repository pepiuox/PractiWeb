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
                if (isset($_GET['idPro']) && !empty($_GET['idPro'])) {
                    $idPro = (int) $_GET['idPro'];
                    if (isset($_POST['submitted'])) {
                        $sql = "UPDATE `my_info` SET  `idUser` =  '{$_POST['idUser']}' ,  `first_name` =  '{$_POST['first_name']}' ,  `last_name` =  '{$_POST['last_name']}' ,  `age` =  '{$_POST['age']}' ,  `gender` =  '{$_POST['gender']}' ,  `description` =  '{$_POST['description']}' ,  `image` =  '{$_POST['image']}' ,  `active` =  '{$_POST['active']}'   WHERE `idPro` = '$idPro' ";
                        $database->query($sql) or die($database->error);
                        echo ($database->affected_rows) ? "Fila Editada.<br />" : "No se hizo Cambios. <br />";
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    $row = mysqli_fetch_array($database->query("SELECT * FROM `my_info` WHERE `idPro` = '$idPro' "));
                    ?>
                    <p>
                        <a class='button' href='listPro.php'>Retornar a la Lista</a> - <a class='button' href='newPro.php'>Nueva Fila</a> 
                    </p>
                    <h3>Editar de profile</h3> 

                    <form action='' method='POST'>                     
                        <div class='col_25_2'><label>First Name:</label><br /><input type='text' name='first_name' id='first_name' value='<?php echo $row['first_name']; ?>' /></div> 
                        <div class='col_25_2 last'><label>Last Name:</label><br /><input type='text' name='last_name' id='last_name' value='<?php echo $row['last_name']; ?>' /></div> 
                        <div class='col_25_2'><label>Age:</label><br /><input type='text' name='age' id='age' value='<?php echo $row['age']; ?>' /></div> 
                        <div class='col_25_2 last'><label>Gender:</label><br /><input type='text' name='gender' id='gender' value='<?php echo $row['gender']; ?>' /></div> 
                        <div class='col_full'><label>Description:</label><br /><textarea name='description' id='description'><?php echo $row['description']; ?></textarea></div> 
                        <div class='col_25_2'><label>Image:</label><br /><input type='text' name='image' id='image' value='<?php echo $row['image']; ?>' /></div> 
                        <div class='col_25_2 last'><label>Active:</label><br /><input type='text' name='active' id='active' value='<?php echo $row['active']; ?>' /></div> 
                        <div class='col_full'><input type='submit' value='Editar Fila' /><input type='hidden' value='1' name='submitted' /></div> 
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
