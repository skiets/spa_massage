<?php

class apiKeys
{

    /**
     * Encode - Encrypt string
     *
     * @param string $input - String to encode
     * @param string $key - Secret key
     * @param string $enc_method (optional)
     *
     * @return string Encrypted string
     */
    public static function Encode(string $input, string $key, string $enc_method = 'AES-256-CBC')
    {
        $enc_iv = self::_generateIV($key, openssl_cipher_iv_length($enc_method));

        return base64_encode(openssl_encrypt($input, $enc_method, $key, 0, $enc_iv));
    }

    /**
     * Decode - Decrypt encrypted string
     *
     * @param string $input - Encrypted string
     * @param string $key - Secret key
     * @param string $enc_method (optional)
     *
     * @return string Decoded string
     */
    public static function Decode(string $input, string $key, string $enc_method = 'AES-256-CBC')
    {
        $enc_iv = self::_generateIV($key, openssl_cipher_iv_length($enc_method));

        return openssl_decrypt(base64_decode($input), $enc_method, $key, 0, $enc_iv);
    }

    /**
     * _generateIV - Automatic generate rquired encrypion iv from key
     *
     * @param string $key - Secret key
     * @param int $size - Size of the iv
     * @return string iv
     */
    public static function _generateIV($key, $size)
    {
        $hash = base64_encode(sha1($key));
        while (strlen($hash) < $size) {
            $hash = $hash . $hash;
        }
        return substr($hash, 0, $size);
    }
}
