<?php
$UrlP = $_SERVER['HTTP_HOST'];

define("UPLOAD_PATH", "../upload/");

if (is_array($_FILES)) {
    foreach ($_FILES['userImage']['name'] as $name => $value) {
        if (is_uploaded_file($_FILES['userImage']['tmp_name'][$name])) {
            $sourcePath = $_FILES['userImage']['tmp_name'][$name];
            $targetPath = UPLOAD_PATH . $_FILES['userImage']['name'][$name];
            if (move_uploaded_file($sourcePath, $targetPath)) {
                ?>
                <img src="<?php echo $targetPath; ?>" width="150px" height="180px" />
                <?php
            }
        }
    }
}
?>