<?php $cms_userRoles = array(
    "crits-cds_1", "crits-senior_cds", "crits_regional_director",
    "critd_cd-2", "critd_senior_cds", "critd_supervising_cds", "critd_chief_of_division"
    );
?>

<?php
$returnedID; $returnedRegion; $returnedType;
$args_officialEmail = array(
    'posts_per_page'   => -1,
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

<?php
$cms_delegatedIDs = get_field('delegates_id', $get_post_id);
function isSelected($accountID, $delegatedID){
    $result;
    if(preg_match('/(^|,)'.$accountID.'($|,)/', $delegatedID)){
        $result = "selected";
    } else {
        $result = "";
    }
    echo $result;
}
?>

<?php if($returnedType == "CTPRO") { ?>

<!-- CRITS -->
<div class="roleSelect role-crits-cds_1">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'crits-cds_1',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
        <p>REGIONAL - CDS 1</p>
        <select id="crits-cds_1" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            crits_cds_1 = new vanillaSelectBox("#crits-cds_1", {
                placeHolder: "Select Delegate for CRITS CDS-1",
                "maxHeight": 200,
                "translations": { "all": "All CRITS CDS-1", "items": "CRITS CDS-1", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available CRITS CDS-1 --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-crits-senior_cds">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'crits-senior_cds',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
      <p>REGIONAL - Senior CDS</p>
        <select id="crits-senior_cds" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#crits-senior_cds", {
                placeHolder: "Select Delegate for CRITS Senior CDS",
                "maxHeight": 200,
                "translations": { "all": "All CRITS Senior CDS", "items": "CRITS Senior CDS", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available CRITS Senior CDS --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-crits_regional_director">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'crits_regional_director',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
     <p>REGIONAL Director</p>
        <select id="crits_regional_director" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php $isMes; if($returnedID == get_the_id()){ $isMes = "(Me)"; } ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?> <?php echo $isMes; ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#crits_regional_director", {
                placeHolder: "Select Delegate for CRITS Regional Director",
                "maxHeight": 200,
                "translations": { "all": "All CRITS Regional Director", "items": "CRITS Regional Director", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available CRITS Regional Director --</option>
        </select>
    <?php endif; ?>
</div>


<!-- CRITD -->
<div class="roleSelect role-critd_cd-2">
    
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'critd_cd-2',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
     <p>REGIONAL - CDS 2</p>
        <select id="critd_cd-2" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#critd_cd-2", {
                placeHolder: "Select Delegate for CRITD CDS-2",
                "maxHeight": 200,
                "translations": { "all": "All CRITD CDS-2", "items": "CRITD CDS-2", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available CRITD CDS-2 --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-critd_senior_cds">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'critd_senior_cds',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
    <p>Head Office - CDS </p>
        <select id="critd_senior_cds" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#critd_senior_cds", {
                placeHolder: "Select Delegate for CRITD Senior CDS",
                "maxHeight": 200,
                "translations": { "all": "All CRITD Senior CDS", "items": "CRITD Senior CDS", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available CRITD Senior CDS --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-critd_supervising_cds">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'critd_supervising_cds',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
      <p>Head Office - Supervising CDS </p>
        <select id="critd_supervising_cds" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#critd_supervising_cds", {
                placeHolder: "Select Delegate for CRITD Supervising CDS",
                "maxHeight": 200,
                "translations": { "all": "All CRITD Supervising CDS", "items": "CRITD Supervising CDS", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available CRITD Supervising CDS --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-critd_chief_of_division">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'critd_chief_of_division',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
      <p>Head Office - Chief of Division </p>
        <select id="critd_chief_of_division" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php $isMeD; if($returnedID == get_the_id()){ $isMeD = "(Me)"; } ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?> <?php echo $isMeD; ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#critd_chief_of_division", {
                placeHolder: "Select Delegate for CRITD Chief of Division",
                "maxHeight": 200,
                "translations": { "all": "All CRITD Chief of Division", "items": "CRITD Chief of Division", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available CRITD Chief of Division --</option>
        </select>
    <?php endif; ?>
</div>

<?php } else { ?>

<!-- SES -->
<div class="roleSelect role-crits-cds_1">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'ses_cds-2',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
      <p>Head Office - CDS 2 SES</p>
        <select id="crits-cds_1" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            crits_cds_1 = new vanillaSelectBox("#crits-cds_1", {
                placeHolder: "Select Delegate for SES CDS-2",
                "maxHeight": 200,
                "translations": { "all": "All SES CDS-2", "items": "SES CDS-2", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available SES CDS-2 --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-crits-senior_cds">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'ses_senior_cds',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
      <p>Head Office - Senior CDS SES</p>
        <select id="crits-senior_cds" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#crits-senior_cds", {
                placeHolder: "Select Delegate for SES Senior CDS",
                "maxHeight": 200,
                "translations": { "all": "All SES Senior CDS", "items": "SES Senior CDS", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available SES Senior CDS --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-crits_regional_director">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'ses_regional_director',
                'compare'  => '=='
            ),
            array(
                'key' => 'region',
                'value' => $returnedRegion,
                'compare' => '==',
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
       <p>Regional - Director SES</p>
        <select id="crits_regional_director" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php $isMes; if($returnedID == get_the_id()){ $isMes = "(Me)"; } ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?> <?php echo $isMes; ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#crits_regional_director", {
                placeHolder: "Select Delegate for SES Regional Director",
                "maxHeight": 200,
                "translations": { "all": "All SES Regional Director", "items": "SES Regional Director", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available SES Regional Director --</option>
        </select>
    <?php endif; ?>
</div>

<!-- Head Office -->
<div class="roleSelect role-critd_cd-2">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'ho_cds_1',
                'compare'  => '=='
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
       <p>Head Office - CDS 1</p>
        <select id="critd_cd-2" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#critd_cd-2", {
                placeHolder: "Select Delegate for Head Office - CDS-1",
                "maxHeight": 200,
                "translations": { "all": "All Head Office - CDS-1", "items": "Head Office - CDS-1", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available Head Office - CDS-1 --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-critd_senior_cds">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'ho_cds_2',
                'compare'  => '=='
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
       <p>Head Office - CDS 2</p>
        <select id="critd_senior_cds" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#critd_senior_cds", {
                placeHolder: "Select Delegate for Head Office - CDS-2",
                "maxHeight": 200,
                "translations": { "all": "All Head Office - CDS-2", "items": "Head Office - CDS-2", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available Head Office - CDS-2 --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-critd_supervising_cds">
       <p>Head Office - Senior CDS </p>
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'ho_senior_cds',
                'compare'  => '=='
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
        <select id="critd_supervising_cds" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#critd_supervising_cds", {
                placeHolder: "Select Delegate for Head Office Senior CDS",
                "maxHeight": 200,
                "translations": { "all": "All Head Office Senior CDS", "items": "Head Office Senior CDS", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available Head Office Senior CDS --</option>
        </select>
    <?php endif; ?>
</div>

<div class="roleSelect role-critd_chief_of_division">
    <?php query_posts( array( 
        'post_type' => array('regional_officers'), 
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'      => 'user_role',
                'value'    => 'ho_chief_cds',
                'compare'  => '=='
            )
        )
    )); ?>
    <?php if ( have_posts() ) : ?>
       <p>Head Office - Chief CDS</p>
        <select id="critd_chief_of_division" multiple="" size="3">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php $isMeD; if($returnedID == get_the_id()){ $isMeD = "(Me)"; } ?>
                <option value="<?php echo get_the_id(); ?>" <?php isSelected(get_the_id(), $cms_delegatedIDs); ?>><?php echo get_field('first_name').' '.get_field('last_name'); ?> <?php echo $isMeD; ?></option>
            <?php endwhile; ?>
        </select>
        <script>
            selectBoxTest = new vanillaSelectBox("#critd_chief_of_division", {
                placeHolder: "Select Delegate for Head Office Chief CDS",
                "maxHeight": 200,
                "translations": { "all": "All Head Office Chief CDS", "items": "Head Office Chief CDS", "selectAll":"Check All", "clearAll":"Clear All"}
            });
        </script>
    <?php else : ?>
        <select class="crit-empty">
            <option>-- No Available Head Office Chief CDS --</option>
        </select>
    <?php endif; ?>
</div>

<?php } ?>

<style>
    .roleSelect {
        padding: 10px;
    }
    .crit-empty {
        min-width: 120px;
        border-radius: 0px;
        width: 100%;
        text-align: left;
        z-index: 1;
        color: rgb(51, 51, 51);
        line-height: 20px;
        font-size: 14px;
        padding: 9px 10px !important;
        background: white !important;
        border: 1px solid rgb(153, 153, 153) !important;
        max-width: 500px;
    }
</style>
<script>
    function getValues(id) {
        let result = [];
        let collection = document.querySelectorAll("#" + id + " option");
        collection.forEach(function (x) {
            if (x.selected) {
                result.push(x.value);
            }
        });
        return result;
    }
    
    function display_ct5() {
        const arr_delegates = new Array();
        var crits_cds_1;
        var crits_senior_cds;
        var crits_regional_director;
        var all_delegates;
        
        // CTPRO
        
        if (getValues('crits-cds_1').length != 0) {
            arr_delegates.push(getValues('crits-cds_1'));
        }
        
        if (getValues('crits-senior_cds').length != 0) {
            arr_delegates.push(getValues('crits-senior_cds'));
        }
        
        if (getValues('crits_regional_director').length != 0) {
            arr_delegates.push(getValues('crits_regional_director'));
        }
        
        if (getValues('critd_cd-2').length != 0) {
            arr_delegates.push(getValues('critd_cd-2'));
        }
        
        if (getValues('critd_senior_cds').length != 0) {
            arr_delegates.push(getValues('critd_senior_cds'));
        }
        
        if (getValues('critd_supervising_cds').length != 0) {
            arr_delegates.push(getValues('critd_supervising_cds'));
        }
        
        if (getValues('critd_chief_of_division').length != 0) {
            arr_delegates.push(getValues('critd_chief_of_division'));
        }
        
        all_delegates = arr_delegates;
        
        document.getElementById('acf-field_61dec54c98bbf').value = all_delegates;
        
        display_c5();
    }
    function display_c5(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct5()',refresh)
    }
    display_c5();
</script> <!-- Realtime date -->