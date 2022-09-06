
<?php
//Monthly Reports
$p = $_GET['post_id'];
?>

<table id="CEATrainingReport"  class="customers">
    <thead>
        <tr>
            <th style="text-align:center;">Sequence no</th>
            <th>Name</th>
            <th>Title of Training</th>
            <th>Date of Training</th>
            <th>No. of Hours</th>
            <th>PICPA Accreditation No.</th>
            <th>Remarks</th>
            <th style="text-align:center;">View Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $args = array(
            'post_type' => array(
                'cea_training_reports'
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
                <?php $counter = 1; ?>
                <tr>
                    <td style="text-align:center;"><?php echo $counter; ?></td>
                    <td><?php echo get_field('added_by'); ?></td>
                    <td><?php echo get_field('title_of_training'); ?></td>
                    <td><?php echo get_field('date_of_training'); ?></td>
                    <td><?php echo get_field('no_of_hours'); ?></td>
                    <td><?php echo get_field('picpa_accreditation_no'); ?></td>
                    <td><?php echo get_field('remarks'); ?></td>
                    <td style="text-align:center;"><a href="<?php echo get_field('attachment')['url']; ?>" target="_new" style="color:inherit;">View</a></td>
                </tr>
               
                <div style="display:none" class="fancybox-hidden">
                    <div id="fancyboxID-<?php echo $queryID; ?>" class="hentry" style="line-height:1.3; font-size:13px; width:560px;max-width:100%;">
                        <div style="font-weight:bold;">Training Information: <?php echo get_field('venue_training'); ?></div><br>
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
        $('#CEATrainingReport').DataTable({
            "ordering": false
        });
    });
</script>
