<?php
/* Template Name: Documentary Requirement Requests */
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
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Documentary Requirement Requests</div>
            <div class="tabs">
                
                <input type="radio" name="tabs" id="monthly" checked="checked">
                <label for="monthly"></label>
                
                <div class="tab">
                    <?php include( get_template_directory() . '-child/officials/documentary-requirements-requests/documentary-requirements.php' ); ?>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
