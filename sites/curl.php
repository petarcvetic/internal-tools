<?php

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://videobox.rs/wp-login.php',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        'log' => 'videobox',
        'pwd' => 'Um^J$oFnO#E1NqYVXkjz4Dtb',
        'wp-submit' => 'Log In',
        'redirect_to' => 'http://videobox.rs/wp-admin/',
        'testcookie' => 1
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
die(var_dump($resp));

// Close request to clear up some resources
curl_close($curl);