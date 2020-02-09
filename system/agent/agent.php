<?php
include '../include/classes/session.php';
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include '../top.php';
include '../header.php';
if ($session->logged_in) {


    /**
     * displayUsers - Displays the users database table in
     * a nicely formatted html table.
     */
    function displayUsers() {
        global $database, $session;
        $a = $session->username;
        $q = "SELECT username,userlevel,email,timestamp, parent_directory "
                . "FROM " . TBL_USERS . " where parent_directory = '$a' ORDER BY userlevel DESC,username";
        $result = $database->query($q);
        /* Error occurred, return given name by default */
        $num_rows = mysql_numrows($result);
        if (!$result || ($num_rows < 0)) {
            echo " Error de visualización de información";
            return;
        }
        if ($num_rows == 0) {
            echo "Tabla de la base de datos vacía";
            return;
        }
        /* Display table contents */
        echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
        echo "<tr><td><b>Usuario</b></td><td><b>Nivel</b></td><td><b>Email</b></td><td><b>Ultima Actividad</b></td><td><b>Group</b></td></tr>\n";
        for ($i = 0; $i < $num_rows; $i++) {
            $uname = mysql_result($result, $i, "username");
            $ulevel = mysql_result($result, $i, "userlevel");
            $email = mysql_result($result, $i, "email");
            $time = mysql_result($result, $i, "timestamp");
            $parentd = mysql_result($result, $i, "parent_directory");

            echo "<tr><td>$uname</td><td>$ulevel</td><td>$email</td><td>$time</td><td>$parentd</td></tr>\n";
        }
        echo "</table><br>\n";
    }

    /**
     * displayBannedUsers - Displays the banned users
     * database table in a nicely formatted html table.
     */
    function displayBannedUsers() {
        global $database;
        $q = "SELECT username,timestamp "
                . "FROM " . TBL_BANNED_USERS . " ORDER BY username";
        $result = $database->query($q);
        /* Error occurred, return given name by default */
        $num_rows = mysql_numrows($result);
        if (!$result || ($num_rows < 0)) {
            echo " Error de visualización de información";
            return;
        }
        if ($num_rows == 0) {
            echo "Tabla de la base de datos vacía";
            return;
        }
        /* Display table contents */
        echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
        echo "<tr><td><b>Usuario</b></td><td><b>Time Banned</b></td></tr>\n";
        for ($i = 0; $i < $num_rows; $i++) {
            $uname = mysql_result($result, $i, "username");
            $time = mysql_result($result, $i, "timestamp");

            echo "<tr><td>$uname</td><td>$time</td></tr>\n";
        }
        echo "</table><br>\n";
    }

    /**
     * User not an administrator, redirect to Página Principal
     * automatically.
     */
    if (!$session->isAgent()) {
        header("Location: ../main.php");
    } else {
        /**
         * Administrator is viewing page, so display all
         * forms.
         */
        ?>    
        <div id="main" class="container">
            <div class="col_x_3">        

            </div>
            <div class="col_x_9 last"> 
                <h2>Centro de Vendedor</h2>
                <font size="5" color="#ff0000">
                <b>::::::::::::::::::::::::::::::::::::::::::::</b></font>
                <font size="4">Conectado como <b><?php echo $session->username; ?></b></font><br><br>
                Volver a [<a href="../main.php">Página Principal</a>]<br><br>
                <?php
                if ($form->num_errors > 0) {
                    echo "<font size=\"4\" color=\"#ff0000\">"
                    . "!*** Error con la solicitud, por favor arreglar</font><br><br>";
                }
                ?>
                <table align="left" border="0" cellspacing="5" cellpadding="5">
                    <tr><td>
                            <?php
                            /**
                             * Display Users Table
                             */
                            ?>
                            <h3>Tabla Contenido de Usuario:</h3>
                            <?php
                            displayUsers();
                            ?>
                        </td></tr>
                    <tr>
                        <td><hr></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            /**
                             * Eliminar Usuario
                             */
                            ?>
                            <h3>Eliminar Usuario</h3>
                            <?php echo $form->error("deluser"); ?>
                            <form action="agentprocess.php" method="POST">
                                Usuario:<br>
                                <input type="text" name="deluser" maxlength="30" value="<?php echo $form->value("deluser"); ?>">
                                <input type="hidden" name="subdeluser" value="1">
                                <input type="submit" value="Eliminar Usuario">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td><hr></td>
                    </tr>
                </table>
            </div>
        </div>

        <?php
    }
}
include '../footer.php';
?>

