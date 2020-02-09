<?php
include "include/classes/session.php";

if (!$session->logged_in) {
    header("Location: " . $session->referrer);
}

if ($_POST) {
    $_POST = $session->cleanInput($_POST);
}

//	$result1=$database->query("SELECT * FROM ".TBL_USERS." WHERE username='$username'") or die($database->error);
//	$row100 = mysqli_fetch_array($result1);
?>
<html class="no-js" lang="en"> 
    <head> 
        <?php include 'head.php'; ?> 
    </head> 
    <body> 
        <?php include 'menu.php'; ?>

        <div id="main" class="container">
            <div class="row">
                <h1>Sistema de mensajes del usuario</h1>
                <form method="post" action="mail.php">
                    <input type="submit" name="mailAction" value="Componer" /><input type="submit" name="mailAction" value="Bandeja" />
                </form>

                <?php
                if (!empty($_POST['mailAction']) && isset($_POST['mailAction'])) {
                    $action = $_POST['mailAction'];
                } else {
                    $action = 'Bandeja';
                }
                if (($action == 'Componer') || ($action == 'Reply')) {

                    if (isset($_POST['mailSubject']) && !empty($_POST['mailSubject'])) {
                        $mailSubject = 'Re: ' . $_POST['mailSubject'];
                    } else {
                        $mailSubject = "";
                    }

                    if (isset($_POST['mailFrom']) && !empty($_POST['mailFrom'])) {
                        $mailTo = $_POST['mailFrom'];
                    } else {
                        $mailTo = "";
                    }
                    ?>
                    <form action="mail.php" method='post'>
                        <div id="compose">
                            <p class="textinput">Para:</p><p class=""><input type='text' name='mailTo' size='20' value='<?php echo $mailTo; ?>'></p>
                            <div class="clear"></div>
                            <p class="textinput">Sujeto:</p><p class=""><input type='text' name='mailSubject' size='20' value='<?php echo $mailSubject; ?>'></p>
                            <div class="clear"></div>
                            <p class="textinput">Mensaje:</p><p class=""><textarea rows='16' cols='45' name='mailMessage'></textarea></p>
                            <div class="clear"></div>
                            <p class=""><input type="submit" name="mailAction" value="Enviar" /></p>
                        </div>
                    </form>
                    <?php
                }
                if ($action == "Bandeja") {

                    $user = $session->username;
                    $q = sprintf("SELECT * FROM mail WHERE UserTo = '%s' ORDER BY SentDate DESC", $database->real_escape_string($user));
                    $getMail = $database->query($q) or die($database->error);

                    echo "<div id='inbox'>";

                    if (mysql_num_rows($getMail) == 0) {
                        echo "<p>Usted no tiene correo</p><br /><br />";
                    } else {
                        ?>
                        <table>
                            <tr class="title">
                                <td colspan="2" align="center">Acción</td>
                                <td>Estatus</td>
                                <td>De</td>
                                <td>Sujeto</td>
                                <td>Tiempo</td>
                            </tr>
                    </div>
                    <?php
                    echo "<form action='mail.php' method='post'>";
                    while ($mail = mysqli_fetch_array($getMail)) {
                        ?>
                        <tr>
                        <input type="hidden" name="mail_id" value="<?php echo $mail['mail_id']; ?>" />
                        <td align="center"><input type="submit" name="mailAction" value='Ver' /></td>
                        <td align="center"><input type="submit" name="mailAction" value="Eliminar" /></td>
                        <td><?php echo $mail['status']; ?></td>
                        <td><?php echo $mail['UserFrom']; ?></td>
                        <td><?php echo $mail['Subject']; ?></td>
                        <td><?php echo $mail['SentDate']; ?></td>
                    </tr>
                    <?php
                }

                echo "</form>";
            }
            echo "</table>";
        }

        if ($action == 'Enviar') {

            if (empty($_POST['mailSubject']) || !isset($_POST['mailSubject'])) {
                echo "Sujeto esta vacio";
            } else {
                $subject = $_POST['mailSubject'];
            }

            if (empty($_POST['mailTo']) || !isset($_POST['mailTo'])) {
                echo "Para esta vacio";
            } else {
                $mailTo = $_POST['mailTo'];
            }

            if (empty($_POST['mailMessage']) || !isset($_POST['mailMessage'])) {
                echo "Mensaje esta vacio";
            } else {
                $message = $_POST['mailMessage'];
            }

            $date = date('m/d/Y') . " at " . date('g:i.s') . " " . date('a');

            $q = sprintf("INSERT INTO mail (UserTo, UserFrom, Subject, Message, SentDate, status) VALUES ('%s','$session->username','%s','%s','%s','unread')", $database->real_escape_string($mailTo), $database->real_escape_string($subject), $database->real_escape_string($message), $database->real_escape_string($date));
            if (!($send = $database->query($q))) {
                echo "Una carta no podía ser enviado a " . $mailTo . "!";
            } else {
                echo "Mensaje enviado a " . $mailTo . "!";
            }
        }


        if ($action == "Ver") {


            $mail_id = $_POST['mail_id'];
            $user = $session->username;
            $q = sprintf("SELECT * FROM mail WHERE UserTo = '%s' AND mail_id = '%s'", $database->real_escape_string($user), $database->real_escape_string($mail_id));
            $result = $database->query($q) or die($database->error);
            $row = $result->fetch_array();


            if ($row['UserTo'] != $session->username) {
                echo "<font face=verdana><b>Este no es tu correo!";
                exit;
            }
            $q = "UPDATE mail SET status='read' WHERE UserTo='$session->username' AND mail_id='$row[mail_id]'";
            $database->query($q) or die("Se produjo un error resultante que este mensaje no se ha marcado lectura.");
            ?>
            <form method="post" action="mail.php">
                <div id="single">
                    <p class="">De: </p><p><?php echo $row['UserFrom']; ?><input type="hidden" name="mailFrom" value="<?php echo $row['UserFrom']; ?>" /></p>
                    <p class="clear">Sujeto: </p><p><?php echo $row['Subject']; ?><input type="hidden" name="mailSubject" value="<?php echo$row['Subject']; ?>" /></p>
                    <p class="clear">Mensaje: <br /><?php echo $row['Message']; ?><br /></p>
                    <p class="clear" align="right"><input type="submit" name="mailAction" value="Responder" /></p>
                </div>
            </form>
            <?php
        }


        if ($action == 'Eliminar') {
            $id = $_POST['mail_id'];
            $query = sprintf("UPDATE mail SET 'Deleted' = 1 WHERE mail_id='%s' LIMIT 1", $database->real_escape_string($id));

            if (!$query) {
                echo "El mensaje no se ha eliminado";
            } else {
                header("Location: mail.php");
            }
        }
        echo "<div class='clear'>";
        echo "[<a href=\"main.php\">Principal</a>]&nbsp;";
        echo "[<a href=\"userinfo.php?user=$session->username\">Mi Cuenta</a>]&nbsp;";
        echo "[<a href=\"process.php\">Cerrar Sesión</a>]";
        echo "</div>";
        ?>

    </div>
</div>
</body>
</html>
