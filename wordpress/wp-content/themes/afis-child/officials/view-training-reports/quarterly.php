
<?php
//Quarterly Reports
$p = $_GET['post_id'];
?>

<table id="quarterlyReport" class="customers">
    <thead>
        <tr>
            <th>Date of Training</th>
            <th>Quarter Period</th>
            <th>Year</th>
            <th>Crediting Hours</th>
            <th>Venue of Training</th>
            <th>Participants</th>
            <th style="text-align:center;">Remarks</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $args = array(
            'post_type' => array(
                'quarterly_reports'
            ),
            'post_status' => array(
                'publish'
            ),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'   => 'post_id',
                    'value' => $p,
                    'compare' => '='
                )
            )
        );
    
        $variable = new WP_Query($args);
        if ($variable->have_posts()): the_post(); ?>
            <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                <?php $queryID = get_the_ID(); ?>
                <tr>
                    <td><?php echo get_field('date_of_training'); ?></td>
                    <td><?php echo get_field('quarter_period'); ?></td>
                    <td><?php echo get_field('year'); ?></td>
                    <td><?php echo get_field('crediting_hours'); ?></td>
                    <td><?php echo get_field('venue_of_training'); ?></td>   
                    <td><?php echo get_field('amount_of_training_of_participants'); ?></td>  
                    <td style="text-align:center;"><a href="#fancyboxID-<?php echo $queryID; ?>" class="fancybox-inline" style="color:inherit;">View</a></td>
                </tr>
               
                <div style="display:none" class="fancybox-hidden">
                    <div id="fancyboxID-<?php echo $queryID; ?>" class="hentry" style="line-height:1.3; font-size:13px; width:560px;max-width:100%;">
                        <div style="font-weight:bold;">Remarks:</div><br>
                        <?php echo get_field('remarks'); ?>   
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </tbody>
</table>

<script>
    $(document).ready( function () {
        $('#quarterlyReport').DataTable({});
    });
</script>