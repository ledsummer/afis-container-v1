<?php
/* Template Name: Contact Us */
get_header();
acf_form_head();
?>
<?php include ("account-header.php"); ?>
<?php
$page_object = get_queried_object();
$page_id     = get_queried_object_id();
?>
<div class="container">
    <div class="col-mid-15">
        <?php include ("account-sidebar.php"); ?>
    </div>
    <div class="col-mid-85"  id="main-content">
        <div class="standardCenter" style="height:100vh !important;">
            <div class="account-information" style="width:100%;">
                <?php if($page_id == 159){ ?> <!-- Contact Us -->
                    <?php if(($user_roles[0] == "ctpro") || ($user_roles[0] == "cea")){ ?>
                        <div class="headerAccount"><i class="fas fa-certificate"></i> Ticket Concerns</div>
                        <div class="tabs">
                            <input type="radio" name="tabs" id="listcert" checked="checked">
                            <label for="listcert"></label>
                            <div class="tab">
                                <div style="text-align:right;">
                                    <a href="contact-us-submission/" class="nextbtn" target="_blank"><button>Create new ticket</button></a>
                                </div>
                                
                                <div class="clear"></div>
                                <br>
                                
                                <?php include( get_template_directory() . '-child/my-account/contact-us/account-contact-us-table.php' ); ?>
                            </div>   
                        </div>
                    <?php } else { ?>
                        <div class="headerAccount"><i class="fas fa-certificate"></i> Ticket Concerns</div>
                        <div class="tabs">
                            <input type="radio" name="tabs" id="listcert" checked="checked">
                            <label for="listcert"></label>
                            <div class="tab">
                                <?php include( get_template_directory() . '-child/officials/contact-us/account-contact-us-table.php' ); ?>
                            </div>   
                        </div>
                    <?php } ?>
                <?php } else if($page_id == 1372) { ?> <!-- Contact Us Form -->
                    <div class="headerAccount"><i class="fas fa-certificate"></i> Submit your concern</div>
                    <?php include( get_template_directory() . '-child/my-account/contact-us/account-contact-us-form.php' ); ?>
                <?php } else if($page_id == 1387) { ?> <!-- Contact Us View -->
                    
                    <style>
                        .convo-wrapper {
                            padding-right: 15px;
                            max-height: 500px;
                            overflow: hidden;
                            overflow-y: auto;
                        }
                        
                        .convo-wrapper::-webkit-scrollbar {
                          width: 5px;
                        }
                        .convo-wrapper::-webkit-scrollbar-track {
                          background: #ccc; 
                        }
                        .convo-wrapper::-webkit-scrollbar-thumb {
                          background: #00a3ff; 
                        }
                        .convo-wrapper::-webkit-scrollbar-thumb:hover {
                          background: #555; 
                        }
                        
                        .convo {
                            width: 100%;
                            display: block;
                            clear: both;
                            
                            font-size: 13px;
                            padding: 15px;
                            margin-bottom: 15px;
                        }
                        .convo-right {
                            float: right;
                            text-align: right;
                            background: #e5f9f1;
                        }
                        
                        .convo-left {
                            background: #ececf2;
                        }
                        .convo span {
                            display: block;
                            margin-top: 15px;
                        }
                        #acf-form .acf-field-620c5751c5149 {
                            padding-left: 0!important;
                            padding-right: 0!important;
                        }
                    </style>
                    
                    <?php if(($user_roles[0] == "ctpro") || ($user_roles[0] == "cea")){ ?>
                        <?php
                        $tckt_args = array(
                            'posts_per_page'=> 1,
                            'post_type' => array(
                                'ticket_requests'
                            ),
                            'post_status' => array(
                                'publish'
                            ),
                            's' => $_GET['ticket']
                        );
                        
                        $tckt_var = new WP_Query($tckt_args);
                        if ($tckt_var->have_posts()): the_post(); ?>
                            <?php while( $tckt_var->have_posts() ): $tckt_var->the_post(); ?>
                                <?php global $ca, $user_id, $ticket_id, $title, $ticketrequestID;
                                $ticketrequestID = get_the_id();
                                $ca         = get_field('ca_no');
                                $user_id    = get_field('user_id');
                                $ticket_id  = $_GET['ticket'];
                                $title      = get_field('title');
                                
                                ?>
                                <div class="headerAccount"><i class="fas fa-certificate"></i> <?php echo get_field('title'); ?> [ID: <?php echo $_GET['ticket']; ?>]</div>
                                
                                <div id="dConvo-Wrapper" class="convo-wrapper">
                                    <div class="convo convo-right">
                                        <?php echo get_field('message'); ?>
                                    </div>
                                    <?php
                                    $tcktConvo_args = array(
                                        'posts_per_page'=> -1,
                                        'post_type' => array(
                                            'ticket_requests'
                                        ),
                                        'post_status' => array(
                                            'publish'
                                        ),
                                        'meta_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'key'   => 'ticket_id',
                                                'value' => $_GET['ticket'],
                                                'compare' => '='
                                            )
                                        ),
                                        'orderby'   => array(
                                            'date' => 'ASC',
                                        )
                                    );
                                
                                    $tcktConvo_var = new WP_Query($tcktConvo_args);
                                    if ($tcktConvo_var->have_posts()): the_post(); ?>
                                        <?php while( $tcktConvo_var->have_posts() ): $tcktConvo_var->the_post(); ?>
                                            <?php
                                            $fieldRole = get_field_object('user_role', get_field('user_id'));
                                            $valueRole = $fieldRole['value'];
                                            $labelRole = $fieldRole['choices'][ $valueRole ];
                                            ?>
                                            <?php if(get_field('is_officer') != 1){ ?>
                                                <div class="convo convo-right">
                                                    <?php echo get_field('message'); ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="convo convo-left">
                                                    <?php echo get_field('message'); ?>
                                                    <span style="font-size: 13px; font-family:Roboto; font-weight: 600;"> 
                                                    <i class="fas fa-pencil-alt"></i> Author:  <?php echo get_field('region', get_field('user_id')).' - '.get_field('first_name', get_field('user_id')).' '.get_field('last_name', get_field('user_id')).', '.$labelRole; ?> -- <?php echo get_the_date('F d, Y H:i:s'); ?></span>
                                                </div>
                                            <?php } ?>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <?php wp_reset_query(); ?>
                                    
                                    <div class="clear"></div>
                                </div>
                                
                                <script>
                                    $("#dConvo-Wrapper").scrollTop($("#dConvo-Wrapper")[0].scrollHeight);
                                </script>
                                
                                <?php if(get_field('status', $ticketrequestID) == "Closed") { ?>
                                    <div style="margin-top: 50px; background: #fddfe2; padding: 25px 15px; text-align: center;">Closed</div>
                                <?php } else { ?>
                                    <div class="convo-sendMessage">
                                        <style>
                                            .convo-sendMessage .acf-label {
                                                display: none;
                                            }
                                        </style>
                                        <?php
                                        function generateRandomString($length) {
                                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                            $charactersLength = strlen($characters);
                                            $randomString = '';
                                            for ($i = 0; $i < $length; $i++) {
                                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                                            }
                                            return $randomString;
                                        }
                                        $token = generateRandomString(10);
                                        acf_form(array(
                                            'post_id' => 'new_post',
                                            'field_groups' => array(
                                                'group_620c569d82682'
                                            ) ,
                                            'new_post' => array(
                                                'post_type' => 'ticket_requests',
                                                'post_title' => $token,
                                                'post_status' => 'publish',
                                            ) ,
                                            'updated_message' => __("", 'acf'),
                                            'submit_value'  => __('Submit', acf)
                                        ));
                                        ?>
                                        <script>
                                            document.getElementById("acf-field_620c56bbc5142").value = "<?php echo $ca; ?>";
                                            document.getElementById("acf-field_620c56fec5144").value = "<?php echo $user_id; ?>";
                                            document.getElementById("acf-field_620c5743c5147").value = "<?php echo $ticket_id; ?>";
                                            document.getElementById("acf-field_620c5749c5148").value = "<?php echo $title; ?>";
                                            
                                            document.getElementsByClassName('acf-field-620c5749c5148')[0].style.display = "none";
                                       </script>
                                    </div>
                                    
                                    <style>
                                        .acf-field-620ca7aacfeaa {
                                            display: none;
                                        }
                                    </style>
                                <?php } ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    <?php } else { ?>
                        <?php
                        global $getEmailID;
                        $getEmail_args = array(
                            'posts_per_page'=> -1,
                            'post_type' => array(
                                'regional_officers'
                            ),
                            'post_status' => array(
                                'publish'
                            ),
                            'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                    'key' => 'email_address',
                                    'value' => $email,
                                    'compare' => '=',
                                )
                            )
                        );
                        
                        $getEmail_var = new WP_Query($getEmail_args);
                        if ($getEmail_var->have_posts()): the_post(); ?>
                            <?php while( $getEmail_var->have_posts() ): $getEmail_var->the_post(); ?>
                                <?php $getEmailID = get_the_id(); ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                        
                        <?php
                        $tckt_args = array(
                            'posts_per_page'=> 1,
                            'post_type' => array(
                                'ticket_requests'
                            ),
                            'post_status' => array(
                                'publish'
                            ),
                            's' => $_GET['ticket']
                        );
                        
                        $tckt_var = new WP_Query($tckt_args);
                        if ($tckt_var->have_posts()): the_post(); ?>
                            <?php while( $tckt_var->have_posts() ): $tckt_var->the_post(); ?>
                                <?php global $ca, $user_id, $ticket_id, $title, $ticketrequestorID, $ticketrequestID;
                                $ticketrequestID = get_the_id();
                                $ticketrequestorID = get_field('user_id');
                                $ca         = get_field('ca_no');
                                $user_id    = $getEmailID;
                                $ticket_id  = $_GET['ticket'];
                                $title      = get_field('title');
                                ?>
                                <div class="headerAccount">
                                    <div class="col-mid-50">
                                    <i class="fas fa-certificate"></i> <?php echo get_field('title'); ?> [ID: <?php echo $_GET['ticket']; ?>]
                                    </div>
                                    <div class="col-mid-50" style="text-align:right;">
                                        <?php if(($_GET['closed']) || (get_field('status', $ticketrequestID) == "Closed")) { ?>
                                            <a href="view-ticket-concern/?ticket=<?php echo $_GET['ticket']; ?>&open=y" class="nextbtn"><button>Reopen Ticket</button></a>
                                        <?php } else { ?>
                                            <a href="view-ticket-concern/?ticket=<?php echo $_GET['ticket']; ?>&closed=y" class="nextbtn"><button>Close Ticket</button></a>
                                        <?php } ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                
                                <div id="dConvo-Wrapper" class="convo-wrapper">
                                    <div class="convo convo-left">
                                        <?php echo get_field('message'); ?>
                                        <span style="font-size: 13px; font-family:Roboto; font-weight: 600;"> 
                                        <i class="fas fa-pencil-alt"></i> Author:  <?php echo get_field('region', $ticketrequestorID).' - '.get_field('first_name', $ticketrequestorID).' '.get_field('last_name', $ticketrequestorID); ?> -- <?php echo get_the_date('F d, Y H:i:s'); ?></span>
                                    </div>
                                    <?php
                                    $tcktConvo_args = array(
                                        'posts_per_page'=> -1,
                                        'post_type' => array(
                                            'ticket_requests'
                                        ),
                                        'post_status' => array(
                                            'publish'
                                        ),
                                        'meta_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'key'   => 'ticket_id',
                                                'value' => $_GET['ticket'],
                                                'compare' => '='
                                            )
                                        ),
                                        'orderby'   => array(
                                            'date' => 'ASC',
                                        )
                                    );
                                
                                    $tcktConvo_var = new WP_Query($tcktConvo_args);
                                    if ($tcktConvo_var->have_posts()): the_post(); ?>
                                        <?php while( $tcktConvo_var->have_posts() ): $tcktConvo_var->the_post(); ?>
                                            <?php
                                            $fieldRole = get_field_object('user_role', get_field('user_id'));
                                            $valueRole = $fieldRole['value'];
                                            $labelRole = $fieldRole['choices'][ $valueRole ];
                                            ?>
                                            <?php if(get_field('is_officer') != 1){ ?>
                                                <div class="convo convo-left">
                                                    <?php echo get_field('message'); ?>
                                                    <span style="font-size: 13px; font-family:Roboto; font-weight: 600;"> 
                                                    <i class="fas fa-pencil-alt"></i> Author:  <?php echo get_field('region', $ticketrequestorID).' - '.get_field('first_name', $ticketrequestorID).' '.get_field('last_name', $ticketrequestorID); ?> -- <?php echo get_the_date('F d, Y H:i:s'); ?></span>
                                                </div>
                                            <?php } else { ?>
                                                <div class="convo convo-right">
                                                    <?php echo get_field('message'); ?>
                                                    <span style="font-size: 13px; font-family:Roboto; font-weight: 600;"> 
                                                    <i class="fas fa-pencil-alt"></i> Author:  <?php echo get_field('region', $user_id).' - '.get_field('first_name', $user_id).' '.get_field('last_name', $user_id).', '.$labelRole; ?> -- <?php echo get_the_date('F d, Y H:i:s'); ?></span>
                                                </div>
                                            <?php } ?>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <?php wp_reset_query(); ?>
                                    
                                    <div class="clear"></div>
                                </div>
                                
                                <script>
                                    $("#dConvo-Wrapper").scrollTop($("#dConvo-Wrapper")[0].scrollHeight);
                                </script>
                                
                                <?php
                                if($_GET['closed']) {
                                    update_field( 'field_620ca95084de9', 'Closed', $ticketrequestID );
                                } else if ($_GET['open']) {
                                    update_field( 'field_620ca95084de9', 'Open', $ticketrequestID );
                                }?>
                                
                                <?php if(get_field('status', $ticketrequestID) == "Closed") { ?>
                                    <div style="margin-top: 50px; background: #fddfe2; padding: 25px 15px; text-align: center;">Closed</div>
                                <?php } else { ?>
                                    <div class="convo-sendMessage">
                                        <style>
                                            .convo-sendMessage .acf-label {
                                                display: none;
                                            }
                                        </style>
                                        <?php
                                        function generateRandomString($length) {
                                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                            $charactersLength = strlen($characters);
                                            $randomString = '';
                                            for ($i = 0; $i < $length; $i++) {
                                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                                            }
                                            return $randomString;
                                        }
                                        $token = generateRandomString(10);
                                        acf_form(array(
                                            'post_id' => 'new_post',
                                            'field_groups' => array(
                                                'group_620c569d82682',
                                            ) ,
                                            'new_post' => array(
                                                'post_type' => 'ticket_requests',
                                                'post_title' => $token,
                                                'post_status' => 'publish',
                                            ) ,
                                            'updated_message' => __("", 'acf'),
                                            'submit_value'  => __('Submit', acf)
                                        ));
                                        ?>
                                        <script>
                                            document.getElementById("acf-field_620c56bbc5142").value = "<?php echo $ca; ?>";
                                            document.getElementById("acf-field_620c5710c5145").value = "1";
                                            document.getElementById("acf-field_620c56fec5144").value = "<?php echo $user_id; ?>";
                                            document.getElementById("acf-field_620c5743c5147").value = "<?php echo $ticket_id; ?>";
                                            document.getElementById("acf-field_620c5749c5148").value = "<?php echo $title; ?>";
                                            
                                            document.getElementsByClassName('acf-field-620c5749c5148')[0].style.display = "none";
                                       </script>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
