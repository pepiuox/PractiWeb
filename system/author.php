<?php
/**
 * author.php
 * You can gather more details by following the
 * Adding Protected Pages to the Jp77 System
 * tutorial found here: http://ivannovak.com/b5rj
 */
include "include/classes/session.php";

if (!$session->isAuthor()) {
    header("Location: main.php");
} else {
    ?>


    <html class="no-js" lang="en">
        <head>
            <link rel="stylesheet" href="../../css/columnal.css" type="text/css" />
        </head>
        <body>


            <div id="main" class="container">
                <p>Tu tiene privilegios de autor</p>
            </div>

        </body>
    </html>
    <?php
}
?>
