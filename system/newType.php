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
                    $sql = "INSERT INTO `type_page` ( `type_page`  ) VALUES(  '{$_POST['type_page']}'  ) ";
                    $database->query($sql) or die($database->error);
                    echo "Fila Agregada.<br />";
                    echo '<meta http-equiv="refresh" content="0">';
                }
                ?>
                <p>
                    <a class="button" href='listType.php'>Retornar a la Lista</a> 
                </p>
                <h3>Agregar un Tipo de Página</h3> 

                <form action='' method='POST'> 
                    <div class='col_25_2'><label>Tipo Página:</label><br /><input type='text' name='type_page' id='type_page'/></div> 
                    <div class='col_25_2 last'><input type='submit' value='Agregar Tipo' /><input type='hidden' value='1' name='submitted' /></div> 
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
