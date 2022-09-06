<?php 
  /* Template Name: Home */
    acf_form_head();
  get_header(); 

?>

 <div class="container">
             <div class="homewrapper" >
             
             <div class="bannerWrapper">
             <div class="standardCenterhomepage">
             <div class="col-mid-60">
             <div class="margin-right">
             <h2>WELCOME TO CDA (AFIS)</h2>
             Accreditation Facility Information System for the CDA Cooperative Research, Information, and Training Division (CRITD) and Supervision and Examination Division (SED). 
             <br><br>
             The system automates the accreditation and monitoring process of Cooperative Training Providers (CTPros) and Cooperative External Auditors (CEAs) being implemented by CRITD and SED respectively.
             It also conducts completeness and validity check on the documents submitted by the applicant. 
             <br><br>
             A non-refundable application fee is being collected. With this, you can now apply online. Anytime. Anywhere
            <br><br>
            
            <h2>HOW TO REGISTER?</h2>
            <ul>
				<li>Click register as <strong>Cooperative Training Provider (CTPRO)</strong> or <strong>Cooperative Exernal Auditor (CEA)</strong>. You will then be taken to the registration forms where you will need to enter your registration data.</li>
				<li>Fill in your cooperative name, to check if there is an existing record. If there is none, you may register with new details.</li>
				<li><strong>For CEA:</strong> Choose your CEA type whether it's individual or Firm, and enter the required data in the fields.</li>
				<li>Press next to verify your details and then press submit if all details are correct.</li>
				<li>Once submitted, you will be provided with an email confirmation if your submissions has been accepted or rejected.</li>
			</ul>
            <div class="container">
            <div class="col-mid-50">
            <div class="margin-right">
            <a href="<?php echo site_url(); ?>/ctpro-online-registration/" style="color:inherit;">
            <div class="reg-btn">
            Register as 
            <br>Cooperative Training Providers  
            </div>
             </a>
            </div>
            </div>
            <div class="col-mid-50">
            <a href="<?php echo site_url(); ?>/new-cea-account-registration/" style="color:inherit;">
            <div class="reg-btn-cea">
             Register as 
            <br>Cooperative External Auditors
            </div>   

            </a>
            </div>
            <div class="clear"></div>
            </div>
            </div>
            </div>
             
            <div class="col-mid-40">
            
            <div class="registrationhome" style="position: relative;">
                <h3><i class="fas fa-key"></i> LOGIN YOUR ACCOUNT</h3>
                <p>If you have an existing account please login here:</p>
                <?php wp_login_form(); ?>
                <p class="login-remember" style="position: absolute; bottom: 77px; right: 12px;"><label><input name="showPass" type="checkbox" id="showPass" value=""> Show Password</label></p>
            </div>
            
            <div class="reg-btn-renewal">
                <h3>Account Renewal?</h3>
                To ensure the continuous validity of its accreditation, CTPro and CEA shall apply for the renewal of its accreditation two (2) months prior to the expiration of its accreditation.
            </div>
            
            </div>
             <div class="clear"></div>
  <div class="copyright-home text-center"><div class="standardCenter">© 2021 Cooperative Development Authority. All Rights Reserved.</div></div>
        </div> 
       
        </div>
 

 </div> 
 </div> 

<script>
    $(document).ready(function() {
        $('#showPass').change(function() {
            if(this.checked) {
                $('#user_pass').attr('type', 'text');
            } else {
                $('#user_pass').attr('type', 'password');
            }   
        });
});
</script>