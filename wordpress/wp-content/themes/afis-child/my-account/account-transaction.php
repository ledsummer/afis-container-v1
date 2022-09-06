<?php
/* Template Name: History Transactions */
get_header();
acf_form_head();
?>
<?php include ("account-header.php"); ?>
<div class="container">

<div class="col-mid-15">
        <?php include ("account-sidebar.php"); ?>
 </div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter " style="height:100vh !important;">
        <div class="account-information">
            <div class="headerAccount"><i class="fas fa-certificate"></i> Transactions</div>
            <?php
            $current_user = wp_get_current_user();
            $email = $current_user->user_email;
            $posts = get_posts(array(
                'numberposts' => 1,
                'post_type' => array(
                    'cea',
                    'ctpro'
                ) ,
                'post_status' => array(
                    'publish'
                ) ,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'email',
                        'value' => $email,
                        'compare' => '=',
                    )
                )
            ));
            if (have_posts()):
                while (have_posts()): the_post();
                    $cpost = get_the_ID(); ?>
                    <style>.no-tabs { padding: 20px!important; }</style>
                    <div class="no-tabs">
                        <table id="transactionList"  class="customers">
                            <thead>
                                <tr>
                                    <th>CA NO</th>
                                    <th>Application Type</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Proof of Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $args = array(
                                    'post_type' => array(
                                        'cpt-transactions'
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
                            
                                $variable = new WP_Query($args);
                                if ($variable->have_posts()): the_post(); ?>
                                    <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                                        <?php $queryID = get_the_ID(); ?>
                                        <tr>
                                            <td><?php echo get_field('ca_no') ;?></td>
                                            <td>
                                                <?php
                                                if(get_field('application') == 1){
                                                    echo "New";
                                                } else {
                                                    echo "Renewal";
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo get_field('account_name') ;?></td>
                                            <td><?php echo get_field('account_number');?></td>
                                            <td> 
                                                <a href="<?php echo get_field('or_payment_receipt')['url'];?>" style="color:inherit;" target="_blank">
                                                <i class="fas fa-eye"></i> File Attachment
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                <?php endif; ?>
                                <?php wp_reset_query(); ?>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        $(document).ready( function () {
                            $('#transactionList').DataTable({
                                "ordering": false
                            });
                        });
                    </script>
                <?php endwhile;
            endif; ?>
        </div>
    </div>
</div>

</div>
<div class="clear"></div>
<?php get_footer(); ?>
