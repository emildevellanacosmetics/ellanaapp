<h1 style="text-align:center">Ellana Cosmetics Private App</h1>
<h4 style="text-align:center">Forbidden Area</h4>
<?php 
      $API_KEY = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI3ZDRlYjMxZi00NDkwLTQzZWQtOWJhZi1lMzUxYWJjMzk4MTUiLCJjb2RlIjoiN2Q0ZWIzMWYtNDQ5MC00M2VkLTliYWYtZTM1MWFiYzM5ODE1IiwibmFtZSI6IkVsbGFuYSBDb3NtZXRpY3MgSW5jLiAiLCJpZCI6MTE4LCJyb2xlcyI6eyJiZS10cmFuc2FjdGlvbnMiOlsibWVyY2hhbnQiLCJ0cnhfcmVhZCIsInRyeF93cml0ZSIsInJlZnVuZCIsImJlX2FjYyJdfSwidG9rZW5fdHlwZSI6ImFjY2VzcyIsImV4cCI6MTc0NTMxMDIzNywiaWF0IjoxNTg3NjMzNDMxLCJqdGkiOiI1N2U3NDYzMS1iYjM0LTRlOGMtOGI5YS0yYzE0M2JlMjZmYmQifQ.IQj6MGHfDb2rFjiv3XnyEwAiocubohVOtNUcamEha-M';
      $SECRET = 'rCMBuQcvUCsj8w9R5ULT7gnJjHjLrwn83yqmrSQfDY541lupMcPcAbRREikh4qOo';
      $STORE_URL = 'https://pub.staging.fdfc.io/be-transactions-api/trx/checkout';
      $TOKEN_ID = '998e14e0-5310-45c3-a1bc-2b228ea76aab';
      $MECHANT_CODE = '7d4eb31f-4490-43ed-9baf-e351abc39815';
      $SHOP_CODE = '83ad5234-62b0-4a61-92d1-79762db4cc9d';
      $shopcurl = curl_init();


      $customerData = array (
        'shop_code' => $SHOP_CODE,
        'amount' => 20000,
        'currency' => 'PHP',
        'merchant_code' => $MECHANT_CODE,
        'bem_id' => 4,
        'checkout_type' => 'standard',
        'items' => 
        array (
          0 => 
          array (
          ),
          1 => 
          array (
          ),
        ),
        'sellers' => 
        array (
          0 => 
          array (
          ),
        ),
        'customer' => 
        array (
          'full_name' => 'Vitalii Sharavara',
          'email' => 'sharavara@example.com',
          'phone' => 639054194316,
          'adr_billing' => 
          array (
          ),
          'adr_shipping' => 
          array (
          ),
        ),
        'callbackapi_url' => 'https://youtube.com',
        'url_redirect' => 'https://youtube.com',
        'order_id' => 'ORDER-23',
      );

      $data_string = json_encode($customerData);

      curl_setopt($shopcurl, CURLOPT_URL, $STORE_URL);
      curl_setopt($shopcurl, CURLOPT_HTTPHEADER, array(
        'Authorization' => 'Bearer ' . $API_KEY,
        'Content-Type' => 'application/json'
      ));
      curl_setopt($shopcurl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($shopcurl, CURLOPT_VERBOSE, 0);
      curl_setopt($shopcurl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($shopcurl, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($shopcurl, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($shopcurl);
      curl_close($shopcurl);
      $json_returned = json_decode($response, true);
      echo json_encode($json_returned);
 
      // echo $product_xml->variants->variant->{'inventory-quantity'};
?>