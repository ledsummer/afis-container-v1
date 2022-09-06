<?php 
/* Template Name: View Documentary Requirement Requests */ 
get_header();
acf_form_head();
?>
<?php include( get_template_directory() . '-child/my-account/account-restriction.php' ); ?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>

<div class="container">

<div class="col-mid-15">
    <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
</div>

<?php
    $reportID = $_GET['post_id'];
    $reportPT = get_post_type($reportID);
?>

<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;

$globalID;
$args_officialEmail = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'regional_officers'
    ),
    'post_status' => array(
        'publish'
    ),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'email_address',
            'value' => $email,
            'compare' => '=',
        )
    )
);

$variable_officialEmail = new WP_Query($args_officialEmail);
if ($variable_officialEmail->have_posts()): the_post(); ?>
    <?php while( $variable_officialEmail->have_posts() ): $variable_officialEmail->the_post(); ?>
        <?php $globalID = get_the_id(); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<div class="col-mid-85"  id="main-content">
    <div class="standardCenter" style="height:100vh !important;">
        <div class="col-mid-70">
            <div class="account-information">
                <?php if (isset($_GET['success'])) { ?>
                    <div class="info-success">
                        You have successfully updated the status
                    </div>
                <?php } ?>
			    <div class="headerAccount"><i class="fas fa-file-alt"></i> Yearly Training Report</div>
                <br>
                
                <iframe src="<?php echo get_field('document', $reportID)['url']; ?>" style="width: 100%; height: 700px;"></iframe>
            </div>
        </div>
        <div class="col-mid-30" style="padding-left: 25px;">
            <div class="account-information">
                <div class="headerAccount"><i class="fas fa-user-edit"></i> Update Status</div>
                <?php 
                    acf_form(array(
                        'post_id' => $reportID,
                        'field_groups' => array(
                            'group_61fc919349e09'   
                        ) ,
                        $reportID => array(
                            'post_type' => $reportPT,
                            'post_status' => 'publish',
                        ) ,
                        'updated_message' => __("", 'acf'),
                        'submit_value'  => __('Submit', acf),
                        'return' => "?post_id=".$reportID."&success=y",
                    ));
                ?>
                <style>
				    .frontendhidden {
				        display: block;
				    }
				    .alwaysHide {
				        display: none;
				    }
				      .btn-download button, input[type="submit"], input[type="button"], input[type="reset"] {
			          background: linear-gradient(to bottom, #4458b4 0%, #4054b2 100%)!important;
			          border: none;
			          border-bottom: 3px solid #4054b2 !important;
			          padding: 10px !important;
			          border: 0px !important;
			          text-transform: UPPERCASE;
			          font-size: 13px;
			          font-family: 'Open Sans';
			        }
				</style>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>
<div class="clear"></div>

<script>
    document.getElementById("acf-field_621db14d328f3").value = "<?php echo $globalID; ?>";
</script>
<?php get_footer(); ?>