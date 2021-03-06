<?php require_once('header.php'); ?>
<body id="home2" class="product-grid-sidebar-left">
    <?php require_once('main-header.php'); ?>
    <?php
if(!isset($_REQUEST['search_text'])) {
    header('location: index.php');
    exit;
} else {
    if($_REQUEST['search_text']=='') {
        header('location: index.php');
        exit;
    }
}
?>

    <div class="main-content">
        <div class="wrap-banner">
            <?php include("menu-category.php"); ?>
        </div>
        <div id="wrapper-site">
            <div id="content-wrapper" class="full-width">
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
                                                <span> <?php 
                $search_text = strip_tags($_REQUEST['search_text']); 
                echo $search_text; 
            ?>   </span>
                                            </a>
                                        </li>
                                        
                                    </ol>
                                </div>
                            </div>
                        </nav>

                        <div class="container">
                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12 col-md-12 product-container">
                                        <br><br>
                                        <h3> <?php 
                $search_text = strip_tags($_REQUEST['search_text']); 
                echo $search_text; 
            ?>   </h3>
                                        <br>
                                        <div class="tab-content product-items">
                                            <div id="grid" class="related tab-pane fade in active show">
                                                <div class="container row">
                                                    <?php
                            $search_text = '%'.$search_text.'%';
                        ?>

            <?php
            /* ===================== Pagination Code Starts ================== */
            $adjacents = 5;
            $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? AND p_name LIKE ?");
            $statement->execute(array(1,$search_text));
            $total_pages = $statement->rowCount();

            $targetpage = BASE_URL.'search-result.php?search_text='.$_REQUEST['search_text'];   //your file name  (the name of this file)
            $limit = 12;                                 //how many items to show per page
            $page = @$_GET['page'];
            if($page) 
                $start = ($page - 1) * $limit;          //first item to display on this page
            else
                $start = 0;
            

            $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? AND p_name LIKE ? LIMIT $start, $limit");
            $statement->execute(array(1,$search_text));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
           
            
            if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
            $prev = $page - 1;                          //previous page is page - 1
            $next = $page + 1;                          //next page is page + 1
            $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;   
            $pagination = "";
            if($lastpage > 1)
            {   
                $pagination .= "<div class=\"pagination\">";
                if ($page > 1) 
                    $pagination.= "<a href=\"$targetpage&page=$prev\">&#171; previous</a>";
                else
                    $pagination.= "<span class=\"disabled\">&#171; previous</span>";    
                if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
                {   
                    for ($counter = 1; $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                    }
                }
                elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
                {
                    if($page < 1 + ($adjacents * 2))        
                    {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                        $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
                    }
                    elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    {
                        $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                        $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                        $pagination.= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                        $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
                    }
                    else
                    {
                        $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                        $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                        $pagination.= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                        }
                    }
                }
                if ($page < $counter - 1) 
                    $pagination.= "<a href=\"$targetpage&page=$next\">next &#187;</a>";
                else
                    $pagination.= "<span class=\"disabled\">next &#187;</span>";
                $pagination.= "</div>\n";       
            }
            /* ===================== Pagination Code Ends ================== */
            ?>

                     
                            <?php
                            
                            if(!$total_pages):
                                echo '<span style="color:red;font-size:18px;">No result found</span>';
                            else:
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
                            <?php } ?>
                             <div class="clear"></div>
                            <div class="pagination">
                            <?php 
                                echo $pagination; 
                            ?>
                            </div>
                            <?php
                            endif;
                        ?>
                                                </div>
                                            </div>
                                        </div>
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