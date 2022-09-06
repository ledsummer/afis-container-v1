<div class="stepper-wrapper  ">
    <div class="stepper-item completed ">
        <div class="step-counter">1</div>
        <div class="step-name">Review Information</div>
    </div>
    
    <div class="stepper-item completed ">
        <div class="step-counter">2</div>
        <div class="step-name" style="text-align: center;">Review of Training Certificates <br>and Documentary Requirements</div>
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
        <?php $postAccrID= get_field('post_id'); ?>
        <div class="account-information">
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Application Status</div>
            <b>Status:</b>
            <?php if (get_field('status_sed') == "Deferred"){ ?>
                <span style="color:red;"> <?php the_field('status_sed'); ?></span>
            <?php }else{ ?>
                <span style="color:blue;"> <?php the_field('status_sed'); ?></span>
            <?php } ?>
            
            <div class="headerAccount"><i class="fas fa-comments"></i> Summary of Accreditation</div>
            <div class="remarks-info" >
                <?php the_field('remarks_sed'); ?>
            </div>
        </div>
        <div class="clear"></div>
        <?php
            $reapply_date = get_field('date_reapply');
            $converted_reapply_date = date("Y-m-d", strtotime($reapply_date));
            $current = strtotime(date("Y-m-d"));
            $date    = strtotime($converted_reapply_date);
            
            $datediff = $date - $current;
            $difference = floor($datediff/(60*60*24));
            
            if($difference==0) {
                update_field( 'field_623d43e5b727d', '', $postAccrID ); // Application No
                update_field( 'field_61f3b4aec27ae', 'change-to-renewal', $postAccrID ); // Token
            }
        ?>
        
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
          