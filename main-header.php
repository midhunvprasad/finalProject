<?php echo $after_body; ?>

    <header>
        <div class="header-mobile d-md-none">
            <div class="mobile hidden-md-up text-xs-center d-flex align-items-center justify-content-around">
                
                <!-- menu left -->
                <div id="mobile_mainmenu" class="item-mobile-top">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>

                <!-- logo -->
                <div class="mobile-logo">
                    <a href="index.php">
                        <img class="logo-mobile img-fluid" src="assets/uploads/<?php echo $logo; ?>" alt="logo">
                    </a>
                </div>

                <!-- menu right -->
                <div class="mobile-menutop" data-target="#mobile-pagemenu">
                    <i class="zmdi zmdi-more"></i>
                </div>
            </div>

            <!-- search -->
            <div id="mobile_search" class="d-flex">
                <div id="mobile_search_content">
                    <form role="search" action="search-result.php" method="get">
                    	<?php $csrf->echoInputField(); ?>
                        <input type="text" placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="desktop_cart">
                    <div class="blockcart block-cart cart-preview tiva-toggle">
                        <div class="tiva-toggle-btn"><br>
                            <span style="color: #fff;border-radius: 50%; font-size: 13px;">
                            	<a href="cart.php" style="color: white;">
                                 <?php echo LANG_VALUE_1; ?><?php
                    if(isset($_SESSION['cart_p_id'])) {
                        $table_total_price = 0;
                        $i=0;
                        foreach($_SESSION['cart_p_qty'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_p_qty[$i] = $value;
                        }                    $i=0;
                        foreach($_SESSION['cart_p_current_price'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_p_current_price[$i] = $value;
                        }
                        for($i=1;$i<=count($arr_cart_p_qty);$i++) {
                            $row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
                            $table_total_price = $table_total_price + $row_total_price;
                        }
                        echo $table_total_price;
                    } else {
                        echo '0';
                    }
                    ?>
                        </span>
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- header desktop -->
        <div class="header-top d-xs-none">
            <div class="row margin-0">
                <!-- menu -->
                <div class="d-flex icon-menu align-items-center justify-content-center">
                    <i class="fa fa-bars" aria-hidden="true" id="icon-menu"></i>
                </div>
                <div style="margin-left: 12px;"></div>
                <div class="flex-2 d-flex align-items-center justify-content-center">
                    <div id="logo">
                        <a href="index.php">
                            <img src="assets/uploads/<?php echo $logo; ?>" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="main-menu d-flex align-items-center justify-content-start navbar-expand-md">
                    <div class="menu navbar collapse navbar-collapse">
                        <ul class="menu-top navbar-nav">
                            <li>
                                <a href="index.php" class="parent">Home</a>
                            </li>
                            <li>
                                <a href="about.php" class="parent">About Us</a>
                            </li>
                            <li>
                                <a href="faq.php" class="parent">Faq</a>
                            </li>
                            <li>
                                <a href="contact.php" class="parent">Contact US</a>
                            </li>
                           
                            
                        </ul>
                    </div>
                </div>


                <div id="search_widget" class="d-flex align-items-center justify-content-end">
                   <div id="mobile_search_content">
						<form role="search" action="search-result.php" method="get">
                    	<?php $csrf->echoInputField(); ?>
                        <input type="text" placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text">
							<button type="submit">
								<i class="fa fa-search"></i>
							</button>
						</form>
					</div>
                    <div id="block_myaccount_infos">
                        <div class="myaccount-title hidden-sm-down dropdown d-flex align-items-center justify-content-center">
                            <a href="#acount" data-toggle="collapse" class="acount">
                                Account
                            </a>
                        </div>
                        <div id="acount" class="collapse">
                            <div class="account-list-content">
                            	<?php
					        if(isset($_SESSION['customer'])) {
					        	?>
                                <div>
                                    <a class="login" href="dashboard.php" rel="nofollow" title="Log in to your customer account">
                                        <i class="fa fa-cog"></i>
                                        <span><?php echo $_SESSION['customer']['cust_name']; ?></span>
                                    </a>
                                     <a class="nav-item nav-link" href="dashboard.php">
                                    <span style="color: black;">Dashboard</span>
                                </a>
                            
                            
                                 <a class="nav-item nav-link" href="customer-profile-update.php">
                                    <span style="color: black;">Update Profile</span>
                                </a>
                            
                            
                                 <a class="nav-item nav-link" href="customer-billing-shipping-update.php">
                                    <span style="color: black;">Update Billing Address</span>
                                </a>
                            
                            
                                 <a class="nav-item nav-link" href="customer-password-update.php">
                                    <span style="color: black;">Update Password</span>
                                </a>
                            
                            
                                 <a class="nav-item nav-link" href="customer-order.php">
                                    <span style="color: black;">Order History</span>
                                </a>

                                <a class="nav-item nav-link" href="logout.php">
                                    <span style="color: black;"><?php echo LANG_VALUE_14; ?></span>
                                </a>
                                </div>
                                <?php
					} else {
						?>
                                <div>
                                    <a class="login" href="login.php" rel="nofollow" title="Log in to your customer account">
                                        <i class="fa fa-sign-in"></i>
                                        <span><?php echo LANG_VALUE_9; ?></span>
                                    </a>
                                </div>
                                <div>
                                    <a class="register" href="registration.php" rel="nofollow" title="Register Account">
                                        <i class="fa fa-user"></i>
                                        <span><?php echo LANG_VALUE_15; ?></span>
                                    </a>
                                </div>
                                <?php	
					}
					?>
                            </div>
                        </div>
                    </div>
                    <div class="desktop_cart d-flex align-items-center">
                        <div class="blockcart block-cart cart-preview tiva-toggle">
                        	<a href="cart.php">
                            <div class="tiva-toggle-btn">
                                 <span style="color: black;border-radius: 50%; font-size: 13px;">
                            	<?php echo LANG_VALUE_1; ?><?php
					if(isset($_SESSION['cart_p_id'])) {
						$table_total_price = 0;
						$i=0;
	                    foreach($_SESSION['cart_p_qty'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_qty[$i] = $value;
	                    }                    $i=0;
	                    foreach($_SESSION['cart_p_current_price'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_current_price[$i] = $value;
	                    }
	                    for($i=1;$i<=count($arr_cart_p_qty);$i++) {
	                    	$row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
	                        $table_total_price = $table_total_price + $row_total_price;
	                    }
						echo $table_total_price;
					} else {
						echo '0';
					}
					?></span>
                                <i class="fa fa-shopping-cart" aria-hidden="true">Cart</i>
                            </div>
                          </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
