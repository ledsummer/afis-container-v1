<?php
if(isset($_GET['deleterequest'])){
    $deleteid=$_GET['deleterequest'];
   echo "<div class='info-success'><i class=\"fas fa-check-circle\"></i> Successfully Deleted!</a></div>";
   wp_delete_post($deleteid);
}elseif(isset($_GET['cancelled'])){
     echo "<div class='info-success'><i class=\"fas fa-check-circle\"></i> Successfully Cancelled for Deletion!</a></div>";
}else{
    
}
?>

<?php
//Documents Reports
$docReqID;
$current_user = wp_get_current_user();
$email = $current_user->user_email;

$args_officialEmail = array(
    'posts_per_page' => -1,
    'post_type' => array(
        'cea',
        'ctpro'
    ),
    'post_status' => array(
        'publish'
    ),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'email',
            'value' => $email,
            'compare' => '=',
        )
    )
);

$variable_officialEmail = new WP_Query($args_officialEmail);
if ($variable_officialEmail->have_posts()): the_post(); ?>
    <?php while( $variable_officialEmail->have_posts() ): $variable_officialEmail->the_post(); ?>
        <?php
        if($email == get_field('email')){ ?>
            <?php
            $args = array(
                'posts_per_page' => 1,
                'post_type' => array(
                    'training_requirement'
                ),
                'post_status' => array(
                    'publish'
                ),
                's' => $_GET['success']
            );
        
            $variable = new WP_Query($args);
            if ($variable->have_posts()): the_post(); ?>
                <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                    <?php $docReqID = get_the_id(); ?>
                    <iframe src="<?php echo get_field('document', get_the_id())['url']; ?>" style="width: 100%; height: 700px;"></iframe>
                    <a class="btn-download" href="<?php echo get_home_url().'/training-documents-submission/?rep='.$docReqID.'&to='.$_GET['success']; ?>"><button>Replace File</button></a>
                <?php endwhile; ?>
            <?php else : ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        <?php } ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>