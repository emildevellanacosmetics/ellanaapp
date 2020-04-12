<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');    // cache for 1 day
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");  


//Modify these
//header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
//header("content-type: application/javascript");
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
 


    if ($result = $conn->query("SELECT * FROM user WHere iduser = '".$iduser ."'")) {

      /* determine number of rows result set */
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

?>
