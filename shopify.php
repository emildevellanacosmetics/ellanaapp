<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');    // cache for 1 day
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");  


//Modify these
//header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
//header("content-type: application/javascript");
// $API_KEY = '4cf854673912040bdd999758c2038e13'; dev
// $SECRET = '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'; dev
$API_KEY = '71883cf9cfce84d175fdc94f4e5819f2';
$SECRET = '58b2593d6f6244ea402434320e31a1dc';
$TOKEN = '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';
// $STORE_URL = "ellanacosmetics-staging.myshopify.com"; dev
$STORE_URL = "ellana-cosmetics.myshopify.com";
$PRODUCT_ID = 'product-id-here';

$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "b373f528b8e38d";
$password = "e6cdc6ea";
$dbname = "heroku_30c47afc2d3c720";

/*
  require "config.php";
  require "common.php";

*/
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}






if (isset($_POST['beautyquiz']))
{
    //var_dump the array so that we can view it's structure.
    // $data = json_encode($_POST['beautyquiz']);
    $data = $_POST['beautyquiz'];
    $aq1 = $data['aq1'];
    $aq2 = $data['aq2'];
    $aq3 = $data['aq3'];
    $bq1 = $data['bq1'];
    $bq2 = $data['bq2'];
    $bq3 = $data['bq3'];
    $cq1 = $data['cq1'];
    $dq1 = $data['dq1']; 
    $iduser = $data['iduser'];

    if ($result = $conn->query("SELECT * FROM user WHere iduser = '".$iduser ."'")) {
      $row_cnt = $result->num_rows;
            if ($row_cnt > 0){
            $sql = "UPDATE user
            SET
            aq1 = '" . $aq1 . "',
            aq2 = '" . $aq2 . "',
            aq3 = '" . $aq3 . "',
            bq1 = '" . $bq1 . "',
            bq2 = '" . $bq2 . "',
            bq3 = '" . $bq3 . "',
            cq1 = '" . $cq1 . "',
            dq1 = '" . $dq1 . "'
        WHERE iduser = '" . $iduser . "'";
        
        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Update Error";
        }
     }else{
      $sql = "INSERT INTO user                
      (
      iduser,
      aq1,
      aq2,
      aq3,
      bq1,
      bq2,
      bq3,
      cq1,
      dq1
      ) VALUES (
      '".$iduser."',
      '".$aq1."',
      '".$aq2."',
      '".$aq3."',
      '".$bq1."',
      '".$bq2."',
      '".$bq3."',
      '".$cq1."',
      '".$dq1."'            
      )";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
      echo "Insert error";
    }
     }
        /* close result set */
      $result->close();
  }
  $conn->close();              
  }

  if (isset($_GET['beautycall'])){

    $data = $_GET['beautycall'];
    $iduser = $data['iduser'];
    $sql = "SELECT * FROM user WHERE iduser = '".$iduser."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $aq1 = $row['aq1'];
          $aq2 = $row['aq2'];
          $aq3 = $row['aq3'];
          $bq1 = $row['bq1'];
          $bq2 = $row['bq2'];
          $bq3 = $row['bq3'];
          $cq1 = $row['cq1'];
          $dq1 = $row['dq1'];           
          $return_arr[] = array(
                          "aq1" => $aq1,
                          "aq2" => $aq2,
                          "aq3" => $aq3,
                          "bq1" => $bq1,
                          "bq2" => $bq2,
                          "bq3" => $bq3,
                          "cq1" => $cq1,
                          "dq1" => $dq1
                        );
        echo json_encode($return_arr);

        }
    } 
    

  }

if(isset($_POST['ajaxcall'])){
     $data = $_POST['ajaxcall'];
     if ($data['process']=='add') {
  
      $beautyregname = $data['beautyregname'];
      $beautyreglastname = $data['beautyreglastname'];
      $beautyregemail = $data['beautyregemail'];
      $beautyregpassword = $data['beautyregpassword'];
   
   
      $customerData = array
      (
          "customer" => array(
              "first_name"    =>  $beautyregname,
              "last_name"     =>  $beautyreglastname,
              "email"         =>  $beautyregemail,
              "verified_email" =>  true,
              "password" => $beautyregpassword,
              "password_confirmation"=> $beautyregpassword,
              "send_email_welcome" => false
          )
      );

      $data_string = json_encode($customerData);
   
      
        $url="https://".$API_KEY.":".$SECRET."@".$STORE_URL."/admin/api/2020-04/customers.json";
            $shopcurl = curl_init();
            curl_setopt($shopcurl, CURLOPT_URL, $url);
            curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
            
            curl_setopt($shopcurl, CURLOPT_POSTFIELDS, $data_string);
             curl_setopt($shopcurl, CURLOPT_HEADER, 1);
             curl_setopt($ch, CURLOPT_VERBOSE, 0); 
            curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "POST");
            $response = curl_exec($shopcurl);
            if (curl_errno($shopcurl)) {
              $error_msg = curl_error($shopcurl);
            }
            curl_close($shopcurl);
            $json_returned = json_decode($response, true);
            if (isset($error_msg)) {
              
            }else{
              
            }
            echo $json_returned;
  }
}
  if(isset($_GET['ajaxcall'])){
    if ($_GET['ajaxcall']=='getdata') {
      $url="https: //".$API_KEY.":".$SECRET."@".$STORE_URL."/admin/api/2020-01/orders/count.json?status=any";
            $shopcurl = curl_init();
            curl_setopt($shopcurl, CURLOPT_URL, $url);
            curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
            curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
            // curl_setopt($shopcurl, CURLOPT_HEADER, 1);
            curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($shopcurl);
            curl_close($shopcurl);
            $json_returned = json_decode($response, true);
            echo $json_returned['count'];
  }

  if ($_GET['ajaxcall']=='getall') {
      $url="https: //".$API_KEY.":".$SECRET."@".$STORE_URL."/admin/api/2020-01/orders/count.json?status=any";
            $shopcurl = curl_init();
            curl_setopt($shopcurl, CURLOPT_URL, $url);
            curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
            curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
            // curl_setopt($shopcurl, CURLOPT_HEADER, 1);
            curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($shopcurl);
            curl_close($shopcurl);
            $json_returned = json_decode($response, true);
            echo $json_returned['count'];
            // echo $product_xml->variants->variant->{'inventory-quantity'};
            
        }
        elseif ($_GET['ajaxcall'] == 'getshipped')
        {
            $url = "https://" . $API_KEY . ":" . $SECRET . "@" . $STORE_URL . "/admin/api/2020-01/orders/count.json?fulfillment_status=shipped";
            $shopcurl = curl_init();
            curl_setopt($shopcurl, CURLOPT_URL, $url);
            curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
            curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
            // curl_setopt($shopcurl, CURLOPT_HEADER, 1);
            curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($shopcurl);
            curl_close($shopcurl);

            $json_returned = json_decode($response, true);
            echo $json_returned['count'];
            // echo $product_xml->variants->variant->{'inventory-quantity'};
            
        }
        elseif ($_GET['ajaxcall'] == 'customers')
        {

            $url = "https://" . $API_KEY . ":" . $SECRET . "@" . $STORE_URL . "/admin/api/2020-01/customers/count.json";
            $shopcurl = curl_init();
            curl_setopt($shopcurl, CURLOPT_URL, $url);
            curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array(
              'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJiaWxsZWFzZS1qd3QiLCJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkFwcGxlIGFuZCBjby4iLCJpYXQiOjE1MTYyMzkwMjIsImNvZGUiOiIxMjNlNDU2Ny1lODliLTEyZDMtYTQ1Ni00MjY2NTU0NDAwMDAiLCJ0b2tlbmlkIjoiZHNmYmFocTIzMjUzd2VyaGZhbzY4cXBic2RmODM0OTJnZWhqciIsImtleSI6InVpdHd5ZXJiZGpzYWYzNDk4MmtqaGdhc2RmMDI5MWFmazI5MCJ9.uV24Chf32ECnsGpUNqU_PMNjVexjmF-K59c7YeIS3mE',
              'Content-Type' => 'application/json'
            )
            );
            curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
            // curl_setopt($shopcurl, CURLOPT_HEADER, 1);
            curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($shopcurl);
            curl_close($shopcurl);

            $json_returned = json_decode($response, true);
            echo $json_returned['count'];
            // echo $product_xml->variants->variant->{'inventory-quantity'};
            
        }
      }
?>
