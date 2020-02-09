<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$_SESSION['language'] = '';

$url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
$url_path = parse_url($escaped_url, PHP_URL_PATH);
$basename = pathinfo($url_path, PATHINFO_BASENAME);

if (isset($basename) && !empty($basename)) {
    $rs = $database->query("SELECT * FROM `page` WHERE active='1' AND link = '$basename'");
    $rpx = $rs->fetch_assoc();
    $_SESSION['language'] = $rpx['language'];
} elseif (isset($_GET['page']) && !empty($_GET['page'])) {
    $id = (int) $_GET['page'];
    $rs = $database->query("SELECT * FROM `page` WHERE active='1' AND `id` = '$id'");
    $rpx = $rs->fetch_assoc();
    $_SESSION['language'] = $rpx['language'];
} else {
    $rs = $database->query("SELECT * FROM `page` WHERE active='1' AND `starpage` = '1' ");
    $rpx = $rs->fetch_array();
    $_SESSION['language'] = $rpx['language'];
    $GLOBALS['pLang'] = $_SESSION['language'];
}

$bid = $rpx['id'];
$ttlp = $rpx['title'];
$cont = $rpx['type'];
$imgp = $rpx['image'];
$men = $rpx['menu'];
$contn = $rpx['content'];
$lng = $rpx['language'];

if ($bid) {
    include 'require/header.php';
    $rst = $database->query("SELECT id ,type_page FROM `type_page`  WHERE `id` = '$cont' ");
    $rtp = $rst->fetch_assoc();
    include 'tpl/' . $rtp['type_page'] . '.php';
    include 'require/footer.php';
}
?>