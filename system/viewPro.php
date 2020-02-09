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
                }
                $row = mysqli_fetch_array($database->query("SELECT * FROM `my_info` WHERE `idPro` = '$idPro' "));
                ?>
                <p>
                    <a class='button' href='listPro.php'>Retornar a la Lista</a> - <a class='button' href='newPro.php'>Nueva Fila</a> 
                </p>
                <h3>Vista de profile</h3> 

                <div class='col_full'>                 
                    <div class='col_25_2'><label>First Name:</label><?php echo $row['first_name']; ?></div> 
                    <div class='col_25_2'><label>Last Name:</label><?php echo $row['last_name']; ?></div> 
                    <div class='col_25_2'><label>Age:</label><?php echo $row['age']; ?></div> 
                    <div class='col_25_2'><label>Gender:</label><?php echo $row['gender']; ?></div> 
                    <div class='col_25_2'><label>Description:</label><?php echo $row['description']; ?></div> 
                    <div class='col_25_2'><label>Image:</label><?php echo $row['image']; ?></div> 
                    <div class='col_25_2'><label>Active:</label><?php echo $row['active']; ?></div> 
                </div> 
            </div
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
