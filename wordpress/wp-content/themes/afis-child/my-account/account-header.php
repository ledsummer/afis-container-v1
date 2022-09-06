<?php
if ( is_user_logged_in() ) {
}else{ ?>
<script>
    window.location.href = "<?php echo site_url(); ?>";
</script>
<?php } ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>-child/my-account/account.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>
<?php
    $current_user = wp_get_current_user();
    $email= $current_user->user_email;
    $user_roles = $current_user->roles;
   
    global $post_type;
    global $labelName;
    
    
  $posts = get_posts(array(
	        'numberposts'	=> 1,
	        'post_type'		=> array('cea','ctpro'),
	        'post_status'   => array('publish'),
        	'meta_query'	=> array(
		    'relation'		=> 'AND',
		    array(
			'key'	  	=> 'email',
			'value'	  	=> $email,
			'compare' 	=> '=',
		))));
       if ( have_posts() ) : while ( have_posts() ) : the_post();
        $cpost=get_the_ID();   
        $post_type = get_post_type( $cpost );
        if(get_field('type_of_cea') == "Firm"){
            $labelName =  get_field('firm_name');
        } else {
            $labelName= get_field('first_name')." ".get_field('last_name'); 
        }
          
    endwhile;
    endif;

   ?>
   <?php $thisPageID = get_queried_object_id(); ?>
  <div class="navigation-ciap">
            <div class="headerTop myaccount-header" id="accountHeadTop">
               <div class="flex">
                 <div class="col-mid-60">
                 <a href="#">CDA AFIS</a>
                 </div>
                  <div class="col-mid-10">
                     
                  </div>
                  <div class="col-mid-30" style="text-align:right;">
                  <div style="color:#000; font-family:Asap; text-transform:UPPERCASE; font-size:13px; cursor: default;" class="dropdown" id="dropdown"><i class="fas fa-user"></i>&nbsp; &nbsp;<?php  echo $labelName; ?>  </div>  
                  <div class="dropdown-content" id="dropdown-content">
                   <ul>
                    <li> <?php echo '<a href="#" class="btn-login" style="color:inherit;">  <i class="fas fa-user"></i> Account Settings</a>'; ?></li>
                    <!--<?php if($thisPageID=="132" || $thisPageID=="206"  || $thisPageID=="229"  || $thisPageID=="231" ) {} else { ?>-->
                    <!--    <li><?php  echo '<a href="'.wp_logout_url().'" class="btn-login" style="color:inherit;"> <i class="fas fa-key"></i>    Logout</a>'; ?></li>-->
                    <!--<?php } ?>-->
                   </ul> 
                  </div>
                  </div>
                  <div class="clear"></div>
               </div>
            </div>
