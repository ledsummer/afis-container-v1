<?php 
/* Template Name: View Training Report Requests */ 
get_header();
acf_form_head();
?>
<?php include( get_template_directory() . '-child/my-account/account-restriction.php' ); ?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>

<div class="container">

<div class="col-mid-15">
    <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
</div>

<?php
    $reportID = $_GET['post_id'];
    $reportPT = get_post_type($reportID);
?>

<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;

$globalID;
$args_officialEmail = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'regional_officers'
    ),
    'post_status' => array(
        'publish'
    ),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'email_address',
            'value' => $email,
            'compare' => '=',
        )
    )
);

$variable_officialEmail = new WP_Query($args_officialEmail);
if ($variable_officialEmail->have_posts()): the_post(); ?>
    <?php while( $variable_officialEmail->have_posts() ): $variable_officialEmail->the_post(); ?>
        <?php $globalID = get_the_id(); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<div class="col-mid-85"  id="main-content">
    <div class="standardCenter" style="height:100vh !important;">
        <?php
        $currRole;
        foreach ( $user->roles as $role ){
            if(($role=="ses_cds-2") || ($role=="ses_senior_cds") || ($role=="ses_regional_director") || ($role=="ho_cds_1") || ($role=="ho_cds_2") || ($role=="ho_senior_cds") || ($role=="ho_chief_cds")){
                $currRole='cea';
            }else{
                $currRole='ctpro';    
            }
        }
        ?>
        
        <?php if($currRole == "ctpro") { ?>
            <div class="col-mid-70">
                <div class="account-information">
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="info-success">
                            You have successfully updated the status
                        </div>
                    <?php } ?>
                    <?php if($reportPT == 'monthly_reports') { ?>
                        <div class="headerAccount"><i class="fas fa-file-alt"></i> Monthly Training Report</div>
                        <br>
                        
                        <div class="label-information">Date of Training:</div>
        				<div class="data-information"><?php echo get_field('date_training', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Title of Training:</div>
        				<div class="data-information"><?php echo get_field('title_training', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">No. of Participants:</div>
        				<div class="data-information"><?php echo get_field('no_participants', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Venue of Training:</div>
        				<div class="data-information"><?php echo get_field('venue_training', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Amount of fees Charged per Training:</div>
        				<div class="data-information"><?php echo get_field('amount_fees', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Live Details:</div>
        				<div class="data-information"><?php echo get_field('option_live', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Resource Persons:</div>
        				<div class="data-information"></div>
        				<div class="clear"></div>
        				<table  class="customers">
        				    <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Institution Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if( have_rows('resource_persons', $reportID) ):
                                    while( have_rows('resource_persons', $reportID) ) : the_row(); ?>
                                        <tr>
                                            <td><?php echo get_sub_field('first_name', $reportID); ?></td>
                                            <td><?php echo get_sub_field('last_name', $reportID); ?></td>
                                            <td><?php echo get_sub_field('institution_name', $reportID); ?></td>
                                        </tr>
                                    <?php endwhile;
                                else :
                                endif;
                                ?>
                            </tbody>
        				</table>
        				<style>
        				    th {
        				        text-transform: capitalize;
        				    }
        				</style>
    				<?php } else if($reportPT == 'quarterly_reports') { ?>
    				    <div class="headerAccount"><i class="fas fa-file-alt"></i> Quarterly Training Report</div>
                        <br>
                        
                        <div class="label-information">Quarter Period:</div>
        				<div class="data-information"><?php echo get_field('quarter_period', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Year:</div>
        				<div class="data-information"><?php echo get_field('year', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">No of Crediting Hours:</div>
        				<div class="data-information"><?php echo get_field('crediting_hours', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Date of Training:</div>
        				<div class="data-information"><?php echo get_field('date_of_training', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Venue of Training:</div>
        				<div class="data-information"><?php echo get_field('venue_of_training', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Amount of Training of Participants:</div>
        				<div class="data-information"><?php echo get_field('amount_of_training_of_participants', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Remarks:</div>
        				<div class="clear"></div>
        				<div class="data-information"><?php echo get_field('remarks', $reportID); ?></div>
        			<?php } else if($reportPT == 'yearly_reports') { ?>
        			    <div class="headerAccount"><i class="fas fa-file-alt"></i> Yearly Training Report</div>
                        <br>
                        
                        <div class="label-information">Title of Training:</div>
        				<div class="data-information"><?php echo get_field('title_of_training', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Total No of Trainings Completed:</div>
        				<div class="data-information"><?php echo get_field('no_of_trainings', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">Date Conducted:</div>
        				<div class="data-information"><?php echo get_field('date_conducted', $reportID); ?></div>
        				<div class="clear"></div>
        				
        				<div class="label-information">No of Participants:</div>
        				<div class="data-information"><?php echo get_field('no_of_participants', $reportID); ?></div>
        				<div class="clear"></div>
    				<?php } ?>
                </div>
            </div>
            <div class="col-mid-30" style="padding-left: 25px;">
                <div class="account-information">
                    <div class="headerAccount"><i class="fas fa-user-edit"></i> Update Status</div>
                    <?php 
                        acf_form(array(
                            'post_id' => $reportID,
                            'field_groups' => array(
                                'group_61fc919349e09'   
                            ) ,
                            $reportID => array(
                                'post_type' => $reportPT,
                                'post_status' => 'publish',
                            ) ,
                            'updated_message' => __("", 'acf'),
                            'submit_value'  => __('Submit', acf),
                            'return' => "?post_id=".$reportID."&success=y",
                        ));
                    ?>
                    <style>
    				    .frontendhidden {
    				        display: block;
    				    }
    				    .alwaysHide {
    				        display: none;
    				    }
    				      .btn-download button, input[type="submit"], input[type="button"], input[type="reset"] {
    			          background: linear-gradient(to bottom, #4458b4 0%, #4054b2 100%)!important;
    			          border: none;
    			          border-bottom: 3px solid #4054b2 !important;
    			          padding: 10px !important;
    			          border: 0px !important;
    			          text-transform: UPPERCASE;
    			          font-size: 13px;
    			          font-family: 'Open Sans';
    			        }
    				</style>
                </div>
            </div>
            <div class="clear"></div>
        <?php } else { ?>
            <div class="account-information">
                <div class="headerAccount"><i class="fas fa-file-alt"></i> CEA Training Report</div>
                <br>
                
                <div class="label-information">Name:</div>
				<div class="data-information"><?php echo get_field('added_by', $reportID); ?></div>
				<div class="clear"></div>
				
				<div class="label-information">Title of Training:</div>
				<div class="data-information"><?php echo get_field('title_of_training', $reportID); ?></div>
				<div class="clear"></div>
                
                <div class="label-information">Date of Training:</div>
				<div class="data-information"><?php echo get_field('date_of_training', $reportID); ?></div>
				<div class="clear"></div>
				
				<div class="label-information">No. of Hours:</div>
				<div class="data-information"><?php echo get_field('no_of_hours', $reportID); ?></div>
				<div class="clear"></div>
				
				<div class="label-information">Training Provider:</div>
				<div class="data-information"><?php echo get_field('training_provider', $reportID); ?></div>
				<div class="clear"></div>
				
				<div class="label-information">Remarks:</div>
				<div class="data-information"><?php echo get_field('remarks', $reportID); ?></div>
				<div class="clear"></div>
				
				<div class="label-information">Attachment:</div>
				<div class="data-information"><a href="<?php echo get_field('attachment', $reportID)['url']; ?>" target="_new"><?php echo get_field('attachment', $reportID)['title']; ?></a></div>
				<div class="clear"></div>
				
            </div>
        <?php } ?>
        
    </div>
</div>
</div>
<div class="clear"></div>

<script>
    document.getElementById("acf-field_621db14d328f3").value = "<?php echo $globalID; ?>";
</script>
<?php get_footer(); ?>