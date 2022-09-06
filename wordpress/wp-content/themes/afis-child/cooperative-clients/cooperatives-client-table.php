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
global $wp_query; $globalPost_id = $wp_query->get_queried_object_id();
global $globalDocID;
?>

<?php
$docReqID; $globalDocID = array();
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
            
            <table id="cooperativeClients"  class="customers">
                <thead>
                    <tr>
                        <th>Date Submitted</th>
                        <th>Date</th>
                        <th>Name of Cooperatives</th>
                        <th>Address</th>
                        <th>Year Audited</th>
                        <th>Total Asset</th>
                        <th>Remarks</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $args;
                    if($globalPost_id == "206"){
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
                                    'value' => get_the_ID(),
                                    'compare' => '='
                                )
                                // array(
                                //     'key'   => 'show_when_applying',
                                //     'value' => "1",
                                //     'compare' => '='
                                // )
                            )
                        );
                    } else {
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
                                    'value' => get_the_ID(),
                                    'compare' => '='
                                )
                            )
                        );
                    }
                
                    $variable = new WP_Query($args);
                    if ($variable->have_posts()): the_post(); ?>
                        <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                            <?php $queryID = get_the_ID(); ?>
                            <?php
                            array_push($globalDocID, $queryID);
                            
                            $thisDate = get_the_date('l F j, Y H:i:s A');
                            $getDate            = get_field('date');
                            
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
                                        <td style="text-align:center;">
                                            <a href="cooperative-clients-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a>
                                        </td>
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
        <?php } ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>




<script>
    $(document).ready( function () {
        $('#cooperativeClients').DataTable({
            "ordering": false
        });
    });
</script>