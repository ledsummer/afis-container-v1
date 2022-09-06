<?php
/* Template Name: Cooperative Clients */
get_header();
acf_form_head();
?>
<?php include ("account-header.php"); ?>
<div class="container">

<div class="col-mid-15">
        <?php include ("account-sidebar.php"); ?>
 </div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter flex" style="height:100vh !important;">
   <div class="account-information" style="width:100%;">
<div class="headerAccount"><i class="fas fa-certificate"></i> List of Cooperative Clients</div>
        
   <div class="tabs">

    <input type="radio" name="tabs" id="listcert" checked="checked">
    <label for="listcert"></label>
    <div class="tab">
      <div class="col-mid-80"><h1></h1></div>  <div class="col-mid-20" style="text-align:right;">
          <a href="cooperative-clients-submission/" class="nextbtn" target="_blank"><button>Add New</button></a></div>
     
      <div class="clear"></div>
       <br>
       
      <?php include( get_template_directory() . '-child/cooperative-clients/cooperatives-client-table.php' ); ?>
           
        </div>   
  </div>


  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
  function displayForm() {
      document.getElementById("hide").style.display = "block";
  }

</script>
        </div>
    </div>


</div>

</div>
<div class="clear"></div>
<?php get_footer(); ?>
