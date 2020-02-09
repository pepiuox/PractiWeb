<div class="container">
    <div class="col_l_3">
        <h3>
            <a href="index.php"><?php echo SITE_NAME; ?></a>
        </h3>
    </div>
    <div class="col_l_9 last">
        <div class="col_full">
            <label>Centro de Administración</label>  - Conectado como <b><?php echo $session->username; ?></b> | <a href="social.php">Redes Sociales</a> | <a href="settings.php">Configuracion</a> | Volver a [<a href="index.php">Página Principal</a>]<br />
        </div>
        <?php
        if ($form->num_errors > 0) {
            echo "<font size=\"4\" color=\"#ff0000\">"
            . "!*** Error con la solicitud, por favor arreglar</font><br /><br />";
        }

        /**
         * Display Users Table
         */
        ?>
        <div class="col_full">
            <?php
            if (($session->logged_in) && ($session->isMember())) {
                echo "[<a href=\"../userinfo.php?user=$session->username\">Mi Cuenta</a>] &nbsp;  \n";
                echo "[<a href=\"../useredit.php\">Editar Cuenta</a>] &nbsp; \n";
            } elseif (($session->logged_in) && ($session->isAdmin())) {
                echo "[<a href=\"../userinfo.php?user=$session->username\">Mi Cuenta</a>] &nbsp;  \n";
                echo "[<a href=\"../useredit.php\">Editar Cuenta</a>] &nbsp;  \n";
            }
            echo "[<a href=\"../process.php\">Desconectarse</a>]  \n";
            ?>
        </div>
    </div>
</div>