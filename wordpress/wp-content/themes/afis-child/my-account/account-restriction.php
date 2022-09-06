 <?php 
    $user_id = get_current_user_id();
    $user = new WP_User( $user_id );

    if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
    foreach ( $user->roles as $role ){
    if($role=="ctpro" || $role=="cea" ){
    $url="../restricted-access/";
    wp_redirect( $url );
    exit;   
    }
    }
    }
?>  