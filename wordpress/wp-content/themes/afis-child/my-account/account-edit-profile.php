<?php
/* Template Name: Edit Profile */
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
                <div class="headerAccount"><i class="fas fa-pencil-alt"></i> Edit Information</div>
                <?php
                $current_user = wp_get_current_user();
                $email = $current_user->user_email;
                $user_roles = $current_user->roles;
                
                if(($user_roles[0] == "ctpro") || ($user_roles[0] == "cea")){
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
                            $cpost = get_the_ID();
                            
                            if($myrole=="cea"){
                                acf_form(array(
                                    'post_id' => $cpost,
                                    'field_groups' => array(
                                        'group_61cbcf2877fe0', // Profile Photo
                                        'group_61c96c5027748', // CEA Registration
                    					// 'group_621456bf521c0', // Regions
                    					'group_61d66694f1e9f', // Edit Password
                                    ) ,
                                    $cpost => array(
                                        'post_type' => 'ctpro',
                                        'post_status' => 'publish',
                                    ) ,
                                    'updated_message' => __("", 'acf'),
                                    'submit_value'  => __('Save', acf),
                                    'return' => "?success=".$cpost,
                                )); ?>
                                <style>
                                    .acf-field-61d666a13b71d,
                                    .acf-field-61d666c53b720 {
                                        display: none;
                                    }
                                </style>
                                <script>
                                    document.getElementById("acf-field_62b9731425183").value = "1";
                                    document.getElementById("acf-field_62b9731425183").checked = true;
                                </script>
                            <?php } elseif($myrole=="ctpro") {
                                acf_form(array(
                                    'post_id' => $cpost,
                                    'field_groups' => array(
                                        'group_61cbcf2877fe0', // Profile Photo
                                        'group_61cd2c4eaaec3', // CTPRO Registration
                    					'group_621456bf521c0', // Regions
                    					'group_61d66694f1e9f', // Edit Password
                                    ) ,
                                    $cpost => array(
                                        'post_type' => 'ctpro',
                                        'post_status' => 'publish',
                                    ) ,
                                    'updated_message' => __("", 'acf'),
                                    'submit_value'  => __('Save', acf),
                                    'return' => "?success=".$cpost,
                                )); ?>
                                
                                <style>
                                    .acf-field-61cd2c4eefa29 .acf-input select, 
                                    .acf-field-61cd2c4eeffb0 .acf-input input,
                                    .acf-field-61d7e5939ddeb .acf-input select {
                                        pointer-events: none;
                                        background: #fdfdfd;
                                        border: unset;
                                    }
                                </style>
                            <?php }
                        endwhile;
                    endif; ?>
                    <style>
                        .acf-field-61c96c606b2b0 {
                            display: none;
                        }
                    </style>
                    <script>
                        document.getElementById("acf-field_61c96d486b2b9").disabled = true;
                        document.getElementById("acf-field_61cd2c4eeffb0").disabled = true;
                    </script>
                <?php } else {
                    $posts = get_posts(array(
                        'numberposts' => 1,
                        'post_type' => array(
                            'regional_officers',
                        ) ,
                        'post_status' => array(
                            'publish'
                        ) ,
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => 'email_address',
                                'value' => $email,
                                'compare' => '=',
                            )
                        )
                    ));
                    if (have_posts()):
                        while (have_posts()): the_post();
                            $cpost = get_the_ID();
                            
                            acf_form(array(
                                'post_id' => $cpost,
                                'field_groups' => array(
                                    'group_61cbcf2877fe0', // Profile Photo
                                    'group_61d6ca91ba062', // CDA AFIS
                                ) ,
                                $cpost => array(
                                    'post_type' => 'regional_officers',
                                    'post_status' => 'publish',
                                ) ,
                                'updated_message' => __("", 'acf'),
                                'submit_value'  => __('Save', acf),
                                'return' => "?success=".$cpost,
                            ));
                        endwhile;
                    endif; ?>
                    <style>
                        .acf-field-620f5dd291a2a, .acf-field-61d9933dcae48 {
                            display: none;
                        }
                    </style>
                    <script>
                        document.getElementById("acf-field_61d6cab101c1d").disabled = true;
                    </script>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>


<?php get_footer(); ?>
