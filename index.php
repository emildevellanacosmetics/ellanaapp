<h1 style="text-align:center">Ellana Cosmetics Private App</h1>
<h4 style="text-align:center">Forbidden Area</h4>

$request = new HttpRequest();
$request->setUrl('https://trx-test.billease.ph/be-transactions-api/trx/checkout');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJiaWxsZWFzZS1qd3QiLCJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkFwcGxlIGFuZCBjby4iLCJpYXQiOjE1MTYyMzkwMjIsImNvZGUiOiIxMjNlNDU2Ny1lODliLTEyZDMtYTQ1Ni00MjY2NTU0NDAwMDAiLCJ0b2tlbmlkIjoiZHNmYmFocTIzMjUzd2VyaGZhbzY4cXBic2RmODM0OTJnZWhqciIsImtleSI6InVpdHd5ZXJiZGpzYWYzNDk4MmtqaGdhc2RmMDI5MWFmazI5MCJ9.uV24Chf32ECnsGpUNqU_PMNjVexjmF-K59c7YeIS3mE',
  'Content-Type' => 'application/json'
));

$request->setBody('{
  "shop_id": "D5103E13-3EEC-44C3-A1B3-AE02592C4C43",
  "amount": 20000,
  "currency": "PHP",
  "merchant_id": "73CB6A3A-67AB-43E8-9267-E04ABA1CA77E",
  "checkout_type": "standard",
  "items": [
    {
      "code": "SKU123e4567",
      "item": "iPhone Xs",
      "price": 10000,
      "quantity": 1,
      "currency": "PHP",
      "url_item": "https://www.lazada.com.ph/products/apple-iphone-xs-i262561730-s364449221.html?spm=a2o4l.searchlist.list.6.2d46599fbfVZWH&search=1",
      "url_img": "https://upload.wikimedia.org/wikipedia/commons/3/3b/IPhone_5s_top.jpg",
      "category": "mobile",
      "seller_code": "ALPHABET123",
      "item_type": "item"
    },
    {
      "code": "SKU123e4568",
      "item": "MacBook Pro",
      "price": 10000,
      "quantity": 1,
      "currency": "PHP",
      "url_item": "https://www.lazada.com.ph/products/macbook-pro-133-matte-protective-case-gold-i100057364-s100071533.html?spm=a2o4l.searchlistbrand.list.17.4fd7afdfABECD6&search=1",
      "url_img": "https://upload.wikimedia.org/wikipedia/commons/1/1d/MacBook_Pro%2C_Late-2008.jpg",
      "category": "mobile",
      "seller_code": "ALPHABET123",
      "item_type": "item"
    }
  ],
  "sellers": [
    {
      "code": "ALPHABET123",
      "seller_name": "Alphabet inc.",
      "url": "http://example.com",
      "email": "info@example.com",
      "phone": "+639054196316",
      "country": "PH",
      "province": "NRC",
      "city": "Manila",
      "barangay": "Makati",
      "street": "Paseo de Roxas 104",
      "address": "Address in one line"
    }
  ],
  "customer": {
    "full_name": "Vitalii Sharavara",
    "email": "sharavara@example.com",
    "phone": "+639054194316",
    "adr_billing": {
      "addr_type": "billing",
      "country": "PH",
      "province": "NCR",
      "city": "Manila",
      "barangay": "Makati",
      "street": "Paseo de Roxas 104",
      "address": "Address in one line"
    },
    "adr_shipping": {
      "addr_type": "shipping",
      "country": "PH",
      "province": "NCR",
      "city": "Manila",
      "barangay": "Makati",
      "street": "Paseo de Roxas 104",
      "address": "Address in one line"
    }
  },
  "callbackapi_url": "https://example.com/api/update",
  "url_redirect": "https://example.com/xxx.html",
  "order_id": "ORDER-23"
}');

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
