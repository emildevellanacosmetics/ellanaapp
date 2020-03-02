
<?php
  //Modify these
  $API_KEY = '71883cf9cfce84d175fdc94f4e5819f2';
  $SECRET = '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';
  $TOKEN = '58b2593d6f6244ea402434320e31a1dc';
  $STORE_URL = 'ellana-cosmetics.myshopify.com';
  $PRODUCT_ID = 'product-id-here';

  $url = 'https://' . $API_KEY . ':' . md5($SECRET) . '@' . $STORE_URL . '/admin/api/2020-01/orders/count.json';

  $session = curl_init();

  curl_setopt($session, CURLOPT_URL, $url);
  curl_setopt($session, CURLOPT_HTTPGET, 1); 
  curl_setopt($session, CURLOPT_HEADER, false);
  curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/xml', 'Content-Type: application/xml'));
  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

  if(ereg("^(https)",$url)) curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);

  $response = curl_exec($session);
  curl_close($session);

  $product_xml = new SimpleXMLElement($response); 

  echo $product_xml;
  // echo $product_xml->variants->variant->{'inventory-quantity'};
?>