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
            <th style="text-align:center;">Status</th>
            <th>Name</th>
            <th>Date of Submission</th>
            <th>CA NO</th>
            <th>File Attachment</th>
            <th style="text-align:center;">View Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $args = array(
            'post_type' => array(
                'training_requirement'
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
                <tr>
                    <td style="text-align:center;">
                        <?php if(get_field('status') == '') {
                            echo "Pending";
                        } else {
                            echo get_field('status');
                        }?>
                    </td>
                    <td><?php echo get_field('added_by'); ?></td>
                    <td><?php echo get_the_date('F d, Y H:i:s') ;?></td>
                    <td><?php echo get_field('ca-no');?></td>
                    <td> 
                        <a href="<?php echo get_field('document')['url'];?>" style="color:inherit;" target="_blank">
                        File Attachment
                        </a>
                    </td>
                    <td style="text-align:center;"><a href="../view-documentary-requirement-requests?post_id=<?php echo $queryID; ?>" style="color:inherit;" target="_blank">View</a></td>
                </tr>
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