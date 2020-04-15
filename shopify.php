<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');    // cache for 1 day
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");  


//Modify these
//header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
//header("content-type: application/javascript");
$API_KEY = '4cf854673912040bdd999758c2038e13';
$SECRET = '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';
$TOKEN = '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';
$STORE_URL = 'ellanacosmetics-staging.myshopify.com';
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
 
  if(isset($_GET['ajaxcall'])){

    if ($_GET['ajaxcall']['process']=='add') {
      $data = {
        "customer": {
          "first_name": "Steve",
          "last_name": "Lastnameson",
          "email": "steve.lastnameson@example.com",
          "phone": "+15142546011",
          "verified_email": true,
          "addresses": [
            {
              "address1": "123 Oak St",
              "city": "Ottawa",
              "province": "ON",
              "phone": "555-1212",
              "zip": "123 ABC",
              "last_name": "Lastnameson",
              "first_name": "Mother",
              "country": "CA"
            }
          ]
        }
      };
      $url="https: //".$API_KEY.":".$SECRET."@".$STORE_URL."/admin/api/2020-04/customers.json";
            $shopcurl = curl_init();
            curl_setopt($shopcurl, CURLOPT_URL, $url);
            curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
            // curl_setopt($shopcurl, CURLOPT_HEADER, 1);
            curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($shopcurl);
            curl_close($shopcurl);
            $json_returned = json_decode($response, true);
            echo $json_returned['customer'].id;
  }

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
      }
?>
