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
//Yearly Reports
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
        ),
        // array(
        //     'key' => 'application',
        //     'value' => "2",
        //     'compare' => '=',
        // )
    )
);

$variable_officialEmail = new WP_Query($args_officialEmail);
if ($variable_officialEmail->have_posts()): the_post(); ?>
    <?php while( $variable_officialEmail->have_posts() ): $variable_officialEmail->the_post(); ?>
        <?php
        if($email == get_field('email')){ ?>
            <table id="yearlyReport" class="customers">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Title of Training</th>
                        <th>Total No. of Training Conducted</th>
                        <th>Date Conducted</th>
                        <th>No. of Participants</th>
                        <th>Approved by</th>
                        <th style="text-align:center;">Action</th>
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
                                'value' => get_the_id(),
                                'compare' => '='
                            )
                        )
                    );
                
                    $variable = new WP_Query($args);
                    if ($variable->have_posts()): the_post(); ?>
                        <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                            <?php $queryID = get_the_ID(); ?>
                            <tr>
                                <td><?php echo get_field('status') ;?></td>
                                <td><?php echo get_field('title_of_training'); ?></td>
                                <td><?php echo get_field('no_of_trainings'); ?></td>
                                <td><?php echo get_field('date_conducted'); ?></td>
                                <td><?php echo get_field('no_of_participants'); ?></td>
                                <td>
                                    <?php
                                    if(get_field('approved_by') != ''){
                                    echo get_field('region', get_field('approved_by')).' - '.get_field('first_name', get_field('approved_by')).' '.get_field('last_name', get_field('approved_by')).', '.$labelRole;
                                    }
                                    ?>
                                </td>
                                <td style="text-align:center;">
                                    <a href="#DeleteQuery-<?php echo $queryID; ?>" class="fancybox-inline" style="color:inherit;"><i class="fas fa-trash"></i></a>  
                                    <a href="edit-yearly-training-reports/" target="_blank" style="color:inherit;"><i class="fas fa-edit"></i></a></td>
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
                                       <div class="col-mid-50"><a  href="?cancelled=<?php echo $queryID; ?>"   class="btn-no">No</a></div></div>  
                                       <div class="clear"></div>
                                       <br/>
                                       <br/>
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
        <?php } ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
    
<script>
    $(document).ready( function () {
        $('#yearlyReport').DataTable({
            "ordering": false
        });
    });
</script>
