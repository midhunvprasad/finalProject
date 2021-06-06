<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;

    $path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        // removing the existing photo
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $logo = $row['logo'];
            unlink('../assets/uploads/'.$logo);
        }

        // updating the data
        $final_name = 'logo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET logo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'Logo is updated successfully.';
        
    }
}

if(isset($_POST['form2'])) {
    $valid = 1;

    $path = $_FILES['photo_favicon']['name'];
    $path_tmp = $_FILES['photo_favicon']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        // removing the existing photo
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $favicon = $row['favicon'];
            unlink('../assets/uploads/'.$favicon);
        }

        // updating the data
        $final_name = 'favicon'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET favicon=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'Favicon is updated successfully.';
        
    }
}



if(isset($_POST['form4'])) {
    // updating the database
    $statement = $pdo->prepare("UPDATE tbl_settings SET receive_email=?, receive_email_subject=?,receive_email_thank_you_message=?, forget_password_message=? WHERE id=1");
    $statement->execute(array($_POST['receive_email'],$_POST['receive_email_subject'],$_POST['receive_email_thank_you_message'],$_POST['forget_password_message']));

    $success_message = 'Contact form settings information is updated successfully.';
}




if(isset($_POST['form6_0'])) {
    // updating the database
    $statement = $pdo->prepare("UPDATE tbl_settings SET home_service_on_off=?, home_welcome_on_off=?, home_featured_product_on_off=?, home_latest_product_on_off=?, home_popular_product_on_off=?, home_testimonial_on_off=?, home_blog_on_off=? WHERE id=1");
    $statement->execute(array($_POST['home_service_on_off'],$_POST['home_welcome_on_off'],$_POST['home_featured_product_on_off'],$_POST['home_latest_product_on_off'],$_POST['home_popular_product_on_off'],$_POST['home_testimonial_on_off'],$_POST['home_blog_on_off']));

    $success_message = 'Section On-Off Settings is updated successfully.';
}


if(isset($_POST['form6'])) {
    // updating the database
    $statement = $pdo->prepare("UPDATE tbl_settings SET meta_title_home=?, meta_keyword_home=?, meta_description_home=? WHERE id=1");
    $statement->execute(array($_POST['meta_title_home'],$_POST['meta_keyword_home'],$_POST['meta_description_home']));

    $success_message = 'Home Meta settings is updated successfully.';
}

if(isset($_POST['form6_7'])) {

    $valid = 1;

    if(empty($_POST['cta_title'])) {
        $valid = 0;
        $error_message .= 'Call to Action Title can not be empty<br>';
    }

    if(empty($_POST['cta_content'])) {
        $valid = 0;
        $error_message .= 'Call to Action Content can not be empty<br>';
    }

    if(empty($_POST['cta_read_more_text'])) {
        $valid = 0;
        $error_message .= 'Call to Action Read More Text can not be empty<br>';
    }

    if(empty($_POST['cta_read_more_url'])) {
        $valid = 0;
        $error_message .= 'Call to Action Read More URL can not be empty<br>';
    }

    $path = $_FILES['cta_photo']['name'];
    $path_tmp = $_FILES['cta_photo']['tmp_name'];

    if($path != '') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {

        if($path != '') {
            // removing the existing photo
            $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
            foreach ($result as $row) {
                $cta_photo = $row['cta_photo'];
                unlink('../assets/uploads/'.$cta_photo);
            }

            // updating the data
            $final_name = 'cta'.'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_settings SET cta_title=?,cta_content=?,cta_read_more_text=?,cta_read_more_url=?,cta_photo=? WHERE id=1");
            $statement->execute(array($_POST['cta_title'],$_POST['cta_content'],$_POST['cta_read_more_text'],$_POST['cta_read_more_url'],$final_name));
        } else {
            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_settings SET cta_title=?,cta_content=?,cta_read_more_text=?,cta_read_more_url=? WHERE id=1");
            $statement->execute(array($_POST['cta_title'],$_POST['cta_content'],$_POST['cta_read_more_text'],$_POST['cta_read_more_url']));
        }

        $success_message = 'Call to Action Data is updated successfully.';
        
    }
}

if(isset($_POST['form6_4'])) {

    $valid = 1;

    if(empty($_POST['featured_product_title'])) {
        $valid = 0;
        $error_message .= 'Featured Product Title can not be empty<br>';
    }

    if(empty($_POST['featured_product_subtitle'])) {
        $valid = 0;
        $error_message .= 'Featured Product SubTitle can not be empty<br>';
    }

    if($valid == 1) {

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET featured_product_title=?,featured_product_subtitle=? WHERE id=1");
        $statement->execute(array($_POST['featured_product_title'],$_POST['featured_product_subtitle']));

        $success_message = 'Featured Product Data is updated successfully.';
        
    }
}

if(isset($_POST['form6_5'])) {

    $valid = 1;

    if(empty($_POST['latest_product_title'])) {
        $valid = 0;
        $error_message .= 'Latest Product Title can not be empty<br>';
    }

    if(empty($_POST['latest_product_subtitle'])) {
        $valid = 0;
        $error_message .= 'Latest Product SubTitle can not be empty<br>';
    }

    if($valid == 1) {

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET latest_product_title=?,latest_product_subtitle=? WHERE id=1");
        $statement->execute(array($_POST['latest_product_title'],$_POST['latest_product_subtitle']));

        $success_message = 'Latest Product Data is updated successfully.';
        
    }
}

if(isset($_POST['form6_6'])) {

    $valid = 1;

    if(empty($_POST['popular_product_title'])) {
        $valid = 0;
        $error_message .= 'Popular Product Title can not be empty<br>';
    }

    if(empty($_POST['popular_product_subtitle'])) {
        $valid = 0;
        $error_message .= 'Popular Product SubTitle can not be empty<br>';
    }

    if($valid == 1) {

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET popular_product_title=?,popular_product_subtitle=? WHERE id=1");
        $statement->execute(array($_POST['popular_product_title'],$_POST['popular_product_subtitle']));

        $success_message = 'Popular Product Data is updated successfully.';
        
    }
}

if(isset($_POST['form6_1'])) {

    $valid = 1;

    if(empty($_POST['testimonial_title'])) {
        $valid = 0;
        $error_message .= 'Testimonial Title can not be empty<br>';
    }

    if(empty($_POST['testimonial_subtitle'])) {
        $valid = 0;
        $error_message .= 'Testimonial SubTitle can not be empty<br>';
    }

    $path = $_FILES['testimonial_photo']['name'];
    $path_tmp = $_FILES['testimonial_photo']['tmp_name'];

    if($path != '') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {


        if($path != '') {
            // removing the existing photo
            $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
            foreach ($result as $row) {
                $testimonial_photo = $row['testimonial_photo'];
                unlink('../assets/uploads/'.$testimonial_photo);
            }

            // updating the data
            $final_name = 'testimonial'.'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_settings SET testimonial_title=?,testimonial_subtitle=?, testimonial_photo=? WHERE id=1");
            $statement->execute(array($_POST['testimonial_title'],$_POST['testimonial_subtitle'],$final_name));
        } else {
            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_settings SET testimonial_title=?,testimonial_subtitle=? WHERE id=1");
            $statement->execute(array($_POST['testimonial_title'],$_POST['testimonial_subtitle']));
        }

        $success_message = 'Testimonial Data is updated successfully.';
        
    }
}


if(isset($_POST['form6_2'])) {

    $valid = 1;

    if(empty($_POST['blog_title'])) {
        $valid = 0;
        $error_message .= 'Blog Title can not be empty<br>';
    }

    if(empty($_POST['blog_subtitle'])) {
        $valid = 0;
        $error_message .= 'Blog SubTitle can not be empty<br>';
    }

    if($valid == 1) {

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET blog_title=?,blog_subtitle=? WHERE id=1");
        $statement->execute(array($_POST['blog_title'],$_POST['blog_subtitle']));

        $success_message = 'Blog Data is updated successfully.';
        
    }
}

if(isset($_POST['form6_3'])) {

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET newsletter_text=? WHERE id=1");
        $statement->execute(array($_POST['newsletter_text']));
        
        $success_message = 'Newsletter Text is updated successfully.';
 
}


if(isset($_POST['form9'])) {
    // updating the database
    $statement = $pdo->prepare("UPDATE tbl_settings SET paypal_email=?, stripe_public_key=?, stripe_secret_key=?, bank_detail=? WHERE id=1");
    $statement->execute(array($_POST['paypal_email'],$_POST['stripe_public_key'],$_POST['stripe_secret_key'],$_POST['bank_detail']));

    $success_message = 'Payment Settings is updated successfully.';
}

if(isset($_POST['form10'])) {
    // updating the database
    $statement = $pdo->prepare("UPDATE tbl_settings SET before_head=?, after_body=?, before_body=? WHERE id=1");
    $statement->execute(array($_POST['before_head'],$_POST['after_body'],$_POST['before_body']));

    $success_message = 'Head and Body Script is updated successfully.';
}


?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Settings</h1>
    </div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
    $logo                            = $row['logo'];
    $favicon                         = $row['favicon'];
    $receive_email                   = $row['receive_email'];
    $receive_email_subject           = $row['receive_email_subject'];
    $receive_email_thank_you_message = $row['receive_email_thank_you_message'];
    $forget_password_message         = $row['forget_password_message'];
    $total_recent_post_footer        = $row['total_recent_post_footer'];
    $total_popular_post_footer       = $row['total_popular_post_footer'];
    $total_recent_post_sidebar       = $row['total_recent_post_sidebar'];
    $total_popular_post_sidebar      = $row['total_popular_post_sidebar'];
    $total_featured_product_home     = $row['total_featured_product_home'];
    $total_latest_product_home       = $row['total_latest_product_home'];
    $total_popular_product_home      = $row['total_popular_product_home'];
    $meta_title_home                 = $row['meta_title_home'];
    $meta_keyword_home               = $row['meta_keyword_home'];
    $meta_description_home           = $row['meta_description_home'];
    $banner_login                    = $row['banner_login'];
    $banner_registration             = $row['banner_registration'];
    $banner_forget_password          = $row['banner_forget_password'];
    $banner_reset_password           = $row['banner_reset_password'];
    $banner_search                   = $row['banner_search'];
    $banner_cart                     = $row['banner_cart'];
    $banner_checkout                 = $row['banner_checkout'];
    $banner_product_category         = $row['banner_product_category'];
    $cta_title                       = $row['cta_title'];
    $cta_content                     = $row['cta_content'];
    $cta_read_more_text              = $row['cta_read_more_text'];
    $cta_read_more_url               = $row['cta_read_more_url'];
    $cta_photo                       = $row['cta_photo'];
    $featured_product_title          = $row['featured_product_title'];
    $featured_product_subtitle       = $row['featured_product_subtitle'];
    $latest_product_title            = $row['latest_product_title'];
    $latest_product_subtitle         = $row['latest_product_subtitle'];
    $popular_product_title           = $row['popular_product_title'];
    $popular_product_subtitle        = $row['popular_product_subtitle'];
    $paypal_email                    = $row['paypal_email'];
    $stripe_public_key               = $row['stripe_public_key'];
    $stripe_secret_key               = $row['stripe_secret_key'];
    $bank_detail                     = $row['bank_detail'];
    $before_head                     = $row['before_head'];
    $after_body                      = $row['after_body'];
    $before_body                     = $row['before_body'];
    $home_featured_product_on_off    = $row['home_featured_product_on_off'];
    $home_latest_product_on_off      = $row['home_latest_product_on_off'];
    $home_popular_product_on_off     = $row['home_popular_product_on_off']; 
    $newsletter_on_off               = $row['newsletter_on_off'];
}
?>


<section class="content" style="min-height:auto;margin-bottom: -30px;">
    <div class="row">
        <div class="col-md-12">
            <?php if($error_message): ?>
            <div class="callout callout-danger">
            
            <p>
            <?php echo $error_message; ?>
            </p>
            </div>
            <?php endif; ?>

            <?php if($success_message): ?>
            <div class="callout callout-success">
            
            <p><?php echo $success_message; ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">
                            
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Logo</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Favicon</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Email</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Home Page</a></li>
                        <li><a href="#tab_9" data-toggle="tab">Payment Settings</a></li>
                        <li><a href="#tab_10" data-toggle="tab">Head and Body Scripts</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">


                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $logo; ?>" class="existing-photo" style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">New Photo</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="photo_logo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form1">Update Logo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                            


                        </div>
                        <div class="tab-pane" id="tab_2">

                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $favicon; ?>" class="existing-photo" style="height:40px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">New Photo</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="photo_favicon">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form2">Update Favicon</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>


                        <div class="tab-pane" id="tab_4">

                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Contact Email Address</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="receive_email" value="<?php echo $receive_email; ?>">
                                        </div>
                                    </div>                                  
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Contact Email Subject</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="receive_email_subject" value="<?php echo $receive_email_subject; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Contact Email Thank you message</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="receive_email_thank_you_message"><?php echo $receive_email_thank_you_message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Forget password Message</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="forget_password_message"><?php echo $forget_password_message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-success pull-left" name="form4">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>






                        <div class="tab-pane" id="tab_6">


                        	<h3>Sections On and Off</h3>
                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Featured Product Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_featured_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_featured_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_featured_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Latest Product Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_latest_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_latest_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_latest_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Popular Product Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_popular_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_popular_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_popular_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_0">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                            
                            <h3>Meta Section</h3>
                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Meta Title </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="meta_title_home" class="form-control" value="<?php echo $meta_title_home ?>">
                                        </div>
                                    </div>      
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Meta Keyword </label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="meta_keyword_home" style="height:100px;"><?php echo $meta_keyword_home ?></textarea>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Meta Description </label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="meta_description_home" style="height:200px;"><?php echo $meta_description_home ?></textarea>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>



                            <h3>Call to Action Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="cta_title" value="<?php echo $cta_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Content<span>*</span></label>
                                        <div class="col-sm-8">
                                            <textarea name="cta_content" class="form-control" cols="30" rows="10" style="height:120px;"><?php echo $cta_content; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Read More Text<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="cta_read_more_text" value="<?php echo $cta_read_more_text; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Read More URL<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="cta_read_more_url" value="<?php echo $cta_read_more_url; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Existing Call to Action Background</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $cta_photo; ?>" class="existing-photo" style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">New Background</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="cta_photo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_7">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>





                            <h3>Featured Product Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Featured Product Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="featured_product_title" value="<?php echo $featured_product_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Featured Product SubTitle<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="featured_product_subtitle" value="<?php echo $featured_product_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_4">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                            <h3>Latest Product Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Latest Product Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="latest_product_title" value="<?php echo $latest_product_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Latest Product SubTitle<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="latest_product_subtitle" value="<?php echo $latest_product_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_5">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                            <h3>Popular Product Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Popular Product Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="popular_product_title" value="<?php echo $popular_product_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Popular Product SubTitle<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="popular_product_subtitle" value="<?php echo $popular_product_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_6">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>





                        <div class="tab-pane" id="tab_9">
                            <form class="form-horizontal" action="" method="post">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">PayPal - Business Email </label>
                                            <div class="col-sm-5">
                                                <input type="text" name="paypal_email" class="form-control" value="<?php echo $paypal_email; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Stripe - Public Key </label>
                                            <div class="col-sm-5">
                                                <input type="text" name="stripe_public_key" class="form-control" value="<?php echo $stripe_public_key; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Stripe - Secret Key </label>
                                            <div class="col-sm-5">
                                                <input type="text" name="stripe_secret_key" class="form-control" value="<?php echo $stripe_secret_key; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Bank Information </label>
                                            <div class="col-sm-5">
                                                <textarea name="bank_detail" class="form-control" cols="30" rows="10"><?php echo $bank_detail; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form9">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="tab-pane" id="tab_10">
                            <form class="form-horizontal" action="" method="post">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Code before &lt;/head&gt; tag </label>
                                            <div class="col-sm-8">
                                                <textarea name="before_head" class="form-control" cols="30" rows="10"><?php echo $before_head; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Code after &lt;body&gt; tag </label>
                                            <div class="col-sm-8">
                                                <textarea name="after_body" class="form-control" cols="30" rows="10"><?php echo $after_body; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Code before &lt;/body&gt; tag </label>
                                            <div class="col-sm-8">
                                                <textarea name="before_body" class="form-control" cols="30" rows="10"><?php echo $before_body; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form10">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>

                

            </form>
        </div>
    </div>

</section>

<?php require_once('footer.php'); ?>