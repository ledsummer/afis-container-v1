<?php
/* Template Name: Training Documents Submission */
get_header();
acf_form_head();
?>
<?php include( get_template_directory() . '-child/my-account/account-header.php' ); ?>
<div class="container">

<div class="col-mid-15">
  <?php include( get_template_directory() . '-child/my-account/account-sidebar.php' ); ?>
 </div>

        
<div class="col-mid-85"  id="main-content">
    <div class="standardCenter" style="height:100vh !important;">
        <?php if (isset($_GET['success'])) { ?>
        <div class="">
        <?php } else { ?>
        <div class="col-mid-70">
        <?php } ?>
            <div class="account-information">
                <div class="headerAccount"><i class="fas fa-file-alt"></i> Submit your Documentary Requirements</div>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="info-success">
                        You have successfully submitted the documents
                    </div>
                    
                <?php } else if(isset($_GET['edit'])) { ?>
                    <div class='info-alert'><i class="fas fa-exclamation-circle"></i> Please submit all the required documents listed on the Documentation Policy. Make sure to rename the file to it's corresponding fields. Tick the checkbox once done.</div>
                    <?php
                    $dpost = $_GET['edit'];
                    acf_form(array(
                        'post_id' => $dpost,
                        'field_groups' => array(
                            'group_61de5f2107f9c',
                            'group_61fc919349e09'
                        ) ,
                        $dpost => array(
                            'post_type' => 'training_requirement',
                            'post_status' => 'publish',
                        ) ,
                        'updated_message' => __("", 'acf'),
                        'submit_value'  => __('Save', acf),
                        'return' => "?success=".$dpost,
                    ));
                    ?>
                <?php } else { ?>
                    <div class='info-alert'><i class="fas fa-exclamation-circle"></i> Please submit all the required documents listed on the Documentation Policy. Make sure to rename the file to it's corresponding fields. Tick the checkbox once done.</div>
                    <?php
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
                        while (have_posts()):
                            the_post();
                            $cpost = get_the_ID(); ?>
                            
                            <?php if(get_field("type_of_cea", $cpost) == "Individual") { ?>
                                Download Profile of the Applicant with attached 2 x 2 colored ID picture template <a href="<?php echo get_field('individual_profile', 'options')['url']; ?>" download>here</a>.
                            <?php } else if(get_field("type_of_cea", $cpost) == "Firm") { ?>
                                Download Profile of the Firm/Partnership Template <a href="<?php echo get_field('firm_profile', 'options')['url']; ?>" download>here</a>.
                            <?php } ?>
                            
                            <?php $token = get_field('confirmation_key');
                            $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');
                            $ca =   get_field('ca-no');
                            $date = date('M-d-Y');
                            acf_form(array(
                                'post_id' => 'new_post',
                                'field_groups' => array(
                                    'group_61de5f2107f9c',
                                    'group_61fc919349e09'
                                ) ,
                                'new_post' => array(
                                    'post_type' => 'training_requirement',
                                    'post_title' => $token,
                                    'post_status' => 'publish',
                                ) ,
                                'updated_message' => __("", 'acf'),
                                'submit_value'  => __('Submit', acf),
                                'return' => "?success=$token",
                            ));
                        endwhile;
                    endif;
                } ?>
    
                <div style="display:none" class="fancybox-hidden">
                    <div id="termsAndConditions" style="line-height:1.3; font-size:13px; width:560px; max-width:100%;">
                        <h5>Terms and Conditions</h5>
                        <ol>
                            <li>All reports to be submitted should be certified true and correct.</li>
                            <li>All reports should be submitted on or before the deadline specified under Section 11 of MC2015-10. Non-compliance will lead to the non-renewal, cancellation, or revocation of accreditation.</li>
                            <li>For training reports with findings, the CTPro is given a grace period of twenty one (21) calendar days to rectify the findings. Failure to comply within the given grace period will lead to the non-renewal, cancellation, or revocation of accreditation.</li>
                        </ol>
                    </div>
                </div>
                
                <script>
                document.getElementById("acf-field_61de682e871a6").value = "<?php echo $name; ?>";
                document.getElementById("acf-field_61de680d871a5").value = "<?php echo $ca; ?>";
                document.getElementById("acf-field_61de67dc871a4").value = "<?php echo $cpost; ?>";
                
               </script>
            </div>
        </div>
        
        <?php if (isset($_GET['success'])) { ?>
        <?php } else { ?>
        <div class="col-mid-30" style="padding-left: 25px;">
            <div class="account-information">
                <div class="headerAccount"><i class="fas fa-file-alt"></i> Documentation Policy</div>
                <div class="list-desc">
                    <div class="chkForm">
                        <?php if(get_field("type_of_cea", $cpost) == "Individual") { ?>
                            <div>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Letter Application</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Profile of the Applicant with attached 2 x 2 colored ID picture (Templated)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Valid Professional Regulation Commission Identification Card (PRC ID) (Uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Valid Certificate of Accreditation with the PRC-BOA (uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Current PTR issued by the local government (uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Valid Certificate of Membership in Good Standing with the Philippine Institute of Certified Public Accountants (PICPA); or Certification of Life Sustaining Membership issued by PICPA, if any;</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Certificate of Attendance to training equivalent to a minimum of 24 hours of required training as provided in Section 4 of Memorandum Circular No. 2019-</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Official receipt (P2,000.00)</span>
                                </label>
                            </div>
                        <?php } else if(get_field("type_of_cea", $cpost) == "Firm") { ?>
                            <div>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Letter Application (Uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Profile of the Firm/Partnership (templated)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Annex 2.2 Audit Firm ( Initial, Renewal and Additional Signing Partner)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Profile of the signing partners with 2x2 colored ID picture</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Annex 2.3 Signing Partner ( Initial, Renewal, Additional signing partner</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">SEC Registration Certificate of Partnership (uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Articles of Partnership (uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Valid Partnership's Certificate of Accreditation with the BOA (uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">PTR of individual signing partner/s (uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Valid Certificate of Membership in Good Standing with PICPA of the signing partners (uploading)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Certificate of Attendance to training equivalent to a minimum of 24 hours of required training as provided in Section 4 of Memorandum Circular No. 2019-10 (uploading)</span>
                                </label>
                            </div>
                        <?php } else if((get_field("type_of_cea", $cpost) == "Federation of Cooperatives") || (get_field("type_of_cea", $cpost) == "Cooperative Unions") || (get_field("type_of_cea", $cpost) == "Advocacy Cooperatives")) { ?>
                            <?php if(get_field("application", $cpost) == "1") { ?>
                                <div>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter endorsement from EO</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter Application for Accreditation</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Valid Certificate of Compliance (COC)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Basic Info.(Name, address/contact details)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">List of Programs and services</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Historical profile of coop. training conducted</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Affiliation, if any</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">List of Key Officers and Staff</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Pool of Competent Trainers</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">List of Trainers</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Individual Profile/Biodata</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Attendance/Completion to Trainers Training on co-operatives of the trainer; </span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Recognition/Appreciation as Resource Person issued by cooperative/institution where he/she acted as resource person and must be knowledgeable on basic philosophy of cooperatives</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Cooperative Annual Performance Report (CAPR);</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Latest Audited Financial Statements of the Immediate preceding year duly received by CDA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter/ Certificate of Undertaking to adopt CDA MC 2015-09 prescribed training curriculum for cooperative officers and to utilize the services of its pool of trainers in the conduct of trainings</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Official Receipt (P3,000.00)</span>
                                    </label>
                                </div>
                            <?php } else { ?>
                                <div>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter endorsement from EO</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter application for renewal</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Report of training conducted (Training Report 1)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">List of Participants Trained (Training Report 3)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Modules of Cooperative Training Conducted</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Two (2) year Cooperative Training Plan</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Updated List of Trainers</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Individual profile/ PDS/ bio-data</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Completion/Attendance to Trainers Training on Cooperatives of the trainer</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Recognition/Appreciation as Resource Person issued by cooperative/institution where he/she acted as resource person and must be knowledgeable on basic philosophy of cooperatives</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Cooperative Annual Progress Report (CAPR) duly received by CDA </span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Latest Audited Financial Statement duly received by the BIR/CDA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Valid Certificate of Compliance (COC)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message"> Official Receipt (P5,000.00)</span>
                                    </label>
                                </div>
                            <?php } ?>
                        <?php } else if((get_field("type_of_cea", $cpost) == "State Universities and Colleges (SUCs)") || (get_field("type_of_cea", $cpost) == "National Government Agencies (NGAs)") || (get_field("type_of_cea", $cpost) == "Local Cooperative Development Offices (LCDOs)")) { ?>
                            <?php if(get_field("application", $cpost) == "1") { ?>
                                <div>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter endorsement from EO</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter Application for Accreditation</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certification from Head of Agency that such office/unit has cooperative development program, in lieu of the Certificate of Registration; or appropriate local issuance/s creating the office (in the case of LCDOs)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Basic Info.(Name, address/contact details)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">List of Programs and services</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Historical profile of coop. training conducted</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Affiliation, if any</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">List of Key Officers and Staff</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Pool of Competent Trainers</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">List of Trainers</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Attendance/Completion to Training of Trainers on Cooperative</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Recognition/Appreciation as Resource Person issued by cooperative/institution where he/she acted as resource person and must be knowledgeable on basic philosophy of cooperatives</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter/ Certificate of Undertaking to adopt CDA MC 2015-09 prescribed training curriculum for cooperative officers and to utilize the services of its pool of trainers in the conduct of trainings</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Official Receipt (P1,500.00)</span>
                                    </label>
                                </div>
                            <?php } else { ?>
                                <div>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter endorsement from EO</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter application for renewal</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Report of training conducted (Training Report 1)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">List of Participants Trained (Training Report 3)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Modules of Cooperative Training Conducted</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Two (2) year Cooperative Training Plan</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Updated List of Trainers</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Individual profile/ PDS/ bio-data</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Completion/Attendance to Trainers Training on Cooperatives of the trainer</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Recognition/Appreciation as Resource Person issued by cooperative/institution where he/she acted as resource person and must be knowledgeable on basic philosophy of cooperatives</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Official Receipt (P2,500.00)</span>
                                    </label>
                                </div>
                            <?php } ?>
                        <?php } else if((get_field("type_of_cea", $cpost) == "Training Institutions including Non-Government Organizations (NGOs) and Private Academic Institutions")) { ?>
                            <?php if(get_field("application", $cpost) == "1") { ?>
                                <div>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter endorsement from EO</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter Application for Accreditation</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Certificate of Registration from the concerned Philippine Government Agency</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Articles of Incorporation and By-Laws where coop. devt. is one of its objectives and purposes or coop. devt. is one of its identified program thrusts</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Valid Business Permit</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.1.  Basic Info.(Name, address/contact details)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.2.  List of Programs and services</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.3.  Historical profile of coop. training conducted</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.4.  Affiliation, if any</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.5.  List of Key Officers and Staff</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.6.  Pool of Competent Trainers</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.6.1.  List of Trainers</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.6.2.  Individual profile/bio-data:</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.6.3.  Certificate of Attendance/Completion to Training of Trainers on co-operatives;</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">6.6.4.  Certificate of Recognition/Appreciation as Resource Person issued by cooperative/institution where he/she acted as resource person and must be knowledgeable on basic philosophy of cooperatives</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Annual Reports for the last 2 years</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Audited Financial Statements for the last 2 years</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Letter/ Certificate of Undertaking to adopt CDA MC 2015-09 prescribed training curriculum for cooperative officers and to utilize the services of its pool of trainers in the conduct of trainings</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                        <span class="message">Official Receipt (P3,000.00)</span>
                                    </label>
                                </div>
                            <?php } else { ?>
                            <?php } ?>
                        <?php } else { ?>
                            <div>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Letter endorsement from EO</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Letter Application for Accreditation</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Certificate of Registration from the concerned Philippine Government Agency</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Articles of Incorporation and By-Laws where coop. devt. is one of its objectives and purposes or coop. devt. is one of its identified program thrusts</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Valid Business Permit</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Basic Info.(Name, address/contact details)</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">List of Programs and services</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Historical profile of coop. training conducted</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Affiliation, if any</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">List of Key Officers and Staff</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Pool of Competent Trainers</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">List of Trainers</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Individual profile/bio-data:</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Certificate of Attendance/Completion to Training of Trainers on co-operatives;</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Certificate of Recognition/Appreciation as Resource Person issued by cooperative/institution where he/she acted as resource person and must be knowledgeable on basic philosophy of cooperatives</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Annual Reports for the last 2 years</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Audited Financial Statements for the last 2 years</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Letter/ Certificate of Undertaking to adopt CDA MC 2015-09 prescribed training curriculum for cooperative officers and to utilize the services of its pool of trainers in the conduct of trainings</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="checklist" value="1" class="chkType" autocomplete="off">
                                    <span class="message">Official Receipt (P3,000.00)</span>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <style>
                        .chkForm label { display: block; margin-bottom: 10px;}
                        .chkForm .acf-label {
                            display: none;
                        }
                        .disabled {
                            pointer-events: none;
                            background: #ccc!important;
                        }
                    </style>
                </div>
            </div>
        </div>
        <?php } ?>
        
        <script>
            <?php $jsGetApplType = get_field('application', $cpost); ?>
            console.log("<?php echo $jsGetApplType; ?>");
            
            <?php 
            $assignAppType;
            if($jsGetApplType == 1) {
                $assignAppType = "Initial";
            } else {
                $assignAppType = "Renewal";
            }
            ?>
            $("#acf-field_6243ba2aed69d").val("<?php echo $assignAppType; ?>");
            
            
            <?php $jsGetType = get_field('type_of_cea', $cpost); ?>
            $("#acf-field_622aa385f9224").val("<?php echo $jsGetType; ?>");
            
            
            
            
            
            
            
            
            if ($('.chkType:checked').length == $('.chkType').length) {
                $(".acf-form-submit input[type='submit']").removeClass( "disabled" );
                
            } else {
                $(".acf-form-submit input[type='submit']").addClass( "disabled" );
            }
            
            $(".chkType").change(function(){
                if ($('.chkType:checked').length == $('.chkType').length) {
                    $(".acf-form-submit input[type='submit']").removeClass( "disabled" );
                } else {
                    $(".acf-form-submit input[type='submit']").addClass( "disabled" );
                }
            });
            <?php if (isset($_GET['edit'])) { ?>
                $(function(){
                    $('.chkType').attr('checked', 'checked');
                });
                $(".acf-form-submit input[type='submit']").removeClass( "disabled" );
            <?php } ?>
        </script>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
