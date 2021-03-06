<?php require_once('header.php'); ?>
<div id="home2">
    <?php require_once('main-header.php'); ?>
</div>
<?php
if(!isset($_REQUEST['id'])) {
    header('location: index.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if( $total == 0 ) {
        header('location: index.php');
        exit;
    }
}

foreach($result as $row) {
    $p_name = $row['p_name'];
    $p_old_price = $row['p_old_price'];
    $p_current_price = $row['p_current_price'];
    $p_qty = $row['p_qty'];
    $p_featured_photo = $row['p_featured_photo'];
    $p_description = $row['p_description'];
    $p_short_description = $row['p_short_description'];
    $p_feature = $row['p_feature'];
    $p_condition = $row['p_condition'];
    $p_return_policy = $row['p_return_policy'];
    $p_total_view = $row['p_total_view'];
    $p_is_featured = $row['p_is_featured'];
    $p_is_active = $row['p_is_active'];
    $ecat_id = $row['ecat_id'];
}

// Getting all categories name for breadcrumb
$statement = $pdo->prepare("SELECT
                        t1.ecat_id,
                        t1.ecat_name,
                        t1.mcat_id,

                        t2.mcat_id,
                        t2.mcat_name,
                        t2.tcat_id,

                        t3.tcat_id,
                        t3.tcat_name

                        FROM tbl_end_category t1
                        JOIN tbl_mid_category t2
                        ON t1.mcat_id = t2.mcat_id
                        JOIN tbl_top_category t3
                        ON t2.tcat_id = t3.tcat_id
                        WHERE t1.ecat_id=?");
$statement->execute(array($ecat_id));
$total = $statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $ecat_name = $row['ecat_name'];
    $mcat_id = $row['mcat_id'];
    $mcat_name = $row['mcat_name'];
    $tcat_id = $row['tcat_id'];
    $tcat_name = $row['tcat_name'];
}


$p_total_view = $p_total_view + 1;

$statement = $pdo->prepare("UPDATE tbl_product SET p_total_view=? WHERE p_id=?");
$statement->execute(array($p_total_view,$_REQUEST['id']));





if(isset($_POST['form_review'])) {
    
    $statement = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=? AND cust_id=?");
    $statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id']));
    $total = $statement->rowCount();
    
    if($total) {
        $error_message = LANG_VALUE_68; 
    } else {
        $statement = $pdo->prepare("INSERT INTO tbl_rating (p_id,cust_id,comment,rating) VALUES (?,?,?,?)");
        $statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id'],$_POST['comment'],$_POST['rating']));
        $success_message = LANG_VALUE_163;    
    }
    
}

// Getting the average rating for this product
$t_rating = 0;
$statement = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$tot_rating = $statement->rowCount();
if($tot_rating == 0) {
    $avg_rating = 0;
} else {
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
    foreach ($result as $row) {
        $t_rating = $t_rating + $row['rating'];
    }
    $avg_rating = $t_rating / $tot_rating;
}

if(isset($_POST['form_add_to_cart'])) {

    // getting the currect stock of this product
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
    foreach ($result as $row) {
        $current_p_qty = $row['p_qty'];
    }
    if($_POST['p_qty'] > $current_p_qty):
        $temp_msg = 'Sorry! There are only '.$current_p_qty.' item(s) in stock';
        ?>
        <script type="text/javascript">alert('<?php echo $temp_msg; ?>');</script>
        <?php
    else:
    if(isset($_SESSION['cart_p_id']))
    {
        $arr_cart_p_id = array();
        $arr_cart_p_qty = array();
        $arr_cart_p_current_price = array();

        $i=0;
        foreach($_SESSION['cart_p_id'] as $key => $value) 
        {
            $i++;
            $arr_cart_p_id[$i] = $value;
        }



        for($i=1;$i<=count($arr_cart_p_id);$i++) {
            if( ($arr_cart_p_id[$i]==$_REQUEST['id']) ) {
                $added = 1;
                break;
            }
        }
        if($added == 1) {
           $error_message1 = 'This product is already added to the shopping cart.';
        } else {

            $i=0;
            foreach($_SESSION['cart_p_id'] as $key => $res) 
            {
                $i++;
            }
            $new_key = $i+1;


          

            $_SESSION['cart_p_id'][$new_key] = $_REQUEST['id'];
            $_SESSION['cart_p_qty'][$new_key] = $_POST['p_qty'];
            $_SESSION['cart_p_current_price'][$new_key] = $_POST['p_current_price'];
            $_SESSION['cart_p_name'][$new_key] = $_POST['p_name'];
            $_SESSION['cart_p_featured_photo'][$new_key] = $_POST['p_featured_photo'];

            $success_message1 = 'Product is added to the cart successfully!';
        }
        
    }
    else
    {

         
        
        
        

        $_SESSION['cart_p_id'][1] = $_REQUEST['id'];
        $_SESSION['cart_p_qty'][1] = $_POST['p_qty'];
        $_SESSION['cart_p_current_price'][1] = $_POST['p_current_price'];
        $_SESSION['cart_p_name'][1] = $_POST['p_name'];
        $_SESSION['cart_p_featured_photo'][1] = $_POST['p_featured_photo'];

        $success_message1 = 'Product is added to the cart successfully!';
    }
    endif;
}
?>

<?php
if($error_message1 != '') {
    echo "<script>alert('".$error_message1."')</script>";
}
if($success_message1 != '') {
    echo "<script>alert('".$success_message1."')</script>";
    header('location: product.php?id='.$_REQUEST['id']);
}
?>

<body id="product-detail">
    <div class="main-content">
        <div id="wrapper-site">
            <div id="content-wrapper">
                <div id="main">
                    <div class="page-home">

                        <!-- breadcrumb -->
                        <nav class="breadcrumb-bg">
                            <div class="container no-index">
                                <div class="breadcrumb">
                                    <ol>
                                        <li>
                                            <a href="<?php echo BASE_URL; ?>">
                                                <span>Home</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo BASE_URL.'product-category.php?id='.$tcat_id.'&type=top-category' ?>">
                                                <span><?php echo $tcat_name; ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo BASE_URL.'product-category.php?id='.$mcat_id.'&type=mid-category' ?>">
                                                <span><?php echo $mcat_name; ?></span>
                                            </a>
                                        </li>
                                        <li><a href="<?php echo BASE_URL.'product-category.php?id='.$ecat_id.'&type=end-category' ?>"><?php echo $ecat_name; ?></a></li>
                                       <li>></li>
                                       <li><?php echo $p_name; ?></li>
                                    </ol>
                                </div>
                            </div>
                        </nav>
                        <div class="container">
                            <div class="content">
                                <div class="row">
                                    <div class="sidebar-3 sidebar-collection col-lg-3 col-md-3 col-sm-4">
                                        <div class="sidebar-block">
                                            <div class="title-block"> Best seller</div>
                                            <div class="product-content tab-content">
                                                <div class="row">


                                                   <?php
                                                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_id!=?");
                                                    $statement->execute(array($ecat_id,$_REQUEST['id']));
                                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result as $row) {
                                                        ?>
                                                    <div class="item col-md-12">
                                                        <div class="product-miniature item-one first-item d-flex">
                                                            <div class="thumbnail-container border">
                                                                <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                                    <img class="img-fluid" src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="img">
                                                                </a>
                                                            </div>
                                                            <div class="product-description">
                                                                <div class="product-groups">
                                                                    <div class="product-title">
                                                                        <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                                            <?php echo $row['p_name']; ?>
                                                                    </div>
                                                                    <div class="rating">
                                                                        <div class="star-content">
                                                                           <?php
                                                        $t_rating = 0;
                                                        $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                                        $statement1->execute(array($row['p_id']));
                                                        $tot_rating = $statement1->rowCount();
                                                        if($tot_rating == 0) {
                                                            $avg_rating = 0;
                                                        } else {
                                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($result1 as $row1) {
                                                                $t_rating = $t_rating + $row1['rating'];
                                                            }
                                                            $avg_rating = $t_rating / $tot_rating;
                                                        }
                                                        ?>
                                                        <?php
                                                        if($avg_rating == 0) {
                                                            echo '';
                                                        }
                                                        elseif($avg_rating == 1.5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            ';
                                                        } 
                                                        elseif($avg_rating == 2.5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            ';
                                                        }
                                                        elseif($avg_rating == 3.5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            ';
                                                        }
                                                        elseif($avg_rating == 4.5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                            ';
                                                        }
                                                        else {
                                                            for($i=1;$i<=5;$i++) {
                                                                ?>
                                                                <?php if($i>$avg_rating): ?>
                                                                    <i class="fa fa-star-o"></i>
                                                                <?php else: ?>
                                                                    <i class="fa fa-star"></i>
                                                                <?php endif; ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-group-price">
                                                                        <div class="product-price-and-shipping">
                                                                            <span class="price">
                                                                                <?php echo LANG_VALUE_1; ?><?php echo $row['p_current_price']; ?> 
                                                            <?php if($row['p_old_price'] != ''): ?>
                                                            <del>
                                                                <?php echo LANG_VALUE_1; ?><?php echo $row['p_old_price']; ?>
                                                            </del>
                                                            <?php endif; ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <?php
                                                          }
                                                          ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- category -->
                                        <div class="sidebar-block">
                                            <div class="title-block">Categories</div>
                                            <div class="block-content">
                                                <?php
                                        $i=0;
                                        $statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_id DESC");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
                                        foreach ($result as $row) {
                                            $i++;
                                            ?>
                                                <div class="cateTitle hasSubCategory open level1">
                                                    <a class="cateItem" href="product-category.php?id=<?php echo $row['tcat_id']; ?>"><?php echo $row['tcat_name']; ?></a>
                                                </div>
                                                 <?php 
                                                    
                                                    }
                                                ?>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-8 col-lg-9 col-md-9">
                                        <form method="POST" action="">
                                        <div class="main-product-detail">
                                            <h2><?php echo $p_name; ?></h2>
                                            <div class="product-single row">
                                                <div class="product-detail col-xs-12 col-md-5 col-sm-5">
                                                    <div class="page-content" id="content">
                                                        <div class="images-container">
                                                            <div class="js-qv-mask mask tab-content border">
                                                                <div id="item1" class="tab-pane fade active in show">
                                                                    <img src="assets/uploads/<?php echo $p_featured_photo; ?>" alt="img">
                                                                </div>
                                                                
                                                            </div>
                                                            <ul class="product-tab nav nav-tabs d-flex"><?php
                                                            $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                                            $statement->execute(array($_REQUEST['id']));
                                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($result as $row) {
                                                                ?>
                                                                <li class="active col">
                                                                    <a href="#item1" data-toggle="tab" aria-expanded="true" class="active show">
                                                                        <img src="assets/uploads/product_photos/<?php echo $row['photo']; ?>" alt="img">
                                                                    </a>
                                                                </li>
                                                                 <?php
                                                                    }
                                                                    ?>
                                                            </ul>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-info col-xs-12 col-md-7 col-sm-7">
                                                    <div class="detail-description">
                                                        <div class="price-del">
                                                            <span class="price"> <span>
                                                    <?php if($p_old_price!=''): ?>
                                                        <del><?php echo LANG_VALUE_1; ?><?php echo $p_old_price; ?></del>
                                                    <?php endif; ?> 
                                                        <?php echo LANG_VALUE_1; ?><?php echo $p_current_price; ?>
                                                </span></span>
                                                        </div>
                                                        <p class="description"><?php echo $p_short_description; ?></p>
                                                  
                                                        <div class="has-border cart-area">
                                                            <div class="product-quantity">
                                                                <input type="hidden" name="p_current_price" value="<?php echo $p_current_price; ?>">
                                                                             <input type="hidden" name="p_name" value="<?php echo $p_name; ?>">
                                                                             <input type="hidden" name="p_featured_photo" value="<?php echo $p_featured_photo; ?>">

                                                                <div class="qty">
                                                                    <div class="input-group">
                                                                        <div class="quantity">
                                                                            <span class="control-label">QTY : </span>
                                                                            

                                                                       <input type="number" step="1" min="1" max="" name="p_qty" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" class="input-group form-control">

                                                                        
                                                                        </div>
                                                                        <?php if($p_qty == 0): ?>
                                                                            <span class="add">
                                                                              <div class="btn btn-sm">Out Of Stock</div>
                                                                        </span>
                                                                      
                                                                        <?php else: ?>
                                                                        <span class="add">
                                                                              <input class="btn btn-sm" type="submit" value="<?php echo LANG_VALUE_154; ?>" name="form_add_to_cart">

                                                                         
                                                                        </span>
                                                                          <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <p class="product-minimal-quantity">
                                                            </p>
                                                        </div>
                                              
                                                    </div>
                                                </div>
                                            </div>
											
                                            <div class="review">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#description" class="active show">Description</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#tag">Features</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#conditions">Conditions</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#review">Reviews</a>
                                                    </li>
                                                </ul>
												
                                                <div class="tab-content">
                                                    <div id="description" class="tab-pane fade in active show">
                                                        <p><?php
                                                            if($p_description == '') {
                                                                echo LANG_VALUE_70;
                                                            } else {
                                                                echo $p_description;
                                                            }
                                                            ?>
                                                        </p>
                                                       
                                                        </p>
                                                    </div>

                                                    <div id="tag" class="tab-pane fade">
                                                       
                                                         <p><?php
                                                        if($p_feature == '') {
                                                            echo LANG_VALUE_71;
                                                        } else {
                                                            echo $p_feature;
                                                        }
                                                        ?>
                                                                    </div>
                													
                                                    <div id="conditions" class="tab-pane fade">
                                                                       
                                                                        <?php
                                                        if($p_condition == '') {
                                                            echo LANG_VALUE_72;
                                                        } else {
                                                            echo $p_condition;
                                                        }
                                                        ?>
                                                    </div>
                                                    <div id="review" class="tab-pane fade">
                                                        <P>
                                                        <?php
                                        $statement = $pdo->prepare("SELECT * 
                                                            FROM tbl_rating t1 
                                                            JOIN tbl_customer t2 
                                                            ON t1.cust_id = t2.cust_id 
                                                            WHERE t1.p_id=?");
                                        $statement->execute(array($_REQUEST['id']));
                                        $total = $statement->rowCount();
                                        ?>
                                        <h2><?php echo LANG_VALUE_63; ?> (<?php echo $total; ?>)</h2>
                                        <?php
                                        if($total) {
                                            $j=0;
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                $j++;
                                                ?>
                                                <div class="mb_10"><b><u><?php echo LANG_VALUE_64; ?> <?php echo $j; ?></u></b></div>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width:170px;"><?php echo LANG_VALUE_75; ?></th>
                                                        <td><?php echo $row['cust_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo LANG_VALUE_76; ?></th>
                                                        <td><?php echo $row['comment']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo LANG_VALUE_78; ?></th>
                                                        <td>
                                                            <div class="rating">
                                                                <?php
                                                                for($i=1;$i<=5;$i++) {
                                                                    ?>
                                                                    <?php if($i>$row['rating']): ?>
                                                                        <i class="fa fa-star-o"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-star"></i>
                                                                    <?php endif; ?>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <?php
                                            }
                                        } else {
                                            echo LANG_VALUE_74;
                                        }
                                        ?>
                                        
                                        <h2><?php echo LANG_VALUE_65; ?></h2>
                                        <?php
                                        if($error_message != '') {
                                            echo "<script>alert('".$error_message."')</script>";
                                        }
                                        if($success_message != '') {
                                            echo "<script>alert('".$success_message."')</script>";
                                        }
                                        ?>
                                        <?php if(isset($_SESSION['customer'])): ?>

                                            <?php
                                            $statement = $pdo->prepare("SELECT * 
                                                                FROM tbl_rating
                                                                WHERE p_id=? AND cust_id=?");
                                            $statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id']));
                                            $total = $statement->rowCount();
                                            ?>
                                            <?php if($total==0): ?>
                                            <form action="" method="post">
                                            <div class="rating-section">
                                                <input type="radio" name="rating" class="fa fa-star" style="color: " value="1" checked>
                                                <input type="radio" name="rating" class="fa fa-star" style="color: " value="2" checked>
                                                <input type="radio" name="rating" class="fa fa-star" style="color: " value="3" checked>
                                                <input type="radio" name="rating" class="fa fa-star" style="color: " value="4" checked>
                                                <input type="radio" name="rating" class="fa fa-star" style="color: " value="5" checked>
                                            </div>                                            
                                            <div class="form-group">
                                                <textarea name="comment" class="form-control" cols="30" rows="10" placeholder="Write your comment (optional)" style="height:100px;"></textarea>
                                            </div>
                                            <input type="submit" class="btn btn-default" name="form_review" value="<?php echo LANG_VALUE_67; ?>">
                                            </form>
                                            <?php else: ?>
                                                <span style="color:red;"><?php echo LANG_VALUE_68; ?></span>
                                            <?php endif; ?>


                                        <?php else: ?>
                                            <p class="error">
                                                <?php echo LANG_VALUE_69; ?> <br>
                                                <a href="login.php" style="color:red;text-decoration: underline;"><?php echo LANG_VALUE_9; ?></a>
                                            </p>
                                        <?php endif; ?>   
                                    </P>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="related">
                                                <div class="title-tab-content  text-center">
                                                    <div class="title-product justify-content-start">
                                                        <h2>Related Products</h2>
                                                    </div>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="row">

                                                    <?php
                                                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_id!=?");
                                                    $statement->execute(array($ecat_id,$_REQUEST['id']));
                                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result as $row) {
                                                        ?>
                                                        <div class="item text-center col-md-4">
                                                            <div class="product-miniature js-product-miniature item-one first-item">
                                                                <div class="thumbnail-container border border">
                                                                    <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                                        <img class="img-fluid" src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="img">
                                                                    </a>
                                                                    
                                                                </div>
                                                                <div class="product-description">
                                                                    <div class="product-groups">
                                                                        <div class="product-title">
                                                                            <a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a>
                                                                        </div>
                                                                        <div class="rating">
                                                                            <div class="star-content">
                                                                                 <?php
                                                        $t_rating = 0;
                                                        $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                                        $statement1->execute(array($row['p_id']));
                                                        $tot_rating = $statement1->rowCount();
                                                        if($tot_rating == 0) {
                                                            $avg_rating = 0;
                                                        } else {
                                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($result1 as $row1) {
                                                                $t_rating = $t_rating + $row1['rating'];
                                                            }
                                                            $avg_rating = $t_rating / $tot_rating;
                                                        }
                                                        ?>
                                                        <?php
                                                        if($avg_rating == 0) {
                                                            echo '';
                                                        }
                                                        elseif($avg_rating == 1.5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            ';
                                                        } 
                                                        elseif($avg_rating == 2.5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            ';
                                                        }
                                                        elseif($avg_rating == 3.5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            ';
                                                        }
                                                        elseif($avg_rating == 4.5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                            ';
                                                        }
                                                        else {
                                                            for($i=1;$i<=5;$i++) {
                                                                ?>
                                                                <?php if($i>$avg_rating): ?>
                                                                    <i class="fa fa-star-o"></i>
                                                                <?php else: ?>
                                                                    <i class="fa fa-star"></i>
                                                                <?php endif; ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-group-price">
                                                                            <div class="product-price-and-shipping">
                                                                                <span class="price">
                                                                                    <?php echo LANG_VALUE_1; ?><?php echo $row['p_current_price']; ?> 
                                                <?php if($row['p_old_price'] != ''): ?>
                                                <del>
                                                    <?php echo LANG_VALUE_1; ?><?php echo $row['p_old_price']; ?>
                                                </del>
                                                <?php endif; ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-buttons d-flex justify-content-center">
                                                                        <form  method="post" class="formAddToCart">
                                                                            <a class="add-to-cart" href="product.php?id=<?php echo $row['p_id']; ?>" data-button-action="add-to-cart">
                                                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                                            </a>
                                                                        </form>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                          }
                                                          ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
