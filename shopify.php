<?php
  //Modify these
  header("Access-Control-Allow-Origin: *");  
  $API_KEY = '71883cf9cfce84d175fdc94f4e5819f2';
  $SECRET = '58b2593d6f6244ea402434320e31a1dc';
  $TOKEN = '58b2593d6f6244ea402434320e31a1dc';
  $STORE_URL = 'ellana-cosmetics.myshopify.com';
  $PRODUCT_ID = 'product-id-here';
  
  

  require "config.php";
  require "common.php";


  if(isset($_POST['beautyquiz'])){
  
 
//var_dump the array so that we can view it's structure.
    
   // $data = json_encode($_POST['beautyquiz']);
  $data = $_POST['beautyquiz'];
    

      
       $aq1 = $data['aq1'] ?? "";
       $aq2 = $data['aq2'] ?? "";
       $aq3 = $data['aq3'] ?? "";
       $bq1 = $data['bq1'] ?? "";
       $bq2 = $data['bq2'] ?? "";
       $bq3 = $data['bq3'] ?? "";
       $cq1 = $data['cq1'] ?? "";
       $dq1 = $data['dq1'] ?? "";
       $iduser = $data['iduser'] ?? "";
    echo $iduser;
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    
      try {
        $connection = new PDO($dsn, $username, $password, $options);
    
      
             
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
                '".$bq2.",
                '".$bq3."',
                '".$cq1."',
                '". $dq1."',               
                )";
      
      $statement = $connection->prepare($sql);
      $statement->execute($user);
      } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
      }

  }else{
    echo "not recieved 2";
  }



  if(isset($_GET['ajaxcall'])){
  if ($_GET['ajaxcall']=='getall') {
      $url="https://".$API_KEY.":".$SECRET."@".$STORE_URL."/admin/api/2020-01/orders/count.json?status=any";
      $shopcurl = curl_init();
      curl_setopt($shopcurl, CURLOPT_URL, $url);
      curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
      // curl_setopt($shopcurl, CURLOPT_HEADER, 1);
      curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec ($shopcurl);
      curl_close ($shopcurl);      
      $json_returned = json_decode($response, true);
      echo $json_returned['count'];  
      // echo $product_xml->variants->variant->{'inventory-quantity'};
   }elseif ($_GET['ajaxcall']=='getshipped'){
      $url="https://".$API_KEY.":".$SECRET."@".$STORE_URL."/admin/api/2020-01/orders/count.json?fulfillment_status=shipped";
      $shopcurl = curl_init();
      curl_setopt($shopcurl, CURLOPT_URL, $url);
      curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
      // curl_setopt($shopcurl, CURLOPT_HEADER, 1);
      curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec ($shopcurl);
      curl_close ($shopcurl);
      

      $json_returned = json_decode($response, true);
        echo $json_returned['count'];  
      // echo $product_xml->variants->variant->{'inventory-quantity'};
  }elseif ($_GET['ajaxcall']=='customers') {
    
    $url="https://".$API_KEY.":".$SECRET."@".$STORE_URL."/admin/api/2020-01/customers/count.json";
    $shopcurl = curl_init();
    curl_setopt($shopcurl, CURLOPT_URL, $url);
    curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
    // curl_setopt($shopcurl, CURLOPT_HEADER, 1);
    curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec ($shopcurl);
    curl_close ($shopcurl);
    

    $json_returned = json_decode($response, true);
      echo $json_returned['count'];  
    // echo $product_xml->variants->variant->{'inventory-quantity'};
  }else{
    echo "not accepted";
  }

  }


?>