
<?php
//Monthly Reports
$p = $_GET['post_id'];
?>

<div class="no-tabs" style="padding: 0;">
    <table id="cooperativeClientss"  class="customers">
        <thead>
            <tr>
                <th>Date Submitted</th>
                <th>Date</th>
                <th>Name of Cooperatives</th>
                <th>Address</th>
                <th>Year Audited</th>
                <th>Total Asset</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $docID = get_field('documents_id', $_GET['acc_id']);
            $args = array(
                'post_type' => array(
                    'cpt-coop-clients'
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
                    <?php $queryID=get_the_ID(); ?>
                    <?php
                    $thisDate   = get_the_date('l F j, Y H:i:s A');
                    $getDate    = get_field('date');
                    
                    if( have_rows('cooperatives') ):
                        while( have_rows('cooperatives') ) : the_row();
                            $document_title = get_sub_field('document_title');
                            $document = get_sub_field('document'); 
                            
                            $getCooperatives    = get_sub_field('name_of_cooperatives');
                            $getAddress         = get_sub_field('address');
                            $getYearAudited     = get_sub_field('year_audited');
                            $getAsset           = get_sub_field('total_asset');
                            $getRemarks         = get_sub_field('remarks');
                            ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td> <?php echo $getDate; ?></td>
                                <td> <?php echo $getCooperatives; ?></td>
                                <td> <?php echo $getAddress; ?></td>
                                <td> <?php echo $getYearAudited; ?></td>
                                <td> <?php echo $getAsset; ?></td>
                                <td> <?php echo $getRemarks; ?></td>
                            </tr>
                        <?php endwhile;
                    else :
                    endif;
                    ?>
                <?php endwhile; ?>
            <?php else : ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready( function () {
        $('#cooperativeClientss').DataTable({
            "ordering": false
        });
    });
</script>