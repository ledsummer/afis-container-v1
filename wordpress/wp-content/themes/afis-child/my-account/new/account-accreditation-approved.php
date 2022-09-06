<?php global $_thisUserId; ?>
<?php $_thisUserId = get_the_id(); ?>

<div class="stepper-wrapper  ">
    <div class="stepper-item completed ">
        <div class="step-counter">1</div>
        <div class="step-name">Review Information</div>
    </div>
    
    <div class="stepper-item completed">
        <div class="step-counter">2</div>
        <div class="step-name" style="text-align: center;">Review Documentary Requirements</div>
    </div>
    
    <div class="stepper-item completed">
        <div class="step-counter">3</div>
        <div class="step-name">Under Review Regional Office</div>
    </div>
    
    <div class="stepper-item completed ">
        <div class="step-counter">4</div>
        <div class="step-name">Under Review Head Office</div>
    </div>
    
    <div class="stepper-item completed active">
        <div class="step-counter">5</div>
        <div class="step-name">CDA Decision</div>
    </div>
</div>

<?php
global $postAccrID;
$args = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'accreditations'
    ),
    'post_status' => array(
        'publish'
    ),
    's' => $_GET['token']
);

$variable = new WP_Query($args);
if ($variable->have_posts()): the_post(); ?>
    <?php while( $variable->have_posts() ): $variable->the_post(); ?>
        <div class="account-information">
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Application Status</div>
            <b>Status:</b> 
            <?php
            if (get_field('status_sed') == "Deferred"){
            ?>
            <span style="color:red;"> <?php the_field('status_sed'); ?></span>
            
            <?php }else{ ?>
            
            <span style="color:blue;"> <?php the_field('status_sed'); ?></span>
            
            <?php } ?>
            <div class="headerAccount"><i class="fas fa-comments"></i> Remarks</div>
            
            <div class="remarks-info" >
                <?php the_field('remarks_sed'); ?>
            </div>
            
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Oathtaking</div>
            <b>Oathtaking: </b><span style="color:blue;"><?php echo get_field('oathtaking'); ?></span>
            <br>
            <?php if(get_field('oathtaking') == "Virtual") { ?>
            <b>URL: </b><a href="<?php echo get_field('oathtaking_url'); ?>" target="_blank"><span style="color:blue;"><?php echo get_field('oathtaking_url'); ?></span></a>
            <br>
            <?php } ?>
            <b>Schedule: </b><span style="color:blue;"><?php echo get_field('oathtaking_schedule'); ?></span>
            <br>
            <b>Pledge of Commitment: </b><a href="../../certifications/" target="_blank"><span style="color:blue;">Click here</span></a>
            
            <div class="headerAccount"><i class="fas fa-comments"></i> Certificate</div>
            <div class="cert-info">
                <?php $postAccrID= get_field('post_id'); ?>
                <?php if($_GET['success'] == "y"){ ?>
                    If file has not been downloaded, please click <a id="dlMe" href="<?php echo get_field('upload_certificate')['url']; ?>" download>here</a>.
                    <script>
                        // document.getElementById('dlMe').click();
                    </script>
                    <br>
                    
                    <?php 
                        $today = date("Y-m-d H:i:s");
                        $date = get_field('end_of_accreditation_validity');
                        
                        if(new DateTime() > new DateTime($date)) {
                            update_post_meta( $postAccrID, 'token', 'change-to-renewal' );
                            update_field( 'field_61f3b4aec27ae', 'change-to-renewal', $postAccrID );
                            
                            update_field( 'field_61d14b0a9e40e', '2', $postAccrID );
                            // update_field( 'field_61f34414586d9', '2', $_thisUserId );
                        } else {
                            // Do nothing
                        }
                    ?>
                    
                    <?php
                        // $approval_date = get_field('date_of_approval', get_the_id());
                        // $converted_approvalDate = date("Y-m-d", strtotime($approval_date));
                        
                        // $date1 = new DateTime($converted_approvalDate);
                        // $date2 = new DateTime();
                        
                        // $interval = $date1->diff($date2);
                        
                        // if($interval->y < 3){
                        //     // Do nothing
                        // } else {
                        //     update_post_meta( $postAccrID, 'token', 'change-to-renewal' );
                        //     update_field( 'field_61f3b4aec27ae', 'change-to-renewal', $postAccrID );
                            
                        //     update_field( 'field_61d14b0a9e40e', '2', $postAccrID );
                        //     update_field( 'field_61f34414586d9', '2', $_thisUserId );
                        // }
                    ?>
                <?php } else { ?>
                    <?php
                        if(get_field('upload_certificate')){
                        acf_form(array(
                            'post_id' => get_the_id(),
                            'field_groups' => array(
                                'group_61f366626a388'   
                            ) ,
                            $queryID => array(
                                'post_type' => 'accreditation',
                                'post_status' => 'publish',
                            ) ,
                            'updated_message' => __("", 'acf'),
                            'submit_value'  => __('Download Certificate', acf),
                            'return' => "?token=".$token."&success=y",
                        ));
                        } else { ?>
                            <div class="remarks-info">
                                Certificate is unavailable, please come back later.
                            </div>
                        <?php }
                    ?>
                    <style>
                        .cert-info .acf-label {
                            display: none;
                        }
                        .cert-info .acf-input p,
                        .cert-info .acf-input label span {
                            font-weight: 800;
                            color: #192556;
                            font-family: 'Roboto';
                            font-size: 14px;
                        }
                        .cert-info .acf-form-submit {
                            float: inherit;
                            margin-top: 20px;
                        }
                        
                        .acf-form-submit input.disabled {
                            pointer-events: none;
                            cursor: default;
                            background: #535760!important;
                            -webkit-transition: all 0.35s ease;
                            -moz-transition: all 0.35s ease;
                            -o-transition: all 0.35s ease;
                            transition: all 0.35s ease;
                        }
                        .acf-form-submit input {
                            -webkit-transition: all 0.35s ease;
                            -moz-transition: all 0.35s ease;
                            -o-transition: all 0.35s ease;
                            transition: all 0.35s ease;
                        }
                    </style>
                    <script>
                        $(document).ready(function(){
                            $( ".acf-form-submit input" ).addClass( "disabled" );
                            $(document).ready(function(){
                                $('#acf-field_61f3666f2121e').click(function(){
                                    if($(this).prop("checked") == true){
                                        $( ".acf-form-submit input" ).removeClass( "disabled" );
                                    }
                                    else if($(this).prop("checked") == false){
                                        $( ".acf-form-submit input" ).addClass( "disabled" );
                                    }
                                });
                            });
                        });
                    </script>
                <?php } ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>

<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;
$_returnedID; $_returnedApplication; $returnedToken;
$args = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'cea',
        'ctpro'
    ),
    'post_status' => array(
        'publish'
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

$variable = new WP_Query($args);
if ($variable->have_posts()): the_post(); ?>
    <?php while( $variable->have_posts() ): $variable->the_post(); ?>
        <?php $_returnedID = get_the_id(); ?>
        <?php $_returnedApplication = get_field('application', $_returnedID); ?>
        <?php $returnedToken = get_field('token'); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>


<?php
$acc_id;
$args_accr = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'accreditations'
    ),
    'post_status' => array(
        'publish'
    ),
    's' => $returnedToken
);

$variable_accr = new WP_Query($args_accr);
if ($variable_accr->have_posts()): the_post(); ?>
    <?php while( $variable_accr->have_posts() ): $variable_accr->the_post(); ?>
        <?php $acc_id = get_the_id(); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>


<?php 
$status_ses = get_field('status_ses', $acc_id);
$status_sed = get_field('status_sed', $acc_id);
$status_dlC = get_field('download_certificate', $acc_id);
$new_url;

if($status_ses == "Pending" || $status_ses == "Deferred"){
    $new_url = site_url().'/review-ses-division/?token='.$returnedToken
    ?>
    <script>
        $(document).ready(function(){
            window.location.href = "<?php echo $new_url; ?>";   
            
            console.log("<?php echo $new_url; ?>");
            console.log("<?php echo $returnedToken; ?>");
            console.log("<?php echo $status_ses.' '.$status_sed; ?>");
        });
    </script>
<?php } else if($status_ses == "Approved" && $status_sed == "Pending") {
    $new_url = site_url().'/review-sed-division/?token='.$returnedToken
    ?>
    <script>
        $(document).ready(function(){
            window.location.href = "<?php echo $new_url; ?>";
            
            console.log("<?php echo $new_url; ?>");
            console.log("<?php echo $returnedToken; ?>");
            console.log("<?php echo $status_ses.' '.$status_sed; ?>");
        });
    </script>
<?php } else if($status_ses == "Approved" && $status_sed == "Approved" && $status_dlC == "") {
    if($_GET['success']) {
    $new_url = site_url().'/approved-accreditation/?token='.$returnedToken
    ?>
    <script>
        $(document).ready(function(){
            window.location.href = "<?php echo $new_url; ?>"; 
            
            console.log("<?php echo $new_url; ?>");
            console.log("<?php echo $returnedToken; ?>");
            console.log("<?php echo $status_ses.' '.$status_sed; ?>");
        });
    </script>
    <?php } else {} ?>
<?php } else if($status_ses == "Approved" && $status_sed == "Approved" && $status_dlC == "1") {
    if($_GET['success']) {
    } else {
    $new_url = site_url().'/approved-accreditation/?token='.$returnedToken."&success=y";
    ?> 
    <script>
        $(document).ready(function(){
            window.location.href = "<?php echo $new_url; ?>";
            
            console.log("<?php echo $new_url; ?>");
            console.log("<?php echo $returnedToken; ?>");
            console.log("<?php echo $status_ses.' '.$status_sed; ?>");
        });
    </script>
    <?php } ?>
<?php } ?>
