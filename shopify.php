
<?php
  //Modify these
  header("Access-Control-Allow-Origin: *");  
  $API_KEY = '71883cf9cfce84d175fdc94f4e5819f2';
  $SECRET = '58b2593d6f6244ea402434320e31a1dc';
  $TOKEN = '58b2593d6f6244ea402434320e31a1dc';
  $STORE_URL = 'ellana-cosmetics.myshopify.com';
  $PRODUCT_ID = 'product-id-here';
  



  if (isset($_GET['ajaxcall'])=='getall') {
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
   }elseif (isset($_GET['ajaxcall'])=='getshipped'){
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
  }else{
    echo "not accepted";
  }




?>