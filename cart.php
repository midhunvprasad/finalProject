<?php require_once('header.php'); ?>
<body id="home2" class="product-cart checkout-cart blog">
    <?php require_once('main-header.php'); ?>
    <?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_cart = $row['banner_cart'];
}
?>

<?php
$error_message = '';
if(isset($_POST['form1'])) {

    $i = 0;
    $statement = $pdo->prepare("SELECT * FROM tbl_product");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $i++;
        $table_product_id[$i] = $row['p_id'];
        $table_quantity[$i] = $row['p_qty'];
    }

    $i=0;
    foreach($_POST['product_id'] as $val) {
        $i++;
        $arr1[$i] = $val;
    }
    $i=0;
    foreach($_POST['quantity'] as $val) {
        $i++;
        $arr2[$i] = $val;
    }
    $i=0;
    foreach($_POST['product_name'] as $val) {
        $i++;
        $arr3[$i] = $val;
    }
    
    $allow_update = 1;
    for($i=1;$i<=count($arr1);$i++) {
        for($j=1;$j<=count($table_product_id);$j++) {
            if($arr1[$i] == $table_product_id[$j]) {
                $temp_index = $j;
                break;
            }
        }
        if($table_quantity[$temp_index] < $arr2[$i]) {
            $allow_update = 0;
            $error_message .= '"'.$arr2[$i].'" items are not available for "'.$arr3[$i].'"\n';
        } else {
            $_SESSION['cart_p_qty'][$i] = $arr2[$i];
        }
    }
    $error_message .= '\nOther items quantity are updated successfully!';
    ?>
    
    <?php if($allow_update == 0): ?>
        <script>alert('<?php echo $error_message; ?>');</script>
    <?php else: ?>
        <script>alert('All Items Quantity Update is Successful!');</script>
    <?php endif; ?>
    <?php

}
?>

    <div class="main-content" id="cart">
        <div class="wrap-banner">
            <?php include("menu-category.php"); ?>
        </div>
        <div id="wrapper-site">
            <!-- breadcrumb -->
            <nav class="breadcrumb-bg">
                <div class="container no-index">
                    <div class="breadcrumb">
                        <ol>
                            <li>
                                <a href="#">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>Shopping Cart</span>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
                        <section id="main">
                            <div class="cart-grid row">
                                <div class="col-md-9 col-xs-12 check-info">
                                    <h1 class="title-page">Shopping Cart</h1>
                                    <div class="cart-container">
                                        <div class="cart-overview js-cart">
                                            <?php if(!isset($_SESSION['cart_p_id'])): ?>
                                            <?php echo 'Cart is empty'; ?>
                                        <?php else: ?>
                                        <form action="" method="post">
                                            <?php $csrf->echoInputField(); ?>
                                            <ul class="cart-items">
                                                <?php
                                                $table_total_price = 0;

                                                $i=0;
                                                foreach($_SESSION['cart_p_id'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_id[$i] = $value;
                                                }

                                                


                                                $i=0;
                                                foreach($_SESSION['cart_p_qty'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_qty[$i] = $value;
                                                }

                                                $i=0;
                                                foreach($_SESSION['cart_p_current_price'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_current_price[$i] = $value;
                                                }

                                                $i=0;
                                                foreach($_SESSION['cart_p_name'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_name[$i] = $value;
                                                }

                                                $i=0;
                                                foreach($_SESSION['cart_p_featured_photo'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_featured_photo[$i] = $value;
                                                }
                                                ?>
                                                <?php for($i=1;$i<=count($arr_cart_p_id);$i++): ?>


                                                <li class="cart-item">
                                                    <div class="product-line-grid row justify-content-between">
                                                        <!--  product left content: image-->
                                                        <div class="product-line-grid-left col-md-2">
                                                            <span class="product-image media-middle">
                                                                 <a href="product.php?id=<?php echo $arr_cart_p_id[$i]; ?>">
                                                                    <img class="img-fluid" src="assets/uploads/<?php echo $arr_cart_p_featured_photo[$i]; ?>" alt="">
                                                                </a>
                                                            </span>
                                                        </div>
                                                       <div class="product-line-grid-body col-md-6">
                                                            <div class="product-line-info">
                                                                <a class="label" href="product.php?id=<?php echo $arr_cart_p_id[$i]; ?>" data-id_customization="0"><?php echo $arr_cart_p_name[$i]; ?></a>
                                                            </div>
                                                            <div class="product-line-info product-price">
                                                                <span class="value"><?php echo LANG_VALUE_1; ?><?php echo $arr_cart_p_current_price[$i]; ?></span>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="product-line-grid-right text-center product-line-actions col-md-4">
                                                            <div class="row">
                                                                <div class="col-md-5 col qty">
                                                                    <div class="label">Qty:</div>
                                                                    <div class="quantity">
                                                                        <input type="hidden" name="product_id[]" value="<?php echo $arr_cart_p_id[$i]; ?>">
                                                                        <input type="hidden" name="product_name[]" value="<?php echo $arr_cart_p_name[$i]; ?>">
                                                                        <input type="number" step="1" min="1" max="" name="quantity[]" value="<?php echo $arr_cart_p_qty[$i]; ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" class="input-group form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5 col price">
                                                                    <div class="label">Total:</div>
                                                                    <div class="product-price total">
                                                                                                 <?php
                                                        $row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
                                                        $table_total_price = $table_total_price + $row_total_price;
                                                        ?>
                                                        <?php echo LANG_VALUE_1; ?><?php echo $row_total_price; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col text-xs-right align-self-end">
                                                                    <div class="cart-line-product-actions ">
                                                                        <a onclick="return confirmDelete();" href="cart-item-delete.php?id=<?php echo $arr_cart_p_id[$i]; ?>" class="remove-from-cart">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                  <?php endfor; ?><br><br>
                                            <h5 style="float: right;"><span style="color: black;">Total</span> <span style="color: red;"><?php echo LANG_VALUE_1; ?><?php echo $table_total_price; ?></span></h5>
                                            <input type="submit" value="<?php echo LANG_VALUE_20; ?>" class="btn btn-primary" name="form1">


                                    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                                    <a href="checkout.php" class="btn btn-primary"><?php echo LANG_VALUE_23; ?></a>

                                            </ul>
                                        </form>
                                         <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="cart-grid-right col-xs-12 col-lg-3">
                                    <div id="block-reassurance">
                                        <ul>
                                            <li>
                                                <div class="block-reassurance-item">
                                                    <img src="assets/img/product/check1.png" alt="Security policy (edit with Customer reassurance module)">
                                                    <span>Security policy (All the transactiions are secured with TRANSSAFE)</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="block-reassurance-item">
                                                    <img src="assets/img/product/check2.png" alt="Delivery policy (edit with Customer reassurance module)">
                                                    <span>Delivery policy (100% on time delivery)</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="block-reassurance-item">
                                                    <img src="assets/img/product/check3.png" alt="Return policy (edit with Customer reassurance module)">
                                                    <span>Return policy (You will get 100% refund if the product is damaged)</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
