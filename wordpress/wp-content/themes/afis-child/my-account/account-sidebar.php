<?php
$pageID=get_queried_object_id();

if($pageID=="334"){
$sidebarquery="nothing";
}else{
$sidebarquery="secondary";    
}
    $user_id = get_current_user_id();
    $user = new WP_User( $user_id );
    global $myrole;
    
    if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
    foreach ( $user->roles as $role ){
   
    
    if($role=="ctpro"){
    $myrole='ctpro';
  
    }elseif($role=="cea"){
    $myrole='cea';    
    
    }elseif(($role=="critd_supervising_cds") || ($role=="crits_regional_director") || ($role=="ses_cds-2")){
    $myrole='regional_officer';    
    
    }else{
    $myrole='officials';    
    }
    
    }
    }
?>
 
<div class="leftaccountWrapper" id="<?php echo $sidebarquery; ?> leftaccountWrapper">

<center><img src="<?php echo site_url(); ?>/wp-content/uploads/2021/12/logo-menu.png" class="logosidebar" id="logosidebar"></center>
      <div class="menu" id="main-menu">
          <?php 
          if($myrole=="cea"){
                        wp_nav_menu( array( 
                         'theme_location' => 'quick_links', 
                        'container_class' => 'quick_links' ) );
          }elseif($myrole=="ctpro"){
                         wp_nav_menu( array( 
                         'theme_location' => 'ctpro_menu', 
                        'container_class' => 'quick_links' ) );   
          }elseif($myrole=="regional_officer"){
                        wp_nav_menu( array( 
                         'theme_location' => 'regional_officer', 
                        'container_class' => 'quick_links' ) );   
          }else{
                        wp_nav_menu( array( 
                         'theme_location' => 'officials_menu', 
                        'container_class' => 'quick_links' ) );   
          } ?>  
          <div id="menu-logout">
              <li>
                  <?php  echo '<a href="'.wp_logout_url().'"> <i class="fas fa-key"></i>    Logout</a>'; ?>
              </li>
          </div>
          
          
      </div>
      
      <?php if($role == "cea") { ?>
        <?php if(get_field('application', get_the_id()) == "1") { ?>
            <style>
                #menu-item-1760 { display: none; }
            </style>
        <?php } ?>
      <?php } ?>
      
      <?php if(($role == 'crits-cds_1') || ($role == 'crits-senior_cds') || ($role == 'ses_cds-2') || ($role == 'ses_senior_cds')) { ?>
          <style> #menu-item-1397, #menu-item-1412 { display: block; } </style>
      <?php } else { ?>
          <style> #menu-item-1397, #menu-item-1412 { display: none; } </style>
      <?php } ?>
      <!-- / Contact Us -->
      
      <?php if(($role == 'ho_senior_cds') || ($role == 'ho_chief_cds')) { ?>
        <style> 
            #menu-item-1672 { display: block; }
            #menu-item-1671 { display: none; }
        </style>
      <?php } else { ?>
          <style> #menu-item-1672 { display: none; } #menu-item-1671 { display: none; } </style>
      <?php } ?>
      <!-- / For Approval -->
      
      
      <?php if(($role == 'crits-cds_1') || ($role == 'crits-senior_cds') || ($role == 'crits_regional_director') || ($role == 'critd_cd-2') || ($role == 'critd_chief_of_division') || ($role == 'critd_senior_cds') || ($role == 'critd_supervising_cds')) { ?>
          <style>
              #menu-item-1671 {
                  display: none!important;
              }
          </style>
      <?php } ?>
      
      <?php if(($role == 'ses_cds-2') || ($role == 'ses_senior_cds') || ($role == 'ses_regional_director') || ($role == 'ho_cds_1') || ($role == 'ho_cds_2') || ($role == 'ho_senior_cds') || ($role == 'ho_chief_cds')) { ?>
          <style> #menu-item-1111, #menu-item-1112 { display: none; } </style>
      <?php } else { ?>
          <style> #menu-item-1616, #menu-item-1617 { display: none; } </style>
      <?php } ?>
      <!-- / Training Reports -->
      
      <div class="helpdesk" id="helpdesk">
          Helpdesk: 
          <br><i class="fas fa-envelope"></i> helpdesk@cda.gov.ph;
          <br><i class="fas fa-phone"></i> (02) 8725-3764

          <br/><br/>
          CRITD:
          <br/><i class="fas fa-envelope"></i> critd@cda.gov.ph;
          <br/><i class="fas fa-phone"></i> (02) 8725-6604

          <br/><br/>
          SED: 
          <br/><i class="fas fa-envelope"></i> sed@cda.gov.ph; 
          <br/><i class="fas fa-phone"></i> (02) 8725-8536
          
          <br/><br/>
          <i class="fab fa-chrome"></i> Website : <a href="https://www.cda.gov.ph" style="color:inherit">www.cda.gov.ph</a>
      </div>
     
  </div>
   