<?php
//Modify these
header("Access-Control-Allow-Origin: *");
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
 
    $sql = "UPDATE user
    SET
    aq1 = '1',
    aq2 = '1',
    aq3 = '1',
    bq1 = '1',
    bq2 = '1',
    bq3 = '1',
    cq1 = '1',
    dq1 = '1'
WHERE iduser = '2999085203545';

        if ($conn->query($sql) === TRUE) {
            echo "Update successfully";
        } else {
          echo "Insert error";
        }

  $conn->close();              

  }else{
    echo "notrecieved2";
  }



?>
