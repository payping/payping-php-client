<?php

/**
 * ایجاد یک کد شناسایی کاربر
 * @return string
 */
 function generateVerified(){
     $random = bin2hex(openssl_random_pseudo_bytes(32));
     $verifier =base64UrlSafeEncode(pack('H*', $random));
     return $verifier;
 }

/**
 * ساخت یک challenge code
 * @param $codeVerifier
 * @return string
 */
 function generateCodeChallenge($codeVerifier)
 {
     return base64UrlSafeEncode(pack('H*', hash('sha256', $codeVerifier)));
 }

/**
 * escape رشته
 * @param $string
 * @return string
 */
 function base64UrlSafeEncode($string)
 {
     return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
 }