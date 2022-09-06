<?php
/* Template Name: Settle Payment */
get_header();
acf_form_head();
?>
<?php include ("account-header.php"); ?>
<div class="container">

<div class="col-mid-15">
    <?php include ("account-sidebar.php"); ?>
</div>

<div class="col-mid-85"  id="main-content">
    <div class="standardCenter " style="height:100vh !important;">
        <div class="account-information">
            <div class="headerAccount"><i class="fas fa-certificate"></i> Settle Payment</div>
            <?php
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
                while (have_posts()): the_post();
                    $cpost = get_the_ID(); ?>
                    
                    <?php
                    if($_GET ['success']){
                        $args1 = array(
                            'posts_per_page' => -1,
                            'post_type' => array(
                                'cpt-transactions'
                            ),
                            'post_status' => array(
                                'publish'
                            )
                        );
                        
                        $variable1 = new WP_Query($args1);
                        if ($variable1->have_posts()): the_post(); ?>
                            <?php while( $variable1->have_posts() ): $variable1->the_post();
                                if($_GET['success'] == get_the_title()) {
                                    $queryID = get_the_id();
                                    acf_form(array(
                                        'post_id' => $queryID,
                                        'field_groups' => array(
                                            'group_61f0e0c8a86c3'   
                                        ) ,
                                        $queryID => array(
                                            'post_type' => 'cpt-transactions',
                                            'post_status' => 'publish',
                                        ) ,
                                        'updated_message' => __("", 'acf'),
                                        'submit_value'  => __('Save', acf)
                                    ));
                                    ?>
                                    <style>
                                        .acf-field-61f0e0d7e68ba .acf-input .acf-actions .acf-icon,
                                        .acf-form-submit {
                                            display: none;
                                        }
                                    </style>
                                    <script>
                                        document.getElementById("acf-field_6204ab8215630").disabled = true;
                                        document.getElementById("acf-field_6204ab681562f").disabled = true;
                                    </script>
                                <?php }
                            endwhile;
                        endif;
                        
                    } else {
                        function generateRandomString($length = 40) {
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            return $randomString;
                        }
                        $token = generateRandomString();
                        acf_form(array(
                            'post_id' => 'new_post',
                            'field_groups' => array(
                                'group_61f0e0c8a86c3', // Payment Receipt
                            ) ,
                            'new_post' => array(
                                'post_title' => $token,
                                'post_type' => 'cpt-transactions',
                                'post_status' => 'publish',
                
                            ) ,
                            'updated_message' => __("", 'acf') ,
                            'submit_value' => __('Submit', acf) ,
                            'return' => "?success=".$token,
                        ));
                        ?>
                    
                        <script>
                            document.getElementById("acf-field_6204a9fcb0688").value = "<?php echo get_field('ca-no'); ?>";
                            document.getElementById("acf-field_6204aa1ab068a").value = "<?php echo $cpost; ?>";
                            document.getElementById("acf-field_6204aa2eb068b").value = "<?php echo get_field('type_of_cea'); ?>";
                            document.getElementById("acf-field_6204aa38b068c").value = "<?php echo get_field('region'); ?>";
                            document.getElementById("acf-field_6204aa43b068d").value = "<?php echo get_field('delegates_id'); ?>";
                            document.getElementById("acf-field_6204aa8bb068e").value = "<?php if(get_field('application') == ""){ echo "1"; } else { echo get_field('application'); } ?>";
                        </script>
                
                    <?php } ?>
                <?php endwhile;
            endif; ?>
        </div>
    </div>
</div>

<div style="display:none" class="fancybox-hidden">
    <div id="termsAndConditions" style="line-height:1.3; font-size:13px; width:560px; max-width:100%;">
        <h5>Terms and Conditions</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
</div>
            
<div class="clear"></div>
<?php get_footer(); ?>
