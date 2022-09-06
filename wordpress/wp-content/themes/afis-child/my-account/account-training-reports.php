<?php
/* Template Name: Training Reports */
get_header();
acf_form_head();
?>
<?php include ("account-header.php"); ?>
<div class="container">

    <div class="col-mid-15">
        <?php include ("account-sidebar.php"); ?>
    </div>
    
            
    <div class="col-mid-85"  id="main-content">
        <div class="standardCenter " style="height:100vh !important;">
            <div class="account-information">
                <div class="headerAccount"><i class="fas fa-certificate"></i> My Training Reports</div>
                    
                <?php if($myrole == "ctpro") { ?>
                    <div class="tabs">
                        <input type="radio" name="tabs" id="monthly" checked="checked">
                        <label for="monthly">Monthly</label>
                        <div class="tab">
                            <div class="col-mid-80"><h1>Monthly</h1></div>  <div class="col-mid-20" style="text-align:right;">
                            <a href="monthly-report-submission/" class="nextbtn" target="_blank"><button>Add New</button></a></div>
                            
                            <div class="clear"></div>
                            <br><br>
                            
                            <?php include( get_template_directory() . '-child/training-reports/training-reports-monthly.php' ); ?>
                        </div>   
                        
                        <input type="radio" name="tabs" id="quarter">
                        <label for="quarter">Quarterly</label>
                        <div class="tab">
                            <div class="col-mid-80"><h1>Quarterly</h1></div>  <div class="col-mid-20" style="text-align:right;"><a href="quarterly-report-submission/" class="nextbtn" target="_blank"><button>Add New</button></a></div>
                            <div class="clear"></div>
                            <br><br>
                            <?php include( get_template_directory() . '-child/training-reports/training-reports-quarterly.php' ); ?>
                        </div>
                        
                        <input type="radio" name="tabs" id="yearly">
                        <label for="yearly">Yearly</label>
                        <div class="tab">
                            <div class="col-mid-80"><h1>Yearly</h1></div>  <div class="col-mid-20" style="text-align:right;"><a href="yearly-reports-submission/" class="nextbtn" target="_blank"><button>Add New</button></a></div>
                            <div class="clear"></div>
                            <br><br>
                            <?php include( get_template_directory() . '-child/training-reports/training-reports-yearly.php' ); ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="no-tabs">
                        <div class="col-mid-80"><h1> </h1></div>
                        <div class="col-mid-20" style="text-align:right;">
                            <a href="cea-training-reports-submission/" class="nextbtn" target="_blank"><button>Add New</button></a>
                        </div>
                        
                        <div class="clear"></div>
                        <br><br>
                        
                        <?php include( get_template_directory() . '-child/training-reports/cea-training-reports.php' ); ?>
                    </div>
                    <style>
                        .no-tabs h1 {
                            margin: 5px 0px 5px 0px;
                            font-size: 22px;
                            font-weight: 700;
                            letter-spacing: 0px !important;
                            color: #212f57;
                            /* font-size: 13px !important; */
                            font-family: 'Asap', Arial;
                            text-transform: UPPERCASE;
                        }
                    </style>
                <?php } ?>
                <script>
                    if (document.location.search.match(/type=embed/gi)) {
                        window.parent.postMessage("resize", "*");
                    }
                    function displayForm() {
                        document.getElementById("hide").style.display = "block";
                    }
                </script>
            </div>
        </div>
    </div>

</div>
<div class="clear"></div>
<?php get_footer(); ?>
