<?php

include 'include/session.php';


$fields = array();
$res=$database->query("SHOW COLUMNS FROM blocks");
while ($x = mysql_fetch_assoc($res)){
  $fields[] = $x['Field'];
}
foreach ($fields as $f) { echo "<br>Field name: ".$f; }

?>