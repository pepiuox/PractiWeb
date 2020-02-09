<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
/**
 * The user is already logged in, not allowed to register.
 */
if (($session->logged_in) && ($session->isAdmin())) {
    ?>
    <div class='container'> 
        <main class="main">
            <div class="col_m_3">
                <h4>Páginas</h4>
                <?php include 'editmenu.php'; ?> 
            </div>
            <div class='col_m_9 last'> 
                <div class="col_full">              
                    <h2>Agregar un Director al Grupo</h2>
                    <?php
                    if ($form->num_errors > 0) {
                        echo "<td><font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(es) encontrado</font></td>";
                    }
                    ?>
                    <form action="process.php" method="POST">
                        <table align="left" border="0" cellspacing="0" cellpadding="3">
                            <tr><td>Usuario:</td><td><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"></td><td><?php echo $form->error("user"); ?></td></tr>
                            <tr><td>Contraseña:</td><td><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"></td><td><?php echo $form->error("pass"); ?></td></tr>
                            <tr><td>Email:</td><td><input type="text" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>"></td><td><?php echo $form->error("email"); ?></td></tr>
                            <tr><td></td><td align="right"><input type="hidden" name="master_subjoin" value="1"><input type="submit" value="Agregar Master!"></td><td></td></tr>
                            <tr><td></td><td align="left"><a href="main.php">Volver al Inicio</a></td><td></td></tr>
                        </table>
                    </form>
                    <?php
                } else {
                    die('usted no es un Director');
                }
                ?>

            </div>
        </div>
    </main>
</div>
<?php include 'footer.php'; ?> 

