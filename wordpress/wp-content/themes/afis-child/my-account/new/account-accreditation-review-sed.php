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
    
    <div class="stepper-item completed active">
        <div class="step-counter">4</div>
        <div class="step-name">Under Review Head Office</div>
    </div>
    
    <div class="stepper-item ">
        <div class="step-counter">5</div>
        <div class="step-name">CDA Decision</div>
    </div>
</div>

<?php
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
            <?php if (get_field('status_sed') == "Deferred"){ ?>
                <span style="color:red;"> <?php the_field('status_sed'); ?></span>
            <?php } else if(get_field('status_sed') == "Pending") { ?>
                <span style="color:blue;"> Under Appeal</span>
            <?php }else{ ?>
                <span style="color:blue;"> <?php the_field('status_sed'); ?></span>
            <?php } ?>
            
            <div class="headerAccount"><i class="fas fa-comments"></i> Summary of Accreditation</div>
            <div class="remarks-info" >
                <?php the_field('remarks_sed'); ?>
            </div>
        </div>
        
        <?php if(get_field('remarks_sed') == ''){ ?>
        <style>
            .account-information-remarks {
                display: none;
            }
        </style>
        <?php } ?>
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
<?php } else if($status_ses == "Approved" && $status_sed == "Approved" && $status_dlC == "") {
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
<?php } else if($status_ses == "Approved" && $status_sed == "Approved" && $status_dlC == "1") {
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
