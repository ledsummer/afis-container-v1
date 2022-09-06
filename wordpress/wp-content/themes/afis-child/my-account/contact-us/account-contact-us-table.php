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
// Ticket Concerns
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
        'publish',
        'pending'
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
            <table id="ticketConcerns"  class="customers">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Ticket ID</th>
                        <th>Concern</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $args = array(
                        'post_type' => array(
                            'ticket_requests'
                        ),
                        'post_status' => array(
                            'publish'
                        ),
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key'   => 'user_id',
                                'value' => get_the_ID(),
                                'compare' => '='
                            ),
                            array(
                                'key'   => 'ticket_id',
                                'value' => '',
                                'compare' => '='
                            )
                        )
                    );
                
                    $variable = new WP_Query($args);
                    if ($variable->have_posts()): the_post(); ?>
                        <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                            <?php 
                            $ticket_ID = get_the_title();
                            $queryID = get_the_ID();
                            ?>
                            <tr>
                                <td><?php echo get_field('status'); ?></td>
                                <td><?php echo get_the_title(); ?></td>
                                <td><?php echo get_field('title'); ?></td>
                                <td><?php echo get_the_date() ;?></td>
                                <td><a href="../view-ticket-concern?ticket=<?php echo $ticket_ID; ?>" class="nextbtn" target="_blank">View ticket</a></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>
                </tbody>
            </table>
        <?php } ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>


<script>
    $(document).ready( function () {
        $('#ticketConcerns').DataTable({});
    });
</script>