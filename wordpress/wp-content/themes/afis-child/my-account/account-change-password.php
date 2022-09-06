<?php
/* Template Name: Dashboard */
get_header();
acf_form_head();
?>
<?php include( get_template_directory() . '-child/my-account/account-restriction.php' ); ?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>

<div class="container">

<div class="col-mid-15">
   <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
 </div>
 <div class="col-mid-85" >
      <div class="standardCenter-account">
 
           <div class="profile-name-view">
             <div class="profileBg"><h3>Welcome <?php  echo $current_user->user_firstname; ?> <?php  echo $current_user->user_lastname; ?> </h3></div>
             <div class="clear"></div>
             </div>
   </div>
     </div>              
 <div class="col-mid-85" >
      <div class="standardCenter-account">

           <div class="account-information">Change Password</div>
    
 
        </div>
    </div>
</div>

<div class="clear"></div>
</div>

<?php get_footer(); ?>