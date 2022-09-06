<?php
$p = $_GET["post_id"]; 
$posts = get_posts([
    "numberposts" => 1,
    "post_type" => ["ctpro", "cea"],
    "post_status" => ["publish", "pending"],
    "meta_query" => [
        "relation" => "AND",
        [
            "key" => "post_id",
            "value" => $p,
            "compare" => "=",
        ],
    ],
]);
if (have_posts()):
    while (have_posts()):
        the_post();
        
        acf_form([
            "post_id" => $p,
            "field_groups" => ['group_61ca5de56cf9d', 'group_61dec54a1548d'],
            $cpost => [
                "post_type" => "ctpro",
                "post_status" => ["publish", "pending"],
            ],
            "updated_message" => __("", "acf"),
            "submit_value" => __("Update", acf),
            "return" => "?success=$p&&post_id=$get_post_id&&application=yes",
        ]);
        
    endwhile;
endif;
?>

<?php if($_GET['success'] != '') {
    wp_update_post(array( 'ID' => $p, 'post_status' => 'publish' ));
    $returnedID;
    $args = array(
        'post_type' => array(
            'accreditations'
        ),
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'ca_no',
                'value'    => get_field('ca-no', $p),
                'compare'  => '=='
            )
        )
    );
    $variable_ca_no = new WP_Query($args);
    if ($variable_ca_no->have_posts()): the_post(); ?>
        <?php while( $variable_ca_no->have_posts() ): $variable_ca_no->the_post(); ?>
            <?php
                update_field('delegates_id', get_field('delegates_id', $p), get_the_id());
            ?>
        <?php endwhile; ?>
    <?php else : ?>
    <?php endif; ?>
    <?php wp_reset_query();
    
    
}
?>

<style>
    .acf-field.acf-field-61ca5df75925e p.description {
        display: none;
    }
</style>

<script>
    $( document ).ready(function() {
        $(".acf-field-61ca5df75925e").removeClass("frontendhidden");
    });
</script>
