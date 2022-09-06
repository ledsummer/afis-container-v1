<?php
/* Template Name: Edit Monthly Training Reports*/
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
<div class="headerAccount"><i class="fas fa-file-alt"></i> Editing your Monthly Training Reports</div>
  <?php
if (isset($_GET['success']))
{
?>
<div class="info-success">
You have successfully edited your training reports
</div>
 <?php include( get_template_directory() . '-child/training-reports/training-reports-monthly-edit.php' ); ?>
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
            $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');
            $ca =   get_field('ca-no');
            $date = date('M-d-Y');
            
            
            $checkifExist = array(
            'numberposts' => - 1,
            'post_type' => array(
                'monthly_reports'
            ) ,
            'post_status' => array(
                'publish'
            ) ,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'post_id',
                    'value' => $cpost,
                    'compare' => '='
                )
            )
        );
         $num_rows = count($checkifExist); //PHP count()
        if ($num_rows > 0)
        {
        ?>
        <?php
            
        ?>
      
            <?php
            $the_query = new WP_Query($checkifExist);
            if ($the_query->have_posts())
            {
                while ($the_query->have_posts()):
                    $the_query->the_post();
                    $status = get_field('status');
                    $queryID = get_the_ID();
                   
            ?>
                <?php 
                    acf_form(array(
                'post_id' => $queryID ,
                'field_groups' => array(
                    'group_61d28d3f0ba66'   
                ) ,
                $queryID => array(
                    'post_type' => 'monthly_reports',
                    'post_title' => $token,
                    'post_status' => 'publish',
                ) ,
                'updated_message' => __("", 'acf'),
                'submit_value'  => __('Submit', acf),
                'return' => "?success=$cpost",
            ));

                ?>
                
            <?php
                endwhile;
                wp_reset_postdata();

            }
        
            
        }
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


                <script>
                document.getElementById("acf-field_61de682e871a6").value = "<?php echo $name; ?>";
                document.getElementById("acf-field_61de680d871a5").value = "<?php echo $ca; ?>";
                document.getElementById("acf-field_61de67dc871a4").value = "<?php echo $cpost; ?>";

               </script>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
