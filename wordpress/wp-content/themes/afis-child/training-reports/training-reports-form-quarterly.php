<?php
/* Template Name: Quarterly Training Reports */
get_header();
acf_form_head();
?>
<?php include (get_template_directory() . '-child/my-account/account-header.php'); ?>
<div class="container">

<div class="col-mid-15">
  <?php include (get_template_directory() . '-child/my-account/account-sidebar.php'); ?>
 </div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter " style="height:100vh !important;">
   <div class="account-information">
<div class="headerAccount"><i class="fas fa-file-alt"></i> Submit your Quarterly Training Report</div>
                
          
<?php
if (isset($_GET['success']))
{
?>
<div class="info-success">
You have successfully submitted your quarterly training report
</div>
<div class="no-tabs">
 <?php include( get_template_directory() . '-child/training-reports/training-reports-quarterly.php' ); ?>
 </div>
<?php
}
else
{

    $current_user = wp_get_current_user();
    $email = $current_user->user_email;
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
            $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');
            $ca =   get_field('ca-no');
            $date = date('M-d-Y');
            
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
                    'group_61d3a4631905d',  // Quarterly Report
                    'group_61d795eb2e9f1',  // Reports Email Status
                    'group_61f7850d3e394',  // Reminder Settings
                    'group_61fc919349e09'   // Status
                ) ,
                'new_post' => array(
                    'post_type' => 'quarterly_reports',
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
                document.getElementById("acf-field_61d3b51df34b6").value = "<?php echo $name; ?>";
                document.getElementById("acf-field_61d3bc06923bb").value = "<?php echo $ca; ?>";
                document.getElementById("acf-field_61d3b0c7a0055").value = "<?php echo $cpost; ?>";
                document.getElementById("acf-field_61d3a527a10fa").value = "<?php echo date("Y"); ?>";
                
                document.getElementById("acf-field_6200775c20113").value = "<?php echo get_field('monthly_start', $accrID); ?>";
                document.getElementById("acf-field_6200779b20114").value = "<?php echo get_field('monthly_end', $accrID); ?>";
                
                document.getElementById("acf-field_620077c120116").value = "<?php echo get_field('quarterly_start', $accrID); ?>";
                document.getElementById("acf-field_620077d520117").value = "<?php echo get_field('quarterly_end', $accrID); ?>";
                
                document.getElementById("acf-field_620077fb2011a").value = "<?php echo get_field('yearly_start', $accrID); ?>";
                document.getElementById("acf-field_6200780a2011b").value = "<?php echo get_field('quarterly_end', $accrID); ?>";
               </script>
					
					
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
