<?php
include "include/classes/session.php";

$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
?>
<div class="container">
    <div class="row">
        <h3>Acceso de administración</h3>
    </div>
    <div class="row">       
        <div class="col_x_4">                
            <?php
            /**
             * User has already logged in, so display relavent links, including
             * a link to the Centro de Administración if the user is an administrator.
             */
            if (!$session->logged_in) {
                ?>

                <div id="login">                                        
                    <h4>Inicio de sesión</h4>
                    <?php                    
                    if ($form->num_errors > 0) {
                        echo "<font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(es) econtrados</font>";
                    }
                    ?>

                    <form class="col_full" action="process.php" method="POST">
                        <div class="col_full">
                            <p><label>Usuario: </label><br /><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?></p>
                            <p><label>Contraseña: </label><br /><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?></p>
                            <p>
                                <input type="hidden" name="sublogin" value="1">
                                <input class="button" type="submit" value="Inicio de sesión">
                            </p>
                            <p class="text-center">
                                <input type="checkbox" name="remember" <?php
                                if ($form->value("remember") != "") {
                                    echo "checked";
                                }
                                ?>> 
                                Recuérdame la próxima vez</p>
                            <?php
                            if (EMAIL_WELCOME) {
                                echo "<p>¿Necesita un correo electrónico de confirmación? <a href='valid.php'>Enviar!</a>";
                            }
                            ?>
                        </div>
                    </form>
                </div><!-- #login -->
                <?php
            } else {
                if ($session->isAdmin()) {
                    ?>                                               
                    <h4>Páginas a Editar</h4> 
                    <?php include 'editmenu.php';?>
                    <?php
                } else {
                    ?> 
                    <h4>Bienvenido al sistema de administración</h4>
                    <p><b>Estas conectado ahora puedes agregar y editar contenidos.</b></p>

                    <?php
                }
            }

            /**
             * Just a little page footer, tells how many registered members
             * there are, how many users currently logged in and viewing site,
             * and how many guests viewing site. Active users are displayed,
             * with link to their user information.
             */
            ?>
        </div>
        <div class="col_x_4">
            <div id="footer">
                <h4>Conectados</h4>
                <p><b>Miembro Total: </b><?php echo $database->getNumMembers(); ?>
                    <br>Hay <?php echo $database->num_active_users; ?> los usuarios registrados y <?php $database->num_active_guests; ?> invitados viendo el sitio.<br><br>
                    <?php
                    include "include/classes/view_active.php";
                    ?>
                </p>
            </div><!-- #footer -->
        </div><!-- #main -->          
        <div class="col_x_4 last">       
            <h4>Información</h4>
            <p class="text-justify">Si desea conocer más de los productos de la linea <?php echo SITE_NAME; ?> ingrese a nuestro sitio web.</p>
            <p class="text-justify">Si deseas recibir información, visita nuestra página de contactos.</p>
            <p><a id="back" href="../index.php">Ingresar a la página principal.</a></p>

        </div>        
    </div>
</div>
<?php include 'footer.php'; ?>
