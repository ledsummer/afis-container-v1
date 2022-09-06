<?php
/* Template Name: Edit Training Documents*/
get_header();
acf_form_head();
?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>
<div class="container">

<div class="col-mid-15">
  <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
 </div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter " style="height:100vh !important;">
   <div class="account-information">
<div class="headerAccount"><i class="fas fa-file-alt"></i> Submit your Training Documents</div>
  <?php
if (isset($_GET['success']))
{
?>
<div class="info-success">
You have successfully edited your training documents
</div>
 <?php include( get_template_directory() . '-child/training-documents/training-documents-table.php' ); ?>
<?php
}
else
{

        
                   
            ?>
                <?php 
                $queryID=$_GET['queryid'];
                    acf_form(array(
                'post_id' => $queryID ,
                'field_groups' => array(
                    'group_61de5f2107f9c'   
                ) ,
                $queryID => array(
                    'post_type' => 'training_requirement',
                    'post_status' => 'publish',
                ) ,
                'updated_message' => __("", 'acf'),
                'submit_value'  => __('Submit', acf),
                'return' => "?success=$cpost",
            ));

                ?>
                
            <?php
            

            }
        
      
    
?>



                <script>
                document.getElementById("acf-field_61de682e871a6").value = "<?php echo $name; ?>";
                document.getElementById("acf-field_61de680d871a5").value = "<?php echo $ca; ?>";
                document.getElementById("acf-field_61de67dc871a4").value = "<?php echo $cpost; ?>";

               </script>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
