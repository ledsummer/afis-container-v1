<?php
/* Template Name: Dashboard */
get_header();
acf_form_head();
?>

<?php include( get_template_directory() . '-child/my-account/account-restriction.php' ); ?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>

<div class="container">
    <div class="col-mid-15">
       <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
    </div>
    <div class="col-mid-85" >
        <div class="standardCenter-account">
            <div class="profile-name-view">
                <div class="profileBg"><h3>Welcome <?php  echo $current_user->user_firstname; ?> <?php  echo $current_user->user_lastname; ?> </h3></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>     
    
    <div class="col-mid-85" >
        <div class="standardCenter-account">
            <div class="account-information flex" style="background:#fff">
                <div class="col-mid-25">
                    <div class="margin-right">
                        <div class="pending">
                            <div class="padding-left">
                                <p class="dashboard-p-title">Approved Applications</p>
                                <?php
                                $args_appAccr = array(
                                    'posts_per_page'   => -1,
                                    'post_type' => array(
                                        'accreditations'
                                    ),
                                    'post_status' => array(
                                        'publish',
                                        'pending'
                                    ),
                                    'meta_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'key'   => 'status_ses',
                                            'value' => 'Approved',
                                            'compare' => '='
                                        ),
                                        array(
                                            'key'   => 'status_sed',
                                            'value' => 'Approved',
                                            'compare' => '='
                                        )
                                    )
                                );
                                $queryApproved = new WP_Query( $args_appAccr );
                                $totalApproved = $queryApproved->found_posts; ?>
                                <?php wp_reset_query(); ?>
                                
                                <h2><?php echo $totalApproved; ?></h2>
                                <!--<p class="p-percentage"><i class="far fa-arrow-alt-circle-up"></i> +56.21%</p>-->
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="col-mid-25">
                    <div class="margin-right">
                        <div class="pending"> 
                            <div class="padding-left">
                                <p class="dashboard-p-title">Pending Application (Regional Office)</p>
                                <?php
                                $args_penSAccr = array(
                                    'posts_per_page'   => -1,
                                    'post_type' => array(
                                        'accreditations'
                                    ),
                                    'post_status' => array(
                                        'publish',
                                        'pending'
                                    ),
                                    'meta_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'key'   => 'status_ses',
                                            'value' => 'Pending',
                                            'compare' => '='
                                        )
                                    )
                                );
                                $queryPendingS = new WP_Query( $args_penSAccr );
                                $totalPendingS = $queryPendingS->found_posts; ?>
                                <?php wp_reset_query(); ?>
                                
                                <h2><?php echo $totalPendingS; ?></h2>
                                <!--<p class="p-percentage p-down"><i class="far fa-arrow-alt-circle-down"></i> -26.21%</p>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mid-25">
                    <div class="margin-right">
                        <div class="pending">
                            <div class="padding-left">
                                <p class="dashboard-p-title">Pending Application (Head Office)</p>
                                <?php
                                $args_penDAccr = array(
                                    'posts_per_page'   => -1,
                                    'post_type' => array(
                                        'accreditations'
                                    ),
                                    'post_status' => array(
                                        'publish',
                                        'pending'
                                    ),
                                    'meta_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'key'   => 'status_ses',
                                            'value' => 'Approved',
                                            'compare' => '='
                                        ),
                                        array(
                                            'key'   => 'status_sed',
                                            'value' => 'Pending',
                                            'compare' => '='
                                        )
                                    )
                                );
                                $queryPendingD = new WP_Query( $args_penDAccr );
                                $totalPendingD = $queryPendingD->found_posts; ?>
                                <?php wp_reset_query(); ?>
                                
                                <h2><?php echo $totalPendingD; ?></h2>
                                <!--<p class="p-percentage"><i class="far fa-arrow-alt-circle-up"></i> +76.21%</p>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mid-25">
                    <div class="margin-right">
                        <div class="pending">
                            <div class="padding-left">
                                <p class="dashboard-p-title">Denied Application</p>
                                <?php
                                $args_denAccr = array(
                                    'posts_per_page'   => -1,
                                    'post_type' => array(
                                        'accreditations'
                                    ),
                                    'post_status' => array(
                                        'publish',
                                        'pending'
                                    ),
                                    'meta_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'key'   => 'status_ses',
                                            'value' => 'Approved',
                                            'compare' => '='
                                        ),
                                        array(
                                            'key'   => 'status_sed',
                                            'value' => 'Deferred',
                                            'compare' => '='
                                        )
                                    )
                                );
                                $queryDenied = new WP_Query( $args_denAccr );
                                $totalDenied = $queryDenied->found_posts; ?>
                                <?php wp_reset_query(); ?>
                                
                                <h2><?php echo $totalDenied; ?></h2>
                                <!--<p class="p-percentage"><i class="far fa-arrow-alt-circle-up"></i> +46.21%</p>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                
                <div class="col-full">
                    <div class="dashboard-chart">
                        <div class="padding-left">
                            <p class="dashboard-p-title">Pending Applications</p>
                            <div class="no-tab">
                            <?php include( get_template_directory() . '-child/officials/accreditation-requests/pending-requests.php' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                
                <style>
                    .col-full {
                        width: 100%;
                    }
                    .dashboard-p-title {
                        font-weight: bold;
                    }
                    .no-tab #customersPending_length,
                    .no-tab #customersPending {
                        margin-bottom: 25px;
                    }
                    .no-tab .dataTables_length label, .no-tab .dataTables_filter label {
                        background-color: unset!important;
                    }
                    .no-tab .dataTables_wrapper .dataTables_filter input,
                    .no-tab .dataTables_wrapper .dataTables_length select{
                        background-color: #fff;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
<?php get_footer(); ?>