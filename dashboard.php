<?php require_once('header.php'); ?>
<body class="user-acount" id="home2">
    <?php require_once('main-header.php'); ?>

    <div class="main-content">
       <div class="wrap-banner">
            <?php include("menu-category.php"); ?>
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

            <div class="acount head-acount">
                <div class="container">
                    <div id="main">
                        <h1 class="title-page">My Account</h1>
                        <div class="content" id="block-history">
                            <table class="std table">
                                <tbody>
                                    <tr>
                                        <th class="first_item">My Name :</th>
                                        <td><?php echo $_SESSION['customer']['cust_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="first_item">Company :</th>
                                        <td><?php echo $_SESSION['customer']['cust_cname']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="first_item">Address :</th>
                                        <td><?php echo $_SESSION['customer']['cust_address']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="first_item">Country :</th>
                                        <td><?php echo $_SESSION['customer']['country_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="first_item">State :</th>
                                        <td><?php echo $_SESSION['customer']['cust_state']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="first_item">Phone :</th>
                                        <td><?php echo $_SESSION['customer']['cust_phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="first_item">Email:</th>
                                        <td><?php echo $_SESSION['customer']['cust_email']; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>