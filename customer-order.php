<?php require_once('header.php'); ?>
<body class="user-acount" id="home2">
    <?php require_once('main-header.php'); ?>
        <?php
        // Check if the customer is logged in or not
        if(!isset($_SESSION['customer'])) {
            header('location: '.BASE_URL.'logout.php');
            exit;
        } else {
            // If customer is logged in, but admin make him inactive, then force logout this user.
            $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?");
            $statement->execute(array($_SESSION['customer']['cust_id'],0));
            $total = $statement->rowCount();
            if($total) {
                header('location: '.BASE_URL.'logout.php');
                exit;
            }
        }
        ?>
    <div class="main-content">
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
                                    <span>My Account</span>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </nav>

            <div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content"> <br> <br> <br>
                    <h1 class="title-page"><?php echo LANG_VALUE_25; ?></h1>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo LANG_VALUE_7; ?></th>
                                    <th><?php echo LANG_VALUE_48; ?></th>
                                    <th><?php echo LANG_VALUE_27; ?></th>
                                    <th><?php echo LANG_VALUE_28; ?></th>
                                    <th><?php echo LANG_VALUE_29; ?></th>
                                    <th><?php echo LANG_VALUE_30; ?></th>
                                    <th><?php echo LANG_VALUE_31; ?></th>
                                    <th><?php echo LANG_VALUE_32; ?></th>
                                </tr>
                            </thead>
                            <tbody>


            


                                <?php
                                $tip = $page*10-10;
                                foreach ($result as $row) {
                                    $tip++;
                                    ?>
                                    <tr>
                                        <td><?php echo $tip; ?></td>
                                        <td>
                                            <?php
                                            $statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
                                            $statement1->execute(array($row['payment_id']));
                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) {
                                                echo 'Product Name: '.$row1['product_name'];
                                                echo '<br>Quantity: '.$row1['quantity'];
                                                echo '<br>Unit Price: '.$row1['unit_price'];
                                                echo '<br><br>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $row['payment_date']; ?></td>
                                        <td><?php echo $row['txnid']; ?></td>
                                        <td><?php echo $row['paid_amount']; ?></td>
                                        <td><?php echo $row['payment_status']; ?></td>
                                        <td><?php echo $row['payment_method']; ?></td>
                                        <td><?php echo $row['payment_id']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>                               
                                
                            </tbody>
                        </table>
                        <div class="pagination" style="overflow: hidden;">
                        <?php 
                            echo $pagination; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
