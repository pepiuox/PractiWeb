<style type="text/css">

  .photo {
    float: left;
    margin: 0.5em;
    border: 1px solid #ccc;
    padding: 1em;
    font-size: 10px;
  }

</style>
<?php

$midir = "../upload/";
foreach (new DirectoryIterator($midir) as $file) {
    if ($file->isFile()) {
        //print $file->getFilename() . "\n";
        echo '<img class="milko" src="' . $midir . $file->getFilename() . '" alt="Random image" />' . "<br />";
    }
}
?>

