<?php
/* Template Name: Application Requests */
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
            <div class="headerAccount"><i class="fas fa-users"></i> Application Requests</div>
            <div class="tabs">
                <input type="radio" name="tabs" id="pending" checked="checked">
                <label for="pending">Applications</label>
                <div class="tab">
                    <div class="col-mid-80"><h1>All Applications</h1></div> 
                    <div class="clear"></div>
                    <br><br>
                    <?php include( get_template_directory() . '-child/officials/application-requests/requests.php' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
