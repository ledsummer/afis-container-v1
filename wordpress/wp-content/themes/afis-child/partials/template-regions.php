<?php 
  /* Template Name: regions */ 
  get_header(); 
  acf_form_head();
  ?>
  
  
  <?php
    $date = date('F j, Y \a\t g:i A');
	acf_form(array(
		'post_id'		=> 'new_post',
		'field_groups'	=> array(
            'group_621456bf521c0',  // ACF > Regions
		),

		'new_post'		=> array(
            'post_type'		=> 'post',
            'post_title'	=> $date,
            'post_status'	=> 'publish',

        ),

		'return' => add_query_arg(array('updated' => 'true'), get_permalink()),
		'submit_value'  => __('Submit', acf)
	));
  
  ?>

<?php get_footer(); ?>