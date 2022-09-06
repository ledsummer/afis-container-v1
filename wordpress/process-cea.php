<?php
/**
 * Template Name: Validate CEA
 *
 */
?>

<?php
      
        $ch = curl_init();
        global $redirecturl;
     
        $CoopName=$_POST['CoopName'];
        
        if(empty($CoopName)){
         echo "<div id='err' style='color:#fff; margin:10px; padding:10px; background:#ee6a5d;'>Please enter your Name</div>";
        }else{
        // set method
        $username = 'afis';
        $password = '@fis2022';
        $headers = array('Authorization: Basic '. base64_encode($username.':'.$password));

        $post = [
            'name' => $CoopName,
        ];

        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, "https://api.cda.gov.ph/afis/cea");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $response = curl_exec($ch);
        $decoded_json = json_decode($response);
   
        $status         = $decoded_json->afis_status;
        $CoopAccNum     = $decoded_json->data->CEA_No;
        // var_dump($decoded_json);
        
            if($status=="Renewal"){
                echo "<div id='error' style='color:#fff;  margin:10px; padding:10px; background:#178a4f;'>You have an existing records as CEA, please continue the Registration.</div>";
                echo "<script> $('#err').fadeIn('slow'); document.getElementById('registrationform').style.display = 'block'; </script>";
                echo '<script>$( "#acf-field_61d14b0a9e40e-2" ).attr("checked", true);</script>';
                echo '<script>$( "#acf-field_61d14b0a9e40e-1" ).attr("checked", false);</script>';
                echo '<script>document.getElementById("acf-field_620f57f9364ad").value = "'.$CoopAccNum.'";</script>';
             
                
                
            }else{
                echo "<script> $('#err').fadeIn('slow'); document.getElementById('registrationform').style.display = 'block'; </script>";
                echo "<div id='err' style='color:#fff; margin:10px; padding:10px; background:#ee6a5d;'>$CoopName Details not found in our records, your application will be tag as initial application.</div>";
                echo '<script>$( "#acf-field_61d14b0a9e40e-2" ).attr("checked", false);</script>';
                echo '<script>$( "#acf-field_61d14b0a9e40e-1" ).attr("checked", true);</script>';
                echo '<script>document.getElementById("acf-field_620f57f9364ad").value = "";</script>';
            }
        }
?>
