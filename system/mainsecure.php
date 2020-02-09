<?php
/**
 * Main.php
 *
 * This is an example of the Página Principal of a website. Here
 * users will be able to login. However, like on most sites
 * the login form doesn't just have to be on the Página Principal,
 * but re-appear on subsequent pages, depending on whether
 * the user has logged in or not.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: June 15, 2011 by Ivan Novak
 */
include "include/classes/session.php";
$page = "main.php";
?>

<html class="no-js" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Idraet Perú</title>
        <link rel="stylesheet" href="../css/columnal.css" type="text/css" />        
        <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            jQuery(function ($) {
                $
<?php
if (isset($_GET['hash'])) {
    $hash = $_GET['hash'];
} else {
    $hash = '';
}
?>
                jp_hash = ('<?php echo $hash; ?>'.length) ? '<?php echo $hash; ?>' : window.location.hash;
                if (jp_hash) {
                    $.ajax({
                        type: "POST",
                        url: 'process.php',
                        data: 'login_with_hash=1&hash=' + jp_hash,
                        success: function (msg) {
                            if (msg) {
                                alert(msg);
                                window.location.href = "../";
                            } else {
                                alert("Invalid Hash");
                            }
                        }
                    });
                }
            });
        </script>
    </head>
    <body>
        <div id="main" class="container">
            <div class="row">
                <div class="col_x_6">
                    <?php
                    /**
                     * User has already logged in, so display relavent links, including
                     * a link to the Centro de Administración if the user is an administrator.
                     */
                    if ($session->logged_in) {
                        if (MAIL) {
                            $q = "SELECT mail_id FROM " . TBL_MAIL . " WHERE UserTo = '$session->username' and status = 'unread'";
                            $numUnreadMail = $database->query($q) or die($database->error);
                            $numUnreadMail = mysql_num_rows($numUnreadMail);

                            echo "<div class='grid_5'><p class='right'>[<a href=\"mail.php\">Tu tienes $numUnreadMail correos sin leer</a>]&nbsp;</p></div>";
                        }
                        ?>
                        <h1 class="clear">Conectado</h1>
                        <p>Bienvenido <b><?php echo $session->username; ?></b>, estas conectado.</p>
                        <p>[<a href="../index.php">Administracion de productos</a>]&nbsp;[<a href="userinfo.php?user=<?php echo $session->username; ?>">Mi Cuenta</a>]&nbsp;[<a href="useredit.php">Editar Cuenta</a>]
                            <?php
                            if ($session->isAdmin()) {
                                echo "[<a href=\"admin/admin.php\">Centro de Administración</a>]&nbsp;";
                            }
                            echo "[<a href=\"process.php\">Cerrar sesion</a>]";
                            ?></p><?php
                    } else {
                        ?>

                        <div id="login">
                            <h1>Inicio de sesión</h1>
                            <?php
                            /**
                             * User not logged in, display the login form.
                             * If user has already tried to login, but errors were
                             * found, display the total number of errors.
                             * If errors occurred, they will be displayed.
                             */
                            if ($form->num_errors > 0) {
                                echo "<font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(es) econtrados</font>";
                            }
                            ?>

                            <form action="process.php" method="POST">
                                <p class="textinput">Usuario: </p><p><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?></p>
                                <p class="textinput">Contraseña: </p><p><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?></p>
                                <p>
                                    <input type="checkbox" name="remember" <?php
                                    if ($form->value("remember") != "") {
                                        echo "checked";
                                    }
                                    ?>>Recuérdame la próxima vez
                                    <input type="hidden" name="sublogin" value="1">
                                    <input type="submit" value="Inicio de sesión">
                                </p>
                                <p><br />[<a href="forgotpass.php"> ¿Olvidó contraseña? </a>]</p>
                                <p> ¿No registrado? <a href="register.php"> Regístrate!</a></p>
                                <?php
                                if (EMAIL_WELCOME) {
                                    echo "<p>¿Necesita un correo electrónico de confirmación? <a href='valid.php'>Enviar!</a></p>";
                                }
                                ?>
                            </form>
                        </div><!-- #login -->
                        <?php
                    }

                    /**
                     * Just a little page footer, tells how many registered members
                     * there are, how many users currently logged in and viewing site,
                     * and how many guests viewing site. Active users are displayed,
                     * with link to their user information.
                     */
                    ?>
                    <div id="footer"><br />
                        <p><b>Miembro Total:</b><?php echo $database->getNumMembers(); ?>
                            <br>Hay <?php echo $database->num_active_users; ?> los usuarios registrados y <?php $database->num_active_guests; ?> invitados viendo el sitio.<br><br>
                            <?php
                            include("include/view_active.php");
                            ?>
                        </p>
                    </div><!-- #footer -->

                </div><!-- #main -->            
                <div class="col_x_6 last"></div>
            </div>
        </div>
    </body>
</html>
