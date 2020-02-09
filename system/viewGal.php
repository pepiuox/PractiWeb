<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div class='container'> 
        <main class="main">
            <div class="col_m_3">
                <h3>Páginas</h3>
                <?php include 'editmenu.php'; ?> 
            </div>
            <div class='col_m_9 last'>
                <p>
                    <a class="button" href='listGal.php'>Retornar a la Lista</a> - <a class="button" href='newGal.php'>Nueva Galeria</a> 
                </p>
                <link href="<?php echo B_URL; ?>dist/css/lightgallery.css" rel="stylesheet">
                <link href="<?php echo B_URL; ?>system/css/responsiveslides.css" rel="stylesheet">
                <script src="<?php echo B_URL; ?>system/js/jquery-3.1.0.min.js" type="text/javascript"></script>
                <script src="<?php echo B_URL; ?>system/js/responsiveslides.min.js" type="text/javascript"></script> 
                <style>
                    .imagegal{
                        width: 480px;
                        text-align: center;
                    }
                    @media only screen and (max-width: 480px)  {
                        .imagegal{
                            width: 100%;                    
                        }

                    }
                </style> 
                <div class="imagegal">
                    <div id="lightgallery">
                        <?php
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $id = (int) $_GET['id'];

                            $result = $database->query("SELECT id galId, image FROM `image_gal` WHERE `galId` = '$id' ")or trigger_error($database->error);

                            while ($row = $result->fetch_array()) {
                                ?>
                                <a href="<?php echo $row['image']; ?>"><img class="scale" src="<?php echo $row['image']; ?>" /></a>
                                    <?php
                                }
                            }
                            ?>                
                    </div> 
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $("#lightgallery").lightGallery();
                        $("#lightgallery").responsiveSlides();
                    });
                </script>
                <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
                <script src="<?php echo B_URL; ?>dist/js/lightgallery.js"></script>
                <script src="<?php echo B_URL; ?>dist/js/lg-fullscreen.js"></script>
                <script src="<?php echo B_URL; ?>dist/js/lg-thumbnail.js"></script>
                <script src="<?php echo B_URL; ?>dist/js/lg-video.js"></script>
                <script src="<?php echo B_URL; ?>dist/js/lg-autoplay.js"></script>
                <script src="<?php echo B_URL; ?>dist/js/lg-zoom.js"></script>
                <script src="<?php echo B_URL; ?>dist/js/lg-hash.js"></script>
                <script src="<?php echo B_URL; ?>dist/js/lg-pager.js"></script>
                <script src="<?php echo B_URL; ?>lib/jquery.mousewheel.min.js"></script>
            </div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
