<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div class="container">
        <main class="main">
            <div class="col_x_3">        
                <h3>Páginas</h3>
                <?php include 'editmenu.php'; ?> 
            </div>
            <div class="col_x_9 last"> 
                <?php
                /**
                 * User has submitted form without errors and user's
                 * account has been edited successfully.
                 */
                if (isset($_SESSION['useredit'])) {
                    unset($_SESSION['useredit']);

                    echo "<h2>La cuenta de Usuario se edito correctamente!</h2>";
                    echo "<p><b>$session->username</b>, su cuenta se ha actualizado correctamente. "
                    . "<a href='index.php'>Principal</a>.</p>";
                } else {
                    ?>

                    <?php
                    /**
                     * If user is not logged in, then do not display anything.
                     * If user is logged in, then display the form to edit
                     * account information, with the current email address
                     * already in the field.
                     */
                    if ($session->isAdmin()) {
                        ?>

                        <h2>Edición de cuenta de usuario: <?php echo $session->username; ?></h2>
                        <?php
                        if ($form->num_errors > 0) {
                            echo "<td><font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(es) econtrados</font></td>";
                        }
                        ?>
                        <div class="col_full" id="userupdate">
                            <form action="process.php" method="POST">
                                <label>Nombre: </label>
                                <p class="left">
                                    <input class="left" type="text" name="name" maxlength="50" value="<?php
                                    if ($form->value("name") == "") {
                                        echo $session->userinfo['name'];
                                    } else {
                                        echo $form->value("name");
                                    }
                                    ?>">
                                           <?php echo $form->error("name"); ?>
                                </p>
                                <div class="clear"></div>
                                <label>Contraseña Actual: </label>
                                <p class="left">
                                    <input type="password" name="curpass" maxlength="30" value="<?php echo $form->value("curpass"); ?>">
                                    <?php echo $form->error("curpass"); ?>
                                </p>
                                <div class="clear"></div>
                                <label>Nueva Contraseña: </label>
                                <p class="left">
                                    <input class="left" type="password" name="newpass" maxlength="30" value="<?php echo $form->value("newpass"); ?>">
                                    <?php echo $form->error("newpass"); ?>
                                </p>
                                <div class="clear"></div>
                                <label>Email: </label>
                                <p class="left">
                                    <input class="left" type="text" name="email" maxlength="50" value="<?php
                                    if ($form->value("email") == "") {
                                        echo $session->userinfo['email'];
                                    } else {
                                        echo $form->value("email");
                                    }
                                    ?>">
                                           <?php echo $form->error("email"); ?>
                                </p>
                                <div class="clear"></div>
                                <p>
                                    <input type="hidden" name="subedit" value="1" />
                                    <input type="submit" value="Editar Cuenta" />
                                </p>
                            </form>
                        </div>                        
                        <?php
                    }
                }
                ?>
            </div>
            <div class="clear"></div>
        </main>
    </div>
<?php } include 'footer.php'; ?>