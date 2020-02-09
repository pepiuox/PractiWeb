<?php
//To change this license header, choose License Headers in Project Properties.
//To change this template file, choose Tools | Templates
//and open the template in the editor.
//   Created on : 08/07/2016, 09:05:35 PM
//   Author     : PePiuoX
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo SITE; ?> | <?php echo $ttlp; ?></title>     
        <?php require 'require/script-galleries.php'; ?>

    </head>
</head>    
<body>
    <div class="container">          
        <div class="col-md-3">
            <h4><a href="<?php echo B_URL; ?>"><?php echo SITE; ?></a></h4>
        </div>
        <div class="col-md-9">
            <?php
            if ($session->logged_in) {
                if (!$session->isAdmin()) {                    
                    echo '<a href="http://' . $_SERVER['HTTP_HOST'] . '/system/editPage.php?id=' . $bid . '">Editar esta Página</a> ';
                    echo '| <a href="http://' . $_SERVER['HTTP_HOST'] . '/system/listPage.php">Páginas</a> ';
                    echo '| <a href="http://' . $_SERVER['HTTP_HOST'] . '/system/index.php">Administrador</a>';
                }
            }
            ?> 
        </div>            
    </div>