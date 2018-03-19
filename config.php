<?php

$vk_token = ''; // access_token
$vk_v = '5.73'; // vk api version
$url = 'https://api.vk.com/method/streaming.getServerUrl';

$params = array(
        'access_token'     => $vk_token,
        'v'  => $vk_v,
    );
    
$token = json_decode(file_get_contents($url . '?' . urldecode(http_build_query($params))), true);

$key = $token[response][key];
$endpoint = $token[response][endpoint];

$rule_url = 'https://'.$endpoint.'/rules?key='.$key;
	
?>