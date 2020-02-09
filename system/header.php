<div class="container">
    <header class="header">
        <div class="col_l_3">
            <h3>
                <a href="index.php"><?php echo SITE_NAME; ?></a>
            </h3>
        </div>
        <div class="col_l_9 last">
            <?php
            if ($session->logged_in) {
                ?>
                <div class="col_x_6">
                    <p>Conectado - <?php echo traducefecha(); ?></p>
                </div>
                <div class="col_x_6 last">
                    <p> Bienvenido <b><?php echo $session->username; ?></b>, ha iniciado la sesión.</p>
                </div>
                <div class="col_full">
                    <p><a href="<?php echo SYST; ?>userinfo.php?user=<?php echo $session->username; ?>">Mi Cuenta</a>&nbsp;|&nbsp;<a href="<?php echo SYST; ?>profile.php">Editar Perfil</a>&nbsp;|
                        <?php
                        if ($session->isAdmin()) {
                            ?>
                            &nbsp;<a href="<?php echo SYST; ?>admin/social.php">Redes Sociales</a>&nbsp;|&nbsp;<a href="<?php echo SYST; ?>admin/settings.php">Configuracion</a>&nbsp;|&nbsp;<a href='<?php echo SYST; ?>admin/admin.php'>Centro de Administración</a>&nbsp;|
                            <?php
                        }
                        echo "&nbsp;<a href='" . SYST . "process.php'>Cerrar Sesión</a>";
                        ?>
                    </p>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="col_full"> <?php
            if ($session->isAdmin()) {
                ?>
                <div id='headm' class='default'>
                    <nav class="navbar">
                        <ul class="menu">
                            <li><a href='listPage.php'>Páginas</a></li>                             
                            <li><a href='listBlock.php'>Bloques</a></li>
                            <li><a href='listGal.php'>Galerias</a></li>
                            <li><a href='listImg.php'>Imagenes</a></li>
                            <li><a href='listMedia.php'>Multimedia</a></li>
                            <li><a href='listVideos.php'>Videos</a></li>
                            <li><a href='listPress.php'>Publicaciones</a></li>                                    
                            <li><a href='files.php'>Subir Archivos</a></li>
                        </ul>
                    </nav>
                </div>
                <?php
            }
            ?>
        </div>
    </header>
</div>

<div class="container">
    <hr />
</div>