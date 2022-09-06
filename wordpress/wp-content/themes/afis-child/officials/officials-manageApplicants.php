<?php
/* Template Name: Manage Applicants */
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
                <div class="headerAccount"><i class="fas fa-file-alt"></i> Applications</div>
                
                <div class="tabs">
                
                    <input type="radio" name="tabs" id="monthly" checked="checked">
                    <label for="monthly">For Approved Applicants</label>
                    <div class="tab">
                        <div class="col-mid-80"><h1>All For Approved Applicants</h1></div> 
                        
                        <div class="clear"></div>
                        <br><br>
                        <?php include( get_template_directory() . '-child/officials/manage-applicants/for-approve.php' ); ?>
                    </div>
                    
                    
                    <input type="radio" name="tabs" id="pending">
                    <label for="pending">Expiry Applicants</label>
                    <div class="tab">
                        <div class="col-mid-80"><h1>All Expiry Applicants</h1></div> 
                        
                        <div class="clear"></div>
                        <br><br>
                        <?php include( get_template_directory() . '-child/officials/manage-applicants/expiry.php' ); ?>
                    </div>
                    
                    
                    <input type="radio" name="tabs" id="quarter">
                    <label for="quarter">Red Flag Applicants</label>
                    <div class="tab">
                        <div class="col-mid-80"><h1>All Red Flag Applicants</h1></div>  
                        <div class="clear"></div>
                        <br><br>
                        <?php include( get_template_directory() . '-child/officials/manage-applicants/red-flag.php' ); ?>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
