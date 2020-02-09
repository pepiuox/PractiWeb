<?php
/**
 * ForgotPass.php
 *
 * This page is for those users who have forgotten their
 * password and want to have a new password generated for
 * them and sent to the email address attached to their
 * account in the database. The new password is not
 * displayed on the website for security purposes.
 *
 * Note: If your server is not properly setup to send
 * mail, then this page is essentially useless and it
 * would be better to not even link to this page from
 * your website.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 2, 2009 by Ivan Novak
 */
include "include/classes/session.php";
?>

<html class="no-js" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Idraet Perú</title>
        <link rel="stylesheet" href="../css/columnal.css" type="text/css" />
    </head>
    <body>
        <div id="main" class="container">
            <div class="row">
                <div class="col_x_4">
                    <?php
                    /**
                     * Forgot Password form has been submitted and no errors
                     * were found with the form (the username is in the database)
                     */
                    if (isset($_SESSION['forgotpass'])) {
                        /**
                         * New password was generated for user and sent to user's
                         * email address.
                         */
                        if ($_SESSION['forgotpass']) {
                            echo "<h1>Nueva contraseña generada</h1>";
                            echo "<p>Su nueva contraseña se ha generado "
                            . "y enviado a la dirección de correo electrónico <br /> asociada con su cuenta. "
                            . "<a href=\"main.php\">Principal</a>.</p>";
                        }
                        /**
                         * Email could not be sent, therefore password was not
                         * edited in the database.
                         */ else {
                            echo "<h1>Nueva contraseña Fracaso</h1>";
                            echo "<p>Hubo un error al enviarle el "
                            . "correo electrónico con la nueva contraseña, <br /> por lo que su contraseña no se ha cambiado. "
                            . "<a href=\"main.php\">Principal</a>.</p>";
                        }

                        unset($_SESSION['forgotpass']);
                    } else {

                        /**
                         * Forgot password form is displayed, if error found
                         * it is displayed.
                         */
                        ?>

                        <h1>Has Olvidado Tu Contraseña</h1>
                        <p>
                        Una nueva contraseña será generada por usted y se enviará a la dirección de correo electrónico<br />
                         asociada con su cuenta, todo lo que tienes que hacer es entrar con su
                         Usuario.</p><br />
                        <?php echo $form->error("user"); ?>
                        <form action="process.php" method="POST">
                            <b>Usuario:</b> <input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>">
                            <input type="hidden" name="subforgot" value="1">
                            <input type="submit" value="Get New Password">
                        </form>

                        <p><a href="main.php">[Volver a la Página Principal]</a></p>

                        <?php
                    }
                    ?>
                </div>
                <div class="col_x_8 last">
                </div>
            </div>
        </div>
    </body>
</html>
