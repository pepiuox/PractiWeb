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
                <p>
                    <a class='button' href='newPro.php'>Nueva profile</a> 
                </p>
                <h3>Lista de profile</h3> 

                <?php
                echo "<table border=1 cellpadding=0 cellspacing=0 >";
                echo "<thead>";
                echo "<tr class=title>";
                echo "<th><b>IdPro</b></th>";
                echo "<th><b>IdUser</b></th>";
                echo "<th><b>First Name</b></th>";
                echo "<th><b>Last Name</b></th>";
                echo "<th><b>Age</b></th>";
                echo "<th><b>Gender</b></th>";
                echo "<th><b>Description</b></th>";
                echo "<th><b>Image</b></th>";
                echo "<th><b>Active</b></th>";
                echo "<th></th><th></th><th></th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $result = $database->query("SELECT * FROM `my_info`") or trigger_error($database->error);
                while ($row = $result->fetch_array()) {
                    foreach ($row AS $key => $value) {
                        $row[$key] = stripslashes($value);
                    }
                    echo "<tr>";
                    echo "<td valign='top'>" . $row['idPro'] . "</td>";
                    echo "<td valign='top'>" . $row['idUser'] . "</td>";
                    echo "<td valign='top'>" . $row['first_name'] . "</td>";
                    echo "<td valign='top'>" . $row['last_name'] . "</td>";
                    echo "<td valign='top'>" . $row['age'] . "</td>";
                    echo "<td valign='top'>" . $row['gender'] . "</td>";
                    echo "<td valign='top'>" . $row['description'] . "</td>";
                    echo "<td valign='top'>" . $row['image'] . "</td>";
                    echo "<td valign='top'>" . $row['active'] . "</td>";
                    echo "<td valign='top'><a href='viewPro.php?idPro={$row['idPro']}'>Vista</a></td><td valign='top'><a href='editPro.php?idPro={$row['idPro']}'>Editar</a></td><td><a href='deletePro.php?idPro={$row['idPro']}'>Eliminar</a></td> ";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr class=title>";
                echo "<th><b>IdPro</b></th>";
                echo "<th><b>IdUser</b></th>";
                echo "<th><b>First Name</b></th>";
                echo "<th><b>Last Name</b></th>";
                echo "<th><b>Age</b></th>";
                echo "<th><b>Gender</b></th>";
                echo "<th><b>Description</b></th>";
                echo "<th><b>Image</b></th>";
                echo "<th><b>Active</b></th>";
                echo "<th></th><th></th><th></th>";
                echo "</tr>";
                echo "</tfoot>";
                echo "</table>";
                ?> 
            </div>
            <div class="clear"></div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
