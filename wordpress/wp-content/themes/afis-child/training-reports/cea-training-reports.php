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
//Edit CEA Training Reports
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
    'orderby'   => array(
        'date' =>'DESC'
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
            <table id="monthlyReport"  class="customers">
                <thead>
                    <tr>
                        <th style="text-align:center;">Sequence no</th>
                        <th>Name</th>
                        <th>Title of Training</th>
                        <th>Date of Training</th>
                        <th>No. of Hours</th>
                        <th>PICPA Accreditation No.</th>
                        <th>Remarks</th>
                        <th style="text-align:center;">Action</th>
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
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key'   => 'post_id',
                                'value' => get_the_ID(),
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
                                <td><?php echo get_field('added_by'); ?>  asd</td>
                                <td><?php echo get_field('title_of_training'); ?></td>
                                <td><?php echo get_field('date_of_training'); ?></td>
                                <td><?php echo get_field('no_of_hours'); ?></td>
                                <td><?php echo get_field('picpa_accreditation_no'); ?></td>
                                <td><?php echo get_field('remarks'); ?></td>
                                <td style="text-align:center;">
                                    <a href="#DeleteQuery-<?php echo $queryID; ?>" class="fancybox-inline" style="color:inherit;"><i class="fas fa-trash"></i></a>   
                                    <a href="edit-cea-training-report/" target="_blank" style="color:inherit;"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                           
                            <div style="display:none" class="fancybox-hidden">
                               <div id="DeleteQuery-<?php echo $queryID; ?>" class="hentry" style="line-height:1.3; font-size:13px; width:300px;max-width:100%;">
                                   <h4 style="margin: 0px; font-family: 'Poppins'; font-size: 18px; text-align: center; color: #5d4444; ">Are you sure want to delete?</h4>
                                   <br>
                                   <div class="col-mid-50">
                                       <div class="margin-right">
                                           <a href="?deleterequest=<?php echo $queryID; ?>" class="btn-yes">Yes</a>
                                           </div> 
                                       </div> 
                                   <div class="col-mid-50"><a  href="?cancelled=<?php echo $queryID; ?>"   class="btn-no">No</a></div>
                                </div>  
                                <div class="clear"></div>
                            </div>
                            <?php $counter++; ?>
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

<style>
    .no-tabs {
        background: #fff;
        padding: 0;
    }
</style>
<script>
    $(document).ready( function () {
        $('#monthlyReport').DataTable({
            "ordering": false
        });
    });
</script>
