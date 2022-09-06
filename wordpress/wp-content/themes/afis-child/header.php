<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
 acf_form_head();
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://cda.gov.ph/wp-content/uploads/2021/03/favicon-2.ico" />
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    
    
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/officials/assets/vanillaSelectBox.css">
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/officials/assets/vanillaSelectBox.js?v0.75"></script>
    
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php
	 $parent_title = get_the_title($post->post_parent);
	if($parent_title=="Profile"){
	    
	}else{
    ?>
	<div id="page">
	    <div class="navigation-ciap">
            <div class="headerTop">
               <div class="standardCenter flex">
                 <div class="col-mid-10">
                 <a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/06/CDA-new-logo-1.png" class="logo"></a>
                 </div>
                  <div class="col-mid-50">
                     <?php
                        wp_nav_menu( array( 
                         'theme_location' => 'top_head_menu', 
                        'container_class' => 'top_head_menu' ) );
                        ?>  
                  </div>
                  <div class="col-mid-40 login" >
                  <a href="https://cda.gov.ph/cda-privacy-policy/" target="_blank"><i class="fas fa-lock"></i>   Privacy and Policy</a>
                  </div>
                  <div class="clear"></div>
               </div>
            </div>
<?php } ?>
		<div id="main">
