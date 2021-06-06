<?php require_once('header.php'); ?>
<div id="home2">
    <?php require_once('main-header.php'); ?>
    <div class="wrap-banner">
            <?php include("menu-category.php"); ?>
        </div>
</div>

<?php
if( !isset($_REQUEST['id']) || !isset($_REQUEST['type']) ) {
    header('location: index.php');
    exit;
} else {

    if( ($_REQUEST['type'] != 'top-category') && ($_REQUEST['type'] != 'mid-category') && ($_REQUEST['type'] != 'end-category') ) {
        header('location: index.php');
        exit;
    } else {

        $statement = $pdo->prepare("SELECT * FROM tbl_top_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $top[] = $row['tcat_id'];
            $top1[] = $row['tcat_name'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_mid_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $mid[] = $row['mcat_id'];
            $mid1[] = $row['mcat_name'];
            $mid2[] = $row['tcat_id'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_end_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $end[] = $row['ecat_id'];
            $end1[] = $row['ecat_name'];
            $end2[] = $row['mcat_id'];
        }

        if($_REQUEST['type'] == 'top-category') {
            if(!in_array($_REQUEST['id'],$top)) {
                header('location: index.php');
                exit;
            } else {

                // Getting Title
                for ($i=0; $i < count($top); $i++) { 
                    if($top[$i] == $_REQUEST['id']) {
                        $title = $top1[$i];
                        break;
                    }
                }
                $arr1 = array();
                $arr2 = array();
                // Find out all ecat ids under this
                for ($i=0; $i < count($mid); $i++) { 
                    if($mid2[$i] == $_REQUEST['id']) {
                        $arr1[] = $mid[$i];
                    }
                }
                for ($j=0; $j < count($arr1); $j++) {
                    for ($i=0; $i < count($end); $i++) { 
                        if($end2[$i] == $arr1[$j]) {
                            $arr2[] = $end[$i];
                        }
                    }   
                }
                $final_ecat_ids = $arr2;
            }   
        }

        if($_REQUEST['type'] == 'mid-category') {
            if(!in_array($_REQUEST['id'],$mid)) {
                header('location: index.php');
                exit;
            } else {
                // Getting Title
                for ($i=0; $i < count($mid); $i++) { 
                    if($mid[$i] == $_REQUEST['id']) {
                        $title = $mid1[$i];
                        break;
                    }
                }
                $arr2 = array();        
                // Find out all ecat ids under this
                for ($i=0; $i < count($end); $i++) { 
                    if($end2[$i] == $_REQUEST['id']) {
                        $arr2[] = $end[$i];
                    }
                }
                $final_ecat_ids = $arr2;
            }
        }

        if($_REQUEST['type'] == 'end-category') {
            if(!in_array($_REQUEST['id'],$end)) {
                header('location: index.php');
                exit;
            } else {
                // Getting Title
                for ($i=0; $i < count($end); $i++) { 
                    if($end[$i] == $_REQUEST['id']) {
                        $title = $end1[$i];
                        break;
                    }
                }
                $final_ecat_ids = array($_REQUEST['id']);
            }
        }
        
    }   
}
?>

<body id="product-sidebar-left">
    <!-- main content -->
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
                                            <a href="#">
                                                <span>Home</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span><?php echo LANG_VALUE_51; ?> "<?php echo $title; ?></span>
                                            </a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </nav>

                        <div class="container">
                            <div class="content">
                                <div class="row">
                                    <div class="sidebar-3 sidebar-collection col-lg-3 col-md-4 col-sm-4">

                                        <!-- category menu -->
                                         <div class="sidebar-block">
                                            <div class="title-block">Categories</div>
                                            <div class="block-content">
                                                <?php
                $i=0;
                $statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $i++;
                    ?>
                                                <div class="cateTitle hasSubCategory open level1">
                                                    <span class="arrow collapsed collapse-icons" data-toggle="collapse" data-target="#cat-sub-<?php echo $i; ?>" aria-expanded="false" role="status">
                                                        <i class="zmdi zmdi-minus"></i>
                                                        <i class="zmdi zmdi-plus"></i>
                                                    </span>
                                                    <a class="cateItem" href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category"><?php echo $row['tcat_name']; ?></a>
                                                    <div class="subCategory collapse" id="cat-sub-<?php echo $i; ?>" aria-expanded="true" role="status">
                                                        <?php
                            $j=0;
                            $statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
                            $statement1->execute(array($row['tcat_id']));
                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result1 as $row1) {
                                $j++;
                                ?>
                                                        <div class="cateTitle">
                                                            <a href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category" class="cateItem"><?php echo $row1['mcat_name']; ?></a>
                                                        </div>

                                                        <?php
                            }
                            ?>
                                                    </div>
                                                </div>
                                                <?php
                }
            ?>
                                            </div>
                                        </div>

                                        <!-- best seller -->
                                        <!-- <div class="sidebar-block">
                                            <div class="title-block">Catalog</div>
                                            
                                            
                                        </div> -->
                                    </div>
                                    <div class="col-sm-8 col-lg-9 col-md-8 product-container">
                                        <h1>All Products - <?php echo $title; ?></h1>
                                        <div class="js-product-list-top firt nav-top">
                                            <div class="d-flex justify-content-around row">
                                                <div class="col col-xs-12 ">
                                                    <ul class="nav nav-tabs">
                                                        <li>
                                                            <a href="#grid" data-toggle="tab" class="fa fa-th-large"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#list" data-toggle="tab" class="active show fa fa-list-ul"></a>
                                                        </li>
                                                    </ul>
                                                    <!-- <div class="hidden-sm-down total-products">
                                                        <p>There are 12 products.</p>
                                                    </div> -->
                                                </div>
                                                <div class="col col-xs-12">
                                                    <div class="d-flex sort-by-row justify-content-end">
                                                        <div class="products-sort-order dropdown">
                                                            <select class="select-title">
                                                                <option value="">Sort by</option>
                                                                <option value="">Name, A to Z</option>
                                                                <option value="">Name, Z to A</option>
                                                                <option value="">Price, low to high</option>
                                                                <option value="">Price, high to low</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-content product-items">
                                            <div id="grid" class="related tab-pane fade">
                                                <div class="row">
                                                    <?php
                        // Checking if any product is available or not
                        $prod_count = 0;
                        $statement = $pdo->prepare("SELECT * FROM tbl_product");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $prod_table_ecat_ids[] = $row['ecat_id'];
                        }

                        for($ii=0;$ii<count($final_ecat_ids);$ii++):
                            if(in_array($final_ecat_ids[$ii],$prod_table_ecat_ids)) {
                                $prod_count++;
                            }
                        endfor;

                        if($prod_count==0) {
                            echo '<div class="pl_15">'.LANG_VALUE_153.'</div>';
                        } else {
                            for($ii=0;$ii<count($final_ecat_ids);$ii++) {
                                $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_is_active=?");
                                $statement->execute(array($final_ecat_ids[$ii],1));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                                   <div class="item text-center col-md-4">
                                                        <div class="product-miniature js-product-miniature item-one first-item">
                                                            <div class="thumbnail-container border">
                                                                <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                                    <img class="img-fluid"  src="assets/uploads/<?php echo $row['p_featured_photo']; ?>"  alt="img">
                                                                </a>
                                                            </div>
                                                            <div class="product-description">
                                                                        <div class="product-groups">
                                                                            <div class="product-title">
                                                                                 <a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?>
                                </a>
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
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                            ';
                                                        } 
                                                        elseif($avg_rating == 2.5) {
                                                            echo '
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                            ';
                                                        }
                                                        elseif($avg_rating == 3.5) {
                                                            echo '
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                            ';
                                                        }
                                                        elseif($avg_rating == 4.5) {
                                                            echo '
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                            ';
                                                        }
                                                        else {
                                                            for($i=1;$i<=5;$i++) {
                                                                ?>
                                                                <?php if($i>$avg_rating): ?>
                                                                    <div class="star"></div>
                                                                <?php else: ?>
                                                                    <div class="star"></div>
                                                                <?php endif; ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                    </div>
                                </div>
                                    <div class="product-group-price">
                                        <div class="product-price-and-shipping">
                                            <span class="price">$<?php echo $row['p_current_price']; ?> 
                                                    <?php if($row['p_old_price'] != ''): ?>
                                            </span>
                                                <del class="regular-price"> $<?php echo $row['p_old_price']; ?>
                                                                                
                                                </del>
                                                 <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if($row['p_qty'] == 0): ?>
                                                                <div class="out-of-stock">
                                                                    <div class="inner">
                                                                        Out Of Stock
                                                                    </div>
                                                                </div>       
                                                            <?php else: ?>
                                <div class="product-buttons d-flex justify-content-center">
                                    <div class="formAddToCart">
                                        <a class="add-to-cart" href="product.php?id=<?php echo $row['p_id']; ?>" data-button-action="add-to-cart">
                                           <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                       </a>
                                    </div>
                                </div>
                                             <?php endif; ?>
                                         </div>
                                    </div>
                                </div>
                                                    <?php
                                }
                            }
                        }
                        ?>
                                                </div>
                                            </div>
                                            <div id="list" class="related tab-pane fade in active show">
                                                <div class="row">
                                                    <?php
                        // Checking if any product is available or not
                        $prod_count = 0;
                        $statement = $pdo->prepare("SELECT * FROM tbl_product");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $prod_table_ecat_ids[] = $row['ecat_id'];
                        }

                        for($ii=0;$ii<count($final_ecat_ids);$ii++):
                            if(in_array($final_ecat_ids[$ii],$prod_table_ecat_ids)) {
                                $prod_count++;
                            }
                        endfor;

                        if($prod_count==0) {
                            echo '<div class="pl_15">'.LANG_VALUE_153.'</div>';
                        } else {
                            for($ii=0;$ii<count($final_ecat_ids);$ii++) {
                                $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_is_active=?");
                                $statement->execute(array($final_ecat_ids[$ii],1));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                                    <div class="item col-md-12">
                                                        <div class="product-miniature item-one first-item">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="thumbnail-container border">
                                                                        <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                                    <img class="img-fluid" style="width: 100%;"  src="assets/uploads/<?php echo $row['p_featured_photo']; ?>"  alt="img">
                                                                </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="product-description">
                                                                        <div class="product-groups">
                                                                            <div class="product-title">
                                                                                <a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?>
                                </a>
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
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                            ';
                                                        } 
                                                        elseif($avg_rating == 2.5) {
                                                            echo '
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                            ';
                                                        }
                                                        elseif($avg_rating == 3.5) {
                                                            echo '
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                            ';
                                                        }
                                                        elseif($avg_rating == 4.5) {
                                                            echo '
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                                 <div class="star"></div>
                                                            ';
                                                        }
                                                        else {
                                                            for($i=1;$i<=5;$i++) {
                                                                ?>
                                                                <?php if($i>$avg_rating): ?>
                                                                    <div class="star"></div>
                                                                <?php else: ?>
                                                                    <div class="star"></div>
                                                                <?php endif; ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="product-group-price">
                                        <div class="product-price-and-shipping">
                                            <span class="price">$<?php echo $row['p_current_price']; ?> 
                                                    <?php if($row['p_old_price'] != ''): ?>
                                            </span>
                                                <del class="regular-price"> $<?php echo $row['p_old_price']; ?>
                                                                                
                                                </del>
                                                 <?php endif; ?>
                                        </div>
                                    </div>
                                                                        </div>
                                                                        <?php if($row['p_qty'] == 0): ?>
                                                                <div class="out-of-stock">
                                                                    <div class="inner">
                                                                        Out Of Stock
                                                                    </div>
                                                                </div>       
                                                            <?php else: ?>
                                                                        <div class="product-buttons d-flex">
                                                                             <a class="add-to-cart" href="product.php?id=<?php echo $row['p_id']; ?>" data-button-action="add-to-cart">
                                           <i class="fa fa-shopping-cart" aria-hidden="true"></i>Add to cart
                                       </a>
                                                                               
                                                                            
                                                                        </div>
                                                                         <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                }
                            }
                        }
                        ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- pagination -->
                                        <<!-- div class="pagination">
                                            <div class="js-product-list-top ">
                                                <div class="d-flex justify-content-around row">
                                                    <div class="showing col col-xs-12">
                                                        <span>SHOWING 1-3 OF 3 ITEM(S)</span>
                                                    </div>
                                                    <div class="page-list col col-xs-12">
                                                        <ul>
                                                            <li>
                                                                <a rel="prev" href="#" class="previous disabled js-search-link">
                                                                    Previous
                                                                </a>
                                                            </li>
                                                            <li class="current active">
                                                                <a rel="nofollow" href="#" class="disabled js-search-link">
                                                                    1
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a rel="nofollow" href="#" class="disabled js-search-link">
                                                                    2
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a rel="nofollow" href="#" class="disabled js-search-link">
                                                                    3
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a rel="next" href="#" class="next disabled js-search-link">
                                                                    Next
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>

                                    <!-- end col-md-9-1 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php require_once('footer.php'); ?>
    