<?php
/* Template Name: Privacy and Policy  */
get_header();
acf_form_head();
?>
<?php include ("account-header.php"); ?>
<div class="container">

<div class="col-mid-15">
        <?php include ("account-sidebar.php"); ?>
 </div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter " style="height:100vh !important;">
   <div class="account-information">
<div class="headerAccount"><i class="fas fa-certificate"></i> Privacy and Policy</div>
        
<?php the_field('privacy_and_policy_content',option); ?>

  

        </div>
    </div>


</div>

</div>
<div class="clear"></div>
<?php get_footer(); ?>
