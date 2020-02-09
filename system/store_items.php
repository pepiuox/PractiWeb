<?php
session_start();

if (isset($_POST['item_src'])) {
    $item_values = $_POST['item_name'] . "+" . $_POST['item_price'] . "+" . $_POST['item_src'];
    if (count($_SESSION['items']) > 0) {
        if (in_array($item_values, $_SESSION['items'])) {
            
        } else {
            $_SESSION['items'][] = $item_values;
        }
    } else {
        $_SESSION['items'][] = $item_values;
    }
    echo count($_SESSION['items']) . " Items In Your Cart";
    exit();
}

if (isset($_POST['show_cart'])) {
    for ($i = 0; $i < count($_SESSION['items']); $i++) {
        $item_val = explode("+", $_SESSION['items'][$i]);
        ?>
        <div class='cart_items'>
            <img src='<?php echo $item_val[2]; ?>'>
            <p><?php echo $item_val[0]; ?></p>
            <p><?php echo $item_val[1]; ?></p>
            <input type='button' value='Remove Item' onclick='remove_item("<?php echo $_SESSION['items'][$i]; ?>");'>
        </div>
        <?php
    }
    exit();
}

if (isset($_POST['remove_item'])) {
    $item_val = $_POST['item_val'];
    for ($i = 0; $i < count($_SESSION['items']); $i++) {
        if ($_SESSION['items'][$i] == $item_val) {
            unset($_SESSION['items'][$i]);
        }
    }
    $_SESSION['items'] = array_values($_SESSION['items']);
    echo count($_SESSION['items']) . " Items In Your Cart";
    exit();
}
?>

