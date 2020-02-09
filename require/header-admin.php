<div class="container-fluid">  
    <div class="row">
        <div class="col-md-2">  
            <div class="col-md-2">

            </div>
            <div class="col-md-10">

            </div>               
        </div>
        <div class="col-md-10">

            <div class="col-md-6">
                <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/system/editPage.php?id=<?php echo $bid; ?>">Editar esta Página</a> 
                | <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/system/listPage.php">Páginas</a>
                | <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/system/index.php">Administrador</a>
            </div>
            <div class="col-md-6">
                <a id="editMenu">Editar Menu</a>
                <div id="myMenu" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content ccente">                                                              
                        <div class="modal-body">                                   
                            <span class="c1 close">x</span> 
                            <h4>Editar el Menu de Página</h4>
                            <?php
                            include 'system/editMenuPage.php';
                            ?>                                     
                        </div>                               
                    </div>
                </div>
                <?php
                $brow = $database->query("SELECT * FROM `blocks` WHERE `pageId` = '$bid' ");
                $brows = $brow->fetch_array();
                if ($bid = $brows['pageId']) {
                    ?>
                    | <a id="editBlock">Editar Bloque</a>
                    <div id="eBlock" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content ccente">                                                              
                            <div class="modal-body">                                   
                                <span class="c3 close">x</span> 
                                <h4>Editar este Bloque</h4>
                                <?php
                                include 'system/editBlck.php';
                                ?>                                     
                            </div>                               
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    | <a id="addBlock">Agregar bloque</a>
                    <div id="myBlock" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content ccente">                                                              
                            <div class="modal-body">                                   
                                <span class="c2 close">x</span> 
                                <h4>Agregar un tipo de Bloque</h4>
                                <?php
                                include 'system/addBlck.php';
                                ?>                                     
                            </div>                               
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>                                                                                               
            <!-- Modal End -->
            <script>
                $(window).resize(function () {
                    $('.ccente').css({
                        position: 'absolute',
                        left: ($(window).width() - $('.ccente').outerWidth()) / 2,
                        top: ($(window).height() - $('.ccente').outerHeight()) / 2
                    });

                });
                $(window).resize();

                var modal1 = $('#myMenu');
                var btn1 = $("#editMenu");
                var span1 = $(".c1");
                btn1.click(function () {
                    modal1.show();
                });
                span1.click(function () {
                    modal1.hide();
                });

                var modal2 = $('#myBlock');
                var btn2 = $("#addBlock");
                var span2 = $(".c2");
                btn2.click(function () {
                    modal2.show();
                });
                span2.click(function () {
                    modal2.hide();
                });

                var modal3 = $('#eBlock');
                var btn3 = $("#editBlock");
                var span3 = $(".c3");
                btn3.click(function () {
                    modal3.show();
                });
                span3.click(function () {
                    modal3.hide();
                });
            </script>                                                                   
        </div>
    </div>   
</div>