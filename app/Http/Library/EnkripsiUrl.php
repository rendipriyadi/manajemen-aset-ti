<?php

namespace App\Http\Library;

trait EnkripsiUrl
{
    public function enkrip($string)
    {
        $secret_key = "sip-pdskp-2023";
        $secret_iv = "2456378494765431";
        $encrypt_method = "aes-256-cbc";
        // hash
        $key = hash("sha256", $secret_key);
        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv = substr(hash("sha256", $secret_iv), 0, 16);
        //do the encryption given text/string/number
        $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($result);
        return $output;
    }

    public function dekrip($string)
    {
        $secret_key = "sip-pdskp-2023";
        $secret_iv = "2456378494765431";
        $encrypt_method = "aes-256-cbc";
        // hash
        $key = hash("sha256", $secret_key);
        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv = substr(hash("sha256", $secret_iv), 0, 16);
        //do the decryption given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
}
