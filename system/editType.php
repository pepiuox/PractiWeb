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
                        $sql = "UPDATE `type_page` SET  `type_page` =  '{$_POST['type_page']}'   WHERE `id` = '$id' ";
                        $database->query($sql) or die($database->error);
                        echo ($database->affected_rows) ? "Fila Editada.<br />" : "No se hizo Cambios. <br />";
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    $row = mysqli_fetch_array($database->query("SELECT * FROM `type_page` WHERE `id` = '$id' "));
                    ?>
                    <p>
                        <a class="button" href='listType.php'>Retornar a la Lista</a> - <a class="button" href='newType.php'>Nueva Fila</a> 
                    </p>
                    <h3>Editar tipe de página</h3> 

                    <form action='' method='POST'> 
                        <div class='col_full'><label>Type Page:</label><br /><input type='text' name='type_page' id='type_page' value='<?php echo $row['type_page']; ?>' /></div> 
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
