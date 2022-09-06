<?php
/* Template Name: CEA Training Reports Submission */
get_header();
acf_form_head();
?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>
<div class="container">

<div class="col-mid-15">
  <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
 </div>

<div class="col-mid-85"  id="main-content">
    <div class="standardCenter " style="height:100vh !important;">
   <div class="account-information">
<div class="headerAccount"><i class="fas fa-file-alt"></i> Submit your Training Report</div>
  <?php
if (isset($_GET['success']))
{
?>
<div class="info-success">
You have successfully submitted your monthly training report
</div>
<div class="no-tabs">
    <?php include( get_template_directory() . '-child/training-reports/cea-training-reports.php' ); ?>
</div>
<?php
}
else
{

    $current_user = wp_get_current_user();
    $email = $current_user->user_email;
    global $name;
    global $cpost;
    global $token;
    global $ca;
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
            $cpost = get_the_ID();
            $token = get_field('confirmation_key');
            $name;
            
            if(get_field('type_of_cea') == "Firm"){
                $name = get_field('firm_name' );
            } else {
                $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');
            }
            
            $ca =   get_field('ca-no');
            $date = date('M-d-Y'); ?>
            
            <?php
            //Documents Reports
            $accrID;
            $args_officialEmail = array(
                'posts_per_page' => 1,
                'post_type' => array(
                    'accreditations'
                ),
                'post_status' => array(
                    'publish'
                ),
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'ca_no',
                        'value' => $ca,
                        'compare' => '=',
                    )
                )
            );
            $variable_officialEmail = new WP_Query($args_officialEmail);
            if ($variable_officialEmail->have_posts()): the_post(); ?>
                <?php while( $variable_officialEmail->have_posts() ): $variable_officialEmail->the_post(); ?>
                    <?php $accrID = get_the_id(); ?>
                <?php endwhile; ?>
            <?php else : ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
            
            
            <?php
            acf_form(array(
                'post_id' => 'new_post',
                'field_groups' => array(
                    'group_62393ea34953e',  // Monthly Report
                ) ,
                'new_post' => array(
                    'post_type' => 'cea_training_reports',
                    'post_title' => $token,
                    'post_status' => 'publish',
                ) ,
                'updated_message' => __("", 'acf'),
                'submit_value'  => __('Submit', acf),
                'return' => "?success=$cpost",
            ));

        endwhile;
        endif;
        
               

    }
?>
            <div style="display:none" class="fancybox-hidden">
                <div id="termsAndConditions" style="line-height:1.3; font-size:13px; width:560px; max-width:100%;">
                    <h5>Terms and Conditions</h5>
                    <ul>
                        <li>All submitted documents are still subject for evaluation and verification of CDA</li>
                        <li>Applicant is responsible to monitor the status of its application in the system thru its application code</li>
                    </ul>
                </div>
            </div>
            
            <style>
                .reminderSettings { display: none; }
            </style>
            <script>
                document.getElementById("acf-field_623940467f68b").value = "<?php echo $name; ?>";
                document.getElementById("acf-field_623940327f68a").value = "<?php echo $ca; ?>";
                document.getElementById("acf-field_6239401e7f689").value = "<?php echo $cpost; ?>";
                document.getElementById("acf-field_62fc3f0622e50").value = "<?php echo get_field('type_of_cea', $cpost); ?>";
            </script>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
