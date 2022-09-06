
<?php
//Monthly Reports
$p = $_GET['post_id'];
?>

<div class="no-tabs" style="padding: 0;">
    <table id="trainingDocuments"  class="customers">
        <thead>
            <tr>
                <th>Date Submitted</th>
                <th>Document</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $docID = get_field('documents_id', $_GET['acc_id']);
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
                        'value' => $p,
                        'compare' => '='
                    )
                )
            );
        
            $variable = new WP_Query($args);
            if ($variable->have_posts()): the_post(); ?>
                <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                    <?php $queryID=get_the_ID(); ?>
                    <?php
                    $thisDate = get_the_date();
                    $thisAccountType = get_field('accountType');
                    
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
                            
                    if((get_field('type_of_cea', $p) == "Federation of Cooperatives") || (get_field('type_of_cea', $p) == "Cooperative Unions") || (get_field('type_of_cea', $p) == "Advocacy Cooperatives") ||
                        (get_field('type_of_cea', $p) == "State Universities and Colleges (SUCs)") || (get_field('type_of_cea', $p) == "Training Institutions including Non-Government Organizations (NGOs) and Private Academic Institutions") ||
                        (get_field('type_of_cea', $p) == "National Government Agencies (NGAs)") || (get_field('type_of_cea', $p) == "Local Cooperative Development Offices (LCDOs)")){ ?>
                        
                        
                        if(get_the_id() == $docID){ ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_1['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_1['title']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_2['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_2['title']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_3['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_3['title']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_4['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_4['title']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_5['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_5['title']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_6['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_6['title']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_7['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_7['title']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_8['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_8['title']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_9['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_9['title']; ?></a></td>
                            </tr>
                            
                            <?php if($file_url_10) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_10['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_10['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($file_url_11) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_11['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_11['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($file_url_12) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_12['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_12['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($file_url_13) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_13['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_13['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($file_url_14) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_14['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_14['title']; ?></a></td>
                            </tr>
                            
                            <?php if($file_url_15) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_15['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_15['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($file_url_16) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_16['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_16['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($file_url_17) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_17['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_17['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($file_url_18) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_18['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_18['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($file_url_19) { ?>
                            <tr>
                                <td><?php echo $thisDate;?></td>
                                <td><a href="<?php echo $file_url_19['url']; ?>" style="color:inherit;" target="_blank"><?php echo $file_url_19['title']; ?></a></td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php }
                    
                    if(get_field('type_of_cea', $p) == "Individual") {
                        if( have_rows('documents') ):
                            while( have_rows('documents') ) : the_row();
                                $document_title = get_sub_field('document_title');
                                $document = get_sub_field('document'); ?>
                        
                                <tr>
                                    <td><?php echo $thisDate;?></td>
                                    <td> 
                                        <a href="<?php echo $document['url']; ?>" style="color:inherit;" target="_blank"><?php echo $document_title; ?></a>
                                    </td>
                                </tr>
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
                                </tr>
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
</div>

<script>
    $(document).ready( function () {
        $('#trainingDocuments').DataTable({
            "ordering": false
        });
    });
</script>