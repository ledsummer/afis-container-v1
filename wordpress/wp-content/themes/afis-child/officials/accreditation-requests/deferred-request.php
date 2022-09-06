<?php
//Deferred Accreditation Requests

    $user_id = get_current_user_id();
    $user = new WP_User( $user_id );
    global $groupkey;
    if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
    foreach ( $user->roles as $role ){
        
    if(($role=="crits-cds_1") || ($role=="crits-senior_cds") || ($role=="crits_regional_director") || ($role=="ses_cds-2") || ($role=="ses_senior_cds") || ($role=="ses_regional_director")){
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

<table id="customersDeffered" class="customers">
    <thead>
        <tr>
            <th>Application Type</th> 
            <th>Name</th>
            <th>Application No</th>  
            <th>Regional Office</th>
            <th>Head Office</th>
            <th>Date Applied</th>
            <th style="text-align:center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($groupkey=='status_ses'){
            $args = array(
                'post_type' => array(
                    'accreditations'
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
                        'key' => $groupkey,
                        'value' => 'Deferred',
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'region',
                        'value' => $returnedRegion,
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'delegates_id',
                        'value' => $returnedID,
                        'compare' => 'LIKE',
                    )
                )
            );
        } else {
            $args = array(
                'post_type' => array(
                    'accreditations'
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
                        'key' => 'status_ses',
                        'value' => 'Approved',
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'status_sed',
                        'value' => 'Deferred',
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'delegates_id',
                        'value' => $returnedID,
                        'compare' => 'LIKE',
                    )
                )
            );
        }
        
    
        $variable = new WP_Query($args);
        if ($variable->have_posts()): the_post(); ?>
            <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                <?php $cpost = get_field('post_id'); ?>
                <tr>
                    <td>
                        <?php
                        if(get_field('application') == 1){
                            echo "New";
                        } else if(get_field('application') == 2) {
                            echo "Renewal";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if(get_field('type_of_cea', get_field('post_id')) == "Firm"){
                            echo get_field('firm_name', get_field('post_id'));
                        } else { get_field('requestor'); } ?>
                    </td>
                    <td>
                        <?php 
                        if(get_field('reg_form_role', get_field('post_id')) == "CEA"){
                            echo get_field('application_no', get_field('post_id'));
                        } else {
                            echo get_field('ca-no', get_field('post_id'));
                        }
                        ?>
                    </td>
                    <td><?php echo get_field('status_ses'); ?></td>
                    <td><?php echo get_field('status_sed'); ?></td>
                    <td><?php echo get_the_date('F d, Y H:i:s') ;?></td>
                    <td style="text-align:center;"> <a href="../view-accreditation-request?post_id=<?php echo $cpost; ?>&acc_id=<?php echo get_the_id(); ?>" style="color:inherit;" target="_blank">View Application</a>   </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
          
        <?php endif; ?>
            
        <?php wp_reset_query(); ?>
    </tbody>
</table>


<script>
    $(document).ready( function () {
        $('#customersDeffered').DataTable({
            "ordering": false
        });
    });
</script>


