       <?php require_once('header.php'); ?>
       <body id="home2">
       <?php require_once('main-header.php'); ?>
		<?php
		$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
		foreach ($result as $row) {
		    $about_title = $row['about_title'];
		    $about_content = $row['about_content'];
		    $about_banner = $row['about_banner'];
		}
		?>
		<div class="main-content">
			<div class="wrap-banner">
            <?php include("menu-category.php"); ?>
        </div>
			<div id="wrapper-site">
				<div id="content-wrapper">
					
					<!-- breadcrumb -->
					<nav class="breadcrumb-bg">
						<div class="container no-index">
							<div class="breadcrumb">
								<ol>
									<li>
										<a href="index.php">
											<span>Home</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span><?php echo $about_title; ?></span>
										</a>
									</li>
								</ol>
							</div>
						</div>
					</nav>
					<div id="main">
						<div class="page-home">
							<div class="container">
								<div class="about-us-content">
									<br>
									<h1 class="title-page"><?php echo $about_title; ?></h1>
									  <?php echo $about_content; ?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once('footer.php'); ?>
    