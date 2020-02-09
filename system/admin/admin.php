<?php
include('../include/classes/session.php');
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include '../top.php';
include 'header.php';
if ($session->logged_in) {

    /**
     * User not an administrator, redirect to Página Principal
     * automatically.
     */
    if (!$session->isAdmin()) {
        header("Location: $bUrl");
    } else {
        ?>     

        <div class='container'> 
            <div class="col_m_3">
                <h4>Páginas</h4>
                <?php include '../editmenu.php'; ?> 
            </div>
            <div class='col_m_9 last'> 
                <div class="col_full">
                    <?php

                    /**
                     * displayUsers - Displays the users database table in
                     * a nicely formatted html table.
                     */
                    function displayUsers() {
                        global $database;
                        $q = "SELECT username,userlevel,email,timestamp "
                                . "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
                        $result = $database->query($q);
                        /* Error occurred, return given name by default */
                        $num_rows = $result->num_rows;
                        $fecth_rows = $result->fetch_array();
                        if (!$result || ($num_rows < 0)) {
                            echo " Error de visualización de información";
                            return;
                        }
                        if ($num_rows == 0) {
                            echo "Tabla de la base de datos vacía";
                            return;
                        }
                        /* Display table contents */
                        echo "<table id='display'>";
                        echo "<tr class='title'><td colspan='2'>Usuario</td><td>Nivel</td><td colspan='2'>Email</td><td colspan='2'>Última actividad</td></tr>";
                        echo "<div class='clear'></div>";
                        for ($i = 0; $i < $num_rows; $i++) {
                            $uname = $fecth_rows["username"];
                            $ulevel = $fecth_rows["userlevel"];
                            $email = $fecth_rows["email"];
                            $time = $fecth_rows["timestamp"];

                            echo "<tr><td colspan='2'>" . $uname . "</td><td>" . $ulevel . "</td><td colspan='2'>" . $email . "</td><td colspan='2'>" . $time . "</td></tr>";
                        }
                        echo "</table>";
                    }
                    ?>
                </div>                
                <div class="col_full">
                    <?php

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
                        $num_rows = $result->num_rows;
                        if (!$result || ($num_rows < 0)) {
                            echo " Error de visualización de información";
                            return;
                        }
                        if ($num_rows == 0) {
                            echo "<p class='grid_12'>Tabla de base de datos vacia.</p>";
                            return;
                        }
                        /* Display table contents */
                        echo "<table id='display'>";
                        echo "<tr class='title'><tr colspan='2'>Usuario</td><td colspan='2'>Tiempo Prohibido</td></tr>";
                        for ($i = 0; $i < $num_rows; $i++) {
                            $uname = $fecth_rows["username"];
                            $time = $fecth_rows["timestamp"];

                            echo "<tr><td colspan='2'>" . $uname . "</td><td colspan='2'>" . $time . "</td></tr>";
                        }
                        echo "</table>";
                    }

                    /**
                     * Administrator is viewing page, so display all
                     * forms.
                     */
                    ?>
                </div>

                <div class="col_full">
                    <h4>Contenido Tabla de Usuarios:</h4>
                    <?php
                    displayUsers();
                    ?>
                </div>
                <div class="col_full">
                    <div class="clear"><br /></div>
                    <hr class="clear">
                    <br />
                </div>
                <div class="col_full">

                    <?php
                    /**
                     * The user is already logged in, not allowed to register.
                     */
                    if (isset($_SESSION['regsuccess'])) {
                        /* Registration was successful */
                        if ($_SESSION['regsuccess']) {
                            echo "<h4>Registrado!</h4>";
                            if (EMAIL_WELCOME) {
                                echo "<p>Agrega el usuario: <b>" . $_SESSION['reguname'] . "</b>, Se le ha enviado un correo electr�nico de confirmación que debe llegar en breve. Por favor, confirme su registro antes de continuar.<br />Volver a <a href='../'>Principal</a>"
                                . "<a href='admin.php'>Agregar nuevo usuario</a>";
                            } else {
                                echo "<p>Agrega el usuario: <b>" . $_SESSION['reguname'] . "</b>, su información se ha añadido a la base de datos, "
                                . "usted puede ahora <a href=\"../index.php\">acceder</a>.</p>";
                            }
                        }
                        /* Registration failed */ else {
                            echo "<h4>Registracion Fallida</h4>";
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

                        <h4>Agregar Nuevo Usuario</h4>                                
                        <?php
                        if ($form->num_errors > 0) {
                            echo "<div><font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(es) encontrados</font></div>";
                        }
                        ?>
                        <form action="../process.php" method="POST">
                            <div class="col_20_5"><b>Nombre:</b> <br /><input type="text" name="name" maxlength="30" value="<?php echo $form->value("name"); ?>"><?php echo $form->error("name"); ?></div>
                            <div class="col_20_5"><b>Usuario:</b> <br /><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?></div>
                            <div class="col_20_5"><b>Contraseña:</b> <br /><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?></div>
                            <div class="col_20_5"><b>Email:</b> <br /><input type="text" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>"><?php echo $form->error("email"); ?></div>
                            <div class="col_20_5 last"><br /><input type="hidden" name="subjoin" value="1"><input class="button" type="submit" value="Ingresar!"></div> 
                        </form>
                        <?php
                    }
                    ?>
                    <div class="clear"></div>
                </div>                                        
                <?php
                /**
                 * Update User Valid
                 */
                ?>     

                <div class="col_full">
                    <div class="clear"><br /></div>
                    <hr class="clear">
                    <br />
                </div>
                <div class="col_15_3">

                    <h4>Validad e Invalidar Usuario</h4>
                    <?php echo $form->error("valuser"); ?>
                    <form action="adminprocess.php" method="POST">
                        <p><b>Usuario:</b><br /> <input type="text" name="valuser" maxlength="30" value="<?php echo $form->value("valuser"); ?>"></p>
                        <p><b>Validar o Invalidad:</b><br />
                            <select name="updvalid">
                                <option value="1">Validar</option>
                                <option value="0">Invalidar</option>                                                                                
                            </select>
                        </p>
                        <input type="hidden" name="subupdvalid" value="1">
                        <input class="button" type="submit" value="Validar">
                    </form>

                </div>    
                <?php
                /**
                 * Update User Level
                 */
                ?>                             
                <div class="col_15_3">

                    <h4>Actualizar Nivel de Usuario</h4>
                    <?php echo $form->error("upduser"); ?>
                    <form action="adminprocess.php" method="POST">
                        <p><b>Usuario:</b><br /> <input type="text" name="upduser" maxlength="30" value="<?php echo $form->value("upduser"); ?>"></p>
                        <p><b>Nivel:</b><br />
                            <select name="updlevel">
                                <option value="1">Vendedor</option>
                                <option value="2">Supervidor de Vendedor</option>
                                <option value="3">Agente</option>
                                <option value="4">Agente Miembro</option>
                                <option value="5">Supervidor de Agente</option>
                                <option value="7">Gerente</option>                                        
                                <option value="9">Administrador</option>
                            </select>
                        </p>
                        <input type="hidden" name="subupdlevel" value="1">
                        <input class="button" type="submit" value="Nivel">
                    </form>                            

                    <div class="clear"></div>
                </div>                                         
                <?php
                /**
                 * Eliminar Usuario
                 */
                ?>                     
                <div class="col_15_3 last">

                    <h4>Eliminar Usiario</h4>
                    <?php echo $form->error("deluser"); ?>
                    <form action="adminprocess.php" method="POST">
                        <p><b>Usuario:</b><br /> <input type="text" name="deluser" maxlength="30" value="<?php echo $form->value("deluser"); ?>"></p>
                        <input type="hidden" name="subdeluser" value="1">
                        <input class="button" type="submit" value="Eliminar Usuario">
                    </form>

                </div>
                <div class="col_full">
                    <div class="clear"></div>
                    <hr class="clear">
                    <br />
                </div>
                <?php
                /**
                 * Delete Inactive Users
                 */
                ?>
                <div class="col_15_3">

                    <h4>Eliminar Usuarios Inactivos</h4>
                    <p>
                        Esto eliminará todos los usuarios (no administradores), que no han iniciado sesión en el sitio<br />
                        dentro de un determinado período de tiempo. Se especifica los días pasados inactivo.</p>
                    <form action="adminprocess.php" method="POST">
                        <p><b>Dias:</b><br />
                            <select name="inactdays">
                                <option value="3">3</option>
                                <option value="7">7</option>
                                <option value="14">14</option>
                                <option value="30">30</option>
                                <option value="100">100</option>
                                <option value="365">365</option>
                            </select>
                        </p>
                        <input type="hidden" name="subdelinact" value="1">
                        <input class="button" type="submit" value="Eliminar todos inactivos">
                    </form>

                </div>                    
                <?php
                /**
                 * Usuario Prohibido
                 */
                ?>
                <div class="col_15_3">

                    <h4>Usuario Prohibido</h4><?php echo $form->error("banuser"); ?>
                    <p>Prohibir el acceso al sistema de un usuario.<br />
                        Si solamente se desea restringir, o se recomienda inactivarlo en todo caso.</p>
                    <form action="adminprocess.php" method="POST">
                        <p><b>Usuario:</b><br /> <input type="text" name="banuser" maxlength="30" value="<?php echo $form->value("banuser"); ?>"></p>
                        <input type="hidden" name="subbanuser" value="1">
                        <input class="button" type="submit" value="Usuario Prohibido">
                    </form>

                </div>

                <?php
                /**
                 * Display Banned Users Table
                 */
                ?>

                <div class="col_15_3 last">

                    <h4>Tabla de Usuarios prohibidos para el contenido:</h4>
                    <?php
                    displayBannedUsers();
                    ?>

                    <?php
                    /**
                     * Eliminar usuario prohibido
                     */
                    ?>
                    <h4>Eliminar Usuarios prohibidos</h4><?php echo $form->error("delbanuser"); ?>
                    <form action="adminprocess.php" method="POST">
                        <p><b>Usuario:</b><br /> <input type="text" name="delbanuser" maxlength="30" value="<?php echo $form->value("delbanuser"); ?>"></p>
                        <input type="hidden" name="subdelbanned" value="1">
                        <input class="button" type="submit" value="Eliminar usuario prohibido">
                    </form>

                </div>
                <div class="clear"></div>
                <hr class="clear">
                <div class="col_full">
                    Volver a [<a href="../index.php">Página Principal</a>]
                    <br />
                </div>                                    
            </div> 
        </div>
        <?php
    }
} else {
    header("location: http://$bUrl/");
}
include '../footer.php';
?> 

