<?php 
/* Template Name: View Certificate */ 
get_header();
acf_form_head();

if ( is_user_logged_in() ) {
}else{ ?>
<script>
    window.location.href = "<?php echo site_url(); ?>";
</script>
<?php } 
$get_post_id = $_GET['post_id'];
$get_acc_id = $_GET["acc_id"];
$user_id = get_current_user_id();
$user = new WP_User($user_id);

$returnedID; $returnedRegion;
$args_officialEmail = array(
    'posts_per_page'   => -1,
    'post_type' => array(
        'regional_officers'
    ),
    'post_status' => array(
        'publish',
        'pending'
    )
);

$variable_officialEmail = new WP_Query($args_officialEmail);
if ($variable_officialEmail->have_posts()): the_post(); ?>
    <?php while( $variable_officialEmail->have_posts() ): $variable_officialEmail->the_post(); ?>
        <?php
        if($user->user_email == get_field('email_address')){
            $returnedID = get_the_id();
            $returnedRegion = get_field('region');
        }
        ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query();

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
            echo '<style> .btn-default{ display:none; } </style>';
        }
        elseif (($role == "critd_chief_of_division") || ($role == "ho_chief_cds"))
        {
            $groupkey = 'group_61d2b9c28ee70';
            $colmid = 'col-mid-60';
            echo '<style> .recommendations, .btn-default{ display:none; } </style>';
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
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/officials/style-print.css">

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
				<? 
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
		
		<div class="col-mid-85" id="main-content">
			<div class="standardCenter-account">
				<div class="account-information acct-info-cert">
				    <div id="printversion" oncontextmenu="return false;" style="width: 50%; border: 1px solid #ccc;">
                        <?php $date = strtotime(get_field('date_of_approval', $get_acc_id)); ?>
                        <?php $initial_renewal = get_field('application', $get_acc_id); ?>
                        <?php $cert_url; ?>
                        <?php $thisType; ?>
                        
                        <?php if(get_post_type($_GET['post_id']) == "ctpro") { ?>
                            <?php if($initial_renewal == 1){ 
                                $thisType = "CDA CTPRO No. ".get_field('cea-no');
                                $cert_url = 'ctpro_certificate';
                            } else {
                                $thisType = "CDA CTPRO No. ".get_field('cea-no');
                                $cert_url = 'ctpro_certificate_renewal';
                            }
                            ?>
                            <img src="<?php echo get_field($cert_url, 'options')['url']; ?>" width="100%" height="auto" alt="Print Page">
                        <?php } else { ?>
                            <?php if($initial_renewal == 1){ 
                                $thisType = "CDA CEA No. ".get_field('cea-no');
                                $cert_url = 'cea_certificate'; ?>
                                <style>
                                    .account-information #printversion .print-no {
                                        right: 0%;
                                    }
                                </style>
                            <?php
                            } else {
                                $thisType = "CDA CEA No. <br>".get_field('cea-no');
                                $cert_url = 'cea_certificate_renewal'; ?>
                                <style>
                                    .account-information #printversion .print-no {
                                        top: 18%;
                                        right: 6%;
                                    }
                                    .account-information #printversion .print-day {
                                        top: 70.5%;
                                        left: 29.5%;
                                    }
                                    .account-information #printversion .print-month {
                                        top: 70.5%;
                                        left: 44%;
                                    }
                                    .account-information #printversion .print-city2 {
                                        top: 70.5%;
                                        left: 67%;
                                    }
                                    .account-information #printversion .print-validFrom {
                                        top: 74.3%;
                                        left: 33%;
                                    }
                                    .account-information #printversion .print-validTo {
                                        top: 74.3%;
                                        left: 52%;
                                    }
                                    .account-information #printversion .print-boardReso {
                                        top: 77%;
                                        left: 43%;
                                    }
                                    .account-information #printversion .print-boardResoDate {
                                        top: 77%;
                                        left: 64%;
                                    }
                                </style>
                            <?php
                            }
                            ?>
                            <img src="<?php echo get_field($cert_url, 'options')['url']; ?>" width="100%" height="auto" alt="Print Page">
                        <?php } ?>
                        <div class="print-no">
                            <center><?php echo $thisType; ?></center>
                        </div>
                        <div class="print-name">
                            <?php if(get_field('type_of_cea') == "Firm") { ?>
                                <?php
                                if( have_rows('signing_partner') ) {
                                    while( have_rows('signing_partner') ) {
                                        the_row();
                                        $first_row_title = get_sub_field('title');
                                        if(get_sub_field('partner_middle_name')){
                                            echo get_sub_field('partner_first_name').' '.get_sub_field('partner_middle_name').'. '.get_sub_field('partner_last_name');
                                        } else {
                                            echo get_sub_field('partner_first_name').' '.get_sub_field('partner_last_name');
                                        }
                                
                                        break;
                                    }
                                } else {
                                    echo get_field('firm_name');
                                }
                                ?>
						    <?php } else { ?>
                                <?php if(get_field('middle_initial')){ ?>
                                    <?php echo get_field('first_name').' '.get_field('middle_initial').'. '.get_field('last_name').' '.get_field('suffix'); ?>
                                <?php } else { ?>
                                    <?php echo get_field('first_name').' '.get_field('last_name').' '.get_field('suffix'); ?>
                                <?php } ?>
						    <?php } ?>
                        </div>
                        <div class="print-city1">
                            <?php echo get_field('city', $get_post_id).' City , '.get_field('province', $get_post_id); ?>
                        </div>
                        <div class="print-day">
                            <?php echo date('jS', $date); ?>
                        </div>
                        <div class="print-month">
                            <?php echo date('F', $date); ?>
                        </div>
                        <div class="print-city2">
                            <?php echo get_field('city', $returnedID).' City'; ?>
                        </div>
                        <div class="print-validFrom">
                            <u><?php echo get_field('date_of_approval', $get_acc_id); ?></u>
                        </div>
                        <div class="print-validTo">
                            <u><?php echo get_field('end_of_accreditation_validity', $get_acc_id); ?></u>
                        </div>
                        <div class="print-boardReso">
                            <u><?php echo get_field('board_resolution_no', $get_acc_id); ?></u>
                        </div>
                        <div class="print-boardResoDate">
                            <u><?php echo get_field('date_of_approval', $get_acc_id); ?></u>
                        </div>
                    </div>
                    
                    <div class="submit-btn" style="margin-top: 25px;">
                        <div class="buttons text-align-right">
                            <a class="site-btn printit" href="javascript:window.print()">Print</a>
                        </div>
                    </div>
                    
                    
					<?php
					endwhile;
					else:
					echo '<div class="info-alert" style="margin-top:10px;"> No Available Information. Either you enter a wrong post id or invalid wrong URL. </div>';
					endif;
					?>
					
					<?php wp_reset_query(); ?>

				</div>
			</div>
		</div>
	</div>
	
	<div class="col-mid-25 displayTrainingReports" id="secondary">
		<div class="rightaccountWrapper">
		    
			<?php }else{
			echo '<div class="info-alert" style="margin-top:10px;"> No Available Information</div>';
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
	</style>
	
	

</html>