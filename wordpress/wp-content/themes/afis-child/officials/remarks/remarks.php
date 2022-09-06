
          
<?php
$p = $_GET['post_id'];

global $accreditations_id;
$args = [
    "posts_per_page" => 1,
    "post_type" => ["accreditations"],
    "post_status" => ["publish"],
    "meta_query" => [
        "relation" => "AND",
        [
            "key" => "post_id",
            "value" => $p,
            "compare" => "=",
        ],
    ],
];

$variable = new WP_Query($args);
if ($variable->have_posts()):
    the_post(); ?>
    <?php while ($variable->have_posts()):
        $variable->the_post(); ?>
        <?php $accreditations_id = get_the_id(); ?>
    
    <?php
    endwhile; ?>
<?php
else:
endif;
?>
 
          
       <div class="accreditations-container-feedback" id="conversations">
	    <div class="structures-list-feedback">
     <?php
global $ca_no;
global $last_name;
$args = [
    "posts_per_page" => -1,
    "post_type" => ["remarks"],
    "post_status" => ["publish"],
    "meta_query" => [
    "relation" => "AND",
        [
            "key" => "post_id",
            "value" => $p,
            "compare" => "=",
        ],
         [
             "key" => "accreditation_id",
              "value" => $accreditations_id,
              "compare" => "=",
      ],
    ],
];

$variable = new WP_Query($args);
if ($variable->have_posts()):
    the_post(); ?>
    <?php while ($variable->have_posts()):
        $variable->the_post(); 
          $presscount++;  
                $cpost              =   get_the_ID();
                $remarks            =   get_field('remarks',$cpost);
                $postedby           =   get_field('user',$cpost);
                $author             =   get_display_name($postedby);
                $new_user           =   get_userdata( $user_id );
                $first_name         =   $new_user->first_name;
                $last_name          =   $new_user->last_name;
                $date               =   get_the_date();
                $is_officer         =   get_field('is_officer',$cpost);
                $post_id            =   get_field('post_id', $cpost);
                $accreditation_id   =   get_field('accreditation_id', $cpost);
                $ca_no              =   get_field('ca_no', $cpost);
                global $myrole;
                $user = new WP_User($postedby);
                if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
                foreach ( $user->roles as $role ){
                //CRITD
                if ( $role=="critd_cd-2" ) {
                $position ="CRITD CDS II";
                } elseif ($role=="critd_chief_of_division" ) {
                $position ="CRITD Chief of Division";
                } elseif ($role=="critd_senior_cds" ) {
                $position ="CRITD Senior CDS";
                } elseif ($role=="critd_supervising_cds" ) {
                $position ="CRITD Supervising CDS";    
                //CRITS
                } elseif ($role=="crits-cds_1" ) {
                 $position ="CRITS CDS I";  
                } elseif ($role=="crits-senior_cds" ) {
                 $position ="CRITS Senior CDS";  
                } elseif ($role=="crits_regional_director" ) {
                 $position ="CRITS Regional Director";  
                }else{
                    
                }
                }
                }
                $date=get_the_date();
              
               if($is_officer=="1"){
                    $bgcolor="#edf1f3";
                    
               }else{
                    $bgcolor="#fbfbfb";
               }
               $status_ses  = get_field('status_ses',$accreditation_id);
               $status_sed  = get_field('status_sed',$accreditation_id);
               $getremarkses = get_field('remarks_ses',$accreditation_id);
               $getremarksed = get_field('remarks_sed',$accreditation_id);
     
      
               echo '<div class="each-list-feedback" style="background:'.$bgcolor.'; padding: 10px; border-radius: 3px; line-height:1.3; margin-bottom: 10px; font-size:13px; margin-top: 4px; border: 0px dotted #625c5c; font-family: \'Open Sans\', sans-serif; font-weight: normal;">
              '.$remarks.'
               <span style="font-size: 12px; font-family:Roboto; color: #564023; font-weight: 600;"> 
               <i class="fas fa-user"></i> CA No: '.$ca_no. ' - '.$author.', '.$position.' -- '.$date.' </span>
               
               <br>
               </div>';
  
    endwhile; endif;
?>
	<?php if($presscount > 3) { ?>
        	 
			                <div class="readMore-btn">
			                    <button class="display-block link-btn for-whitebg" id="loadmoreFeedback">Load more</button>
			                </div>
			<?php } ?>
			
		
<br>
        <span 
    style="color: white;
    cursor: pointer;
    right: 0;
    background: #5080cb;
    padding: 10px 20px;
    width: 100%;
    text-align: center;
    border-radius: 29px;
    text-transform: UPPERCASE;" id="element">Reply to <?php echo $participant; echo " "; ?> <i class="fas fa-comment-dots"></i>
    </div>
     </span>
     <br id="fade1">
    <br id="fade2">
     </div>
         </div>
         	 <div class="readMore-btn">
			                    <button class="display-block link-btn for-whitebg" id="LoadConversation">View Conversation</button>
			   </div>
			
         <script>
     $("#element").click(function(){
     $("#replybox").fadeIn();
     $("#element").fadeOut();
     $("#fade1").fadeOut();
     $("#fade2").fadeOut();
     $("#acf-field_61d9a835ecc2f").prop("checked", true);
    });
    $("#conversations").fadeOut();
    $("#LoadConversation").click(function(){
        $("#conversations").fadeIn();
        $("#LoadConversation").fadeOut();
    });     
 </script>
 
          <div class="account-information-remarks" style="margin-top: 19px !important; display:none;" id="replybox">
        <div class="headerAccount">
          <i class="fas fa-file-alt">
          </i> Your Reply
         
        </div>
       
        <?php acf_form([
            "post_id" => "new_post",
            "field_groups" => ["group_61d91169501a2"],
            "new_post" => [
                "post_type" => "remarks",
                "post_status" => "publish",
                "post_author" => $display_name,
            ],
            "updated_message" => __("", "acf" ),
            "submit_value" => __("Send Message", acf),
        ]); ?>
       
                <script>
                document.getElementById("acf-field_61d91178a1a7d").value = "<?php echo $user_id; ?>";
                document.getElementById("acf-field_61d91171a1a7c").value = "<?php echo $p; ?>";
                document.getElementById("acf-field_61d95c67d14da").value = "<?php echo $participant; ?>";
                document.getElementById("acf-field_61d95ce023ea8").value = "<?php echo $ca_no; ?>";
                document.getElementById("acf-field_61d9b6b40d0c8").value = "<?php echo $accreditations_id; ?>";
                document.getElementById("acf-field_61d9a835ecc2f").prop("checked", true);
                </script>
 
  
  