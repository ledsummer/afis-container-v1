
<?php
//Yearly Reports
$p = $_GET['post_id'];
?>

<table id="yearlyReport" class="customers">
    <thead>
        <tr>
            <th>Title of Training</th>
            <th>Total No. of Training Conducted</th>
            <th>Date Conducted</th>
            <th>No. of Participants</th>
            <th style="text-align:center;">View Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $args = array(
            'post_type' => array(
                'yearly_reports'
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
                    <td><?php echo get_field('title_of_training'); ?></td>
                    <td><?php echo get_field('no_of_trainings'); ?></td>
                    <td><?php echo get_field('date_conducted'); ?></td>
                    <td><?php echo get_field('no_of_participants'); ?></td>
                    <td style="text-align:center;"><a href="#fancyboxID-<?php echo $queryID; ?>" class="fancybox-inline" style="color:inherit;">View</a></td>
                </tr>
               
                <div style="display:none" class="fancybox-hidden">
                    <div id="fancyboxID-<?php echo $queryID; ?>" class="hentry" style="line-height:1.3; font-size:13px; width:560px;max-width:100%;">
                        <!--<div style="font-weight:bold;">Training Information: <?php echo get_field('venue_training'); ?></div><br>-->
                        <!--<?php echo get_field('remarks'); ?>   -->
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
        $('#yearlyReport').DataTable({});
    });
</script>