<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;
$posts = get_posts(array(
    'numberposts' => 1,
    'post_type' => array(
        'cea',
        'ctpro'
    ) ,
    'post_status' => array(
        'publish'
    ) ,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'email',
            'value' => $email,
            'compare' => '=',
        ) ,
        array(
            'key' => 'application',
            'value' => "1",
            'compare' => '=',
        ) ,
    )
));
if (have_posts()):
    while (have_posts()):
        the_post();
        $cpost = get_the_ID();
        $token = get_field('confirmation_key');
        $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');

        //CheckIfExist
        $checkifExist = array(
            'numberposts' => - 1,
            'post_type' => array(
                'accreditations'
            ) ,
            'post_status' => array(
                'publish'
            ) ,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'post_id',
                    'value' => $cpost,
                    'compare' => '='
                )
            )
        );

        $num_rows = count($checkifExist); //PHP count()
        if ($num_rows > 0)
        {
            $the_query = new WP_Query($checkifExist);
            if ($the_query->have_posts())
            {
                while ($the_query->have_posts()):
                    $the_query->the_post();
                    $status_ses = get_field('status_ses');
                    $status_sed = get_field('status_sed');
        ?>
        
         <div class="account-information">
           <div class="headerAccount"><i class="fas fa-file-alt"></i> Application Status</div>
          
           <b>Status:</b> 
           <?php
            if ($status_ses == "Deferred"){
            ?>
           <span style="color:red;"> <?php the_field('status_ses'); ?></span>
           
           <?php }else{ ?>
           
             <span style="color:blue;"> <?php the_field('status_ses'); ?></span>
             
           <?php } ?>
          <div class="headerAccount"><i class="fas fa-comments"></i> Remarks</div>
            
          <div class="remarks-info" >
              <?php the_field('remarks_ses'); ?>
          </div>
            
                   
       <?php
                endwhile;
                wp_reset_postdata();
            }
            else
            {

            }
        }
    endwhile;
endif;
?>
