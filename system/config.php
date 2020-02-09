<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set("display_errors", true);
date_default_timezone_set("America/Lima");
//$mysqli = new mysqli("mysql1216.ixwebhosting.com", "A977111_photo", "SevaDD108", "A977111_photo");
$mysqli = new mysqli("localhost", "root", "", "milko");
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>