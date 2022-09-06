<?php
// Ticket Concerns
$docReqID;
$current_user = wp_get_current_user();
$email = $current_user->user_email;
?>
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
            'orderby'   => array(
                'date' =>'DESC'
            ),
            'meta_query' => array(
                'relation' => 'AND',
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
                    <td><?php echo get_the_date('F d, Y H:i:s') ;?></td>
                    <td><a href="../view-ticket-concern?ticket=<?php echo $ticket_ID; ?>" class="nextbtn" target="_blank">View ticket</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </tbody>
</table>


<script>
    $(document).ready( function () {
        $('#ticketConcerns').DataTable({
            "ordering": false
        });
    });
</script>