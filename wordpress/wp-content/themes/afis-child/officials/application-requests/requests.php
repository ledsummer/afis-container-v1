<?php
//Application Requests

    $user_id = get_current_user_id();
    $user = new WP_User( $user_id );
    global $groupkey;
    if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
    foreach ( $user->roles as $role ){
        
    if($role=="ctpro_ses"){
    $groupkey='status_ses';
  
    }else{
    $groupkey='status_sed';    
    }
    }
}
?>

<?php
$returnedID; $returnedRegion; $returnedType;
$args_officialEmail = array(
    'posts_per_page' => -1,
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
            $returnedType = get_field('type');
        }
        ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<table id="customersPending"  class="customers">
    <thead>
        <tr>
            <th>Name</th>
            <th>Application No</th>            
            <th>Account Status</th>
            <th>Region</th>
            <th>Date Registered</th>
            <th style="text-align:center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $args = array(
            'post_type' => array(
                $returnedType
            ),
            'post_status' => array(
                'publish',
                'pending'
            ),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'region',
                    'value' => $returnedRegion,
                    'compare' => '=',
                )
            )
        );
    
        $variable = new WP_Query($args);
        if ($variable->have_posts()): the_post(); ?>
            <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                <?php $cpost = get_the_id(); ?>
                
                <?php
                $fieldRegion = get_field_object('region');
                $valueRegion = get_field('region');
                $labelRegion = $fieldRegion['choices'][ $valueRegion ];
                ?>
                
                <tr>
                    <td>
                        <?php 
                        if(get_field('type_of_cea') == "Firm"){ 
                            echo get_field('firm_name'); 
                        } else {
                            echo get_field('first_name').' '.get_field('last_name'); 
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if(get_field('reg_form_role') == "CEA"){
                            echo get_field('application_no');
                        } else {
                            echo get_field('ca-no');
                        }
                        
                        ?>
                    </td>
                    <td><?php echo get_field('status'); ?></td>
                    <td><?php echo $labelRegion; ?></td>
                    <td><?php echo get_the_date('F d, Y H:i:s') ;?></td>
                    <td style="text-align:center;"> <a href="<?php echo site_url(); ?>/view-application-request?post_id=<?php echo $cpost; ?>" style="color:inherit;" target="_blank">View Application</a>   </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
         
        <?php endif; ?>
            
        <?php wp_reset_query(); ?>
    </tbody>
</table>


<script>
    $(document).ready( function () {
        $('#customersPending').DataTable({
            "ordering": false
        });
    });
</script>


