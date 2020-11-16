<?php
// 应用公共文件

/**
 * 创建订单号
 * @param $prefix  string 订单号前缀
 * @return string
 */
function CreateOrderId($prefix){
    return $prefix . date('YmdHis') . str_pad(rand(1,99999),5,'0',STR_PAD_LEFT);
}


/**
 * 加密
 * @param string $str    要加密的数据
 * @return bool|string   加密后的数据
 */
function encrypt($str) {
    $data = openssl_encrypt($str, 'AES-128-ECB', env('AES_KEY','bUYJ3nTV6VBasdJF'), OPENSSL_RAW_DATA);
    $data = base64_encode($data);
    return $data;
}

/**
 * 解密
 * @param string $str    要解密的数据
 * @return string        解密后的数据
 */
function decrypt($str) {
    $decrypted = openssl_decrypt(base64_decode($str), 'AES-128-ECB', env('AES_KEY','bUYJ3nTV6VBasdJF'), OPENSSL_RAW_DATA);
    return $decrypted;
}