<?php
//Pending Accreditation Requests

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




<table id="customersPending"  class="customers">
    <thead>
        <tr>
            <th>CA No</th>
            <th>Member Name</th>
            <th>Account Type</th>
            <th style="text-align:center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $args = array(
           'post_type'		=> array('cea','ctpro'),
            'post_status' => array('publish','pending'),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'status',
                    'value' => 'Pending',
                    'compare' => '=',
                )
            )
        );
    
        $variable = new WP_Query($args);
        if ($variable->have_posts()): the_post(); ?>
            <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                <?php $cpost = get_field('post_id'); ?>
                <tr>
                    <td><?php echo get_field('ca-no'); ?></td>
                    <td><?php echo get_field('first_name'); ?><?php echo get_field('middle_name'); ?><?php echo get_field('last_name'); ?> </td>
                    <td><?php echo get_post_type($cpost); ?></td>
                    <td style="text-align:center;"> <a href="../view-accreditation-request?post_id=<?php echo $cpost; ?>" style="color:inherit;" target="_blank"><i class="fas fa-eye"></i> View Application</a>   </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
           <br>
            <div class='info-alert'>No Pending for Approval</div>
            <br>
        <?php endif; ?>
            
        <?php wp_reset_query(); ?>
    </tbody>
</table>


<script>
    $(document).ready( function () {
        $('#customersPending').DataTable({
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'excel',
            //         text: 'Download Excel File',
            //         filename: "Pending Customers",
            //         title: 'Pending Customers'
            //     },
            //     {
            //         extend: 'pdfHtml5',
            //         orientation: 'landscape',
            //         pageSize: 'LEGAL',
            //         text: 'Download PDF File',
            //         filename: "Pending Customers",
            //         title: 'Pending Customers'
            //     }
            // ]
        });
    });
</script>


