<?php
/* Template Name: My Certification */
get_header();
acf_form_head();
?>
<?php include ("account-header.php"); ?>
<div class="container">

<div class="col-mid-15">
        <?php include ("account-sidebar.php"); ?>
 </div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter">
   
         
<div class="account-information">
<div class="headerAccount"><i class="fas fa-certificate"></i> My Certifications</div>

<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;
$posts = get_posts(array('numberposts' => 1, 'post_type' => array('cea', 'ctpro'), 'post_status' => array('publish'), 
'meta_query' => array('relation' => 
'AND',
array('key' => 'email', 'value' => $email, 'compare' => '=',),
array('key' => 'application', 'value' => "1", 'compare' => '=',),
)));
if (have_posts()):
    while (have_posts()):
    the_post();
    $cpost = get_the_ID();
    $token = get_field('confirmation_key');
    $name  = get_field('first_name')." ".get_field('middle_name')." ". get_field('last_name'); 

    //CheckIfExist
    $checkifExist = array('numberposts' => -1, 'post_type' => array('certifications'), 'post_status' => array('publish'),  'meta_query' => array('relation' => 
    'AND', array('key' => 'user_id', 'value' => $cpost , 'compare' => '=')));

    $num_rows = count( $checkifExist ); //PHP count()
    if($num_rows > 0){
    $the_query = new WP_Query( $checkifExist );
    if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) : $the_query->the_post(); 
    $status = get_field('status');
    if($status=="Pending"){
    echo '<div class="info-alert"><i class="fas fa-exclamation-circle"></i> You have pending certification is waiting for approval.</div>';
    $certification='Not Available';
    }else{
      $certification='<a href="#"><i class="fas fa-file-pdf"></i> Download</a>'; 
    }
    ?>
    <table id="customers">
    <tr>
    <th>Date Requested</th>  <th>Certification Type</th>  <th>Status</th>  <th>My Digital Signature</th>  <th>Download</th>
    </tr>
    <tr><td><?php the_date(); ?></td><td><?php echo get_field('type_of_certifications'); ?></td><td><?php echo get_field('status'); ?></td>
    <td><a href="<?php echo get_field('signature'); ?>" target="_blank" style="text-align:center; color:darkblue; "><i class="fas fa-image"></i> Check Image</a></td><td style="text-align:center;"><?php echo $certifcation; ?></td></tr>
    </table>
<?php  
endwhile; 
wp_reset_postdata();
} else { 

?>
<center><img src="http://afis.beecr8tive.net/wp-content/uploads/2021/12/logo-menu.png" class="logosidebar"></center>
<h3 style="text-align: center;">PLEDGE OF COMMITMENT</h3>
<div class="oathaking">
    <div class="content">
       I <b><?php the_field('first_name'); ?> <?php the_field('middle_name'); ?> <?php the_field('last_name'); ?></b> <?php the_field('certification_content', 'option'); ?>
 
  <?php
  
   acf_form(array(
                'post_id'		=> 'new_post',
                'field_groups'  => array(
                'group_61d15218d8aba',
                'group_61ca5de56cf9d'
                ),
                'new_post'		=> array(
                
                'post_title'    =>  $token,
                'post_type' 	=> 'certifications',
                'post_status'	=> 'publish',
                
                
                ),
                'updated_message' => __("", 'acf'),
                'submit_value'  => __('I Agree and Submit', acf),
                'return' => "?success=$token",
                ));
?>
    
              
                       
    </div>
</div>

                <script>
                document.getElementById("acf-field_61d1526d41ef0").value = "<?php echo $name; ?>";
                document.getElementById("acf-field_61d15952d907e").value = "<?php echo get_field('ca-no'); ?>";
                document.getElementById("acf-field_61d1583608143").value = "<?php echo $cpost; ?>";
                document.getElementById("acf-field_61d1528b41ef2").value = "Pledge of Commitment";
               
                </script>
                
<?php
} }
endwhile;
endif;
?>




        </div>
    </div>


</div>

</div>
<div class="clear"></div>
<?php get_footer(); ?>