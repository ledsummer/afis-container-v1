<?php
    $user_id = get_current_user_id();
    $user = new WP_User( $user_id );
    global $groupkey;
    if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
    foreach ( $user->roles as $role ){
        
    if(($role=="crits-cds_1") || ($role=="crits-senior_cds") || ($role=="crits_regional_director")){
    $groupkey='status_ses';
  
    }else{
    $groupkey='status_sed';    
    }
    }
}
?>

<?php
$returnedID; $returnedRegion;
$args_officialEmail = array(
    'posts_per_page'   => -1,
    'post_type' => array(
        'regional_officers'
    ),
    'post_status' => array(
        'publish',
        'pending'
    )
);

$variable_officialEmail = new WP_Query($args_officialEmail);
if ($variable_officialEmail->have_posts()): the_post(); ?>
    <?php while( $variable_officialEmail->have_posts() ): $variable_officialEmail->the_post(); ?>
        <?php
        if($user->user_email == get_field('email_address')){
            $returnedID = get_the_id();
            $returnedRegion = get_field('region');
        }
        ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<table id="customersMonthly" class="customers">
    <thead>
        <tr>
            <th style="text-align:center;">Sequence no</th>
            <th>Name</th>
            <th>Title of Training</th>
            <th>Date of Training</th>
            <th>No. of Hours</th>
            <th>Training Provider</th>
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
        );
        
    
        $variable = new WP_Query($args);
        if ($variable->have_posts()): the_post(); ?>
            <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                <?php $cpost = get_field('post_id'); ?>
                <?php $queryID = get_the_ID(); ?>
                <?php $dIDs = get_field('delegates_id', $cpost); ?>
                <?php $arrID = preg_split ("/\,/", $dIDs); ?>
                
                
                <?php if((get_field('region', $cpost) == $returnedRegion) && (in_array( $returnedID, $arrID ))){ ?>
                <?php $counter = 1; ?>
                <tr>
                    <td style="text-align:center;"><?php echo $counter; ?></td>
                    <td><?php echo get_field('added_by'); ?></td>
                    <td><?php echo get_field('title_of_training'); ?></td>
                    <td><?php echo get_field('date_of_training'); ?></td>
                    <td><?php echo get_field('no_of_hours'); ?></td>
                    <td><?php echo get_field('training_provider'); ?></td>
                    <td><?php echo get_field('remarks'); ?></td>
                    <td style="text-align:center;"><a href="../view-training-reports-requests?post_id=<?php echo $queryID; ?>" style="color:inherit;" target="_blank">View</a></td>
                </tr>
                <?php $counter++; ?>
                <?php } ?>
            <?php endwhile; ?>
        <?php else : ?>
          
        <?php endif; ?>
            
        <?php wp_reset_query(); ?>
    </tbody>
</table>


<script>
    $(document).ready( function () {
        $('#customersMonthly').DataTable({
            "ordering": false
        });
    });
</script>


