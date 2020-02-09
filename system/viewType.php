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
                }
                $row = mysqli_fetch_array($database->query("SELECT * FROM `type_page` WHERE `id` = '$id' "));
                ?>
                <p>
                    <a class="button" href='listType.php'>Retornar a la Lista</a> - <a class="button" href='newType.php'>Nueva Fila</a> 
                </p>
                <h3>Vista de type_page</h3> 

                <div class='col_full'> 
                    <div class='col_25_2'><label>Type Page:</label><?php echo $row['type_page']; ?></div> 
                </div> 
            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
