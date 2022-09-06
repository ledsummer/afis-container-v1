<?php
/* Template Name: Accreditation - Approved */
get_header();
acf_form_head();
?>
<?php include ("account-header.php"); ?>
<?php include ("account-accreditation.php"); ?>
<div class="container">

<div class="col-mid-15">
        <?php include ("account-sidebar.php"); ?>
 </div>
 
<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;

$returnedID;
$posts = get_posts(array(
    'numberposts' => 1,
    'post_type' => array(
        'cea',
        'ctpro'
    ) ,
    'post_status' => array(
        'publish'
    ) ,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'email',
            'value' => $email,
            'compare' => '=',
        )
    )
));
if (have_posts()):
    while (have_posts()):
        the_post();
        $returnedID = get_the_id();
    endwhile;
endif;
?> 

<div class="col-mid-85"  id="main-content">
    <div class="standardCenter">
        <center><h3>Apply for Accreditation</h3></center>
        <br><br><br>
        <div>
            <?php if(get_field('application', $returnedID) == 1){ ?>
                <?php include ("new/account-accreditation-approved.php"); ?>
            <?php } else if(get_field('application', $returnedID) == 2) { ?>
                <?php include ("old/account-accreditation-approved.php"); ?>
            <?php } ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>