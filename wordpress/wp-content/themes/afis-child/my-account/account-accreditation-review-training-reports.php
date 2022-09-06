<?php
/* Template Name: Accreditation - Training Report Submission */
get_header();
acf_form_head();
$current_user = wp_get_current_user();
$email = $current_user->user_email;
?>
<?php include ("account-header.php"); ?>
<?php include ("account-accreditation.php"); ?>

<?php
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

$thisReturnedID;
$variable1 = new WP_Query($args1);
if ($variable1->have_posts()): the_post(); ?>
    <?php while( $variable1->have_posts() ): $variable1->the_post(); ?>
        <?php $thisReturnedID = get_the_id(); ?>
    <?php endwhile;
endif; ?>
<div class="container">

<div class="col-mid-15">
        <?php include ("account-sidebar.php"); ?>
 </div>

        
<div class="col-mid-85 "  id="main-content">
    <div class="standardCenter ">
   
          <center><h3>Apply for Accreditation</h3></center>
      <br><br><br>
      <div>
        <div class="stepper-wrapper  ">
          <div class="stepper-item completed ">
            <div class="step-counter">1</div>
            <div class="step-name">Review Information</div>
          </div>
          <div class="stepper-item   completed active">
            <div class="step-counter">2</div>
            <?php if(get_field('application', $thisReturnedID) == 1) { ?> 
            <div class="step-name" style="text-align: center;">Review Documentary Requirements</div>
            <?php } else { ?>
            <div class="step-name" style="text-align: center;">Review of Training Certificates <br>and Documentary Requirements</div>
            <?php } ?>
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
        

    <div class='info-alert'>
        <i class="fas fa-exclamation-circle"></i>
        Disclaimer: Make sure to upload your documents and please double-check your attachment before submitting your application during accreditation. 
        Kindly click the name of the title of document to view the uploaded document.
    </div>
    
    <div class="account-information ">
    <?php if(get_field('application', get_the_id()) == 2) { ?> 
    
        <?php if(get_post_type(get_the_id()) == "ctpro"){ ?>
            <div class="headerAccount"><i class="fas fa-file-alt"></i> My Training Reports</div>
            <div class="tabs">
                <input type="radio" name="tabs" id="monthly" checked="checked">
                <label for="monthly">Monthly</label>
                <div class="tab">
                    <div class="col-mid-80"><h1>Monthly</h1></div>  
                    
                    <div class="clear"></div>
                    <br><br>
                    
                    <?php include( get_template_directory() . '-child/training-reports/training-reports-monthly.php' ); ?>
                </div>
                
                <input type="radio" name="tabs" id="quarter">
                <label for="quarter">Quarterly</label>
                <div class="tab">
                    <div class="col-mid-80"><h1>Quarterly</h1></div> 
                    <div class="clear"></div>
                    <br><br>
                    <?php include( get_template_directory() . '-child/training-reports/training-reports-quarterly.php' ); ?>
                </div>
                
                <input type="radio" name="tabs" id="yearly">
                <label for="yearly">Yearly</label>
                <div class="tab">
                    <div class="col-mid-80"><h1>Yearly</h1></div>  
                    <div class="clear"></div>
                    <br><br>
                    <?php include( get_template_directory() . '-child/training-reports/training-reports-yearly.php' ); ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="headerAccount"><i class="fas fa-file-alt"></i> My CEA Training Certificates</div>
            <div class="tabs">
                <input type="radio" name="tabs" id="ceatraining" checked="checked">
                <label for="ceatraining" style="display: none;">CEA Training Reports</label>
                <div class="tab">
                    <div class="col-mid-80"><h1>CEA Training Reports</h1></div>  
                    <div class="clear"></div>
                    <br><br>
                    <?php include( get_template_directory() . '-child/training-reports/cea-training-reports.php' ); ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
    <?php if(get_post_type(get_the_id()) == "cea") { ?>
        <div class="headerAccount"><i class="fas fa-file-alt"></i> Cooperative Clients</div>
            <div class="tab" style="margin-top: 20px;">
                <div class="col-mid-80"></div>
                <div class="col-mid-20" style="text-align:right;"></div>
                
                <div class="clear"></div>
                <div class="documentaryReq">
                <?php include( get_template_directory() . '-child/cooperative-clients/cooperatives-client-table.php' ); ?>
                </div>
                
                <style>
                    .documentaryReq .dataTables_length,
                    .documentaryReq .dataTables_filter,
                    .documentaryReq #documentaryReports {
                        margin-bottom: 25px;
                    }
                </style>
            </div>   
    <?php } ?>
  
    <div class="headerAccount"><i class="fas fa-file-alt"></i> My Documentary Requirements</div>
    <div class="tab" style="margin-top: 20px;">
        <div class="col-mid-80"></div>
        <div class="col-mid-20" style="text-align:right;"></div>
        
        <div class="clear"></div>
        <div class="documentaryReq">
        <?php include( get_template_directory() . '-child/training-documents/training-documents-table.php' ); ?>
        </div>
        
        <style>
            .documentaryReq .dataTables_length,
            .documentaryReq .dataTables_filter,
            .documentaryReq #documentaryReports {
                margin-bottom: 25px;
            }
        </style>
    </div>   



<?php
$args_officialEmail = array(
    'posts_per_page' => -1,
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
$variable_officialEmail = new WP_Query($args_officialEmail);
if ($variable_officialEmail->have_posts()): the_post(); ?>
    <?php while( $variable_officialEmail->have_posts() ): $variable_officialEmail->the_post(); ?>
        <?php
        if($email == get_field('email')){ ?>
            <?php
            function generateRandomString($length = 40) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $cpost = get_the_ID();
            $token = generateRandomString();
            
            $name;
            if(get_field('type_of_cea') == "Firm") {
                $name = get_field('firm_name');
            } else {
                $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');
            }
            $payment = get_field('payment_status');
            
            
            
            $type           = get_field('type_of_cea', $cpost);
            $application    = get_field('application', $cpost); 
            $region         = get_field('region', $cpost);
            $currentMonth   = date('m');
            $accSequenceNum = get_field(get_post_type($cpost).'_accreditation_sequence_no', 'options');
            $code; $regionCode;
            
            if(($type == "Individual") && ($application == "1")){
                $code = "II";
            } else if (($type == "Individual") && ($application == "2")) {
                $code = "IR";
            } else if (($type == "Firm") && ($application == "1")) {
                $code = "FI";
            } else if (($type == "Firm") && ($application == "2")) {
                $code = "FR";
            }
            
            if($region == "region-1"){ 
                $regionCode = "01";
            } else if($region == "region-2"){ 
                $regionCode = "02";
            } else if($region == "region-3"){ 
                $regionCode = "03";
            } else if($region == "region-4A"){ 
                $regionCode = "04";
            } else if($region == "region-5"){ 
                $regionCode = "05";
            } else if($region == "region-6"){ 
                $regionCode = "06";
            } else if($region == "region-7"){ 
                $regionCode = "07";
            } else if($region == "region-8"){ 
                $regionCode = "08";
            } else if($region == "region-9"){ 
                $regionCode = "09";
            } else if($region == "region-10"){ 
                $regionCode = "10";
            } else if($region == "region-11"){ 
                $regionCode = "11";
            } else if($region == "region-12"){ 
                $regionCode = "12";
            } else if($region == "region-13"){ 
                $regionCode = "14";
            } else if($region == "ncr"){ 
                $regionCode = "13";
            } else if($region == "car"){ 
                $regionCode = "15";
            } else if($region == "region-4B"){ 
                $regionCode = "17";
            }
            
            
            
            
            
            
            
            
            
            if ($payment == "Pending" || empty($payment)){
                //echo "<div class='info-alert'><i class=\"fas fa-exclamation-circle\"></i> To approved your accreditation, please settle your pending balance.</div>";
            }
            acf_form(array(
                'post_id' => 'new_post',
                'field_groups' => array(
                    'group_61d2b56290f34', // Accreditation Request
                    'group_61d2b9c28ee70', // Approval Status (SED Division)
                    'group_61d2b97793359', // Approval Status (SES Division)
                    'group_61de88f5cf877' // Accreditation Email Status
                ) ,
                'new_post' => array(
    
                    'post_title' => $token,
                    'post_type' => 'accreditations',
                    'post_status' => 'publish',
    
                ) ,
                'updated_message' => __("", 'acf') ,
                'submit_value' => __('Submit Application', acf) ,
                'return' => "/review-ses-division/?token=".$token,
            ));
            ?>
            
            <div class="clear"></div>
            
            <style>
                .acf-form-submit .acf-button.disabled {
                    pointer-events: none;
                    cursor: default;
                    background: #535760!important;
                }
            </style>
            <script>
                document.getElementById("acf-field_61d2b571b2f90").value = "<?php echo get_field('ca-no'); ?>";
                document.getElementById("acf-field_623d38d405358").value = "<?php echo $code."-".$regionCode."-".$currentMonth."-".$accSequenceNum; ?>"; // Application No
                document.getElementById("acf-field_61d2b59ab2f93").value = "<?php echo $cpost; ?>";
                document.getElementById("acf-field_61d2b578b2f91").value = "<?php echo $name; ?>";
                
                document.getElementById("acf-field_61d2be458bc07").value = "<?php echo strtoupper(get_post_type($thisReturnedID)); ?>";
                
                document.getElementById("acf-field_61de81b8c5a34").value = "<?php echo get_field('region'); ?>";
                document.getElementById("acf-field_61dfd65bdda24").value = "<?php echo get_field('delegates_id'); ?>";
                document.getElementById("acf-field_61f34414586d9").value = "<?php echo get_field('application'); ?>";
                
                document.getElementById("acf-field_6243d174d34a9").value = "<?php echo implode( ",", $globalDocID ); ?>";
                
                
                <?php if(!$globalDocID) { ?>
                    $(document).ready(function(){
                        $( ".acf-form-submit .acf-button" ).addClass( "disabled" );
                    });
                <?php } else { ?>
                    $(document).ready(function(){
                        $( ".acf-form-submit .acf-button" ).removeClass( "disabled" );
                    });
                <?php } ?>
            </script>
        <?php } ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

    </div>
</div>

            
<style>
    .acf-field-61d2ba5f28203, .acf-field-623007155e202{
        display:none !important;
    }
    .page-template-my-account .acf-form-submit {
        margin-top: 25px;
    }
</style>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
