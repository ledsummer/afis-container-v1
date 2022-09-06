<?php 
/* Template Name: View Accreditation Requests */ 
get_header();
acf_form_head();
if (is_user_logged_in())
{
}
else
{
    header("location:../?relogin=true");
}
$get_post_id = $_GET['post_id'];
$get_acc_id = $_GET["acc_id"];
$user_id = get_current_user_id();
$user = new WP_User($user_id);
global $groupkey;
global $role;
if (!empty($user->roles) && is_array($user->roles))
{
    foreach ($user->roles as $role)
    {
        if (($role == "crits_regional_director") || ($role == "ses_regional_director"))
        {
            $groupkey = 'group_61d2b97793359';
            $colmid = 'col-mid-60';
            echo '<style> .btnRecom{ display:none; } </style>';
        }
        elseif (($role == "critd_chief_of_division") || ($role == "ho_chief_cds"))
        {
            $groupkey = 'group_61d2b9c28ee70';
            $colmid = 'col-mid-60';
            echo '<style> .recommendations, .btnRecom{ display:none; }</style>';
        }
        else
        {
            $groupkey = 'group_61d91169501a2';
            $colmid = 'col-mid-85';
            echo "<style> #secondary{ display:none !important; </style>";
        }
    }
}
?>
<?php include( get_template_directory() . '-child/my-account/account-restriction.php' ); ?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>
<html>
<body>
	<div class="container">
		<div class="col-mid-15"  id="mySidebar">
			<?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
		</div>
		
        <?php if((($role == 'ses_regional_director') || ($role == 'crits_regional_director')) && (get_field('status_sed', $get_acc_id) == "Approved")) { ?>
            <style>
                #secondary.displayTrainingReports { display: none; }
            </style>
            <?php $colmid = "col-mid-85"; ?>
        <?php } ?>

		<div class="col-mid-85" id="main-content-header">
			<div class="standardCenter-account">
				<?php
				if(isset($_GET['success'])){
    				echo '<div class="info-success"> <i class="fas fa-check-circle"></i> Successfully Updated!</div>';
    				echo $role;
    				if(($role == "critd_chief_of_division") && (get_field('submitted_d', $get_acc_id) != get_field('status_sed', $get_acc_id))){
    				    update_field( 'field_62201e778d597',  get_field('status_sed', $get_acc_id), $get_acc_id );
        				include( get_template_directory() . '-child/officials/official-insert-accreditation.php' );
    				} else if(($role == "ho_chief_cds") && (get_field('submitted_d', $get_acc_id) != get_field('status_sed', $get_acc_id))){
    				    update_field( 'field_62201e778d597',  get_field('status_sed', $get_acc_id), $get_acc_id );
        				include( get_template_directory() . '-child/officials/official-insert-accreditation.php' );
    				} else if(($role == "crits_regional_director") && (get_field('submitted', $get_acc_id) != get_field('status_ses', $get_acc_id))) {
    				    update_field( 'field_622022e843482',  get_field('status_ses', $get_acc_id), $get_acc_id );
    				    include( get_template_directory() . '-child/officials/official-insert-accreditation.php' );
    				} else if(($role == "ses_regional_director") && (get_field('submitted', $get_acc_id) != get_field('status_ses', $get_acc_id))) {
    				    update_field( 'field_622022e843482',  get_field('status_ses', $get_acc_id), $get_acc_id );
    				    include( get_template_directory() . '-child/officials/official-insert-accreditation.php' );
    				}
    				
    				if((get_field('type_of_cea', $get_post_id) == "Firm") || (get_field('type_of_cea', $get_post_id) == "Individual")){
    				    update_field( 'field_620f57f9364ad',  get_field('update_cea', $get_acc_id), $get_post_id );
    				}
    				?>
				    <meta http-equiv="refresh" content="0;url=<?php echo home_url().'/profile/requests/view-accreditation-request/?post_id='.$get_post_id.'&acc_id='.$get_acc_id; ?>" />
				<? }
				if(isset($_GET['updated'])){
				 echo '<div class="info-success"> <i class="fas fa-check-circle"></i> Successfully Sent Message!</div>';
				}
				if(isset($_GET['post_id'])){
				$p=$_GET['post_id'];
				global $participant;
				$loop = new WP_Query(array(
				'numberposts'   => 1,
				'post_type'     => array('cea','ctpro'),
				'post_status'   => array('publish'),
				'p'             => $p ));
				if ( $loop->have_posts() ):   while ( $loop->have_posts() ) : $loop->the_post();
				$cpost=get_the_ID(); 
				$participant=  get_field('first_name' )." ". get_field('middle_name'). " ". get_field('last_name'); 
				?>

				<div class="profile-name-view">
					<div class="profileBg">
					    <span style="font-size:14px; color:#fff">Manage Accreditation Request</span>
						<h3>
						    <?php if(get_field('type_of_cea') == "Firm") { ?>
    						    <?php echo get_field('firm_name'); ?>
						    <?php } else { ?>
    						    <?php echo  get_field('first_name'); ?> <?php echo  get_field('middle_name'); ?> <?php echo  get_field('last_name'); ?>
						    <?php } ?>
						</h3>
					</div>


					<div class="clear">
					</div>
				</div>
			</div>
		</div>
		
		<div class="<?php echo $colmid; ?>" id="main-content">
			<div class="standardCenter-account">
			    <?php if($_GET['include']) { ?>
			        <?php if($_GET['include'] == "y") { ?>
			            <?php update_field( 'field_62204d70e01d8', "y", $get_acc_id ); ?>
			        <?php } else { ?>
			            <?php update_field( 'field_62204d70e01d8', "n", $get_acc_id ); ?>
			        <?php } ?>
			        <div class="info-success"> <i class="fas fa-check-circle"></i> Successfully Updated!</div>
			    <?php } ?>
			    <?php if($_GET['suspend']) { ?>
			        <?php if($_GET['suspend'] == "y") { ?>
			            <?php update_field( 'field_623137d7f0959', "y", $get_acc_id ); ?>
			        <?php } else { ?>
			            <?php update_field( 'field_623137d7f0959', "n", $get_acc_id ); ?>
			        <?php } ?>
			        <div class="info-success"> <i class="fas fa-check-circle"></i> Successfully Updated!</div>
			    <?php } ?>
			    <?php if($_GET['pstatus']) { ?>
			        <?php if($_GET['pstatus'] == "1") { ?>
			            <?php update_field( 'field_61cb3cc967c2b', "Paid", $get_post_id ); ?>
			        <?php } else { ?>
			        <?php } ?>
			        <div class="info-success"> <i class="fas fa-check-circle"></i> Successfully Updated!</div>
			    <?php } ?>
				<div class="account-information">
					<div class="navigation-menu">
					    <?php if($role == 'ho_senior_cds'){ ?>
    					    <?php if((get_field('forApproved_status', $get_acc_id) == "y")) { ?>
    					        <a class="btn-default btnExIn" href="<?php echo get_the_permalink(334); ?>?post_id=<?php echo $p; ?>&acc_id=<?php echo $_GET['acc_id']; ?>&include=n"><i class="fas fa-minus-square"></i> Exclude in For Approved List</a>
    					    <?php } else { ?>
    					        <a class="btn-default btnExIn" href="<?php echo get_the_permalink(334); ?>?post_id=<?php echo $p; ?>&acc_id=<?php echo $_GET['acc_id']; ?>&include=y"><i class="fas fa-check-square"></i> Include in For Approved List</a>
    					    <?php } ?>
					    <?php } ?>
					    <?php if((get_field('for_suspended', $get_acc_id) == "y")) { ?>
					        <a class="btn-default btnSuspend" href="<?php echo get_the_permalink(334); ?>?post_id=<?php echo $p; ?>&acc_id=<?php echo $_GET['acc_id']; ?>&suspend=n"><i class="fas fa-minus-square"></i> Unsuspend</a>
					    <?php } else { ?>
					        <a class="btn-default btnSuspend" href="<?php echo get_the_permalink(334); ?>?post_id=<?php echo $p; ?>&acc_id=<?php echo $_GET['acc_id']; ?>&suspend=y"><i class="fas fa-minus-square"></i> Suspend</a>
					    <?php } ?>
					    
					    <?php if((get_field('payment_status', $get_post_id) == "Paid")) { ?>
					    <?php } else { ?>
					        <a class="btn-default btnRecom" href="<?php echo get_the_permalink(334); ?>?post_id=<?php echo $p; ?>&acc_id=<?php echo $_GET['acc_id']; ?>&pstatus=1"><i class="fa fa-check"></i> Mark as Paid</a>
					    <?php } ?>
					    
						<a class="btn-default btnRecom" href="<?php echo get_the_permalink(517); ?>?post_id=<?php echo $p; ?>&acc_id=<?php echo $_GET['acc_id']; ?>"><i class="fas fa-file-alt"></i> Submit Your Recommendation</a>
					</div>
					
					<?php if(get_field('status_sed', $get_acc_id) == 'Approved') { ?>
					    <style>
					        .btnExIn {
					            display: none;
					        }
					    </style>
					<?php } ?>
					
					<?php if((get_field('status_sed', $get_acc_id) == 'Approved') && ($role == "ho_chief_cds")) { ?>
					    <style>
					        .btnSuspend {
					            display: inline;
					        }
					    </style>
					<?php } else { ?>
					    <style>
					        .btnSuspend {
					            display: none;
					        }
					    </style>
					<?php } ?>


					<div class="headerAccount">
						<i class="fas fa-file-alt"></i> AFIS Account Information
					</div>

                    <?php if(get_post_type($get_post_id) == "cea"){ ?>
                    <div class="label-information">Application No:</div> <div class="data-information"><?php echo get_field('application_no'); ?></div>
                    <div class="clear"></div>
                    
                    <div class="label-information">CDA CEA No:</div> <div class="data-information"><?php echo get_field('cea-no'); ?></div>
                    <div class="clear"></div>
                    <?php } else { ?>
                    <div class="label-information">CA No:</div> <div class="data-information"><?php echo get_field('ca-no'); ?></div>
                    <div class="clear"></div>
                    <?php } ?>

					<div class="headerAccount">
						<i class="fas fa-file-alt"></i> Payment Status
					</div>


					<div class="label-information">
						Status:
					</div>


					<div class="data-information">
						<?php 
						global $payment;
						$payment= get_field('payment_status'); 
						if($payment=="Pending" || empty($payment)){
						echo "<span style='color:red;'>Pending</span>";
						}else{
						echo "<span style='color:green;'>Paid</span>";
						echo "<style>#submit_paynamics_payment_form{ display:none; }</style>";
						}
						?>
					</div>


					<div class="headerAccount">
						<i class="fas fa-file-alt"></i> Account Type
					</div>
					
					<div class="label-information">
						Application:
					</div>


					<div class="data-information">
						<?php
                        if(get_field('application') == 1){
                            echo "New";
                        } else if(get_field('application') == 2) {
                            echo "Renewal";
                        }
                        ?>
					</div>


					<div class="clear">
					</div>


					<div class="label-information">
						Type:
					</div>


					<div class="data-information">
						<?php echo get_field('type_of_cea'); ?>
					</div>


					<div class="clear">
					</div>


					<?php if(get_post_type($_GET['post_id']) == "cea"){ ?>
                    <div class="label-information">PRC ID No.:</div> <div class="data-information"><?php echo  get_field('prc_id_no' ); ?></div>
                    <div class="clear"></div>
                    
                    <div class="label-information">PRC BOA Accreditation No.:</div> <div class="data-information"><?php echo  get_field('prc_boa_accreditation_no_' ); ?></div>
                    <div class="clear"></div>
                    <?php } ?>
                    
                    <?php if(get_post_type($get_post_id) == "cea"){ ?>
                        <?php if(get_field('type_of_cea', $get_post_id) == "Firm") { ?>
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
                    <?php } else { ?>
                        <div class="label-information">Name of Organization:</div> <div class="data-information"><?php echo  get_field('organization' ); ?></div>
                        <div class="clear"></div>
                        
                        <div class="label-information">Organization Email:</div> <div class="data-information"><?php echo  get_field('organization_email' ); ?></div>
                        <div class="clear"></div>
                    <?php } ?>
                    
					<div class="headerAccount">
						<i class="fas fa-file-alt"></i> Application Information
					</div>

                    <?php if(get_field('type_of_cea') != "Firm") { ?>
					<div class="label-information">
						First Name:
					</div>


					<div class="data-information">
						<?php echo  get_field('first_name' ); ?>
					</div>


					<div class="clear">
					</div>


					<div class="label-information">
						Middle Name:
					</div>


					<div class="data-information">
						<?php echo  get_field('middle_name'); ?>
					</div>


					<div class="clear">
					</div>


					<div class="label-information">
						Last Name:
					</div>


					<div class="data-information">
						<?php echo  get_field('last_name'); ?>
					</div>


					<div class="clear">
					</div>
					<?php } ?>
					
					<?php if(get_post_type($get_post_id) == "ctpro"){ ?>
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
                    

					<div class="label-information">
						City/Municipality :
					</div>


					<div class="data-information">
						<?php echo  get_field('city'); ?>
					</div>


					<div class="clear">
					</div>


					<div class="label-information">
						Province:
					</div>


					<div class="data-information">
						<?php echo  get_field('province'); ?>
					</div>


					<div class="clear">
					</div>


					<div class="headerAccount">
						<i class="fas fa-file-alt"></i> Contact Information
					</div>


					<div class="label-information">
						Email:
					</div>


					<div class="data-information">
						<?php echo  get_field('email'); ?>
					</div>


					<div class="clear">
					</div>


					<div class="label-information">
						Telephone:
					</div>


					<div class="data-information">
						<?php echo  get_field('telephone'); ?>
					</div>


					<div class="clear">
					</div>


					<div class="label-information">
						Mobile:
					</div>


					<div class="data-information">
						<?php echo  get_field('cellphone'); ?>
					</div>


					<div class="clear">
					</div>
					<?php
					endwhile;
					else:
					echo '<div class="info-alert" style="margin-top:10px;"> No Available Information. Either you enter a wrong post id or invalid wrong URL. </div>';
					echo '<style>
					.displayTrainingReports{
					display:none !important;
					}</style>';
					endif;
					?>
					<?php wp_reset_query(); ?>

					<div class="displayTrainingReports">
					    <?php if(get_post_type($_GET['post_id']) == "ctpro"){ ?>
    					    <?php if(get_field('application', $_GET['post_id']) == 2){ ?>
    						<div class="headerAccount">
    							<i class="fas fa-file-alt"></i> Training Reports
    						</div>
    
    						<div class="tabs">
    							<input checked="checked" id="monthly" name="tabs" type="radio"> <label for="monthly">Monthly</label>
    
    							<div class="tab">
    								<div class="col-mid-80">
    									<h1>Monthly Reports</h1>
    								</div>
    
    
    								<div class="clear"></div>
    								<br>
    								<br>
    								<?php include( get_template_directory() . '-child/officials/view-training-reports/monthly.php' ); ?>
    							</div>
    							<input id="quarter" name="tabs" type="radio"> <label for="quarter">Quarterly</label>
    
    							<div class="tab">
    								<div class="col-mid-80">
    									<h1>Quarterly Reports</h1>
    								</div>
    
    
    								<div class="clear"></div>
    								<br>
    								<br>
    								<?php include( get_template_directory() . '-child/officials/view-training-reports/quarterly.php' ); ?>
    							</div>
    							<input id="yearly" name="tabs" type="radio"> <label for="yearly">Yearly</label>
    
    							<div class="tab">
    								<div class="col-mid-80">
    									<h1>Yearly Reports</h1>
    								</div>
    
    
    								<div class="clear"></div>
    								<br>
    								<br>
    								<?php include( get_template_directory() . '-child/officials/view-training-reports/yearly.php' ); ?>
    							</div>
    						</div>
    
    						<?php } ?>
    					<?php } else { ?>
    					    <div class="headerAccount">
    							<i class="fas fa-file-alt"></i> Training Reports
    						</div>
    
    						<div class="tabs">
    							<input checked="checked" id="ceaTraining" name="tabs" type="radio"> <label for="ceaTraining">Cea Training Reports</label>
    
    							<div class="tab">
    								<div class="col-mid-80">
    									<h1>Cea Training Reports</h1>
    								</div>
    
    								<div class="clear"></div>
    								<br>
    								<br>
    								<?php include( get_template_directory() . '-child/officials/view-training-reports/cea-training-reports.php' ); ?>
    							</div>
    						</div>
    						
    						
    						<div class="headerAccount">
    							<i class="fas fa-file-alt"></i> Cooperative Clients
    						</div>
    						
    						<div style="background: #fff;  margin-top: 20px;">
    							<?php include( get_template_directory() . '-child/officials/view-cooperative-clients/documents.php' ); ?>
    						</div>
    					<?php } ?>
    					
						<div class="headerAccount">
							<i class="fas fa-file-alt"></i> Documentary Requirements
						</div>
						
						<div style="background: #fff;  margin-top: 20px;">
							<?php include( get_template_directory() . '-child/officials/view-training-documents/documents.php' ); ?>
						</div>
					</div>
				    
				    <?php if(($role == 'crits-cds_1') || ($role == 'crits-senior_cds')) { ?>
				    
                    <div style="margin-top:10px;">
						<div class="headerAccountSidebar">
							 <i class="fas fa-comment-dots"></i> Conversation 
						</div>
						<br>
						<?php include( get_template_directory() . '-child/officials/remarks/remarks.php' ); ?>
					</div>
					
					<?php } ?>
						
					<div style="margin-top:10px;">
						<div class="headerAccountSidebar">
							 <i class="fas fa-comment-dots"></i>  CDA Recommendations
						</div>
						<br>
						<?php include( get_template_directory() . '-child/officials/official-accreditation-recommendation.php' ); ?>
					</div>
				</div>
				<script>
				     if (document.location.search.match(/type=embed/gi)) {
				       window.parent.postMessage("resize", "*");
				     }
				     function displayForm() {
				       document.getElementById("hide").style.display = "block";
				     }
				</script>
			</div>
		</div>
	</div>
	
	<div class="col-mid-25 displayTrainingReports" id="secondary">
		<div class="rightaccountWrapper">
			<?php include( get_template_directory() . '-child/officials/official-accreditation-update-status.php' ); ?>
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
		          font-weight: bold !important;
		        }
		        .announcement{
		          margin:22px 0px 10px 0px !important;
		        }
		        input[type="submit"]:hover{
		          border-bottom:0px !important;
		        }
		        .account-information{
		            margin-bottom:20px !important;
		        }
		       
                .announcement.reminder .acf-field .acf-label label {
                    display: block!important;
                }
			</style>
			<?php if(get_post_type($get_post_id) == "cea") { ?>
			    <style>
			        .acf-field-6200779b20114,
			        .acf-field-620077d520117,
			        .acf-field-6200780a2011b {
			            display: none;
			        }
			    </style>
			<?php } else { ?>
			    <style>
			        .acf-field-623d57a92083f {
			            display: none;
			        }
			    </style>
			<?php } ?>
			
			<?php if(get_post_type($get_post_id) == "ctpro") { ?>
			    <style>
			        .acf-field-622eab59a259b,
			        .acf-field-622eab90a259c {
			            display: none;
			        }
			    </style>
			<?php } ?>
			
			
			<?php }else{
			echo '<div class="info-alert" style="margin-top:10px;"> No Available Information</div>';
			echo '<style>
			.displayTrainingReports{
			display:none;
			}</style>';
			}?>
		</div>
	</div>
    
	<div class="clear">
		<div class="clear">
			<?php get_footer(); ?>
		</div>
	</div>
	<style>
	    .btn-download button, input[type="submit"], input[type="button"], input[type="reset"]{
	        width:100% !important;
	    }
		input[type="submit"]:hover {
   		 width: 100% !important;
		}
		.exportCert {
		    margin-top: 15px;
		}
		.exportCert a {
		    display: block;
		    text-align: center;
		}
	</style>
	
    <script type="text/javascript">
    $(document).ready(function() {
        $(".acf-field-62007adbb38a1").append('<div class="exportCert"><a href="<?php echo get_home_url(); ?>/profile/requests/view-accreditation-request/export-certificate/?post_id=<?php echo $get_post_id; ?>&acc_id=<?php echo $get_acc_id; ?>" class="acf-button button button-primary button-large" target="_new">Export Accreditation Certificate</a></div>');
    });
    </script>

</html>