<?php require_once('header.php'); ?>
<body id="home2" class="product-checkout checkout-cart">
<?php require_once('main-header.php'); ?>
    <?php
if(!isset($_SESSION['cart_p_id'])) {
    header('location: cart.php');
    exit;
}
