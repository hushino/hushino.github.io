<?php 
// get data param
$data = $_GET['data'];

// get signature param
$signature = $_GET['signature'];

// get key
$key_64 = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwSxLq1gv6Gry7l6awJzfTMk3Y/iHSrwhD67JsW82a0tQ0touBXJInBULrQFpRJwmjeHVXK0G0z1pZW0pfFP5ZKgt0Ti8LMDC/xIqSBPAghpnqlH+bFUFD2pDsosyCt13vIRFjHqD1C2kWCh9g6yLoQA2j8XBWD2YCsY6wLlBVN4ZxTK8jBOLRFw84fn5kqxjcGBg3upd1GonHtBc2NoADO6dwdh2KeBhDu5pEN6n6rsZDcVa5A3kADsrBfOiEqO1xJwwwi7PU0fMzfsNf1N2+7nGqvDzlpvMUHeRmqapldrkiQ0cCvXadvXMsCbLPCa4+G/1qrC1AuXHzEDszuO0NQIDAQAB";



$key =  "-----BEGIN PUBLIC KEY-----\n".
    chunk_split($key_64, 64,"\n").
    '-----END PUBLIC KEY-----';
//using PHP to create an RSA key
$key = openssl_get_publickey($key);


// state whether signature is okay or not
$ok = openssl_verify($data, base64_decode($signature), $key, OPENSSL_ALGO_SHA1);
if ($ok == 1) {
    echo "good";
} elseif ($ok == 0) {
    echo "bad";
} else {
    die ("fault, error checking signature");
}

// free the key from memory
openssl_free_key($key);

?>