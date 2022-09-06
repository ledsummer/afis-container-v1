<?php
/* Template Name: Regional Officer Approval Requests */
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
    <div class="standardCenter flex" style="height:100vh !important;">
   <div class="account-information">
<div class="headerAccount"><i class="fas fa-file-alt"></i> Accreditation Requests</div>
        

       
   <div class="tabs">

    <input type="radio" name="tabs" id="monthly" checked="checked">
    <label for="monthly">Approved Applications</label>
    <div class="tab">
      <div class="col-mid-80"><h1>All Approved Applications</h1></div> 
     
      <div class="clear"></div>
       <br><br>
       
      
    </div>
    
    
     <input type="radio" name="tabs" id="pending" checked="checked">
    <label for="pending">Pending Applications</label>
    <div class="tab">
      <div class="col-mid-80"><h1>All Pending Applications</h1></div> 
     
      <div class="clear"></div>
       <br><br>
       
     <?php include( get_template_directory() . '-child/regional-officer/cooperatives/pending.php' ); ?>
      
      
      
    </div>


    <input type="radio" name="tabs" id="quarter">
    <label for="quarter">Deferred Applications</label>
    <div class="tab">
     <div class="col-mid-80"><h1>All Deferred Applications</h1></div>  
      <div class="clear"></div>
       <br><br>
        
    </div>

  </div>


      </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
