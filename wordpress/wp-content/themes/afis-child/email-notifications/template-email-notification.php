<?php //Template Name: Email Notifications ?>
<?php acf_form_head(); ?>
<?php include("Mailin.php"); ?>
<style>
    body{
        font-family:Monospace;
        font-size:13px;
    }
    table{ width:100%; }
    .center { text-align: center; }
</style>

<?php $siteURL  = site_url(); ?>
<?php $mailin   = new Mailin("https://api.sendinblue.com/v2.0","HbxEnfMWX19QNagm"); ?>
<?php $noReply  = "no-reply@cda.gov.ph"; ?>

<!-- ACCOUNT - UPDATE PASSWORD -->
<div>
    <h2 class="center">Account - Update Password</h2>
    <?php
    query_posts( array( 
        'post_type' => array('cea', 'ctpro'), 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'update_password_on_edit_profile',
                'value'    => '1',
                'compare'  => '=='
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
            
                
            
                <?php 
                $updatePass_postid         = get_the_ID();
                $updatePass_name           = get_field('first_name').' '.get_field('last_name');
                $updatePass_email          = get_field('email');
                // $updatePass_email          = "diego@mybusybee.net";
                $updatePass_password        = get_field('password');
                $updatePass_emailstatus    = get_field('update_password_on_edit_profile');
                $updatePass_role           = get_field('reg_form_role');
                
                
                $updatePass_returnedID = get_user_by( 'email', get_field('email') )->ID;
                ?>
                <tr>
                    <td><?php echo $updatePass_returnedID; ?></td>
                    <td><?php echo $updatePass_postid; ?></td>
                    <td><?php echo $updatePass_role; ?></td>
                    <td><?php echo $updatePass_name; ?></td>
                    <td><?php echo $updatePass_email; ?></td>
                    <td><?php echo $updatePass_password; ?></td>
                    <td><?php echo 'Email Status: '.$updatePass_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $updatePass_toname     = get_field('updatePass_name', 'option');
                    $updatePass_toemail    = get_field('updatePass_email', 'option');
                    $updatePass_bccemail   = get_field('updatePass_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $updatePass_fromname   = $updatePass_name; 
                    $updatePass_fromemail  = $updatePass_email; 
                    
                    $updatePass_forVisitorSubject      = get_field('updatePass_subject', 'option');
                    $updatePass_forVisitorContent1     = str_replace('{role}', get_field('reg_form_role'), get_field('updatePass_content', 'option'));
                    $updatePass_forVisitoremailcontent = "<div>Dear $updatePass_fromname,</div><br/>  $updatePass_forVisitorContent1";
                    
                    // echo $updatePass_forVisitorSubject;
                    // echo "<br>";
                    // echo $updatePass_forVisitoremailcontent;
                    
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $updatePass_visitors_data   = array( 
                        "to"        => array("$updatePass_email"=>"$updatePass_name"),
                        "from"      => array("$updatePass_toemail", "$updatePass_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => array("$updatePass_bccemail"=>"$updatePass_name"),
                        "subject"   => "$updatePass_forVisitorSubject",
                        "html"      => "$updatePass_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($updatePass_visitors_data)["code"] == "success"){
                        
                        update_user_meta($updatePass_returnedID, 'user_pass', $updatePass_password);
                        wp_update_user( array ('ID' => $updatePass_returnedID, 'user_pass' => $updatePass_password) ) ;
                        
                        // update email status
                        update_post_meta($updatePass_postid, 'update_password_on_edit_profile', '0');
                        update_post_meta($updatePass_postid, 'confirm_password', $updatePass_password);
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- REGISTRANTS - PENDING -->
<div>
    <h2 class="center">Registrants - Pending Status</h2>
    <?php
    query_posts( array( 
        'post_type' => array('cea', 'ctpro'), 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status',
                'value'    => 'Pending',
                'compare'  => '=='
            ),
            array(
                'key'      => 'pending_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            ),
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $pending_postid         = get_the_ID();
                $pending_name           = get_field('first_name').' '.get_field('last_name');
                if(get_field('type_of_cea') == "Firm"){
                    $pending_name = get_field('firm_name');
                }
                $pending_email          = get_field('email');
                $pending_mobile_number  = get_field('cellphone');
                $pending_emailstatus    = get_field('pending_status'); 
                $pending_role           = get_field('reg_form_role'); ?>
                
                <tr>
                    <td><?php echo $pending_postid; ?></td>
                    <td><?php echo $pending_role; ?></td>
                    <td><?php echo $pending_name; ?></td>
                    <td><?php echo $pending_email; ?></td>
                    <td><?php echo $pending_mobile_number; ?></td>
                    <td><?php echo 'Email Status: '.$pending_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $pending_toname     = get_field('pending_name', 'option');
                    $pending_toemail    = get_field('pending_email', 'option');
                    $pending_bccemail   = get_field('pending_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $pending_fromname   = $pending_name; 
                    $pending_fromemail  = $pending_email; 
                    
                    $pending_forVisitorSubject      = get_field('pending_subject', 'option');
                    $pending_forVisitorContent1     = str_replace('{role}', get_field('reg_form_role'), get_field('pending_content', 'option'));
                    $pending_forVisitoremailcontent = "<div>Dear $pending_fromname,</div><br/>  $pending_forVisitorContent1";
                    
                    $pending_forAFISemailcontent = "Good Day, <br><br> $pending_name registered to the system.
                    <br><br>
                    Please log in your account to CDA AFIS to view this application.
                    ";
                ?>
                
                <!-- RECEIVER: CLIENT -->
                <?php
                    $pending_emailArray = explode(',', get_field('delegates_id', $pending_postid));
                    $pending_emailToArray = [];
                    
                    for($pending_i=0; $pending_i<count($pending_emailArray); $pending_i++){
                        $pending_delegateID = $pending_emailArray[$pending_i];
                        $pending_emailToArray[get_field('email_address', $pending_delegateID)] = get_field("first_name", $pending_delegateID)." ".get_field("last_name", $pending_delegateID);
                        
                        
                        if((get_field('user_role', $pending_delegateID) == "crits-cds_1") || (get_field('user_role', $critdApproved_delegateID) == "ses_cds-2")){
                            $pending_afis_data   = array( 
                                "to"        => array(get_field('email_address', $pending_delegateID)=>get_field("first_name", $pending_delegateID)." ".get_field("last_name", $pending_delegateID)),
                                "from"      => array("$pending_email", "$pending_requestor"),
                                "replyto"   => array($noReply),
                                "bcc"       => "diego@mybusybee.net",
                                "subject"   => "$pending_forVisitorContent1",
                                "html"      => "$pending_forAFISemailcontent"
                            );
                            
                            var_dump($mailin->send_email($pending_afis_data));
                        }
                    }
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $pending_visitors_data   = array( 
                        "to"        => array("$pending_email"=>"$pending_name"),
                        "from"      => array("$pending_toemail", "$pending_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => array("$pending_bccemail"=>"$pending_name"),
                        "subject"   => "$pending_forVisitorSubject",
                        "html"      => "$pending_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($pending_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($pending_postid, 'pending_status', '0');
                        update_post_meta($pending_postid, 'approved_status', '1');
                        update_post_meta($pending_postid, 'rejected_status', '1');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- REGISTRANTS - APPROVED -->
<div>
    <h2 class="center">Registrants - Approved Status</h2>
    <?php
    query_posts( array( 
        'post_type' => array('cea', 'ctpro'), 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status',
                'value'    => 'Approved',
                'compare'  => '=='
            ),
            array(
                'key'      => 'approved_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            ),
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $approved_postid         = get_the_ID();
                $approved_name           = get_field('first_name').' '.get_field('last_name');
                if(get_field('type_of_cea') == "Firm"){
                    $approved_name = get_field('firm_name');
                }
                $approved_email          = get_field('email');
                $approved_mobile_number  = get_field('cellphone');
                $approved_emailstatus    = get_field('approved_status');
                $approved_role           = get_field('reg_form_role'); ?>
                
                <tr>
                    <td><?php echo $approved_postid; ?></td>
                    <td><?php echo $approved_role; ?></td>
                    <td><?php echo $approved_name; ?></td>
                    <td><?php echo $approved_email; ?></td>
                    <td><?php echo $approved_mobile_number; ?></td>
                    <td><?php echo 'Email Status: '.$approved_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $approved_toname     = get_field('approved_name', 'option');
                    $approved_toemail    = get_field('approved_email', 'option');
                    $approved_bccemail   = get_field('approved_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $approved_fromname   = $approved_name; 
                    $approved_fromemail  = $approved_email; 
                    
                    $approved_forVisitorSubject      = get_field('approved_subject', 'option');
                    $approved_forVisitorContent1     = str_replace('{role}', get_field('reg_form_role'), get_field('approved_content', 'option'));
                    $approved_forVisitorContent2     = str_replace('{email}', $approved_email, $approved_forVisitorContent1);
                    $approved_forVisitorContent3     = str_replace('{password}', get_field('last_name'), $approved_forVisitorContent2);
                    $approved_forVisitorContent4     = str_replace('{url}', '<a href="'.$siteURL.'">'.preg_replace("(^https?://)", "", $siteURL ).'</a>', $approved_forVisitorContent3);
                    $approved_forVisitoremailcontent = "<div>Dear $approved_fromname,</div><br/>  $approved_forVisitorContent4";
                    
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $approved_visitors_data   = array( 
                        "to"        => array("$approved_email"=>"$approved_name"),
                        "from"      => array("$approved_toemail", "$approved_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => array("$approved_bccemail"=>"$approved_name"),
                        "subject"   => "$approved_forVisitorSubject",
                        "html"      => "$approved_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($approved_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($approved_postid, 'pending_status', '1');
                        update_post_meta($approved_postid, 'approved_status', '0');
                        update_post_meta($approved_postid, 'rejected_status', '1');
                        
                        wp_update_post(array( 'ID' => $approved_postid, 'post_status' => 'publish' ));
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- REGISTRANTS - REJECTED -->
<div>
    <h2 class="center">Registrants - Rejected Status</h2>
    <?php
    query_posts( array( 
        'post_type' => array('cea', 'ctpro'), 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status',
                'value'    => 'Dissapproved',
                'compare'  => '=='
            ),
            array(
                'key'      => 'rejected_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            ),
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $rejected_postid         = get_the_ID();
                $rejected_name           = get_field('first_name').' '.get_field('last_name');
                if(get_field('type_of_cea') == "Firm"){
                    $rejected_name = get_field('firm_name');
                }
                $rejected_email          = get_field('email');
                $rejected_mobile_number  = get_field('cellphone');
                $rejected_emailstatus    = get_field('rejected_status');
                $rejected_role           = get_field('reg_form_role'); ?>
                
                <tr>
                    <td><?php echo $rejected_postid; ?></td>
                    <td><?php echo $rejected_role; ?></td>
                    <td><?php echo $rejected_name; ?></td>
                    <td><?php echo $rejected_email; ?></td>
                    <td><?php echo $rejected_mobile_number; ?></td>
                    <td><?php echo 'Email Status: '.$rejected_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $rejected_toname     = get_field('rejected_name', 'option');
                    $rejected_toemail    = get_field('rejected_email', 'option');
                    $rejected_bccemail   = get_field('rejected_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $rejected_fromname   = $rejected_name; 
                    $rejected_fromemail  = $rejected_email; 
                    
                    $rejected_forVisitorSubject      = get_field('rejected_subject', 'option');
                    $rejected_forVisitorContent1     = str_replace('{role}', get_field('reg_form_role'), get_field('rejected_content', 'option'));
                    $rejected_forVisitoremailcontent = "<div>Dear $rejected_fromname,</div><br/>  $rejected_forVisitorContent1";
                    
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $rejected_visitors_data   = array( 
                        "to"        => array("$rejected_email"=>"$rejected_name"),
                        "from"      => array("$rejected_toemail", "$rejected_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => array("$rejected_bccemail"=>"$rejected_name"),
                        "subject"   => "$rejected_forVisitorSubject",
                        "html"      => "$rejected_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($rejected_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($rejected_postid, 'pending_status', '1');
                        update_post_meta($rejected_postid, 'approved_status', '1');
                        update_post_meta($rejected_postid, 'rejected_status', '0');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- REGISTRANTS - PAYMENT PAID -->
<div>
    <h2 class="center">Registrants - Payment Status</h2>
    <?php
    query_posts( array( 
        'post_type' => array('cea', 'ctpro'), 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'payment_status',
                'value'    => 'Paid',
                'compare'  => '=='
            ),
            array(
                'key'      => 'paymentN_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $paidPayment_postid         = get_the_ID();
                $paidPayment_name           = get_field('first_name').' '.get_field('last_name');
                if(get_field('type_of_cea') == "Firm"){
                    $paidPayment_name = get_field('firm_name');
                }
                $paidPayment_email          = get_field('email');
                $paidPayment_mobile_number  = get_field('cellphone');
                $paidPayment_status         = get_field('payment_status');
                $paidPayment_emailstatus    = get_field('paymentN_status');
                $paidPayment_role           = get_field('reg_form_role');
                ?>
                
                <tr>
                    <td><?php echo $paidPayment_postid; ?></td>
                    <td><?php echo $paidPayment_role; ?></td>
                    <td><?php echo $paidPayment_name; ?></td>
                    <td><?php echo $paidPayment_email; ?></td>
                    <td><?php echo $paidPayment_mobile_number; ?></td>
                    <td><?php echo 'Payment Status: '.$paidPayment_status; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $paidPayment_toname     = get_field('paid_name', 'option');
                    $paidPayment_toemail    = get_field('paid_email', 'option');
                    $paidPayment_bccemail   = get_field('paid_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $paidPayment_fromname   = $paidPayment_name; 
                    $paidPayment_fromemail  = $paidPayment_email; 
                    
                    $paidPayment_forVisitorSubject      = get_field('paid_subject', 'option');
                    $paidPayment_forVisitorContent1     = str_replace('{ca-no}', get_field('ca-no'), get_field('paid_content', 'option'));
                    $paidPayment_forVisitorContent2     = str_replace('{payment-status}', $paidPayment_status, $paidPayment_forVisitorContent1);
                    $paidPayment_forVisitorContent3     = str_replace('{account-expiration}', get_field('account_expiration'), $paidPayment_forVisitorContent2);
                    $paidPayment_forVisitoremailcontent = "<div>Dear $paidPayment_fromname,</div><br/>  $paidPayment_forVisitorContent3";
                    
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $paidPayment_visitors_data   = array( 
                        "to"        => array("$paidPayment_email"=>"$paidPayment_name"),
                        "from"      => array("$paidPayment_toemail", "$paidPayment_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => array("$paidPayment_bccemail"=>"$paidPayment_name"),
                        "subject"   => "$paidPayment_forVisitorSubject",
                        "html"      => "$paidPayment_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($paidPayment_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($paidPayment_postid, 'paymentN_status', '0');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- REPORTS - MONTHLY -->
<div>
    <h2 class="center">Reports - Monthly</h2>
    <?php
    query_posts( array( 
        'post_type' => 'monthly_reports', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'email_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $monthlyReports_id             = get_the_ID();
                $monthlyReports_postID         = get_field('post_id');
                $monthlyReports_name           = get_field('added_by');
                $monthlyReports_email          = get_field('email', $monthlyReports_postID);
                $monthlyReports_status         = get_field('email_status');
                
                
                $resource_persons = get_field('resource_persons');
                $html_resourcePerson;
                
                $html_resourcePerson = "<ul>";
                
                if( have_rows('resource_persons') ):
                    while( have_rows('resource_persons') ) : the_row();
                
                        $sub_name               = get_sub_field('first_name').' '.get_sub_field('last_name');
                        $sub_institution_name   = get_sub_field('institution_name');
                        
                        $html_resourcePerson .= "<li>$sub_institution_name - $sub_name</li>";
                
                    endwhile;
                else :
                endif;
                
                $html_resourcePerson .= "</ul>";
                ?>
                
                <tr>
                    <td><?php echo $monthlyReports_id; ?></td>
                    <td><?php echo $monthlyReports_postID; ?></td>
                    <td><?php echo $monthlyReports_name; ?></td>
                    <td><?php echo $monthlyReports_email; ?></td>
                    <td><?php echo 'Email Status: '.$monthlyReports_status; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $monthlyReports_toname     = get_field('monthlyReports_name', 'option');
                    $monthlyReports_toemail    = get_field('monthlyReports_email', 'option');
                    $monthlyReports_bccemail   = get_field('monthlyReports_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $monthlyReports_fromname   = $monthlyReports_name; 
                    $monthlyReports_fromemail  = $monthlyReports_email; 
                    
                    $monthlyReports_forVisitorSubject      = get_field('monthlyReports_subject', 'option');
                    $monthlyReports_forVisitorContent1     = str_replace('{ca-no}', get_field('ca-no'), get_field('monthlyReports_content', 'option'));
                    $monthlyReports_forVisitorContent2     = str_replace('{date_training}', get_field('date_training'), $monthlyReports_forVisitorContent1);
                    $monthlyReports_forVisitorContent3     = str_replace('{title_training}', get_field('title_training'), $monthlyReports_forVisitorContent2);
                    $monthlyReports_forVisitorContent4     = str_replace('{no_participants}', get_field('no_participants'), $monthlyReports_forVisitorContent3);
                    $monthlyReports_forVisitorContent5     = str_replace('{venue_training}', get_field('venue_training'), $monthlyReports_forVisitorContent4);
                    $monthlyReports_forVisitorContent6     = str_replace('{amount_fees}', get_field('amount_fees'), $monthlyReports_forVisitorContent5);
                    $monthlyReports_forVisitorContent7     = str_replace('{option_live}', get_field('option_live'), $monthlyReports_forVisitorContent6);
                    $monthlyReports_forVisitorContent8     = str_replace('{resource_persons}', $html_resourcePerson, $monthlyReports_forVisitorContent7);
                    $monthlyReports_forVisitoremailcontent = "<div>Dear $monthlyReports_fromname,</div><br/>  $monthlyReports_forVisitorContent8";
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $monthlyReports_visitors_data   = array( 
                        "to"        => array("$monthlyReports_email"=>"$monthlyReports_name"),
                        "from"      => array("$monthlyReports_toemail", "$monthlyReports_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => array("$monthlyReports_bccemail"=>"$monthlyReports_name"),
                        "subject"   => "$monthlyReports_forVisitorSubject",
                        "html"      => "$monthlyReports_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($monthlyReports_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($monthlyReports_id, 'email_status', '0');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- REPORTS - QUARTERLY -->
<div>
    <h2 class="center">Reports - Quarterly</h2>
    <?php
    query_posts( array( 
        'post_type' => 'quarterly_reports', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'email_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $quarterlyReports_id             = get_the_ID();
                $quarterlyReports_postID         = get_field('post_id');
                $quarterlyReports_name           = get_field('added_by');
                $quarterlyReports_email          = get_field('email', $quarterlyReports_postID);
                $quarterlyReports_status         = get_field('email_status');
                
                
                $field_quarter_period = get_field_object('quarter_period');
                $value_quarter_period = get_field('quarter_period');
                $label_quarter_period = $field_quarter_period['choices'][ $value_quarter_period ];
                ?>
                
                <tr>
                    <td><?php echo $quarterlyReports_id; ?></td>
                    <td><?php echo $quarterlyReports_postID; ?></td>
                    <td><?php echo $quarterlyReports_name; ?></td>
                    <td><?php echo $quarterlyReports_email; ?></td>
                    <td><?php echo 'Email Status: '.$quarterlyReports_status; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $quarterlyReports_toname     = get_field('quarterlyReports_name', 'option');
                    $quarterlyReports_toemail    = get_field('quarterlyReports_email', 'option');
                    $quarterlyReports_bccemail   = get_field('quarterlyReports_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $quarterlyReports_fromname   = $quarterlyReports_name; 
                    $quarterlyReports_fromemail  = $quarterlyReports_email; 
                    
                    $quarterlyReports_forVisitorSubject      = get_field('quarterlyReports_subject', 'option');
                    $quarterlyReports_forVisitorContent1     = str_replace('{ca-no}', get_field('ca-no'), get_field('quarterlyReports_content', 'option'));
                    $quarterlyReports_forVisitorContent2     = str_replace('{quarter_period}', $label_quarter_period, $quarterlyReports_forVisitorContent1);
                    $quarterlyReports_forVisitorContent3     = str_replace('{year}', get_field('year'), $quarterlyReports_forVisitorContent2);
                    $quarterlyReports_forVisitorContent4     = str_replace('{crediting_hours}', get_field('crediting_hours'), $quarterlyReports_forVisitorContent3);
                    $quarterlyReports_forVisitorContent5     = str_replace('{date_of_training}', get_field('date_of_training'), $quarterlyReports_forVisitorContent4);
                    $quarterlyReports_forVisitorContent6     = str_replace('{venue_of_training}', get_field('venue_of_training'), $quarterlyReports_forVisitorContent5);
                    $quarterlyReports_forVisitorContent7     = str_replace('{amount_of_training_of_participants}', get_field('amount_of_training_of_participants'), $quarterlyReports_forVisitorContent6);
                    $quarterlyReports_forVisitorContent8     = str_replace('{remarks}', get_field('remarks'), $quarterlyReports_forVisitorContent7);
                    $quarterlyReports_forVisitoremailcontent = "<div>Dear $quarterlyReports_fromname,</div><br/>  $quarterlyReports_forVisitorContent8";
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $quarterlyReports_visitors_data   = array( 
                        "to"        => array("$quarterlyReports_email"=>"$quarterlyReports_name"),
                        "from"      => array("$quarterlyReports_toemail", "$quarterlyReports_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => array("$quarterlyReports_bccemail"=>"$quarterlyReports_name"),
                        "subject"   => "$quarterlyReports_forVisitorSubject",
                        "html"      => "$quarterlyReports_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($quarterlyReports_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($quarterlyReports_id, 'email_status', '0');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- REPORTS - YEARLY -->
<div>
    <h2 class="center">Reports - Yearly</h2>
    <?php
    query_posts( array( 
        'post_type' => 'yearly_reports', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'email_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $yearlyReports_id             = get_the_ID();
                $yearlyReports_postID         = get_field('post_id');
                $yearlyReports_name           = get_field('added_by');
                $yearlyReports_email          = get_field('email', $yearlyReports_postID);
                $yearlyReports_status         = get_field('email_status');
                ?>
                
                <tr>
                    <td><?php echo $yearlyReports_id; ?></td>
                    <td><?php echo $yearlyReports_postID; ?></td>
                    <td><?php echo $yearlyReports_name; ?></td>
                    <td><?php echo $yearlyReports_email; ?></td>
                    <td><?php echo 'Email Status: '.$yearlyReports_status; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $yearlyReports_toname     = get_field('yearlyReports_name', 'option');
                    $yearlyReports_toemail    = get_field('yearlyReports_email', 'option');
                    $yearlyReports_bccemail   = get_field('yearlyReports_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $yearlyReports_fromname   = $yearlyReports_name; 
                    $yearlyReports_fromemail  = $yearlyReports_email; 
                    
                    $yearlyReports_forVisitorSubject      = get_field('yearlyReports_subject', 'option');
                    $yearlyReports_forVisitorContent1     = str_replace('{title_of_training}', get_field('title_of_training'), get_field('yearlyReports_content', 'option'));
                    $yearlyReports_forVisitorContent2     = str_replace('{no_of_trainings}', get_field('no_of_trainings'), $yearlyReports_forVisitorContent1);
                    $yearlyReports_forVisitorContent3     = str_replace('{date_conducted}', get_field('date_conducted'), $yearlyReports_forVisitorContent2);
                    $yearlyReports_forVisitorContent4     = str_replace('{no_of_participants}', get_field('no_of_participants'), $yearlyReports_forVisitorContent3);
                    $yearlyReports_forVisitoremailcontent = "<div>Dear $yearlyReports_fromname,</div><br/>  $yearlyReports_forVisitorContent4";
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $yearlyReports_visitors_data   = array( 
                        "to"        => array("$yearlyReports_email"=>"$yearlyReports_name"),
                        "from"      => array("$yearlyReports_toemail", "$yearlyReports_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => array("$yearlyReports_bccemail"=>"$yearlyReports_name"),
                        "subject"   => "$yearlyReports_forVisitorSubject",
                        "html"      => "$yearlyReports_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($yearlyReports_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($yearlyReports_id, 'email_status', '0');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- ACCREDITATION (CRITS) - PENDING -->
<div>
    <h2 class="center">Accreditation (CRITS) - Pending Status</h2>
    <?php
    query_posts( array( 
        'post_type' => 'accreditations', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status_ses',
                'value'    => 'Pending',
                'compare'  => '=='
            ),
            array(
                'key'      => 'pending_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $critsPending_postid         = get_the_ID();
                $critsPending_requestor_id   = get_field('post_id');
                $critsPending_requestor      = get_field('requestor');
                $critsPending_email          = get_field('email', $critsPending_requestor_id);
                $critsPending_ca_no          = get_field('ca_no');
                $critsPending_emailstatus    = get_field('pending_status');
                $critsPending_region         = get_field('region');
                ?>
                
                <tr>
                    <td><?php echo $critsPending_postid; ?></td>
                    <td><?php echo $critsPending_requestor_id; ?></td>
                    <td><?php echo $critsPending_requestor; ?></td>
                    <td><?php echo $critsPending_ca_no; ?></td>
                    <td><?php echo $critsPending_region; ?></td>
                    <td><?php echo 'Email Status: '.$critsPending_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $critsPending_toname     = get_field('critsPending_name', 'option');
                    $critsPending_toemail    = get_field('critsPending_email', 'option');
                    $critsPending_bccemail   = get_field('critsPending_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $critsPending_fromname   = $critsPending_requestor; 
                    $critsPending_fromemail  = $critsPending_email; 
                    
                    $critsPending_forVisitorSubject1    = str_replace('{accreditation_number}', $critsPending_ca_no, get_field('critsPending_subject', 'option'));
                    $critsPending_forVisitorSubject2    = str_replace('{participant_name}', $critsPending_requestor, $critsPending_forVisitorSubject1);
                    $critsPending_forVisitorSubject     = $critsPending_forVisitorSubject2;
                    
                    $critsPending_forVisitorContent1     = get_field('critsPending_content', 'option');
                    $critsPending_forVisitoremailcontent = "<div>Dear $critsPending_fromname,</div><br/>  $critsPending_forVisitorContent1";
                ?>
                
                <!-- RECEIVER: CLIENT -->
                <?php
                    $critsPending_emailArray = explode(',', get_field('delegates_id', $critsPending_postid));
                    $critsPending_emailToArray = [];
                    
                    for($critsPending_i=0; $critsPending_i<count($critsPending_emailArray); $critsPending_i++){
                        $critsPending_delegateID = $critsPending_emailArray[$critsPending_i];
                        $critsPending_emailToArray[get_field('email_address', $critsPending_delegateID)] = get_field("first_name", $critsPending_delegateID)." ".get_field("last_name", $critsPending_delegateID);
                    }
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $critsPending_visitors_data   = array( 
                        "to"        => array("$critsPending_email"=>"$critsPending_requestor"),
                        "from"      => array("$critsPending_toemail", "$critsPending_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => $critsPending_emailToArray,
                        "subject"   => "$critsPending_forVisitorSubject",
                        "html"      => "$critsPending_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($critsPending_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($critsPending_postid, 'pending_status', '0');
                        update_post_meta($critsPending_postid, 'approved_status', '1');
                        update_post_meta($critsPending_postid, 'rejected_status', '1');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- ACCREDITATION (CRITS) - APPROVED -->
<div>
    <h2 class="center">Accreditation (CRITS) - Approved Status</h2>
    <?php
    query_posts( array( 
        'post_type' => 'accreditations', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status_ses',
                'value'    => 'Approved',
                'compare'  => '=='
            ),
            array(
                'key'      => 'approved_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $critsApproved_postid         = get_the_ID();
                $critsApproved_requestor_id   = get_field('post_id');
                $critsApproved_requestor      = get_field('requestor');
                $critsApproved_email          = get_field('email', $critsApproved_requestor_id);
                $critsApproved_ca_no          = get_field('ca_no');
                $critsApproved_emailstatus    = get_field('approved_status');
                $critsApproved_region         = get_field('region');
                ?>
                
                <tr>
                    <td><?php echo $critsApproved_postid; ?></td>
                    <td><?php echo $critsApproved_requestor_id; ?></td>
                    <td><?php echo $critsApproved_requestor; ?></td>
                    <td><?php echo $critsApproved_ca_no; ?></td>
                    <td><?php echo $critsApproved_region; ?></td>
                    <td><?php echo 'Email Status: '.$critsApproved_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $critsApproved_toname     = get_field('critsApproved_name', 'option');
                    $critsApproved_toemail    = get_field('critsApproved_email', 'option');
                    $critsApproved_bccemail   = get_field('critsApproved_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $critsApproved_fromname   = $critsApproved_requestor; 
                    $critsApproved_fromemail  = $critsApproved_email; 
                    
                    $critsApproved_forVisitorSubject1    = str_replace('{accreditation_number}', $critsApproved_ca_no, get_field('critsApproved_subject', 'option'));
                    $critsApproved_forVisitorSubject2    = str_replace('{participant_name}', $critsApproved_requestor, $critsApproved_forVisitorSubject1);
                    $critsApproved_forVisitorSubject     = $critsApproved_forVisitorSubject2;
                    
                    $critsApproved_forVisitorContent1     = get_field('critsApproved_content', 'option');
                    $critsApproved_forVisitoremailcontent = "<div>Dear $critsApproved_fromname,</div><br/>  $critsApproved_forVisitorContent1";
                    
                    $critsApproved_forAFISemailcontent = "Good Day, <br><br> The Application for accreditation of $critdApproved_requestor has been Endorsed to Head Office.
                    <br><br>
                    Please log in your account to CDA AFIS to view this application.
                    ";
                ?>
                
                <!-- RECEIVER: CLIENT -->
                <?php
                    $critsApproved_emailArray = explode(',', get_field('delegates_id', $critsApproved_postid));
                    $critsApproved_emailToArray = [];
                    
                    for($critsApproved_i=0; $critsApproved_i<count($critsApproved_emailArray); $critsApproved_i++){
                        $critsApproved_delegateID = $critsApproved_emailArray[$critsApproved_i];
                        $critsApproved_emailToArray[get_field('email_address', $critsApproved_delegateID)] = get_field("first_name", $critsApproved_delegateID)." ".get_field("last_name", $critsApproved_delegateID);
                        
                        
                        if((get_field('user_role', $critsApproved_delegateID) == "ho_cds_1") || (get_field('user_role', $critdApproved_delegateID) == "ho_cds_2") || 
                        (get_field('user_role', $critsApproved_delegateID) == "ho_senior_cds") || (get_field('user_role', $critsApproved_delegateID) == "ho_chief_cds")){
                            $critsApproved_afis_data   = array( 
                                "to"        => array(get_field('email_address', $critsApproved_delegateID)=>get_field("first_name", $critsApproved_delegateID)." ".get_field("last_name", $critsApproved_delegateID)),
                                "from"      => array("$critsApproved_email", "$critsApproved_requestor"),
                                "replyto"   => array($noReply),
                                "bcc"       => "diego@mybusybee.net",
                                "subject"   => "$critsApproved_forVisitorContent1",
                                "html"      => "$critsApproved_forAFISemailcontent"
                            );
                            
                            var_dump($mailin->send_email($critsApproved_afis_data));
                        }
                    }
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $critsApproved_visitors_data   = array( 
                        "to"        => array("$critsApproved_email"=>"$critsApproved_requestor"),
                        "from"      => array("$critsApproved_toemail", "$critsApproved_toname"),
                        "replyto"   => array($noReply),
                        // "bcc"       => $critsApproved_emailToArray,
                        "subject"   => "$critsApproved_forVisitorSubject",
                        "html"      => "$critsApproved_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($critsApproved_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($critsApproved_postid, 'pending_status', '1');
                        update_post_meta($critsApproved_postid, 'approved_status', '0');
                        update_post_meta($critsApproved_postid, 'rejected_status', '1');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- ACCREDITATION (CRITS) - DEFERRED -->
<div>
    <h2 class="center">Accreditation (CRITS) - Deferred Status</h2>
    <?php
    query_posts( array( 
        'post_type' => 'accreditations', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status_ses',
                'value'    => 'Deferred',
                'compare'  => '=='
            ),
            array(
                'key'      => 'rejected_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $critsRejected_postid         = get_the_ID();
                $critsRejected_requestor_id   = get_field('post_id');
                $critsRejected_requestor      = get_field('requestor');
                $critsRejected_email          = get_field('email', $critsRejected_requestor_id);
                $critsRejected_ca_no          = get_field('ca_no');
                $critsRejected_emailstatus    = get_field('rejected_status');
                $critsRejected_region         = get_field('region');
                ?>
                
                <tr>
                    <td><?php echo $critsRejected_postid; ?></td>
                    <td><?php echo $critsRejected_requestor_id; ?></td>
                    <td><?php echo $critsRejected_requestor; ?></td>
                    <td><?php echo $critsRejected_ca_no; ?></td>
                    <td><?php echo $critsRejected_region; ?></td>
                    <td><?php echo 'Email Status: '.$critsRejected_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $critsRejected_toname     = get_field('critsRejected_name', 'option');
                    $critsRejected_toemail    = get_field('critsRejected_email', 'option');
                    $critsRejected_bccemail   = get_field('critsRejected_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $critsRejected_fromname   = $critsRejected_requestor; 
                    $critsRejected_fromemail  = $critsRejected_email; 
                    
                    $critsRejected_forVisitorSubject1    = str_replace('{accreditation_number}', $critsRejected_ca_no, get_field('critsRejected_subject', 'option'));
                    $critsRejected_forVisitorSubject2    = str_replace('{participant_name}', $critsRejected_requestor, $critsRejected_forVisitorSubject1);
                    $critsRejected_forVisitorSubject     = $critsRejected_forVisitorSubject2;
                    
                    $critsRejected_forVisitorContent1     = get_field('critsRejected_content', 'option');
                    $critsRejected_forVisitoremailcontent = "<div>Dear $critsRejected_fromname,</div><br/>  $critsRejected_forVisitorContent1";
                ?>
                
                <!-- RECEIVER: CLIENT -->
                <?php
                    $critsRejected_emailArray = explode(',', get_field('delegates_id', $critsRejected_postid));
                    $critsRejected_emailToArray = [];
                    
                    for($critsRejected_i=0; $critsRejected_i<count($critsRejected_emailArray); $critsRejected_i++){
                        $critsRejected_delegateID = $critsRejected_emailArray[$critsRejected_i];
                        $critsRejected_emailToArray[get_field('email_address', $critsRejected_delegateID)] = get_field("first_name", $critsRejected_delegateID)." ".get_field("last_name", $critsRejected_delegateID);
                    }
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $critsRejected_visitors_data   = array( 
                        "to"        => array("$critsRejected_email"=>"$critsRejected_requestor"),
                        "from"      => array("$critsRejected_toemail", "$critsRejected_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => $critsRejected_emailToArray,
                        "subject"   => "$critsRejected_forVisitorSubject",
                        "html"      => "$critsRejected_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($critsRejected_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($critsRejected_postid, 'pending_status', '1');
                        update_post_meta($critsRejected_postid, 'approved_status', '1');
                        update_post_meta($critsRejected_postid, 'rejected_status', '0');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- ACCREDITATION (CRITD) - PENDING -->
<div>
    <h2 class="center">Accreditation (CRITD) - Pending Status</h2>
    <?php
    query_posts( array( 
        'post_type' => 'accreditations', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status_ses',
                'value'    => 'Approved',
                'compare'  => '=='
            ),
            array(
                'key'      => 'status_sed',
                'value'    => 'Pending',
                'compare'  => '=='
            ),
            array(
                'key'      => 'critd_pending_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $critdPending_postid         = get_the_ID();
                $critdPending_requestor_id   = get_field('post_id');
                $critdPending_requestor      = get_field('requestor');
                $critdPending_email          = get_field('email', $critdPending_requestor_id);
                $critdPending_ca_no          = get_field('ca_no');
                $critdPending_emailstatus    = get_field('critd_pending_status');
                $critdPending_region         = get_field('region');
                ?>
                
                <tr>
                    <td><?php echo $critdPending_postid; ?></td>
                    <td><?php echo $critdPending_requestor_id; ?></td>
                    <td><?php echo $critdPending_requestor; ?></td>
                    <td><?php echo $critdPending_ca_no; ?></td>
                    <td><?php echo $critdPending_region; ?></td>
                    <td><?php echo 'Email Status: '.$critdPending_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $critdPending_toname     = get_field('critdPending_name', 'option');
                    $critdPending_toemail    = get_field('critdPending_email', 'option');
                    $critdPending_bccemail   = get_field('critdPending_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $critdPending_fromname   = $critdPending_requestor; 
                    $critdPending_fromemail  = $critdPending_email; 
                    
                    $critdPending_forVisitorSubject1    = str_replace('{accreditation_number}', $critdPending_ca_no, get_field('critdPending_subject', 'option'));
                    $critdPending_forVisitorSubject2    = str_replace('{participant_name}', $critdPending_requestor, $critdPending_forVisitorSubject1);
                    $critdPending_forVisitorSubject     = $critdPending_forVisitorSubject2;
                    
                    $critdPending_forVisitorContent1     = get_field('critdPending_content', 'option');
                    $critdPending_forVisitoremailcontent = "<div>Dear $critdPending_fromname,</div><br/>  $critdPending_forVisitorContent1";
                    
                ?>
                
                <!-- RECEIVER: CLIENT -->
                <?php
                    $critdPending_emailArray = explode(',', get_field('delegates_id', $critdPending_postid));
                    $critdPending_emailToArray = [];
                    
                    for($critdPending_i=0; $critdPending_i<count($critdPending_emailArray); $critdPending_i++){
                        $critdPending_delegateID = $critdPending_emailArray[$critdPending_i];
                        $critdPending_emailToArray[get_field('email_address', $critdPending_delegateID)] = get_field("first_name", $critdPending_delegateID)." ".get_field("last_name", $critdPending_delegateID);
                    }
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $critdPending_visitors_data   = array( 
                        "to"        => array("$critdPending_email"=>"$critdPending_requestor"),
                        "from"      => array("$critdPending_toemail", "$critdPending_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => $critdPending_emailToArray,
                        "subject"   => "$critdPending_forVisitorSubject",
                        "html"      => "$critdPending_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                    
                    if($mailin->send_email($critdPending_visitors_data)["code"] == "success"){
                            
                        // update email status
                        update_post_meta($critdPending_postid, 'critd_pending_status', '0');
                        update_post_meta($critdPending_postid, 'critd_approved_status', '1');
                        update_post_meta($critdPending_postid, 'critd_rejected_status', '1');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- ACCREDITATION (CRITD) - APPROVED -->
<div>
    <h2 class="center">Accreditation (CRITD) - Approved Status</h2>
    <?php
    query_posts( array( 
        'post_type' => 'accreditations', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status_ses',
                'value'    => 'Approved',
                'compare'  => '=='
            ),
            array(
                'key'      => 'status_sed',
                'value'    => 'Approved',
                'compare'  => '=='
            ),
            array(
                'key'      => 'critd_approved_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $critdApproved_postid         = get_the_ID();
                $critdApproved_requestor_id   = get_field('post_id');
                $critdApproved_requestor      = get_field('requestor');
                $critdApproved_email          = get_field('email', $critdApproved_requestor_id);
                $critdApproved_ca_no          = get_field('ca_no');
                $critdApproved_emailstatus    = get_field('critd_approved_status');
                $critdApproved_region         = get_field('region');
                ?>
                
                <tr>
                    <td><?php echo $critdApproved_postid; ?></td>
                    <td><?php echo $critdApproved_requestor_id; ?></td>
                    <td><?php echo $critdApproved_requestor; ?></td>
                    <td><?php echo $critdApproved_ca_no; ?></td>
                    <td><?php echo $critdApproved_region; ?></td>
                    <td><?php echo 'Email Status: '.$critdApproved_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $critdApproved_toname     = get_field('critdApproved_name', 'option');
                    $critdApproved_toemail    = get_field('critdApproved_email', 'option');
                    $critdApproved_bccemail   = get_field('critdApproved_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $critdApproved_fromname   = $critdApproved_requestor; 
                    $critdApproved_fromemail  = $critdApproved_email; 
                    
                    $critdApproved_forVisitorSubject1    = str_replace('{accreditation_number}', $critdApproved_ca_no, get_field('critdApproved_subject', 'option'));
                    $critdApproved_forVisitorSubject2    = str_replace('{participant_name}', $critdApproved_requestor, $critdApproved_forVisitorSubject1);
                    $critdApproved_forVisitorSubject     = $critdApproved_forVisitorSubject2;
                    
                    $critdApproved_forVisitorContent1     = get_field('critdApproved_content', 'option');
                    $critdApproved_forVisitoremailcontent = "<div>Dear $critdApproved_fromname,</div><br/>  $critdApproved_forVisitorContent1";
                    
                    $critdApproved_forAFISemailcontent = "Good Day, <br><br> The Application for accreditation of $critdApproved_requestor has been Approved.
                    <br><br>
                    Please log in your account to CDA AFIS to view this application.
                    ";
                ?>
                
                <!-- RECEIVER: CLIENT -->
                <?php
                    $critdApproved_emailArray = explode(',', get_field('delegates_id', $critdApproved_postid));
                    $critdApproved_emailToArray = [];
                    
                    for($critdApproved_i=0; $critdApproved_i<count($critdApproved_emailArray); $critdApproved_i++){
                        $critdApproved_delegateID = $critdApproved_emailArray[$critdApproved_i];
                        $critdApproved_emailToArray[get_field('email_address', $critdApproved_delegateID)] = get_field("first_name", $critdApproved_delegateID)." ".get_field("last_name", $critdApproved_delegateID);
                        
                        
                        if((get_field('user_role', $critdApproved_delegateID) == "critd_cd-2") || (get_field('user_role', $critdApproved_delegateID) == "critd_senior_cds")  || (get_field('user_role', $critdApproved_delegateID) == "critd_supervising_cds") ||
                        (get_field('user_role', $critdApproved_delegateID) == "critd_chief_of_division") || (get_field('user_role', $critdApproved_delegateID) == "ho_cds_1") || (get_field('user_role', $critdApproved_delegateID) == "ho_cds_2") || 
                        (get_field('user_role', $critdApproved_delegateID) == "ho_senior_cds") || (get_field('user_role', $critdApproved_delegateID) == "ho_chief_cds")){
                            $critdApproved_afis_data   = array( 
                                "to"        => array(get_field('email_address', $critdApproved_delegateID)=>get_field("first_name", $critdApproved_delegateID)." ".get_field("last_name", $critdApproved_delegateID)),
                                "from"      => array("$critdApproved_email", "$critdApproved_requestor"),
                                "replyto"   => array($noReply),
                                "bcc"       => "diego@mybusybee.net",
                                "subject"   => "$critdApproved_forVisitorSubject",
                                "html"      => "$critdApproved_forAFISemailcontent"
                            );
                            
                            var_dump($mailin->send_email($critdApproved_afis_data));
                        }
                    }
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $critdApproved_visitors_data   = array( 
                        "to"        => array("$critdApproved_email"=>"$critdApproved_requestor"),
                        "from"      => array("$critdApproved_toemail", "$critdApproved_toname"),
                        "replyto"   => array($noReply),
                        // "bcc"       => $critdApproved_emailToArray,
                        "subject"   => "$critdApproved_forVisitorSubject",
                        "html"      => "$critdApproved_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                    
                    if($mailin->send_email($critdApproved_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($critdApproved_postid, 'critd_pending_status', '1');
                        update_post_meta($critdApproved_postid, 'critd_approved_status', '0');
                        update_post_meta($critdApproved_postid, 'critd_rejected_status', '1');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>

<!-- ACCREDITATION (CRITD) - DEFERRED -->
<div>
    <h2 class="center">Accreditation (CRITD) - Deferred Status</h2>
    <?php
    query_posts( array( 
        'post_type' => 'accreditations', 
        'post_status' => array('publish', 'pending'),
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'status_ses',
                'value'    => 'Approved',
                'compare'  => '=='
            ),
            array(
                'key'      => 'status_sed',
                'value'    => 'Deferred',
                'compare'  => '=='
            ),
            array(
                'key'      => 'critd_rejected_status',
                'value'    => '1',
                'compare'  => 'LIKE'
            )
        )
    ));
    
    if ( have_posts() ) : 
        echo '<table border="1" cellspacing="5" cellpadding="5">';
            while ( have_posts() ) : the_post(); ?>
                <?php 
                $critdRejected_postid         = get_the_ID();
                $critdRejected_requestor_id   = get_field('post_id');
                $critdRejected_requestor      = get_field('requestor');
                $critdRejected_email          = get_field('email', $critdRejected_requestor_id);
                $critdRejected_ca_no          = get_field('ca_no');
                $critdRejected_emailstatus    = get_field('critd_rejected_status');
                $critdRejected_region         = get_field('region');
                ?>
                
                <tr>
                    <td><?php echo $critdRejected_postid; ?></td>
                    <td><?php echo $critdRejected_requestor_id; ?></td>
                    <td><?php echo $critdRejected_requestor; ?></td>
                    <td><?php echo $critdRejected_ca_no; ?></td>
                    <td><?php echo $critdRejected_region; ?></td>
                    <td><?php echo 'Email Status: '.$critdRejected_emailstatus; ?></td>
                </tr> 
                
                <?php 
                    // CLIENT
                    $critdRejected_toname     = get_field('critdRejected_name', 'option');
                    $critdRejected_toemail    = get_field('critdRejected_email', 'option');
                    $critdRejected_bccemail   = get_field('critdRejected_bcc_email', 'option');
                    
                    // WEBSITE VISITORS
                    $critdRejected_fromname   = $critdRejected_requestor; 
                    $critdRejected_fromemail  = $critdRejected_email; 
                    
                    $critdRejected_forVisitorSubject1    = str_replace('{accreditation_number}', $critdRejected_ca_no, get_field('critdRejected_subject', 'option'));
                    $critdRejected_forVisitorSubject2    = str_replace('{participant_name}', $critdRejected_requestor, $critdRejected_forVisitorSubject1);
                    $critdRejected_forVisitorSubject     = $critdRejected_forVisitorSubject2;
                    
                    $critdRejected_forVisitorContent1     = get_field('critdRejected_content', 'option');
                    $critdRejected_forVisitoremailcontent = "<div>Dear $critdRejected_fromname,</div><br/>  $critdRejected_forVisitorContent1";
                ?>
                
                <?php
                    $critdRejected_emailArray = explode(',', get_field('delegates_id', $critdRejected_postid));
                    $critdRejected_emailToArray = [];
                    
                    for($critdRejected_i=0; $critdRejected_i<count($critdRejected_emailArray); $critdRejected_i++){
                        $critdRejected_delegateID = $critdRejected_emailArray[$critdRejected_i];
                        $critdRejected_emailToArray[get_field('email_address', $critdRejected_delegateID)] = get_field("first_name", $critdRejected_delegateID)." ".get_field("last_name", $critdRejected_delegateID);
                    }
                ?>
                
                <!-- RECEIVER: WEBSITE VISITORS -->
                <?php
                    $critdRejected_visitors_data   = array( 
                        "to"        => array("$critdRejected_email"=>"$critdRejected_requestor"),
                        "from"      => array("$critdRejected_toemail", "$critdRejected_toname"),
                        "replyto"   => array($noReply),
                        "bcc"       => $critdRejected_emailToArray,
                        "subject"   => "$critdRejected_forVisitorSubject",
                        "html"      => "$critdRejected_forVisitoremailcontent"
                    );
                    
                    global $wpdb;
                        
                    if($mailin->send_email($critdRejected_visitors_data)["code"] == "success"){
                        
                        // update email status
                        update_post_meta($critdRejected_postid, 'critd_pending_status', '1');
                        update_post_meta($critdRejected_postid, 'critd_approved_status', '1');
                        update_post_meta($critdRejected_postid, 'critd_rejected_status', '0');
                    }
                ?>
            <?php endwhile; ?>
        </table>
        
    <?php else : ?>
        <p class="center">NO Pending Email Notifications.</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>
