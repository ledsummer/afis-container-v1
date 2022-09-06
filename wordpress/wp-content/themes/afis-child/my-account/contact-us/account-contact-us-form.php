<?php if (isset($_GET['success'])) { ?>
    <div class="info-success">
        You have successfully submitted your concern
    </div>
<?php } else {
    $current_user = wp_get_current_user();
    $email = $current_user->user_email;
    global $name;
    global $cpost;
    global $token;
    global $ca;
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
            function generateRandomString($length) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $cpost = get_the_ID();
            $token = generateRandomString(10);
            $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');
            $ca =   get_field('ca-no');
            $date = date('M-d-Y');
            acf_form(array(
                'post_id' => 'new_post',
                'field_groups' => array(
                    'group_620c569d82682',
                    'group_620ca9486bfd8'
                ) ,
                'new_post' => array(
                    'post_type' => 'ticket_requests',
                    'post_title' => $token,
                    'post_status' => 'publish',
                ) ,
                'updated_message' => __("", 'acf'),
                'submit_value'  => __('Submit', acf),
                'return' => "?success=$token",
            ));
            ?>                
            <style>
                .acf-field-620ca7aacfeaa {
                    display: none;
                }
            </style>
            <script>
                $('[data-key="field_620c6b1a30741"] ul.acf-actions a[data-event="add-row"]').trigger('click');
                
                
                document.getElementById("acf-field_620c56bbc5142").value = "<?php echo $ca; ?>";
                document.getElementById("acf-field_620c56fec5144").value = "<?php echo $cpost; ?>";
           </script>
        <?php endwhile;
    endif;
} ?>