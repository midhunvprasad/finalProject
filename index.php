<?php require_once('header.php'); ?>
  
    <?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $featured_product_title = $row['featured_product_title'];
    $featured_product_subtitle = $row['featured_product_subtitle'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $testimonial_title = $row['testimonial_title'];
    $testimonial_subtitle = $row['testimonial_subtitle'];
    $testimonial_photo = $row['testimonial_photo'];
    $blog_title = $row['blog_title'];
    $blog_subtitle = $row['blog_subtitle'];
    $total_featured_product_home = $row['total_featured_product_home'];
    $total_latest_product_home = $row['total_latest_product_home'];
    $total_popular_product_home = $row['total_popular_product_home'];
    $home_service_on_off = $row['home_service_on_off'];
    $home_welcome_on_off = $row['home_welcome_on_off'];
    $home_featured_product_on_off = $row['home_featured_product_on_off'];
    $home_latest_product_on_off = $row['home_latest_product_on_off'];
    $home_popular_product_on_off = $row['home_popular_product_on_off'];
    $home_testimonial_on_off = $row['home_testimonial_on_off'];
    $home_blog_on_off = $row['home_blog_on_off'];
}
?>
    <div class="main-content">
        <div class="wrap-banner">
            <!-- menu category -->
            <div class="menu-banner d-xs-none">
                <div class="tiva-verticalmenu block" data-count_showmore="17">
                    <div class="box-content block_content">
                        <div class="verticalmenu" role="navigation">
                            <ul class="menu level1">
                                <li class="item parent">
                                    <a href="#" class="hasicon" title="SIDE TABLE">
                                        <img src="assets/img/home/table-lamp.png" alt="img">SIDE TABLE</a>
                                </li>
                                <li class="item parent group">
                                    <a href="#" class="hasicon" title="FI">
                                        <img src="assets/img/home/fireplace.png" alt="img">FIREPLACE
                                    </a>
                                </li>
                                <li class="item group-category-img parent group">
                                    <a href="#" class="hasicon" title="TABLE LAMP">
                                        <img src="assets/img/home/table-lamp.png" alt="img">TABLE LAMP
									</a>
                                </li>
                                <li class="item">
                                    <a href="#" class="hasicon" title="OTTOMAN">
                                        <img src="assets/img/home/ottoman.png" alt="img">OTTOMAN
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" class="hasicon" title="ARMCHAIR">
                                        <img src="assets/img/home/armchair.png" alt="img">ARMCHAIR
                                    </a>
                                </li>
                                <li class="more item">Show More</li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-center align-items-center header-top-left pull-left">
                            <div class="toggle-nav act">
                                <div class="btnov-lines-large">
                                    <i class="zmdi zmdi-close"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- main -->
        <div id="wrapper-site">
            <div id="content-wrapper" class="full-width">
                <div id="main">
                    <section class="page-home">
                        <!-- SHOP THE LOOK -->
                        <div class="section spacing-10 groupbanner-special">
                            <div class="title-block">
                                <span>Shop The LookBook 2018</span>
                                <span>LookBook</span>
                                <span>HAND-PICKED ARRIVALS FROM THE BEST DESIGNER</span>
                            </div>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_slider");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                            foreach ($result as $row) {            
                                ?>
                                <li data-target="#bootstrap-touch-slider" data-slide-to="<?php echo $i; ?>" <?php if($i==0) {echo 'class="active"';} ?>></li>
                                <?php
                                $i++;
                            }
                            ?>							
                            <div class="row">
                                <div class="lookbook owl-carousel owl-theme owl-loaded owl-drag">
                                    <?php
                                $i=0;
                                $statement = $pdo->prepare("SELECT * FROM tbl_slider");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                                foreach ($result as $row) {            
                                    ?>
                                    <div class="item">
                                        <!-- Module Lookbooks -->
                                        <div class="tiva-lookbook defaul">
                                            <div class="items col-lg-12 col-sm-12 col-xs-12">
                                                <div class="tiva-content-lookbook">
                                                    <img class="img-fluid img-responsive" src="assets/uploads/<?php echo $row['photo']; ?>" alt="banner images">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                   }
                                 ?>
                                </div>
                            </div>
                        </div>

                        <?php if($home_featured_product_on_off == 1): ?>
                        <div class="section living-room background-none">
                            <div class="container">
                                <div class="tiva-row-wrap row">
                                    <div class="col-md-12 col-xs-12 groupcategoriestab-vertical">
                                        <h3 style="text-align: center; color: black;"><?php echo $featured_product_title; ?></h3>
                                        <div style="margin-bottom: 70px;"></div>
                                        <div class="grouptab">
                                            <div class="product-tab categoriestab-left flex-9">
                                                <div class="title-tab-content d-flex">
                                                    <!-- tab product -->
                                                    <div class="dropdown-toggle toggle-category tab-category-none">Select Category</div>
                                                    <ul class="nav nav-tabs wibkit row">
                                                        <li class="col-xs-6">
                                                            <a href="#all" data-toggle="tab" class="active">ALL PRODUCTS</a>
                                                        </li>
                                                        <li class="col-xs-6">
                                                            <a href="#table" data-toggle="tab">SIDE TABLE</a>
                                                        </li>
                                                        <li class="col-xs-6">
                                                            <a href="#armchair" data-toggle="tab">ARMCHAIR</a>
                                                        </li>
                                                        <li class="col-xs-6">
                                                            <a href="#cushion" data-toggle="tab">CUSHION</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <!-- tab product content -->
                                                <div class="tab-content">
                                                    <div id="all" class="tab-pane fade in active show">
                                                        <div class="item text-center row">
                                                            <!-- Product -->
                                                            <?php
                                                                $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? LIMIT ".$total_featured_product_home);
                                                                $statement->execute(array(1,1));
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                                                                foreach ($result as $row) {
                                                                ?>
                                                            <div class="col-md-3 col-xs-12">
                                                                <div class="product-miniature js-product-miniature item-one first-item">
                                                                    <div class="thumbnail-container">
                                                                        <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                    <img class="img-fluid" src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="img">
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
                            <?php } ?>
            <!-- Product -->
                                                        </div>
                                                        <div class="content-showmore text-center has-showmore">
                                                             <a href="product-category.php?id=2&type=top-category" class="btn btn-default novShowMore">Load More Products</a>

                                                            </button>
                                                            <input type="hidden" value="0" class="count_showmore">
                                                        </div>
                                                    </div>
                                                    <!-- tab -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- banner -->
                        <div class="section spacing-10 group-image-special">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 banner1">
                                    <div class="effect">
                                        <a href="#">
                                            <img class="img-fluid width-100" src="assets/img/home/effect5.jpg" alt="banner-1" title="banner-1">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 banner1">
                                    <div class="effect">
                                        <a href="#">
                                            <img class="img-fluid width-100" src="assets/img/home/effect6.jpg" alt="banner-2" title="banner-2">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 banner1">
                                    <div class="effect">
                                        <a href="#">
                                            <img class="img-fluid width-100" src="assets/img/home/effect7.jpg" alt="banner-2" title="banner-2">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 banner1">
                                    <div class="effect">
                                        <a href="#">
                                            <img class="img-fluid width-100" src="assets/img/home/effect8.jpg" alt="banner-2" title="banner-2">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 banner1">
                                    <div class="effect">
                                        <a href="#">
                                            <img class="img-fluid width-100" src="assets/img/home/effect9.jpg" alt="banner-2" title="banner-2">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <?php if($home_latest_product_on_off == 1): ?>
                                <div class="section new-arrivals col-lg-6 col-xs-6">
                                    <div class="tab-content">
                                        <div class="title-product">
                                            <h2><?php echo $latest_product_title; ?></h2>
                                            <p><?php echo $latest_product_subtitle; ?></p>
                                        </div>
                                        <div class="category-product owl-carousel owl-theme owl-loaded owl-drag">
                                            <?php
                                                $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT ".$total_latest_product_home);
                                                $statement->execute(array(1));
                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                                                foreach ($result as $row) {
                                                    ?>
                                            <div class="item text-center">
                                                <div class="product-miniature js-product-miniature item-one first-item">
                                                    <div class="thumbnail-container">
                                                        <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                            <img  src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="img">
                                                            
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
                                              <?php }  ?>
                                              </div>
                                              </div>
                                              </div>
                                  <?php endif; ?>
                                                            <?php if($home_popular_product_on_off == 1): ?>
                                <div class="section best-sellers col-lg-6 col-xs-6">
                                    <div class="tab-content">
                                        <div class="title-product">
                                             <h2><?php echo $popular_product_title; ?></h2>
                                            <p><?php echo $popular_product_subtitle; ?></p>
                                        </div>
                                        <div class="category-product owl-carousel owl-theme owl-loaded owl-drag">
                                            <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_total_view DESC LIMIT ".$total_popular_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>
                                            <div class="item text-center">
                                                <div class="product-miniature js-product-miniature item-one first-item">
                                                    <div class="thumbnail-container">
                                                        <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                            <img  src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="img">
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
                                             <?php }  ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            </div>
                        </div>

                        <!-- newsletter -->
                        <div class="section newsletter">
                            <div class="container">
                                <div class="row">
                                    <div class="news-content">
                                        <div class="tiva-modules">
                                            <div class="block">
                                                <div class="title-block">Newsletter</div>
                                                <div class="sub-title">Sign up to our newsletter to get the latest articles, lookbooks voucher codes
                                                    direct to your inbox</div>
                                                <div class="block-newsletter">
                                                    <form action="#" method="post">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="email" value="" placeholder="Enter Your Email">
                                                            <span class="input-group-btn">
                                                                <button class="effect-btn btn btn-secondary" name="submitNewsletter" type="submit">
                                                                    <span>subscribe</span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                        <input type="hidden" name="action" value="0">
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="block">
                                                <div class="social-content">
                                                    <div id="social-block">
                                                        <div class="social">
                                                            <ul class="list-inline mb-0 justify-content-end">
                                                                <li class="list-inline-item mb-0">
                                                                    <a href="#" target="_blank">
                                                                        <i class="fa fa-facebook"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item mb-0">
                                                                    <a href="#" target="_blank">
                                                                        <i class="fa fa-twitter"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item mb-0">
                                                                    <a href="#" target="_blank">
                                                                        <i class="fa fa-google"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item mb-0">
                                                                    <a href="#" target="_blank">
                                                                        <i class="fa fa-instagram"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Popup newsletter -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </div>
	<?php require_once('footer.php'); ?>
    
