<?php
//To change this license header, choose License Headers in Project Properties.
//To change this template file, choose Tools | Templates
//and open the template in the editor.
//   Created on : 08/07/2016, 09:05:35 PM
//   Author     : PePiuoX
?>

<!DOCTYPE html>

<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:website="http://ogp.me/ns/website" lang="en-US" itemscope itemtype="http://schema.org/WebPage" >
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo SITE; ?> | <?php echo $ttlp; ?></title>
        <?php require 'require/script-home.php';?>
    </head>
    <body class="home">
        <div class="container">          
            <div class="col-md-3">
                <h3><a href="<?php echo B_URL; ?>"><?php echo SITE; ?></a></h3>
            </div>
            <div class="col-md-9">
                <?php
                if ($session->logged_in) {
                    if (isset($_GET['id']) && !empty($_GET['id'])) {
                        $id = (int) $_GET['id'];
                        echo '<a href="http://' . $_SERVER['HTTP_HOST'] . '/system/editPage.php?id=' . $id . '">Editar esta Página</a> ';
                        echo '| <a href="http://' . $_SERVER['HTTP_HOST'] . '/system/listPage.php">Páginas</a> ';
                        echo '| <a href="http://' . $_SERVER['HTTP_HOST'] . '/system/index.php">Administrador</a>';
                    }
                }
                ?> 
            </div>            
        </div>
