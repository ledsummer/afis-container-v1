<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;

update_field( 'field_6243ccf53ac3d', '0', get_field('documents_id', get_the_id()));

$args1 = array(
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

$variable1 = new WP_Query($args1);
if ($variable1->have_posts()): the_post(); ?>
    <?php while( $variable1->have_posts() ): $variable1->the_post(); ?>
        <?php $returnedID = get_the_id(); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>

<?php update_field('token', $_GET['token'], $returnedID); ?>
<div class="stepper-wrapper  ">
    <div class="stepper-item completed ">
        <div class="step-counter">1</div>
        <div class="step-name">Review Information</div>
    </div>
    
    <div class="stepper-item completed ">
        <div class="step-counter">2</div>
        <div class="step-name" style="text-align: center;">Review of Training Certificates <br>and Documentary Requirements</div>
    </div>
    
    <div class="stepper-item completed active">
        <div class="step-counter">3</div>
        <div class="step-name">Under Review Regional Office</div>
    </div>
    
    <div class="stepper-item ">
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
    
        <?php
        $sequence_no = get_field(get_post_type($returnedID).'_accreditation_sequence_no', 'options');
        $sequence_no = $sequence_no + 1;
        if(get_field('sequence_checker', get_the_id()) == "1"){
            update_field(get_post_type($returnedID).'_accreditation_sequence_no', $sequence_no, 'options');
            update_field('sequence_checker', '0', get_the_id());
        }
        update_field('application_no', get_field('application_no', get_the_id()), $returnedID);
        ?>
        
        <div class="account-information">
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Application Status</div>
            <b>Status:</b>
            <?php if (get_field('status_ses') == "Deferred"){ ?>
                <span style="color:red;"> <?php the_field('status_ses'); ?></span>
            <?php }else{ ?>
                <span style="color:blue;"> <?php the_field('status_ses'); ?></span>
            <?php } ?>
            
            <div class="headerAccount"><i class="fas fa-comments"></i> Summary of Accreditation</div>
            <div class="remarks-info" >
                <?php the_field('remarks_ses'); ?>
            </div>
        </div>
        
        <?php if(get_field('remarks_ses') == ''){ ?>
        <style>
            .account-information-remarks {
                display: none;
            }
        </style>
        <?php } ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
          