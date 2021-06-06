		<?php require_once('header.php'); ?>
		<body id="home2">
         <?php require_once('main-header.php'); ?>
		<?php
		$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
		foreach ($result as $row) {
		    $faq_title = $row['faq_title'];
		    $faq_banner = $row['faq_banner'];
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
											<span><?php echo $faq_title; ?></span>
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
									<h1 class="title-page"><?php echo $faq_title; ?></h1>
								<div class="accordion">
									 <?php
				                    $statement = $pdo->prepare("SELECT * FROM tbl_faq");
				                    $statement->execute();
				                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
				                    foreach ($result as $row) {
				                        ?>
								    <div class="accordion-item">
								      <h2 id="accordion-button-1" aria-expanded="false"><span class="accordion-title"> Q: <?php echo $row['faq_title']; ?></span><span class="icon" aria-hidden="true"></span></h2>
								      <div class="accordion-content">
								        <p> <?php echo $row['faq_content']; ?></p>
								      </div>
								    </div>
								    <?php
					                    }
					                 ?>
								  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		 <style type="text/css">
								  	
								.accordion .accordion-item {
								  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
								  padding:15px 20px;
								  margin-top:20px;
								  border-radius:10px;
								}
								.accordion .accordion-item button[aria-expanded=true] {
								/*   border-bottom: 1px solid #03b5d2; */
								}
								.accordion h2 {
								  position: relative;
								  display: block;
								  text-align: left;
								  width: 100%;
								/*    padding: 1em 0; */
								  color: #333333;
								  font-size: 1.15rem;
								  font-weight: 400;
								  border: none;
								  background: none;
								  outline: none;
								  padding:0px;
								  line-height:25px;
								  margin:0px;
								  font-family: 'Open Sans', sans-serif;
								}
								.accordion h2:hover, .accordion h2:focus {
								  cursor: pointer;
								  color: black;
								}
								.accordion h2:hover::after, .accordion h2:focus::after {
								  cursor: pointer;
								  color: #03b5d2;
								  border: 1px solid #03b5d2;
								}
								.accordion h2 .accordion-title {
								  padding: 1em 1.5em 1em 0;
								}
								.accordion h2 .icon {
								  display: inline-block;
								  position: absolute;
								  top: 2px;
								  right: 0;
								  width: 22px;
								  height: 22px;
								  border: 1px solid;
								  border-radius: 22px;
								}
								.faq-content {
								    padding: 80px 0px;
								}
								.accordion h2 .icon::before {
								  display: block;
								  position: absolute;
								  content: "";
								  top: 9px;
								  left: 5px;
								  width: 10px;
								  height: 2px;
								  background: currentColor;
								}
								.accordion h2 .icon::after {
								  display: block;
								  position: absolute;
								  content: "";
								  top: 5px;
								  left: 9px;
								  width: 2px;
								  height: 10px;
								  background: currentColor;
								}
								.accordion h2[aria-expanded=true] {
								  color: #03b5d2;
								}
								.accordion h2[aria-expanded=true] .icon::after {
								  width: 0;
								}
								.accordion h2[aria-expanded=true] + .accordion-content {
								  opacity: 1;
								  max-height: 5000px;
								  transition: all 200ms linear;
								  will-change: opacity, max-height;
								}
								.accordion .accordion-content {
								  opacity: 0;
								  max-height: 0;
								  overflow: hidden;
								  transition: opacity 200ms linear, max-height 200ms linear;
								  will-change: opacity, max-height;
								}
								.accordion .accordion-content p {
								  font-size: 1rem;
								  font-weight: 300;
								  margin: 0px;
								  margin-top: 10px;
								  font-family: 'Open Sans', sans-serif;
								}
								  </style>
								  <script type="text/javascript">
								  	const items = document.querySelectorAll(".accordion-item h2");

											function toggleAccordion() {
											  const itemToggle = this.getAttribute('aria-expanded');
											  
											  for (i = 0; i < items.length; i++) {
											    items[i].setAttribute('aria-expanded', 'false');
											  }
											  
											  if (itemToggle == 'false') {
											    this.setAttribute('aria-expanded', 'true');
											  }
											}

											items.forEach(item => item.addEventListener('click', toggleAccordion));



								  </script>
		            <?php require_once('footer.php'); ?>
    