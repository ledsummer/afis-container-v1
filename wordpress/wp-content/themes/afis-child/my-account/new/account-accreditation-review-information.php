<div class="stepper-wrapper  ">
    <div class="stepper-item completed active">
        <div class="step-counter">1</div>
        <div class="step-name">Review Information</div>
    </div>
    
    <div class="stepper-item ">
        <div class="step-counter">2</div>
        <div class="step-name" style="text-align: center;">Review Documentary Requirements</div>
    </div>
    
    <div class="stepper-item ">
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
$current_user = wp_get_current_user();
$email = $current_user->user_email;

$args1 = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'cea',
        'ctpro'
    ),
    'post_status' => array(
        'publish',
        'pending'
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
    <?php while( $variable1->have_posts() ): $variable1->the_post();
        $cpost = get_the_ID();
        $profile = get_field('profile_image');
        if (empty($profile)) {
            $profilepicture = "http://afis.beecr8tive.net/wp-content/uploads/2021/12/no-img.png";
        } else {
            $profilepicture = get_field('profile_image');
        }
        
        $payment = get_field('payment_status');
        if ($payment == "Pending" || empty($payment)) {
            echo "<div class='info-alert'><i class=\"fas fa-exclamation-circle\"></i> To approved your accreditation, please submit all required documents.</div>";
        } ?>
      
        <div class="account-information">
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Account Information</div>
            <?php if(get_post_type($cpost) == "cea"){ ?>
            <!--<div class="label-information">Application No:</div> <div class="data-information"><?php echo get_field('application_no'); ?></div>-->
            <!--<div class="clear"></div>-->
            
            <div class="label-information">CDA CEA No:</div> <div class="data-information"><?php echo get_field('cea-no'); ?></div>
            <div class="clear"></div>
            <?php } else { ?>
            <div class="label-information">CA No:</div> <div class="data-information"><?php echo get_field('ca-no'); ?></div>
            <div class="clear"></div>
            <?php } ?>
        
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Payment Status</div>
            <div class="label-information">Status:</div>
            <div class="data-information">
                <?php $payment = get_field('payment_status');
                if ($payment == "Pending" || empty($payment)) {
                    echo "<span style='color:red;'>Unpaid</span>";
                } else {
                    echo "<span style='color:green;'>Paid</span>";
                } ?>
            </div>
            
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Account Type</div>
            <div class="label-information">Application:</div><div class="data-information">New</div>
			<div class="clear"></div>
			
            <div class="label-information">Type:</div> <div class="data-information"><?php echo get_field('type_of_cea'); ?></div>
            <div class="clear"></div>
        
            <?php if(get_post_type($returnedID) == "cea"){ ?>
            <div class="label-information">PRC ID No.:</div> <div class="data-information"><?php echo  get_field('prc_id_no' ); ?></div>
            <div class="clear"></div>
            
            <div class="label-information">PRC BOA Accreditation No.:</div> <div class="data-information"><?php echo  get_field('prc_boa_accreditation_no_' ); ?></div>
            <div class="clear"></div>
            <?php } else { ?>
                <div class="label-information">Name of Organization:</div> <div class="data-information"><?php echo  get_field('organization' ); ?></div>
                <div class="clear"></div>
                
                <div class="label-information">Organization Email:</div> <div class="data-information"><?php echo  get_field('organization_email' ); ?></div>
                <div class="clear"></div>
            <?php } ?>
            
            <?php if(get_post_type($returnedID) == "cea"){ ?>
                <?php if(get_field('type_of_cea') == "Firm") { ?>
                    <div class="headerAccount"><i class="fas fa-file-alt"></i> Firm Information</div>
                    <div class="label-information">Firm Name:</div> <div class="data-information"><?php echo get_field('firm_name'); ?></div>
                    <div class="clear"></div>
                    
                    <?php if( have_rows('signing_partner') ): ?>
                        <div class="label-information">Signing Partner Name:</div>
                        <div class="data-information">
                            <ul style="margin:0; clear:both;">
                			    <?php while( have_rows('signing_partner') ): the_row(); ?>
                    			    <?php if(get_sub_field('partner_middle_name')){ ?>
                                        <li><?php echo get_sub_field('partner_first_name').' '.get_sub_field('partner_middle_name').' '.get_sub_field('partner_last_name'); ?></li>
                                    <?php } else { ?>
                                        <li><?php echo get_sub_field('partner_first_name').' '.get_sub_field('partner_last_name'); ?></li>
                                    <?php } ?>
                    			<?php endwhile; ?>
            			    </ul>
            			</div>
            			<div class="clear"></div>
                    <?php endif; ?>
                <?php } ?>
            <?php } ?>
        
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Application Information</div>
            <?php 
             if(get_field('type_of_cea') == "Firm"){} else { ?>
            <div class="label-information">First Name:</div> <div class="data-information"><?php echo get_field('first_name'); ?></div>
            <div class="clear"></div>
            
            <div class="label-information">Middle Name:</div> <div class="data-information"><?php echo get_field('middle_name'); ?></div>
            <div class="clear"></div>
            
            <div class="label-information">Last Name:</div> <div class="data-information"><?php echo get_field('last_name'); ?></div>
            <div class="clear"></div>
            <?php } ?>
            
            <?php if(get_post_type($returnedID) == "ctpro"){ ?>
                <div class="label-information">Designation:</div> <div class="data-information"><?php echo  get_field('designation' ); ?></div>
                <div class="clear"></div>
                
                <div class="label-information">Proof of Identity:</div> <div class="data-information"><a href="<?php echo  get_field('proof_of_identity' )['url']; ?>" target="_blank">Click here to view</a></div>
                <div class="clear"></div>
            <?php } ?>
            
            <?php if(get_field('address')) { ?>
            <div class="label-information">Home Address:</div> <div class="data-information"><?php echo  get_field('address'); ?>, <?php echo  get_field('zip_code'); ?></div>
            <div class="clear"></div>
            <?php } ?>
            
            <?php if(get_field('office_address')) { ?>
            <div class="label-information">Office Address:</div> <div class="data-information"><?php echo  get_field('office_address'); ?>, <?php echo  get_field('office_zip'); ?></div>
            <div class="clear"></div>
            <?php } ?>
            
            <div class="label-information">City/Municipality :</div> <div class="data-information"><?php echo get_field('city'); ?></div>
            <div class="clear"></div>
        
            <div class="label-information">Province:</div> <div class="data-information"><?php echo get_field('province'); ?></div>
            <div class="clear"></div>
            
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Contact Information</div>
            
            <div class="label-information">Email:</div> <div class="data-information"><?php echo get_field('email'); ?></div>
            <div class="clear"></div>  
            
            <div class="label-information">Telephone:</div> <div class="data-information"><?php echo get_field('telephone'); ?></div>
            <div class="clear"></div>  
            
            <div class="label-information">Mobile:</div> <div class="data-information"><?php echo get_field('cellphone'); ?></div>
            <div class="clear"></div>  
        
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Terms and Conditions</div>
            <div class="label-information" style="width:100%;">
                <p style="font-weight: bold;">Please accept the terms and conditions before proceeding to the next step. <span class="acf-required">*</span></p>
                <input type="checkbox" id="termsC" name="termsC">
                <label for="termsC"> I accept the <a href="#termsAndConditions-<?php echo $cpost; ?>" class="fancybox-inline" style="color:inherit;"><u>Terms and Conditions</u></a></label>
            </div>
            <div class="clear"></div>  
            
            <div style="display:none" class="fancybox-hidden">
                <div id="termsAndConditions-<?php echo $cpost; ?>" style="line-height:1.3; font-size:13px; width:560px; max-width:100%;">
                    <h5>Terms and Conditions</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            
            <style>
                .nextbtn a.disabled {
                    pointer-events: none;
                    cursor: default;
                }
                .nextbtn a button {
                    -webkit-transition: all 0.35s ease;
                    -moz-transition: all 0.35s ease;
                    -o-transition: all 0.35s ease;
                    transition: all 0.35s ease;
                }
                .nextbtn a.disabled button {
                    background: #535760;
                    -webkit-transition: all 0.35s ease;
                    -moz-transition: all 0.35s ease;
                    -o-transition: all 0.35s ease;
                    transition: all 0.35s ease;
                }
            </style>
            <div class="nextbtn"><a class="disabled" href="<?php echo site_url(); ?>/profile/accreditation/review-training-reports/"><button>Next</button></a></div>
            <script>
                $(document).ready(function(){
                    $('#termsC').click(function(){
                        if($(this).prop("checked") == true){
                            $( ".nextbtn a" ).removeClass( "disabled" );
                        }
                        else if($(this).prop("checked") == false){
                            $( ".nextbtn a" ).addClass( "disabled" );
                        }
                    });
                });
            </script>
            
        </div>
            
    <?php endwhile;
endif; ?>

        