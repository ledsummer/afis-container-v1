<?php 
  /* Template Name: NEW CEA ACCOUNT REGISTRATION */ 
  get_header(); 
  acf_form_head();
  ?>

<div  class="site-main">
    <div class="container">
        <?php
        if(isset($_GET['token']) && ($_GET['edit'] == '')){
            $token=$_GET['token']; ?>
            <div class="standardCenter-registration review">
                <center><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/06/CDA-new-logo-1.png" style="width: 100px;"></center>
                <div class="cea-registration">
                    <h1><?php the_title(); ?></h1>
                    <center>Fill all form field to go to next step</center>
                    <br><br><br>
                    <div>
                        <div class="stepper-wrapper  ">
                            <div class="stepper-item completed ">
                                <div class="step-counter">1</div>
                                <div class="step-name">Registration</div>
                            </div>
                            <div class="stepper-item completed active ">
                                <div class="step-counter">2</div>
                                <div class="step-name">Review Submission</div>
                            </div>
                            <div class="stepper-item ">
                                <div class="step-counter">3</div>
                                <div class="step-name">Pending for Review</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">4</div>
                                <div class="step-name">Account Confirmation</div>
                            </div>
                        </div>
                    </div>
                    <br>
   
        
        
        
        
                    <?php
                    function generateRandomString($length = 40) {
                        $characters = 'abcdedfghijklmnopqrstuvwxyz1234567';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0;$i < $length;$i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1) ];
                        }
                        return $randomString;
                    }
                  
                    $total = $amount;
                    $orgin_order_id = rand(40, 100);
                    $confirmationkey = generateRandomString();
                     
             
                    $posts = get_posts(array(
            	        'numberposts'	=> 1,
            	        'post_type'		=> 'cea',
            	        'post_status'   => 'pending',
                    	'meta_query'	=> array(
            		'relation'		=> 'AND',
            		array(
            			'key'	  	=> 'registration_key',
            			'value'	  	=> $token,
            			'compare' 	=> '=',
            		))));
            		
                    if ( have_posts() ) : 
                        while ( have_posts() ) : the_post();
                            $cpost=get_the_ID();
                            acf_form(array(
                                'post_id'		=> $cpost,
                                    'field_groups'  => array(
                                    'group_61c96c5027748', // CEA Account Registration
                    				'group_621456bf521c0', // Regions
                                    'group_61ca5de56cf9d', // Approval Status
                    				'group_61d14aec68533', // Application
                                    'group_61d54cf112e64' // Email Status
                                ),
                                $cpost		=> array(
                                    'post_title'    =>  $token,
                                    'post_type' 	=> 'cea',
                                    'post_status'	=> 'publish',
                                ),
                                'updated_message' => __("", 'acf'),
                                'submit_value'  => __('Submit', acf),
                                'return' => "?success=$confirmationkey",
                            ));
                        endwhile;
                    endif; ?>
                    <script>
                    $(document).on("click", "#btnSubmit", function(){
                        $(".acf-form-submit input.acf-button").trigger("click");
                    });
                    </script>
                    <div class="action-buttons">
                        <a id="btnBack" class="action-btn btn-back" href="<?php echo home_url(); ?>/new-cea-account-registration/?edit=<?php echo get_the_id(); ?>&token=<?php echo $token; ?>">Back</a>
                        <a id="btnSubmit" class="action-btn btn-submit">Submit</a>
                    </div>
                    <script> document.getElementById("acf-field_61c98d06bef7c").value = "<?php echo $confirmationkey; ?>"; </script>
                </div>
            </div>
            <div class="clear"></div>
            
            <style>
                .acf-form-submit {
                    display: none;
                }
                
                .action-buttons {
                    margin-top: 35px;
                    padding: 5px 8px !important;
                    text-align: right;
                }
                
                .action-buttons .action-btn {
                    background: none rgb(37, 87, 167);
                    border: none;
                    border-bottom: 0px solid #4054b2 !important;
                    padding: 10px 29px 10px 29px;
                    text-transform: UPPERCASE;
                    font-family: 'Open Sans';
                    font-size: 1rem;
                    font-weight: 700;
                    border-radius: 3px;
                    color: #fff;
                    cursor: pointer;
                }
                
                .action-buttons .action-btn:hover,
                .action-buttons .action-btn:active,
                .action-buttons .action-btn:focus {
                    background: none rgb(49 69 101)!important;
                    border: none;
                    border-bottom: 0px solid #a9b6ee !important;
                    transition: 0.4s;
                    width: auto;
                    padding: 10px 29px 10px 29px !important;
                    /* font-size: 1rem !important; */
                    font-weight: 700;
                }
            </style>
            
        <?php } elseif($_GET['edit']) { ?>
            <?php $tokenID = $_GET['token']; ?>
            <?php $acctID = $_GET['edit']; ?>
            
            <div class="standardCenter-registration">
                <center><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/06/CDA-new-logo-1.png" style="width: 100px;"></center>
                <div class="cea-registration">
                    <h1><?php the_title(); ?></h1>
                    <center>Fill all form field to go to next step</center>
                    <br><br><br>
                    <div>
                        <div class="stepper-wrapper  ">
                            <div class="stepper-item completed active ">
                                <div class="step-counter">1</div>
                                <div class="step-name">Registration</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">2</div>
                                <div class="step-name">Review Submission</div>
                            </div>
                            <div class="stepper-item ">
                                <div class="step-counter">3</div>
                                <div class="step-name">Pending for Review</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">4</div>
                                <div class="step-name">Account Confirmation</div>
                            </div>
                        </div>
                    </div>
                    <br>
                    
                    <?php
                    $posts = get_posts(array(
            	        'numberposts'	=> 1,
            	        'post_type'		=> 'cea',
            	        'post_status'   => 'pending',
                    	'meta_query'	=> array(
                    		'relation'		=> 'AND',
                    		array(
                    			'key'	  	=> 'registration_key',
                    			'value'	  	=> $token,
                    			'compare' 	=> '=',
                    		)
                    	)
            		));
                    if ( have_posts() ) : 
                        while ( have_posts() ) : the_post();
                            $cpost=get_the_ID();
                            
                            acf_form(array(
                                'post_id' => $acctID,
                                'field_groups' => array(
                                    'group_61c96c5027748', // CEA Account Registration
                                    'group_61ca5de56cf9d', // Approval Status
                    				'group_621456bf521c0', // Regions
                    				'group_61d14aec68533', // Application
                                    'group_61d54cf112e64' // Email Status
                                ) ,
                                $acctID => array(
                                    'post_type' => 'cea',
                                    'post_status' => 'publish',
                                ) ,
                                'updated_message' => __("", 'acf'),
                                'submit_value'  => __('Save', acf),
                                'return' => "?token=".$tokenID,
                            ));
                            
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
            <div class="clear"></div>
            
        <?php } elseif($_GET['success']) { ?>
      
            <div class="standardCenter-registration review">
                <center><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/06/CDA-new-logo-1.png" style="width: 100px;"></center>
                <div class="cea-registration">
                    <h1><?php the_title(); ?></h1>
                    <br><br><br>
                    <div>
                        <div class="stepper-wrapper  ">
                            <div class="stepper-item completed ">
                                <div class="step-counter">1</div>
                                <div class="step-name">Registration</div>
                            </div>
                            <div class="stepper-item completed">
                                <div class="step-counter">2</div>
                                <div class="step-name">Review Submission</div>
                            </div>
                            <div class="stepper-item completed active ">
                                <div class="step-counter">3</div>
                                <div class="step-name">Pending for Review</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">4</div>
                                <div class="step-name">Account Confirmation</div>
                            </div>
                        </div>
                    </div>
                    <br>
                    
                    <center><i class="fas fa-check-circle" style="color:green; font-size:42px;"></i> <br> You have successfully submitted your application;
                    <br>Your account is now subject for approval. Kindly wait for our next email.<br>You will be redirecting to homepage for 2 minutes..</center>
      
                    <script>
                        setTimeout(function () {
                            window.location.href = "../"; //will redirect to your blog page (an ex: blog.html)
                        }, 12000); //will call the function after 2 secs.
                    </script>
                    
                    <?php $h= $_GET['success'];   
          
                    $posts = get_posts(array(
            	        'numberposts'	=> 1,
            	        'post_type'		=> 'cea',
            	        'post_status'   => 'pending',
                    	'meta_query'	=> array(
            		'relation'		=> 'AND',
            		array(
            			'key'	  	=> 'confirmation_key',
            			'value'	  	=> $h,
            			'compare' 	=> '=',
            		))));
            		
                    if ( have_posts() ) : 
                        while ( have_posts() ) : the_post();
                            $account_username = get_field('email');
                            //echo $account_username;
                            $account_password = get_field('last_name');
                            $email_address = get_field('email');
                            $company_name = get_field('first_name');
                            
                            echo "<script>console.log('$email_address')</script>";
        
                            $user_id = wp_insert_user(array(
                                'user_login' => $account_username,
                                'user_pass' => 'default1',
                                'user_email' => $email_address,
                                'first_name' => $company_name,
                                'last_name' => '',
                                'display_name' => '',
                                'role' => 'subscriber'
                            ));
                        endwhile;
                    endif;
                    wp_reset_query(); ?>
                </div>
            </div>
            <div class="clear"></div>
            
        <?php } else { ?>
            <div class="standardCenter-registration">
                <center><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/06/CDA-new-logo-1.png" style="width: 100px;"></center>
                <div class="cea-registration">
                    <h1><?php the_title(); ?></h1>
                    <center>Fill all form field to go to next step</center>
                    <br><br><br>
                    <div>
                        <div class="stepper-wrapper  ">
                            <div class="stepper-item completed active ">
                                <div class="step-counter">1</div>
                                <div class="step-name">Registration</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">2</div>
                                <div class="step-name">Review Submission</div>
                            </div>
                            <div class="stepper-item ">
                                <div class="step-counter">3</div>
                                <div class="step-name">Pending for Review</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">4</div>
                                <div class="step-name">Account Confirmation</div>
                            </div>
                        </div>
                    </div>
                    <br>
          

   <!--<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>-->
    <script>
    $(document).ready(function(){
   document.getElementById("registrationform").style.display = "none";
    $("#validate").on("submit", function(event){
        event.preventDefault();
        var formValues= $(this).serialize();
        var actionUrl = $(this).attr("action");
 
        $.post(actionUrl, formValues, function(data){
            // Display the returned data in browser
            $("#result").html(data);
        });
    });
    });
    </script>

<form action="../process-cea.php" id="validate" style="padding:0 10px; ">
<div class="validationBox">
<div class="validation-title">If you have existing data as CEA, please enter your CEA registered name (individual or firm) (Case sensitive):</div>
        <div id="name-group" class="form-group">
         <p>
          
          <input type="text" class="form-control input-text"  name="CoopName" placeholder="" style="width:100%;"/>
          </p>
           <input type="submit" class="submit-btn" value="Verify Details" style="width:100%; font-size:13px;"><div class="clear"></div>
</div>
</div>
</form>


 <div id="result" style="margin-top: 2em;"></div>
          

          <div id="registrationform">
                    <?php
                    function generateRandomString($length = 40) {
                       $characters = 'abcdedfghijklmnopqrstuvwxyz1234567';
                       $charactersLength = strlen($characters);
                       $randomString = '';
                       for ($i = 0;$i < $length;$i++) {
                           $randomString .= $characters[rand(0, $charactersLength - 1) ];
                       }
                       return $randomString;
                    }
                    $txnid = generateRandomString();
                   
                   
                    function generateca($length) {
                        $characters = '123456789';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0;$i < $length;$i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1) ];
                        }
                        return $randomString;
                    }
                  
                    $ca = generateca(10);
                    $cea = generateca(4);
                     
                    date_default_timezone_set("Asia/Bangkok");
                    $datetoday=date("l jS \of F Y h:i:s A") ;
                    //$titlefoo="New Message Recieved as of $datetoday";
                
                     acf_form(array(
                        'post_id'		=> 'new_post',
                        'field_groups'  => array(
                            'group_61c96c5027748', // CEA Account Registration
            				'group_621456bf521c0', // Regions
            				'group_61d14aec68533', // Application
                            'group_61c97e5a500a0', // Proof you are not a robot
                            'group_61d54cf112e64' // Email Status
                        ),
                        'new_post'		=> array(
                            'post_title'    =>  $txnid,
                            'post_type' 	=> 'cea',
                            'post_status'	=> 'pending',
                        ),
                        'updated_message' => __("", 'acf'),
                        'submit_value'  => __('Next', acf),
                        'return' => "?token=$txnid",
                    )); ?>
                    <script>
                        document.getElementById("acf-field_62faf900cf610").value = "iJ#fS7nZE7U9th!";
                        document.getElementById("acf-field_61c98cfabef7b").value = "<?php echo $txnid; ?>";
                        document.getElementById("acf-field_61cd2b49ab000").value = "CA-<?php echo $ca; ?>";
                        // document.getElementById("acf-field_620f57f9364ad").value = "<?php echo $cea; ?>";
                    </script>
                    <script>
                        // jQuery( document ).ready( function( $ ) {
                        //     $('#acf-field_61c96c606b2b0').on('change', function() {
                        //         if(this.value == 'Firm'){
                        //             document.getElementById("acf-field_620f57f9364ad").value = "<?php echo $cea; ?>-AF";
                        //         } else {
                        //             document.getElementById("acf-field_620f57f9364ad").value = "<?php echo $cea; ?>";
                        //         }
                        //     });
                        // });
                    </script>
                </div>
            </div>
            </div>
            <div class="clear"></div>
                
        <?php } ?>
                
    <!-- #content -->
    </div>
</div>
<style>
    .headerTop{
        display:none !important;
    }
    .acf-form-submit {
        text-align: right;
    }
    .btn-download button, input[type="submit"], input[type="button"], input[type="reset"]{
        width: auto;
    }
    .site-main {
        position: relative;
        margin-bottom: 20px;
        margin-top: 36px;
    }
</style>
 
<?php get_footer(); ?>