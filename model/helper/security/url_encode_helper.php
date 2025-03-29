<?php

function base64UrlEncode(string $data): string
{
    $base64Url = strtr(base64_encode($data), '+/', '-_');
 
    return rtrim($base64Url, '=');
}

function base64UrlDecode(string $base64Url): string
{
    return base64_decode(strtr($base64Url, '-_', '+/'));
}