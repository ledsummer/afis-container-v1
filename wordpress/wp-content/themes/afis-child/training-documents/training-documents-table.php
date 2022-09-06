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
//Documents Reports
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
            
            <table id="documentaryReports"  class="customers">
                <thead>
                    <tr>
                        <th>Date Submitted</th>
                        <th>Document Title</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $args;
                    if($globalPost_id == "206"){
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
                            'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                    'key'   => 'post_id',
                                    'value' => get_the_ID(),
                                    'compare' => '='
                                )
                            )
                        );
                    } else {
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
                            
                            $fieldRole = get_field_object('user_role', get_field('approved_by'));
                            $valueRole = $fieldRole['value'];
                            $labelRole = $fieldRole['choices'][ $valueRole ];
                            
                            $thisDate = get_the_date('l F j, Y H:i:s A');
                            $thisAccountType = get_field('accountType');
                            
                            $post_id = get_field('post_id');
                            
                            $file_url_1   = get_field('ct_file_1');
                            $file_url_2   = get_field('ct_file_2');
                            $file_url_3   = get_field('ct_file_3');
                            $file_url_4   = get_field('ct_file_4');
                            $file_url_5   = get_field('ct_file_5');
                            $file_url_6   = get_field('ct_file_6');
                            $file_url_7   = get_field('ct_file_7');
                            $file_url_8   = get_field('ct_file_8');
                            $file_url_9   = get_field('ct_file_9');
                            $file_url_10   = get_field('ct_file_10');
                            $file_url_11   = get_field('ct_file_11');
                            $file_url_12   = get_field('ct_file_12');
                            $file_url_13   = get_field('ct_file_13');
                            $file_url_14   = get_field('ct_file_14');
                            $file_url_15   = get_field('ct_file_15');
                            $file_url_16   = get_field('ct_file_16');
                            $file_url_17   = get_field('ct_file_17');
                            $file_url_18   = get_field('ct_file_18');
                            $file_url_19   = get_field('ct_file_19');
                            
                            if((get_field('type_of_cea', $post_id) == "Federation of Cooperatives") || (get_field('type_of_cea', $post_id) == "Cooperative Unions") || (get_field('type_of_cea', $post_id) == "Advocacy Cooperatives") ||
                                (get_field('type_of_cea', $post_id) == "State Universities and Colleges (SUCs)") || (get_field('type_of_cea', $post_id) == "Training Institutions including Non-Government Organizations (NGOs) and Private Academic Institutions") ||
                                (get_field('type_of_cea', $post_id) == "National Government Agencies (NGAs)") || (get_field('type_of_cea', $post_id) == "Local Cooperative Development Offices (LCDOs)")){ ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_1['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_1['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_2['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_2['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_3['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_3['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_4['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_4['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_5['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_5['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_6['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_6['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_7['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_7['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_8['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_8['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_9['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_9['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                
                                <?php if($file_url_10) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_10['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_10['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_11) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_11['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_11['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_12) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_12['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_12['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_13) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_13['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_13['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_14) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_14['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_14['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_15) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_15['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_15['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_16) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_16['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_16['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_17) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_17['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_17['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_18) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_18['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_18['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($file_url_19) { ?>
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td><a href="<?php echo $file_url_19['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_19['title']; ?></a></td>
                                    <td style="text-align:center;"><a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                
                            <?php }
                            
                            if(get_field('type_of_cea', $post_id) == "Individual") {
                                if( have_rows('documents') ):
                                    while( have_rows('documents') ) : the_row();
                                        $document_title = get_sub_field('document_title');
                                        $document = get_sub_field('document'); ?>
                                        <tr>
                                            <td><?php echo $thisDate;?></td>
                                            <td> 
                                                <!--<a href="training-documents-submission/?edit=<?php echo get_the_id(); ?>" style="color:inherit;" target="_blank">-->
                                                <!--Attachment-->
                                                <!--</a>-->
                                                <a href="<?php echo $document['url']; ?>" style="color:inherit;" target="_blank"><?php echo $document_title; ?></a>
                                            </td>
                                            <td style="text-align:center;">
                                                <a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a>
                                                <!--<a href="#DeleteQuery-<?php echo $queryID; ?>" class="fancybox-inline" style="color:inherit;"><i class="fas fa-trash"></i></a>-->
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
                                    <?php endwhile;
                                else :
                                endif;
                            }
                            
                            if($thisAccountType == "Firm"){ 
                                if( have_rows('documents') ):
                                    while( have_rows('documents') ) : the_row();
                                        $document_title = get_sub_field('document_title');
                                        $document = get_sub_field('document'); ?>
                                        <tr>
                                            <td><?php echo $thisDate;?></td>
                                            <td> 
                                                <a href="<?php echo $document['url']; ?>" style="color:inherit;" target="_blank"><?php echo $document_title; ?></a>
                                            </td>
                                            <td style="text-align:center;">
                                                <a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php endwhile;
                                else :
                                endif;
                                
                                if( have_rows('other_documents') ):
                                    while( have_rows('other_documents') ) : the_row();
                                        $document_title = get_sub_field('document_title');
                                        $document = get_sub_field('document'); ?>
                                        <tr>
                                            <td><?php echo $thisDate;?></td>
                                            <td> 
                                                <a href="<?php echo $document['url']; ?>" style="color:inherit;" target="_blank"><?php echo $document_title; ?></a>
                                            </td>
                                            <td style="text-align:center;">
                                                <a href="training-documents-submission/?edit=<?php echo $queryID; ?>" style="color:inherit;" target="_new"><i class="fas fa-edit"></i></a>
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
                                    <?php endwhile;
                                else :
                                endif;
                            } ?>
                   
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
        $('#documentaryReports').DataTable({
            "ordering": false
        });
    });
</script>