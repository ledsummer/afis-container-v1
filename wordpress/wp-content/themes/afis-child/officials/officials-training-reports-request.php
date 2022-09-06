<?php
/* Template Name: Training Reports Requests */
get_header();
acf_form_head();
?>
<?php include( get_template_directory() . '-child/my-account/account-restriction.php' ); ?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>
<div class="container">

<div class="col-mid-15">
    <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
</div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter" style="height:100vh !important;">
        <div class="account-information">
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Training Reports Requests</div>
            
            
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
                <div class="tabs">
                    <input type="radio" name="tabs" id="monthly" checked="checked">
                    <label for="monthly">Monthly</label>
                    
                    <div class="tab">
                        <div class="col-mid-80"><h1>Monthly</h1></div> 
                        
                        <div class="clear"></div>
                        <br><br>
                        <?php include( get_template_directory() . '-child/officials/training-reports-requests/monthly-requests.php' ); ?>
                    </div>
                    
                    <input type="radio" name="tabs" id="pending">
                    <label for="pending">Quarterly</label>
                    
                    <div class="tab">
                        <div class="col-mid-80"><h1>Quarterly</h1></div> 
                        
                        <div class="clear"></div>
                        <br><br>
                        <?php include( get_template_directory() . '-child/officials/training-reports-requests/quarterly-requests.php' ); ?>
                    </div>
                    
                    
                    <input type="radio" name="tabs" id="quarter">
                    <label for="quarter">Yearly</label>
                    <div class="tab">
                        <div class="col-mid-80"><h1>Yearly</h1></div>  
                        
                        <div class="clear"></div>
                        <br><br>
                        <?php include( get_template_directory() . '-child/officials/training-reports-requests/yearly-requests.php' ); ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="no-tabs">
                    <?php include( get_template_directory() . '-child/officials/training-reports-requests/cea-training-reports.php' ); ?>
                </div>
                <style>
                    .no-tabs h1 {
                        margin: 5px 0px 5px 0px;
                        font-size: 22px;
                        font-weight: 700;
                        letter-spacing: 0px !important;
                        color: #212f57;
                        /* font-size: 13px !important; */
                        font-family: 'Asap', Arial;
                        text-transform: UPPERCASE;
                    }
                </style>
            <?php } ?>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
