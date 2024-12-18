<?php
$account = [
    ['username' => 'admin', 'password' => 'secret'],
    ['username' => 'user', 'password' => '12345']
];


// fonction pour crypter
function cryptage($username, $password)
{
    $secretKey = "clé_secrete";
    $data = $username . ':' . $password;
    return hash_hmac('sha256', $data, $secretKey);
}

// fonction pour décrypter
function validateToken($username, $password, $token)
{
    $generatedToken = cryptage($username, $password);
    return hash_equals($generatedToken, $token);
}
