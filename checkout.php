<?php require_once('header.php'); ?>
<body id="home2" class="product-checkout checkout-cart">
<?php require_once('main-header.php'); ?>
    <?php
if(!isset($_SESSION['cart_p_id'])) {
    header('location: cart.php');
    exit;
}
?>
    <div id="checkout" class="main-content">
        <div class="wrap-banner">
            <?php include("menu-category.php"); ?>
      
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
                                    <span>Checkout</span>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </nav>
			
            <!-- main -->
            <div id="wrapper-site">
                <div class="container"><br><br><br>
                    <?php if(!isset($_SESSION['customer'])): ?>
                    <center>
                        <p>
                        <a href="login.php" class="btn btn-md btn-danger"><?php echo LANG_VALUE_160; ?></a>
                    </p>
                    </center>
                <?php else: ?>
                    <div class="row">
                        <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
                            <div id="main">
                                <div class="cart-grid row">
                                    <div class="col-md-9 check-info">

                                        <div class="content">
                                            <div class="checkout-personal-step">
                                            <h3 class="step-title h3 info">
                                                PERSONAL INFORMATION
                                            </h3>
                                        </div>
                                            <ul class="nav nav-inline">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#checkout-guest-form">
                                                       Update Billing Address
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#checkout-login-form">
                                                       Update Shipping Address
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade in active show" id="checkout-guest-form" role="tabpanel">
                                                    <form id="customer-form" class="js-customer-form" method="post">
                                                        <div>
                                                            <input type="hidden" name="id_customer" value="">
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_102; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_b_name']; ?>" readonly="" >
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_103; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_b_cname']; ?>" readonly="">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_104; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_b_phone']; ?>" readonly="">
                                                            </div>
                                                            <div class="hidden-comment">
                                                                <div class="form-group row">
                                                                    <label><?php echo LANG_VALUE_106; ?></label>
                                                                    <input class="form-control" value=" <?php
                                                                $statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_id=?");
                                                                $statement->execute(array($_SESSION['customer']['cust_b_country']));
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($result as $row) {
                                                                    echo $row['country_name'];
                                                                }
                                                                ?>"  readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_105; ?></label>
                                                                <input class="form-control" value="<?php echo nl2br($_SESSION['customer']['cust_b_address']); ?>" readonly="" >
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_107; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_b_city']; ?>" readonly="">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_108; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_b_state']; ?>" readonly="">
                                                            </div>
                                                            <div class="hidden-comment">
                                                                <div class="form-group row">
                                                                    <label><?php echo LANG_VALUE_109; ?></label>
                                                                    <input class="form-control" value="<?php echo $_SESSION['customer']['cust_b_zip']; ?>" readonly="">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="checkout-login-form" role="tabpanel">
                                                    <form id="customer-form" class="js-customer-form" method="post">
                                                        <div>
                                                            <input type="hidden" name="id_customer" value="">
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_102; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_name']; ?>" readonly="" >
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_103; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_cname']; ?>" readonly="">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_104; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_phone']; ?>" readonly="">
                                                            </div>
                                                            <div class="hidden-comment">
                                                                <div class="form-group row">
                                                                    <label><?php echo LANG_VALUE_106; ?></label>
                                                                    <input class="form-control" value=" <?php
                                                                $statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_id=?");
                                                                $statement->execute(array($_SESSION['customer']['cust_s_country']));
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($result as $row) {
                                                                    echo $row['country_name'];
                                                                }
                                                                ?>"  readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_105; ?></label>
                                                                <input class="form-control" value="<?php echo nl2br($_SESSION['customer']['cust_s_address']); ?>" readonly="" >
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_107; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_city']; ?>" readonly="">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label><?php echo LANG_VALUE_108; ?></label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_state']; ?>" readonly="">
                                                            </div>
                                                            <div class="hidden-comment">
                                                                <div class="form-group row">
                                                                    <label><?php echo LANG_VALUE_109; ?></label>
                                                                    <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_zip']; ?>" readonly="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix">
                                                            <div class="row">
                                                                <button class="continue btn btn-primary pull-xs-right" name="continue" data-link-action="register-new-customer" type="submit"
                                                                    value="1">
                                                                    Continue
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-grid-right col-xs-12 col-lg-3">
                                        <table class="table table-responsive">
                        <tr>
                            <th><?php echo LANG_VALUE_7; ?></th>
                            <th><?php echo LANG_VALUE_47; ?></th>
                            <th><?php echo LANG_VALUE_159; ?></th>
                            <th><?php echo LANG_VALUE_55; ?></th>
                            <th class="text-right"><?php echo LANG_VALUE_82; ?></th>
                        </tr>
                         <?php
                        $table_total_price = 0;

                        $i=0;
                        foreach($_SESSION['cart_p_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_p_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_size_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_size_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_size_name'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_size_name[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_color_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_color_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_color_name'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_color_name[$i] = $value;
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
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $arr_cart_p_name[$i]; ?></td>
                            <td><?php echo LANG_VALUE_1; ?><?php echo $arr_cart_p_current_price[$i]; ?></td>
                            <td><?php echo $arr_cart_p_qty[$i]; ?></td>
                            <td class="text-right">
                                <?php
                                $row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
                                $table_total_price = $table_total_price + $row_total_price;
                                ?>
                                <?php echo LANG_VALUE_1; ?><?php echo $row_total_price; ?>
                            </td>
                        </tr>
                        <?php endfor; ?>           
                        <tr>
                            <th colspan="7" class="total-text"><?php echo LANG_VALUE_81; ?></th>
                            <th class="total-amount"><?php echo LANG_VALUE_1; ?><?php echo $table_total_price; ?></th>
                        </tr>
                        <?php
                        $statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost WHERE country_id=?");
                        $statement->execute(array($_SESSION['customer']['cust_country']));
                        $total = $statement->rowCount();
                        if($total) {
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $shipping_cost = $row['amount'];
                            }
                        } else {
                            $statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost_all WHERE sca_id=1");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $shipping_cost = $row['amount'];
                            }
                        }                        
                        ?>
                        <tr>
                            <td colspan="7" class="total-text"><?php echo LANG_VALUE_84; ?></td>
                            <td class="total-amount"><?php echo LANG_VALUE_1; ?><?php echo $shipping_cost; ?></td>
                        </tr>
                        <tr>
                            <th colspan="7" class="total-text"><?php echo LANG_VALUE_82; ?></th>
                            <th class="total-amount">
                                <?php
                                $final_total = $table_total_price+$shipping_cost;
                                ?>
                                <?php echo LANG_VALUE_1; ?><?php echo $final_total; ?>
                            </th>
                        </tr>
                    </table> 
                                        <br>
                                        <div class="container">
                                            <?php
                        $checkout_access = 1;
                        if(
                            ($_SESSION['customer']['cust_b_name']=='') ||
                            ($_SESSION['customer']['cust_b_cname']=='') ||
                            ($_SESSION['customer']['cust_b_phone']=='') ||
                            ($_SESSION['customer']['cust_b_country']=='') ||
                            ($_SESSION['customer']['cust_b_address']=='') ||
                            ($_SESSION['customer']['cust_b_city']=='') ||
                            ($_SESSION['customer']['cust_b_state']=='') ||
                            ($_SESSION['customer']['cust_b_zip']=='') ||
                            ($_SESSION['customer']['cust_s_name']=='') ||
                            ($_SESSION['customer']['cust_s_cname']=='') ||
                            ($_SESSION['customer']['cust_s_phone']=='') ||
                            ($_SESSION['customer']['cust_s_country']=='') ||
                            ($_SESSION['customer']['cust_s_address']=='') ||
                            ($_SESSION['customer']['cust_s_city']=='') ||
                            ($_SESSION['customer']['cust_s_state']=='') ||
                            ($_SESSION['customer']['cust_s_zip']=='')
                        ) {
                            $checkout_access = 0;
                        }
                        ?>
                        <?php if($checkout_access == 0): ?>
                                    <div class="col-md-12">
                                                <div style="color:blue;font-size:22px;margin-bottom:50px;">
                                    You must have to fill up all the billing and shipping information from your dashboard panel in order to checkout the order. Please fill up the information going to <a href="customer-billing-shipping-update.php" style="color:blue;text-decoration:underline;">this link</a>.
                                        </div>
                                    </div>
                                   <?php else: ?><br>
                                    <!-- <label>Payment Method *</label> -->
                                                  <div class="content">
                                            <ul class="nav nav-inline">
                                               <!--  <li class="nav-item">
                                                    <a style="color: black;" class="nav-link active" data-toggle="tab" href="#paypal">
                                                        paypal
                                                    </a>
                                                </li> -->
                                               <!--  <li class="nav-item">
                                                    <a style="color: black;" class="nav-link" data-toggle="tab" href="#card">
                                                       Stripe
                                                    </a>
                                                </li> -->
                                            </ul>

                                            <div class="tab-content">
                                               <center>
                                                    <h5>Express checkout</h5>
                                               </center>
                                                <div class="tab-pane fade in active show" id="paypal" role="tabpanel">
                                                     <form class="paypal" action="<?php echo BASE_URL; ?>payment/paypal/payment_process.php" method="post" id="paypal_form" target="_blank">
                                        <input type="hidden" name="cmd" value="_xclick" />
                                        <input type="hidden" name="no_note" value="1" />
                                        <input type="hidden" name="lc" value="UK" />
                                        <input type="hidden" name="currency_code" value="USD" />
                                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />

                                        <input type="hidden" name="final_total" value="<?php echo $final_total; ?>">
                                        <div class="col-md-12 form-group">
                                             <center>
                                                 <button class="btn" type="submit" style="background-color: white;" name="form1" type="submit"
                                                                    value="1">
                                                                    <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="Check out with PayPal" />
                                                                </button>
                                             </center>
                                                    </div>
                                                </form>
                                                    
                                                </div>
                                                <div class="tab-pane fade" id="card" role="tabpanel">
                                                     <form action="payment/stripe/init.php" method="post" id="stripe_form">
                                        <input type="hidden" name="payment" value="posted">
                                        <input type="hidden" name="amount" value="<?php echo $final_total; ?>">
                                        <div class="col-md-12 form-group">
                                            <label for=""><?php echo LANG_VALUE_39; ?> *</label>
                                            <input type="text" name="card_number" class="form-control card-number">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for=""><?php echo LANG_VALUE_40; ?> *</label>
                                            <input type="text" name="card_cvv" class="form-control card-cvc">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for=""><?php echo LANG_VALUE_41; ?> *</label>
                                            <input type="text" name="card_month" class="form-control card-expiry-month">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for=""><?php echo LANG_VALUE_42; ?> *</label>
                                            <input type="text" name="card_year" class="form-control card-expiry-year">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <button class="btn" type="submit" name="form2" id="submit-button">
                                                <img src="assets/stripe.png" style="width: 100%;">
                                             </button>
                                            <div id="msg-container"></div>
                                        </div>
                                    </form>
                                                    <!-- <form id="customer-form" class="js-customer-form" method="post">
                                                        <div>
                                                            <div class="form-group row">
                                                                <label>Card Number *</label>
                                                                <input class="form-control" type="text" name="" placeholder="Card Number">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label>CVV *</label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_name']; ?>">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label>Month *</label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_name']; ?>">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label>Year *</label>
                                                                <input class="form-control" value="<?php echo $_SESSION['customer']['cust_s_name']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="clearfix">
                                                            <div class="row">
                                                                <button class="btn">
                                                                    <img src="assets/stripe.png" style="width: 100%;">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form> -->
                                                </div>
                                            </div>
                                        </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <?php endif; ?>
            </div>
        </div>
    </div>

    <?php require_once('footer.php'); ?>