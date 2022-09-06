<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
</div>

<footer id="footer" >
<div class="footer-content ">
<div class="container standardCenter">
<div class="row">
<div class="col-mid-10"><div class="margin-right"><p><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/2021/12/logo-menu.png" ></a></p></div></div>
<div class="col-mid-25">
<div class="margin-right">
<div class="company-title">Cooperative Development Authority</div>
<p class="mb-2">The Cooperative Development Authority (CDA) is a proactive and responsive lead government agency for the promotion of sustained growth and 
full development of the Philippines cooperatives for them to become broad - based instruments of social justice, equity and balanced national progress..</p>
</div>
</div>
<div class="col-mid-20">
<div class="margin-right">
<?php
 wp_nav_menu( array( 
                         'theme_location' => 'footer_links', 
                        'container_class' => 'footer_links' ) );   
?>
</div>    
</div>
<div class="col-mid-25">
<div class="margin-right">
<div class="one_fourth">
<div class="title">CDA CONTACT DETAILS</div>
<i class="fas fa-map-marker-alt" aria-hidden="true"></i> 827 Aurora Blvd., Service Road,<br>
Brgy. Immaculate Conception Cubao,
1111 Quezon City, Philippines<br>
<i class="fas fa-envelope" aria-hidden="true"></i> Email: <a href="mailto:helpdesk@cda.gov.ph">helpdesk@cda.gov.ph</a><br>
<i class="fas fa-globe" aria-hidden="true"></i> Website: <a href="https://cda.gov.ph/" style="color:inherit;">www.cda.gov.ph</a><br><br>
</div>
</div>
</div>

<div class="col-mid-20">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1670.7476799243566!2d121.04746411190077!3d14.621523572464016!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9b79dfc06c8e7e1e!2sCooperative%20Development%20Authority!5e0!3m2!1sen!2sph!4v1610077428930!5m2!1sen!2sph" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
                    
<div class="clear"></div>
</div>
</div>
</div>
</footer>


<div class="copyright-content ">
<div class="container  standardCenter">
<div class="copyright-text text-center">© 2021 Cooperative Development Authority. All Rights Reserved.</div>
</div>
</div>

	<?php wp_footer(); ?>
	 <script>
       
          try {
            // News
            const news_loadmore = document.querySelector('#loadmoreNews');
            let news_currentItems = 3;
            news_loadmore.addEventListener('click', (e) => {
                const news_elementList = [...document.querySelectorAll('.accreditations-container .structures-list .each-list')];
                for (let i = news_currentItems; i < news_currentItems + 3; i++) {
                    if (news_elementList[i]) {
                        news_elementList[i].style.display = 'block';
                    }
                }
                news_currentItems += 3;

                // Load more button will be hidden after list fully loaded
                if (news_currentItems >= news_elementList.length) {
                    event.target.style.display = 'none';
                }
            });
        }
        catch(err) {}
   
   
   
          try {
            // News
            const news_Feedback = document.querySelector('#loadmoreFeedback');
            let news_currentItemsFeedback = 3;
            news_Feedback.addEventListener('click', (e) => {
                const news_elementListFeedback = [...document.querySelectorAll('.accreditations-container-feedback .structures-list-feedback .each-list-feedback')];
                for (let i = news_currentItemsFeedback; i < news_currentItemsFeedback + 3; i++) {
                    if (news_elementListFeedback[i]) {
                        news_elementListFeedback[i].style.display = 'block';
                    }
                }
                news_currentItemsFeedback += 3;

                // Load more button will be hidden after list fully loaded
                if (news_currentItemsFeedback >= news_elementListFeedback.length) {
                    event.target.style.display = 'none';
                }
            });
        }
        catch(err) {}
    </script> 
    
<script>
document.getElementById("dropdown-content").style.display = "none";
console.log(document.getElementById("dropdown-content").style.display);
jQuery('#dropdown').click(function() {
    if(document.getElementById("dropdown-content").style.display == "none"){
        document.getElementById("dropdown-content").style.display = "block";
    } else {
        document.getElementById("dropdown-content").style.display = "none";
    }
});

</script>


<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;
$_returnedID; $_returnedApplication; $returnedToken;
$args = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'cea',
        'ctpro'
    ),
    'post_status' => array(
        'publish'
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

$variable = new WP_Query($args);
if ($variable->have_posts()): the_post(); ?>
    <?php while( $variable->have_posts() ): $variable->the_post(); ?>
        <?php $_returnedID = get_the_id(); ?>
        <?php $_returnedApplication = get_field('application', $_returnedID); ?>
        <?php $returnedToken = get_field('token'); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>


<?php
$acc_id;
$args_accr = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'accreditations'
    ),
    'post_status' => array(
        'publish'
    ),
    's' => $returnedToken
);

$variable_accr = new WP_Query($args_accr);
if ($variable_accr->have_posts()): the_post(); ?>
    <?php while( $variable_accr->have_posts() ): $variable_accr->the_post(); ?>
        <?php $acc_id = get_the_id(); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>


<?php 
$status_ses = get_field('status_ses', $acc_id);
$status_sed = get_field('status_sed', $acc_id);
$status_dlC = get_field('download_certificate', $acc_id);
$new_url;

if(($returnedToken == "") || ($returnedToken == "change-to-renewal")) {
$new_url = site_url().'/review-information';
?>
    <script>
        $(document).ready(function(){
            $('#menu-item-225 a').attr("href", '<?php echo $new_url; ?>');  
            $('#menu-item-1454 a').attr("href", '<?php echo $new_url; ?>');  
            
            console.log("<?php echo $new_url; ?>");
            console.log("<?php echo $returnedToken; ?>");
            console.log("<?php echo $status_ses.' '.$status_sed; ?>");
        });
    </script>
    
<?php } else {
    if($status_ses == "Pending" || $status_ses == "Deferred"){
        $new_url = site_url().'/review-ses-division/?token='.$returnedToken
        ?>
        <script>
            $(document).ready(function(){
                $('#menu-item-225 a').attr("href", '<?php echo $new_url; ?>');   
                $('#menu-item-1454 a').attr("href", '<?php echo $new_url; ?>');   
                
                console.log("<?php echo $new_url; ?>");
                console.log("<?php echo $returnedToken; ?>");
                console.log("<?php echo $status_ses.' '.$status_sed; ?>");
            });
        </script>
    <?php } else if($status_ses == "Approved" && $status_sed == "Pending") {
        $new_url = site_url().'/review-sed-division/?token='.$returnedToken
        ?>
        <script>
            $(document).ready(function(){
                $('#menu-item-225 a').attr("href", '<?php echo $new_url; ?>'); 
                $('#menu-item-1454 a').attr("href", '<?php echo $new_url; ?>');   
                
                console.log("<?php echo $new_url; ?>");
                console.log("<?php echo $returnedToken; ?>");
                console.log("<?php echo $status_ses.' '.$status_sed; ?>");
            });
        </script>
    <?php } else if($status_ses == "Approved" && $status_sed == "Approved" && $status_dlC == "") {
        $new_url = site_url().'/approved-accreditation/?token='.$returnedToken
        ?>
        <script>
            $(document).ready(function(){
                $('#menu-item-225 a').attr("href", '<?php echo $new_url; ?>');  
                $('#menu-item-1454 a').attr("href", '<?php echo $new_url; ?>');  
                
                console.log("<?php echo $new_url; ?>");
                console.log("<?php echo $returnedToken; ?>");
                console.log("<?php echo $status_ses.' '.$status_sed; ?>");
            });
        </script>
    <?php } else if($status_ses == "Approved" && $status_sed == "Approved" && $status_dlC == "1") {
        $new_url = site_url().'/approved-accreditation/?token='.$returnedToken."&success=y";
        ?> 
        <script>
            $(document).ready(function(){
                $('#menu-item-225 a').attr("href", '<?php echo $new_url; ?>');  
                $('#menu-item-1454 a').attr("href", '<?php echo $new_url; ?>');  
                
                console.log("<?php echo $new_url; ?>");
                console.log("<?php echo $returnedToken; ?>");
                console.log("<?php echo $status_ses.' '.$status_sed; ?>");
            });
        </script>
    <?php } ?>
<?php } ?>



</body>
</html>
