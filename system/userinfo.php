<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div id="main" class="container">
        <main class="main">
            <div class="col_x_3">        
                <h3>Páginas</h3>
                <?php include 'editmenu.php'; ?> 
            </div>
            <div class="col_x_9 last"> 
                <div class="col_full">
                    <?php
                    /* Requested Username error checking */
                    $req_user = trim($_GET['user']);
                    if (!$req_user || strlen($req_user) == 0 ||
                            !preg_match("/^([0-9a-z])+$/i", $req_user) ||
                            !$database->usernameTaken($req_user)) {
                        die("Usuario no registrado");
                    }
                    ?>            
                    <?php
                    /* Logged in user viewing own account */
                    if (strcmp($session->username, $req_user) == 0) {
                        echo "<h3>Mi Cuenta</h3>";
                    }
                    /* Visitor not viewing own account */ else {
                        echo "<h3>Información de Usuario</h3>";
                    }

                    /* Display requested user information */
                    $req_user_info = $database->getUserInfo($req_user);

                    /* Name */
                    echo "<p><b>Nombre:</b> " . $req_user_info['name'] . "<br />";

                    /* Username */
                    echo "<b>Usuario:</b> " . $req_user_info['username'] . "<br />";

                    /* Email */
                    echo "<b>Email:</b> " . $req_user_info['email'] . "</p>";
                    ?>
                    <div class="col_full">
                        <?php
                        /**
                         * Note: when you add your own fields to the users tablemysql_numrows()
                         * to hold more information, like homepage, location, etc.
                         * they can be easily accessed by the user info array.
                         *
                         * $session->user_info['location']; (for logged in users)
                         *
                         * ..and for this page,
                         *
                         * $req_user_info['location']; (for any user)
                         */
                        /* If logged in user viewing own account, give link to edit */
                        if (strcmp($session->username, $req_user) == 0) {
                            echo "<a href=\"useredit.php\">Editar Cuenta Información</a><br /><br />";
                        }

                        if ($session->isAdmin()) {
                            echo "[<a href=\"admin/admin.php\">Centro de Administración</a>]&nbsp;";
                        }
                        /* Link Volver a main */
                        echo "[<a href=\"main.php\">Principal</a>] <br />";
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>    
<?php } include 'footer.php'; ?>