<?php
//Modify these
// header("Access-Control-Allow-Origin: *");
header("content-type: application/javascript");
$API_KEY = '71883cf9cfce84d175fdc94f4e5819f2';
$SECRET = '58b2593d6f6244ea402434320e31a1dc';
$TOKEN = '58b2593d6f6244ea402434320e31a1dc';
$STORE_URL = 'ellana-cosmetics.myshopify.com';
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

  $conn->close();              

  }else{
    echo "notrecieved2";
  }



?>
