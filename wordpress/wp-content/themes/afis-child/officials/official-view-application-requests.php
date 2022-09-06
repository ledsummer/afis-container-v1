<?php 
/* Template Name: View Application Requests */ 
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
$user_id = get_current_user_id();
$user = new WP_User($user_id);
global $groupkey;
if (!empty($user->roles) && is_array($user->roles))
{
    foreach ($user->roles as $role)
    {
        if (($role == "crits_regional_director") || ($role=="ses_cds-2"))
        {
            $groupkey = 'group_61d2b97793359';
            $colmid = 'col-mid-60';
           echo '<style> .btn-default{ display:none; } </style>';
        }
        elseif ($role == "critd_supervising_cds")
        {
            $groupkey = 'group_61d2b9c28ee70';
            $colmid = 'col-mid-60';
            echo '<style> .recommendations, .btn-default{ display:none; } </style>';
        }
        else
        {
            $groupkey = 'group_61d91169501a2';
            $colmid = 'col-mid-85';
            echo "<style> #r_secondary{ display:none !important; </style>";
        }
    }
}

?>
<?php include( get_template_directory() . '-child/my-account/account-restriction.php' ); ?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>


<html>
<head>
	<title>
	</title>
</head>

<body>
	<div class="container">
		<div class="col-mid-15">
			<?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
		</div>


		<div class="col-mid-85">
			<div class="standardCenter-account">
				<?php
				if(isset($_GET['success'])){
				echo '<div class="info-success"> <i class="fas fa-check-circle"></i> Successfully Updated!</div>';
				include( get_template_directory() . '-child/officials/officia-insert-application.php' );
				}
				if(isset($_GET['post_id'])){
				$p=$_GET['post_id'];
				global $participant;
				$loop = new WP_Query(array(
				'numberposts'   => 1,
				'post_type'     => array('cea','ctpro'),
				'post_status'   => array('publish', 'pending'),
				'p'             => $p ));
				if ( $loop->have_posts() ):   while ( $loop->have_posts() ) : $loop->the_post();
				$cpost=get_the_ID(); 
				$participant=  get_field('first_name' )." ". get_field('middle_name'). " ". get_field('last_name'); 
				?>

				<div class="profile-name-view">
					<div class="profileBg">
					    <?php if(get_field('type_of_cea', $_GET['post_id']) == "Firm") { ?>
    					    <h3><?php echo get_field('firm_name', $_GET['post_id']); ?></h3>
					    <?php } else { ?>
    						<h3><?php echo  get_field('first_name' ); ?> <?php echo  get_field('middle_name'); ?> <?php echo  get_field('last_name'); ?></h3>
						<?php } ?>
					</div>


					<div class="clear">
					</div>
				</div>
			</div>
		</div>
		


		<div class="<?php echo $colmid; ?>" id="main-content">
			<div class="standardCenter-account">
				<div class="account-information">
					<div class="navigation-menu">
						<a class="btn-default" href="http://afis.beecr8tive.net/profile/requests/accreditation-requests/submit-recommendation/?post_id=<?php echo $p; ?>" target="_blank"><i class="fas fa-file-alt"></i> Submit Your Recommendation</a>
					</div>

					<div class="headerAccount">
						<i class="fas fa-file-alt"></i> AFIS Account Information
					</div>

					<?php if(get_post_type($get_post_id) == "cea"){ ?>
                    <div class="label-information">CDA CEA No:</div> <div class="data-information"><?php echo get_field('cea-no'); ?></div>
                    <div class="clear"></div>
                    <?php } else { ?>
                    <div class="label-information">CA No:</div> <div class="data-information"><?php echo get_field('ca-no'); ?></div>
                    <div class="clear"></div>
                    <?php } ?>


					<div class="headerAccount">
						<i class="fas fa-file-alt"></i> Account Type
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
                    <div class="label-information">SEC Registration No.:</div> <div class="data-information"><?php echo  get_field('prc_id_no' ); ?></div>
                    <div class="clear"></div>
                    
                    <div class="label-information">SEC Registration Validity:</div> <div class="data-information"><?php echo date_format(date_create(get_field('prc_id_validity' )),"F d, Y"); ?></div>
                    <div class="clear"></div>
                    
                    <div class="label-information">PRC BOA Accreditation No.:</div> <div class="data-information"><?php echo  get_field('prc_boa_accreditation_no_' ); ?></div>
                    <div class="clear"></div>
                    
                    <div class="label-information">PRC BOA Accreditation Validity:</div> <div class="data-information"><?php echo date_format(date_create(get_field('prc_boa_accreditation_validity' )),"F d, Y"); ?></div>
                    <div class="clear"></div>
                    <?php } ?>
                    
                    <?php if(get_post_type($_GET['post_id']) == "cea"){ ?>
                        <?php if(get_field('type_of_cea', $_GET['post_id']) == "Firm") { ?>
                            <div class="headerAccount"><i class="fas fa-file-alt"></i> Firm Information</div>
                            <div class="label-information">Firm Name:</div> <div class="data-information"><?php echo get_field('firm_name', $_GET['post_id']); ?></div>
                            <div class="clear"></div>
                            
                            <?php if( have_rows('signing_partner', $_GET['post_id']) ): ?>
                                <div class="label-information">Signing Partner Name:</div>
                                <div class="data-information">
                                    <ul style="margin:0; clear:both;">
                        			    <?php while( have_rows('signing_partner', $_GET['post_id']) ): the_row(); ?>
                            			    <?php if(get_sub_field('partner_middle_name')){ ?>
                                                <li><?php echo get_sub_field('partner_first_name', $_GET['post_id']).' '.get_sub_field('partner_middle_name', $_GET['post_id']).' '.get_sub_field('partner_last_name', $_GET['post_id']); ?></li>
                                            <?php } else { ?>
                                                <li><?php echo get_sub_field('partner_first_name', $_GET['post_id']).' '.get_sub_field('partner_last_name', $_GET['post_id']); ?></li>
                                            <?php } ?>
                            			<?php endwhile; ?>
                    			    </ul>
                    			</div>
                    			<div class="clear"></div>
                            <?php endif; ?>
                        <?php } ?>
                    <?php } ?>

					<div class="headerAccount">
						<i class="fas fa-file-alt"></i> Application Information
					</div>

                    <?php if(get_field('type_of_cea') != "Firm") { ?>
					<div class="label-information">First Name:</div>
					<div class="data-information"><?php echo  get_field('first_name' ); ?></div>
					<div class="clear"></div>

					<div class="label-information">Middle Name:</div>
					<div class="data-information"><?php echo  get_field('middle_name'); ?></div>
                    <div class="clear"></div>

					<div class="label-information">Last Name:</div>
					<div class="data-information"><?php echo  get_field('last_name'); ?></div>
					<div class="clear"></div>
					<?php } ?>
					
					<?php if(get_field('type_of_cea') == "Individual") { ?>
					<div class="label-information">Birthday:</div>
					<div class="data-information"><?php echo date_format(date_create(get_field('birthdate' )),"F d, Y"); ?></div>
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
				</div>
			</div>
		</div>
	</div>


	<div class="col-mid-25 displayTrainingReports" id="r_secondary">
		<div class="rightaccountWrapper">
			<div class="announcement">
				<div class="headerAccountSidebar">
					<i class="fas fa-user-edit"></i> Update Status
				</div>
				<?php include( get_template_directory() . '-child/officials/official-application-update-status.php' ); ?>
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
				        .account-information{
				            margin-bottom:20px !important;
				        }
				        .leftaccountWrapper {
                            height: 3100px !important;
                        }
				</style>
				
				<div class="headerAccountSidebar">
					<i class="fas fa-users"></i> Accreditation Officers
				</div>
                <div class="multiselect">
                    <?php include( get_template_directory() . '-child/officials/delegates.php' ); ?>
                </div>
			</div>
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
	</style>
</body>
</html>