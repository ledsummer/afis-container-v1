<?php global $_thisUserId; ?>
<?php $_thisUserId = get_the_id(); ?>

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
    
    <div class="stepper-item completed">
        <div class="step-counter">4</div>
        <div class="step-name">Under Review Head Office</div>
    </div>
    
    <div class="stepper-item completed active">
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
            <?php if(get_field('for_suspended') == "y") { ?>
                <span style="color:red;"> Suspended</span>
            <?php } else { ?>
                <?php if (get_field('status_sed') == "Deferred"){ ?>
                <span style="color:red;"> <?php the_field('status_sed'); ?></span>
                
                <?php }else{ ?>
                
                <span style="color:blue;"> <?php the_field('status_sed'); ?></span>
                
                <?php } ?>
            <?php } ?>
            
            <?php if(get_field('for_suspended') == "y") { ?>
            
            <?php } else { ?>
                <div class="headerAccount"><i class="fas fa-comments"></i> Remarks</div>
                
                <div class="remarks-info" >
                    <?php the_field('remarks_sed'); ?>
                </div>
            
            
            
            
            <div class="headerAccount"><i class="fas fa-comments"></i> Certificate</div>
            <div class="cert-info">
                <?php $postAccrID= get_field('post_id'); ?>
                <?php if($_GET['success'] == "y"){ ?>
                    If file has not been downloaded, please click <a id="dlMe" href="<?php echo get_field('upload_certificate')['url']; ?>" download>here</a>.
                    <script>
                        document.getElementById('dlMe').click();
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
            
            <?php } ?>
        </div>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
          