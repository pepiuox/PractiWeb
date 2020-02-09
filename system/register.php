<?php
include "include/classes/session.php";

$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;
?>

<html class="no-js" lang="en"> 
    <head> 
        <?php include 'head.php'; ?> 
    </head> 
    <body> 
        <?php include 'menu.php'; ?>
        <div id="main" class="container">
            <div class="row">
                <?php
                /**
                 * The user is already logged in, not allowed to register.
                 */
                if ($session->logged_in) {
                    echo "<h1>Registrado</h1>";
                    echo "<p>Lo sentimos <b>$session->username</b>, pero ya esta registrado. "
                    . "<a href=\"main.php\">Principal</a>.</p>";
                }
                /**
                 * The user has submitted the registration form and the
                 * results have been processed.
                 */ else  if (isset($_SESSION['regsuccess'])) {
                        /* Registration was successful */
                        if ($_SESSION['regsuccess']) {
                            echo "<h1>Registrado!</h1>";
                            if (EMAIL_WELCOME) {
                                echo "<p>Gracias: <b>" . $_SESSION['reguname'] . "</b>, Se le ha enviado un correo electrónico de confirmación que debe llegar en breve. Por favor, confirme su registro antes de continuar.<br />Volver a <a href='../main.php'>Principal</a></p>"
                                . "<p><a href='admin.php'>Agregar nuevo usuario</a></p>";
                            } else {
                                echo "<p>gracias: <b>" . $_SESSION['reguname'] . "</b>, su información se ha añadido a la base de datos, "
                                . "usted puede ahora <a href=\"../main.php\">acceder</a>.</p>";
                            }
                        }
                        /* Registration failed */ else {
                            echo "<h1>Registracion Fallida</h1>";
                            echo "<p>Lo sentimos, pero ha habido un error y el registro para el Usuario <b>" . $_SESSION['reguname'] . "</b>, "
                            . "No se pudo completar. <br /> Por favor, inténtelo de nuevo en un momento posterior.</p>";
                        }
                        unset($_SESSION['regsuccess']);
                        unset($_SESSION['reguname']);
                    }
                /**
                 * The user has not filled out the registration form yet.
                 * Below is the page with the sign-up form, the names
                 * of the input fields are important and should not
                 * be changed.
                 */ else {
                    ?>

                    <h1>Register</h1>
                    <?php
                    if ($form->num_errors > 0) {
                        echo "<td><font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(es) econtrados</font></td>";
                    }
                    ?>
                    <div id="register">
                        <form action="process.php" method="POST">
                            <p class="textinput">Nombre: </p><p><input type="text" name="name" maxlength="30" value="<?php echo $form->value("name"); ?>"><?php echo $form->error("name"); ?></p>
                            <p class="textinput">Usuario: </p><p><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?></p>
                            <p class="textinput">Contraseña: </p><p><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?></p>
                            <p class="textinput">Email: </p><p><input type="text" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>"><?php echo $form->error("email"); ?></p>
                            <p class="textinput"><input type="hidden" name="subjoin" value="1"><input type="submit" value="Ingresar!"></p>
                            <p><a href="main.php">[Volver a Main]</a></p>
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>
