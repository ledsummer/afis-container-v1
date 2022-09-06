<?php
 /* Template Name: Payment */ 
?>

<?php



    $emailaddress= $current_user->user_email;
         //echo $email;
     $posts = get_posts(array(
	        'numberposts'	=> 1,
	        'post_type'		=> 'cea',
	        'post_status'   => array('publish'),
        	'meta_query'	=> array(
		    'relation'		=> 'AND',
		    array(
			'key'	  	=> 'email',
			'value'	  	=>  $emailaddress,
			'compare' 	=> '=',
		))));
       if ( have_posts() ) : while ( have_posts() ) : the_post();
       $cpost=get_the_ID();


  $orig_order_id =  get_field('registration_key');
  $merchant_id =  "00000030102164743A19";
  $_requestid =  "$cpost";
  $_ipaddress = $_SERVER['REMOTE_ADDR'];
  $_noturl =  "http://afis.beecr8tive.net/payment_notification.php";
  $_resurl = "http://afis.beecr8tive.net/payment_notification.php";
  $_cancelurl = "http://afis.beecr8tive.net/cancel.php";
  $_fname =  get_field('last_name');
  $_mname = get_field('middle_name');
  $_lname = get_field('last_name');
  $_addr1 = get_field('address');
  $_addr2 =  get_field('address');
  $_city =  get_field('city_municipality');
  $_state = get_field('city_municipality');
  $_country =  "Philippines";
  $_zip = get_field('zip');
  $_sec3d = "try3d";
  $_email = get_field('email');
  $_phone = get_field('telephone');
  $_mobile =  get_field('cellphone');
  $_clientip = $_SERVER['REMOTE_ADDR'];
  $order_total = "200.00";
  $shipping = "50.00";
  $_amount = number_format(($order_total) , 2, '.', $thousands_sep = '');
  $_shipping = number_format(($shipping) , 2, '.', $thousands_sep = '');
  $_currency = "PHP";

  //trim forSIgn
  $_mid = trim($merchant_id);
  $_requestid = trim($_requestid);
  $_ipaddress = trim($_ipaddress);
  $_noturl = trim($_noturl);
  $_resurl = trim($_resurl);
  $_fname = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_fname));
  $_lname = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_lname));
  $_mname = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_mname));
  $_addr1 = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_addr1));
  $_addr2 = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_addr2));
  $_city = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_city));
  $_state = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_state));
  $_country = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_country));
  $_zip = trim($_zip);
  $_email = trim(preg_replace("/&#?[a-z0-9]{2,8};/i", "", $_email));
  $_phone = trim($_phone);
  $_clientip = trim($_clientip);
  $_amount = trim($order_total);
  $_currency = trim($_currency);
  $_sec3d = trim($_sec3d);

  $forSign = $_mid . $_requestid . $_ipaddress . $_noturl . $_resurl . $_fname . $_lname . $_mname . $_addr1 . $_addr2 . $_city . $_state . $_country . $_zip . $_email . $_phone . $_clientip . number_format(($_amount) , 2, '.', $thousands_sep = '') . $_currency . $_sec3d;
  $cert = "8D623798D872DC138DCD2A45EAEFD5BD"; //<-- your merchant key
  $_sign = hash("sha512", $forSign . $cert);
  $xmlstr = "";

  $strxml = "";

  $strxml = $strxml . "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
  $strxml = $strxml . "<Request>";
  $strxml = $strxml . "<orders>";
  $strxml = $strxml . "<items>";

  // $myfile = fopen("log.txt", "w") or die("Unable to open file!");
  // $txt = "";
  // $txt = $txt . $strxml;
  // fwrite($myfile, $txt);
  // fclose($myfile);
  $strxml = $strxml . "<Items>";
  $strxml = $strxml . "<itemname>Payment for AFIS Customer Number:  $cpost </itemname><quantity>1</quantity><amount>" . number_format($_amount, 2, '.', $thousands_sep = '') . "</amount>";
  $strxml = $strxml . "</Items>";

  $strxml = $strxml . "</items>";
  $strxml = $strxml . "</orders>";
  $strxml = $strxml . "<mid>" . $_mid . "</mid>";
  $strxml = $strxml . "<request_id>" . $_requestid . "</request_id>";
  $strxml = $strxml . "<ip_address>" . $_ipaddress . "</ip_address>";
  $strxml = $strxml . "<notification_url>" . $_noturl . "</notification_url>";
  $strxml = $strxml . "<response_url>" . $_resurl . "</response_url>";
  $strxml = $strxml . "<cancel_url>" . $_cancelurl . "</cancel_url>";
  $strxml = $strxml . "<mtac_url>http://afis.beecr8tive.net/payment_notification.php</mtac_url>"; // pls set this to the url where your terms and conditions are hosted
  $strxml = $strxml . "<descriptor_note></descriptor_note>"; // pls set this to the descriptor of the merchant
  $strxml = $strxml . "<fname>" . $_fname . "</fname>";
  $strxml = $strxml . "<lname>" . $_lname . "</lname>";
  $strxml = $strxml . "<mname>" . $_mname . "</mname>";
  $strxml = $strxml . "<address1>" . $_addr1 . "</address1>";
  $strxml = $strxml . "<address2>" . $_addr2 . "</address2>";
  $strxml = $strxml . "<city>" . $_city . "</city>";
  $strxml = $strxml . "<state>" . $_state . "</state>";
  $strxml = $strxml . "<country>" . $_country . "</country>";
  $strxml = $strxml . "<zip>" . $_zip . "</zip>";
  $strxml = $strxml . "<secure3d>" . $_sec3d . "</secure3d>";
  $strxml = $strxml . "<trxtype>sale</trxtype>";
  $strxml = $strxml . "<email>" . $_email . "</email>";
  $strxml = $strxml . "<phone>" . $_phone . "</phone>";
  $strxml = $strxml . "<mobile>" . $_mobile . "</mobile>";
  $strxml = $strxml . "<client_ip>" . $_clientip . "</client_ip>";
  $strxml = $strxml . "<amount>" . number_format(($_amount) , 2, '.', $thousands_sep = '') . "</amount>";
  $strxml = $strxml . "<currency>" . $_currency . "</currency>";
  $strxml = $strxml . "<mlogo_url>http://afis.beecr8tive.net/wp-content/uploads/2021/12/logo-menu.png</mlogo_url>"; // pls set this to the url where your logo is hosted
  $strxml = $strxml . "<pmethod></pmethod>";
  $strxml = $strxml . "<signature>" . $_sign . "</signature>";
  $strxml = $strxml . "</Request>";
  $b64string = base64_encode($strxml);
  
  
   ?>
   
  <?php
  
   echo '<form action="https://testpti.payserv.net/webpayment/default.aspx" method="POST" id="paynamics_payment_form" name="beepay">
            <input type="submit" class="renew-account" id="submit_paynamics_payment_form" value="Settle Payment" />
            <input type="hidden" name="paymentrequest" value="'.$b64string.'">
            <style type="text/css">
                .spinner:before {
                    display: none !important;
                }
            </style>
            <script type="text/javascript">
                jQuery(function(){
                    jQuery("body").block(
                        {
                            message: "' . __('Thank you for your order. Please wait while you are being redirected to BeePay payment page.', 'woocommerce-paynamics-payment-gateway') . '",
                            overlayCSS:
                            {
                                background: "#fff",
                                opacity: 1.0
                            },
                            css: {
                                padding:        20,
                                textAlign:      "center",
                                color:          "#555",
                                border:         "3px solid #aaa",
                                backgroundColor:"#fff",
                                cursor:         "wait"
                            }
                        });
                    jQuery(".blockUI").addClass("spinner");
                    jQuery(".blockMsg").css("top", 50);
                    jQuery( "#submit_paynamics_payment_form" ).click();
                });
            </script>
        </form>';

?>
   
   
   
   
   <?php
    endwhile;
    endif;

    ?>