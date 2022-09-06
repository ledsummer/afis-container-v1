<?php
/* Template Name: Cooperative Cliens Submission */
get_header();
acf_form_head();
?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>
<div class="container">

<div class="col-mid-15">
  <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
 </div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter" style="height:100vh !important;">
        <div class="">
            <div class="account-information">
                <div class="headerAccount"><i class="fas fa-file-alt"></i> Submit Cooperative Clients</div>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="info-success">
                        You have successfully submitted the list
                    </div>
                    
                <?php } else if(isset($_GET['edit'])) { ?>
                    <div class='info-alert'><i class="fas fa-exclamation-circle"></i> Please fill out all the required fields.</div>
                    <?php
                    $dpost = $_GET['edit'];
                    acf_form(array(
                        'post_id' => $dpost,
                        'field_groups' => array(
                            'group_624572355afaa'
                        ) ,
                        $dpost => array(
                            'post_type' => 'cpt-coop-clients',
                            'post_status' => 'publish',
                        ) ,
                        'updated_message' => __("", 'acf'),
                        'submit_value'  => __('Save', acf),
                        'return' => "?success=".$dpost,
                    ));
                    ?>
                <?php } else { ?>
                    <div class='info-alert'><i class="fas fa-exclamation-circle"></i> Please fill out all the required fields.</div>
                    <?php
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
                            $cpost = get_the_ID(); ?>
                            
                            <?php $token = get_field('confirmation_key');
                            $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');
                            $ca =   get_field('ca-no');
                            $date = date('M-d-Y');
                            acf_form(array(
                                'post_id' => 'new_post',
                                'field_groups' => array(
                                    'group_624572355afaa'
                                ) ,
                                'new_post' => array(
                                    'post_type' => 'cpt-coop-clients',
                                    'post_title' => $token,
                                    'post_status' => 'publish',
                                ) ,
                                'updated_message' => __("", 'acf'),
                                'submit_value'  => __('Submit', acf),
                                'return' => "?success=$token",
                            ));
                        endwhile;
                    endif;
                } ?>
    
                <script>
                document.getElementById("acf-field_624574ea0d52c").value = "<?php echo $name; ?>";
                document.getElementById("acf-field_624574df0d52b").value = "<?php echo $cpost; ?>";
                
               </script>
            </div>
        </div>
        
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
