<?php
/* Template Name: Accreditation - Check Application Status */
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

$args1 = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'cea',
        'ctpro'
    ),
    'post_status' => array(
        'publish',
        'pending'
    ),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'email',
            'value' => $email,
            'compare' => '=',
        )
    )
);

$variable1 = new WP_Query($args1);
if ($variable1->have_posts()): the_post(); ?>
    <?php while( $variable1->have_posts() ): $variable1->the_post(); ?>
        <?php $returnedID = get_the_id(); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter">
        <center><h3>Apply for Accreditation</h3></center>
        <br><br><br>
        <div>
            <?php if(get_field('application', $returnedID) == 1){ ?>
                <?php include ("new/account-accreditation-review-information.php"); ?>
            <?php } else if(get_field('application', $returnedID) == 2) { ?>
                <?php include ("old/account-accreditation-review-information.php"); ?>
            <?php } ?>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>
