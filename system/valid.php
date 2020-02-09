<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
?>
<div class="container">
    <main class="main">
        <div class="col_x_3">        
            <?php
            $mMenu = $database->query("SELECT id, type_menu FROM type_menu where id='1'");
            $myMenu = $mMenu->fetch_array();
            if (!empty($myMenu['type_menu'])) {
                include '../require/' . $myMenu['type_menu'] . '.php';
            }
            ?>
        </div>
        <div class="col_x_9 last"> 
            <?php
            if (!(isset($_GET['qs1']) && isset($_GET['qs2']))) {
                ?>
                <div id="email">
                    <h3>Enviar correo electrónico de confirmación</h3>
                    <form action="process.php" method="POST">
                        <p>Usuario: <input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?></p>
                        <p>Contraseña: <input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?></p>
                        <p><input type="hidden" name="subConfirm" value="1"><input type="submit" value="Send!"></p>
                        <p><a href="<?php echo B_URL; ?>">Volver al inicio</a></p>
                    </form>
                </div>
                <?php
            } else {

                $v_username = $_GET['qs1'];
                $v_userid = $_GET['qs2'];
                $field = 'valid';

                $q = "SELECT userid from " . TBL_USERS . " WHERE username='$v_username'";
                $query = $database->query($q) or die($database->error);
                $query = mysqli_fetch_array($query);


                /*
                 * if the userid associated with the passed username does not
                 * exactly equal the passed userid automatically redirect
                 * them to the Página Principal.
                 */
                if (!($query['userid'] == $v_userid)) {
                    echo "confirmation failed, username and UIN do not match";
                }
                /*
                 * If the userid's match go ahead and change the value in
                 * the valid field to 1, display a 'success' message, and
                 * redirect to main.php.
                 */ else {

                    $database->updateUserField($v_username, $field, '1') or die($database->error);

                    echo $v_username . " su cuenta se ha verificado correctamente. Tu puedes ahora <a href='main.php'>login</a>.";
                }
            }
            ?>
        </div>
    </main>
</div>
<?php include 'footer.php'; ?>
