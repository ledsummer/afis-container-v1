<?php
/* Template Name: Submit Recommendation Requests */
get_header();
acf_form_head();
if (is_user_logged_in()) {
} else {
    header("location:../?relogin=true");
}

$get_post_id = $_GET["post_id"];
$get_acc_id = $_GET["acc_id"];

 if (isset($_GET["success"])) {
            $url="../profile/requests/view-accreditation-request/?post_id=$get_post_id&acc_id=$get_acc_id";
            header("Location:$url");
            
          
          
}
$user_id = get_current_user_id();
$user = new WP_User($user_id);
$display_name = $current_user->user_firstname. " ".$current_user->user_lastname; 

global $groupkey;
if (!empty($user->roles) && is_array($user->roles)) {
    foreach ($user->roles as $role) {
        if ($role == "crits_regional_director") {
            $groupkey = "group_61d2b97793359";
            $colmid = "col-mid-60";
        } elseif ($role == "critd_supervising_cds") {
            $groupkey = "group_61d2b9c28ee70";
            $colmid = "col-mid-85";
            echo "<style> .recommendations{ display:none; } </style>";
        } else {
            $groupkey = "group_61d91169501a2";
            $colmid = "col-mid-85";
           
        }
    }
}
?>
<?php include( get_template_directory() . '-child/my-account/account-restriction.php' ); ?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>
<div class="container">
  <div class="col-mid-15">
    <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
  </div>
  <div class="col-mid-85" >
    <div class="standardCenter-account">
      <?php
      if (isset($_GET["success"])) {
          echo '<div class="info-success"> <i class="fas fa-check-circle"></i> Successfully Submitted your recommendation!</div>';      
      
          
      }
      if (isset($_GET["post_id"])) {

          $p = $_GET["post_id"];
          global $participant;
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
                  $participant =get_field("first_name") ." " .get_field("middle_name") ." " .get_field("last_name");
                  $ca_no=get_field("ca-no");
                  ?>
      <div class="profile-name-view">
        <div class="profileBg">
          <h3>
          Recommendations
          </h3>
        </div>
        <div class="clear">
        </div>
      </div>
    </div>
  </div>                   

        <?php
              endwhile;
          else:
              echo '<div class="info-alert" style="margin-top:10px;"> No Available Information. Either you enter a wrong post id or invalid wrong URL. </div>';
              echo '<style> .displayTrainingReports{ display:none !important; }</style>';
          endif;
          ?>
       
  <div class="col-mid-85 recommendations" id="disabled-this" >
    <div class="standardCenter-account">
      <div class="account-information">
        <div class="headerAccount">
          <i class="fas fa-file-alt">
          </i> Input your recommendations for 
          <span style="color:darkblue">
            <?php echo $participant; ?>
          </span>
        </div>
        <?php
        $p = $_GET["post_id"]; 
        $posts = get_posts(array(
	        'numberposts'	=> 1,
	        'post_type'		=> array('accreditations'),
	        'post_status'   => array('publish'),
        	'meta_query'	=> array(
		    'relation'		=> 'AND',
		    array(
			'key'	  	=> 'post_id',
			'value'	  	=> $p,
			'compare' 	=> '=',
		))));
        if (have_posts()):
            while (have_posts()):
                the_post();
                $cpost = get_the_ID();
                acf_form([
                    "post_id" => "new_post",
                    "field_groups" => ["group_61d91169501a2"],
                    "new_post" => [
                        "post_type" => "recommendations",
                        "post_status" => "publish",
                        "post_author" =>  $display_name,
                    ],
                    "updated_message" => __("", "acf"),
                    "submit_value" => __("Submit Post", acf),
                    "return" => "?success=$p&&post_id=$get_post_id&&acc_id=$get_acc_id",
                ]);
            endwhile;
        endif;
        ?>
       
                <script>
                document.getElementById("acf-field_61d91178a1a7d").value = "<?php echo $user_id; ?>";
                document.getElementById("acf-field_61d91171a1a7c").value = "<?php echo $p; ?>";
                document.getElementById("acf-field_61d95c67d14da").value = "<?php echo $participant; ?>";
                document.getElementById("acf-field_61d95ce023ea8").value = "<?php echo $ca_no; ?>";
                document.getElementById("acf-field_61d9b6b40d0c8").value = "<?php echo $cpost; ?>";
                </script>
      </div>
    </div>
  
          <style>
            .show-admin{
              display:block !important;
            }
            .recommendations{
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
              border: 0px !important;
              text-transform: UPPERCASE;
              font-size: 14px;
              font-family: 'Open Sans';
            }
            .acf-field .acf-label label {
              font-size: 14px !important;
              font-weight: normal !important;
              display:block !important;
            }
            .announcement{
              margin:22px 0px 10px 0px !important;
            }
            input[type="submit"]:hover{
              border-bottom:0px !important;
            }
          </style>
        </div>
        <?php
      } else {
          echo '<div class="info-alert" style="margin-top:10px;"> No Available Information</div>';
          echo '<style>.displayTrainingReports{ display:none; }</style>';
      }
      ?>
      </div>     
    </div>
  </div>
  <div class="clear">
  <div class="clear">
<style>
    .leftaccountWrapper {
   
    }
</style>
<?php get_footer(); ?>
