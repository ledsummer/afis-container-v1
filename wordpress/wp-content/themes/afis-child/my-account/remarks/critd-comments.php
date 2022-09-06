<?php
/* Template Name: Submit Feedback Requests */
?>
     </div>
       
      <?php
      $p = $returnedID;
      global $participant;
      global $cpost;
      $loop = new WP_Query([
          "numberposts" => 1,
          "post_type" => ["cea", "ctpro"],
          "post_status" => ["publish"],
          "p" => $p,
      ]);
      if ($loop->have_posts()):
          while ($loop->have_posts()):

              $loop->the_post();
              $cpost = get_the_ID();
              $participant =
                  get_field("first_name") .
                  " " .
                  get_field("middle_name") .
                  " " .
                  get_field("last_name");
              $ca_no = get_field("ca-no");
              $token = get_field("token");
              ?>

        <?php
          endwhile;
      else:
      endif;
      ?>
          
<?php
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
      <div class="account-information-remarks">
        <div class="headerAccount">
          <i class="fas fa-file-alt">
          </i> Comments</div>
          
       <div class="accreditations-container">
	    <div class="structures-list">
     <?php

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
     
      
               echo '<div class="each-list" style="background:'.$bgcolor.'; padding: 10px; border-radius: 3px; line-height:1.3; margin-bottom: 10px; font-size:13px; margin-top: 4px; border: 0px dotted #625c5c; font-family: \'Open Sans\', sans-serif; font-weight: normal;">
               <i class="fas fa-comment-dots"></i> '.$remarks.'
               <span style="font-size: 12px; font-family:Roboto; color: #564023; font-weight: 600;"> 
               <i class="fas fa-user"></i> CA No: '.$ca_no. ' - '.$author.', '.$position.' -- '.$date.' </span>
               
               <br>
               </div>';
  
    endwhile; endif;
?>
	<?php if($presscount > 3) { ?>
        	 
			                <div class="readMore-btn">
			                    <button class="display-block link-btn for-whitebg" id="loadmoreNews">Load more</button>
			                </div>
			<?php } ?>
<br><br>
        <span 
    style="color: white;
    cursor: pointer;
    right: 0;
    background: #357deb;
    padding: 10px;
    width: 13%;
    text-align: center;" id="element">Leave us a Message <i class="fas fa-comment-dots"></i></div>
     </span>
     </div>
         </div>
         <script>
     $("#element").click(function(){
     $("#replybox").fadeIn();
     $("#element").fadeOut();
     
    });
 </script>
          <div class="account-information-remarks" style="margin-top: 29px !important; display:none;" id="replybox">
        <div class="headerAccount">
          <i class="fas fa-file-alt">
          </i> Your Reply
         
        </div>
        <?php if (isset($_GET["success"])) {
            echo '<div class="info-success"> <i class="fas fa-check-circle"></i> Successfully Sent!</div>';
        } ?>
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
                </script>
      </div>
  
  
          <style>
            .show-admin{
              display:block !important;
            }
            .rightaccountWrapper .announcement {
              line-height: 1.3;
              font-size: 13px;
              padding: 10px !important;
              color: #3d3636;
              background-color: #d6d7da !important;
            }
            .btn-download button, input[type="submit"], input[type="button"], input[type="reset"] {
              background: linear-gradient(to bottom, #4458b4 0%, #4054b2 100%)!important;
              border: none;
              border-bottom: 3px solid #4054b2 !important;
              padding: 10px !important;
              ;
              border: 0px !important;
              text-transform: UPPERCASE;
              font-size: 14px;
              font-family: 'Open Sans';
            }
            .acf-field .acf-label label {
              font-size: 14px !important;
              font-weight: normal !important;
              display:none !important;
            }
            .announcement{
              margin:22px 0px 10px 0px !important;
            }
            input[type="submit"]:hover{
              border-bottom:0px !important;
            }
            .remarks {
            background: #e8e9eb;
            padding: 10px 10px 10px;
            border: 1px solid #c3b2b2;
            border-radius: 0px;
            color: #1c1a1a;
            font-family: 'Roboto';
            }
            
            .account-information-remarks {
            background: #eef1fe;
            height: auto;
            margin-top: 193px;
            padding-top: 20px;
            padding: 20px;
            margin-bottom: 0px;
            }
          </style>
