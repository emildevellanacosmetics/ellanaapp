
<?php
  //Modify these
  header("Access-Control-Allow-Origin: *");  
  $API_KEY = '71883cf9cfce84d175fdc94f4e5819f2';
  $SECRET = '58b2593d6f6244ea402434320e31a1dc';
  $TOKEN = '58b2593d6f6244ea402434320e31a1dc';
  $STORE_URL = 'ellana-cosmetics.myshopify.com';
  $PRODUCT_ID = 'product-id-here';
  
  if(isset($_GET['ajaxcall']))
  {
    echo $_GET['ajaxcall'];
  } else {
    echo "not recieved";
  }





?>