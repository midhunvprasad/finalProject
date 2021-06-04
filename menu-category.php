<!-- menu category -->
            <div class="menu-banner d-xs-none">
                <div class="tiva-verticalmenu block" data-count_showmore="17">
                    <div class="box-content block_content">
                        <div class="verticalmenu" role="navigation">
                            <ul class="menu level1">
                                 <?php
                $i=0;
                $statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $i++;
                    ?>
                                <li class="item parent">
                                    <a href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category" class="hasicon" title="<?php echo $row['tcat_name']; ?>">
                                     <?php echo $row['tcat_name']; ?></a>
                                </li>
                                
                                 <?php
                }
            ?>
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