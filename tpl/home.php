<!-- Home Template -->
<div class="container-fluid">
    <div class="row">    
        <div class="col-md-3">  
            <div class="navbar-fixed-top">
                <div class="row">      
                    <div class="col-md-11">                     
                        <div class="logo">                                          
                            <h4><a href="<?php echo B_URL; ?>"><img src="<?php echo B_URL; ?>system/img/logo.png" alt="<?php echo SITE_NAME; ?>"></a></h4>                
                        </div>
                        <?php
                        $mMenu = $database->query("SELECT id, type_menu FROM type_menu where id='$men'");
                        $myMenu = $mMenu->fetch_array();
                        if (!empty($myMenu['type_menu'])) {
                            include 'require/' . $myMenu['type_menu'] . '.php';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">           
            <?php
            $mBlocks = $database->query("SELECT id, type_block,idB, blockID, active, pageId FROM type_blocks, blocks WHERE type_blocks.id=blocks.blockId  AND active='1' AND pageId ='$bid'");
            while ($block = $mBlocks->fetch_array()) {
                if (!empty($bid)) {
                    ?>
                    <div class="container myBlock">                    
                        <?php require 'blocks/' . $block['type_block'] . '/' . $block['type_block'] . '.php'; ?>                                      
                    </div>
                    <?php
                }
            }
            ?>        
        </div>      
        <div class="col-md-3">            

        </div> 
    </div>
</div>
<div class="container-fluid">
    <div class="row"> 
    </div>
</div>