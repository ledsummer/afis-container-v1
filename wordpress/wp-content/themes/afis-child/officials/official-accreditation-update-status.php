<?php
$p = $_GET["post_id"]; 
$acc_id = $_GET["acc_id"]; 
$args = array(
    'post_type' => array(
        'accreditations'
    ),
    'post_status' => array(
        'publish'
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
        <?php if(get_the_id() == $acc_id){ ?>
        <div class="announcement">
    		<div class="headerAccountSidebar">
    			<i class="fas fa-user-edit"></i> Update Status
    		</div>
            <?php
            $cpost = get_the_ID();
            acf_form([
                "post_id" => $cpost,
                "field_groups" => [$groupkey],
                $cpost => [
                    "post_type" => "accreditations",
                    "post_status" => "publish",
                ],
                "updated_message" => __("", "acf"),
                "submit_value" => __("Update", acf),
                "return" => "?success=$p&&post_id=$get_post_id&acc_id=$acc_id",
            ]);
            ?>
        </div>
        <?php } ?>
        <!--<div class="announcement"> -->
        <!--    <div class="headerAccountSidebar"><i class="fas fa-certificate"></i> Upload Certificate  </div>-->
            <?php
            // acf_form([
            //     "post_id" => $cpost,
            //     "field_groups" => ["group_61d2e78fb2d56"],
            //     $cpost => [
            //         "post_type" => array('accreditations'),
            //         "post_status" => "publish",
            //     ],
            //     "updated_message" => __("", "acf"),
            //     "submit_value" => __("Upload", acf),
            //     "return" => "?success=$p&&post_id=$get_post_id",
            // ]);
            ?>
		<!--</div>-->
		<script>
    		<?php
		    function generateca($length) {
                $characters = '123456789';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0;$i < $length;$i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1) ];
                }
                return $randomString;
            }
          
            $cea = generateca(4);
            ?>
		  //  document.getElementById("acf-field_622eab59a259b").value = "<?php echo get_field('cea-no', $p); ?>";
		    
		    
		    <?php if(get_field('cea-no', $p) == "") { ?>
                <?php if(get_field('type_of_cea', $p) == "Firm") { ?>
                    document.getElementById("acf-field_622eab59a259b").value = "<?php echo $cea; ?>-AF";
                <?php } else { ?>
                    document.getElementById("acf-field_622eab59a259b").value = "<?php echo $cea; ?>";
                <?php } ?>
    	    <?php } else { ?>  
    	        document.getElementById("acf-field_622eab59a259b").value = "<?php echo get_field('cea-no', $p); ?>";
    	    <?php } ?>
		</script>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
