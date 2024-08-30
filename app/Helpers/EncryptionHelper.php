<?php

namespace App\Helpers;

use phpseclib3\Crypt\TripleDES;

class EncryptionHelper
{
    private $key;

    public function __construct($key)
    {
        // Convert the key from hex string to binary
        $this->key = hex2bin($key);
    }

    public function encrypt($data)
    {
        $des = new TripleDES('ecb');
        $des->setKey($this->key);

        // Pad the data to a multiple of 8 bytes using PKCS7 style padding
        $paddedData = $this->padStringToMultipleOf8($data);

        // Encrypt the padded data
        $encryptedData = $des->encrypt($paddedData);

        // Generate MAC (not necessary in this context but retained for structure)
        $mac = $this->generateMac($paddedData);

        // Generate header
        $header = $this->generateHeader($encryptedData);

        // Combine header, encrypted data, and MAC and return as hexadecimal string
        return $header . bin2hex($encryptedData) . bin2hex($mac);
    }

    public function decrypt($encryptedHex)
    {
        // Pisahkan header, body, dan MAC
        $headerLength = 6; // Header 3 byte dalam hexadecimal = 6 karakter
        $macLength = 16; // MAC 8 byte dalam hexadecimal = 16 karakter

        // Pisahkan header
        $header = substr($encryptedHex, 0, $headerLength);

        // Pisahkan body
        $body = substr($encryptedHex, $headerLength, -$macLength);

        // Pisahkan MAC
        $mac = substr($encryptedHex, -$macLength);

        // Periksa apakah panjang body adalah kelipatan dari 16 (8 byte)
        if (strlen($body) % 16 !== 0) {
            throw new \Exception("Invalid ciphertext body length. Length must be a multiple of 8 bytes.");
        }

        $des = new TripleDES('ecb');
        $des->setKey($this->key);

        // Ubah body dari hexadecimal ke biner
        $encryptedData = hex2bin($body);

        // Dekripsi body
        $decryptedData = $des->decrypt($encryptedData);

        // Hapus padding yang ditambahkan selama enkripsi
        $decryptedData = $this->unpadString($decryptedData);

        // Konversi kembali ke format JSON dan kembalikan sebagai array
        return json_decode($decryptedData, true);
    }

    private function padStringToMultipleOf8($data)
    {
        $blocksize = 8;
        $pad = $blocksize - (strlen($data) % $blocksize);
        return $data . str_repeat(chr($pad), $pad);
    }

    private function unpadString($data)
    {
        $pad = ord($data[strlen($data) - 1]);
        if ($pad < 1 || $pad > 8) {
            throw new \Exception("Invalid padding length detected.");
        }
        return substr($data, 0, -1 * $pad);
    }

    private function generateMac($data)
    {
        $footer = substr($data, -1) . str_repeat("\xFF", 7);
        $des = new TripleDES('ecb');
        $des->setKey($this->key);

        return $des->encrypt($footer);
    }

    private function generateHeader($encrypted_data)
    {
        $length = strlen($encrypted_data) + 8; // Length of encrypted body + MAC
        $key_id = '01'; // Example Key ID
        return bin2hex(pack('n', $length) . $key_id); // Header with length and key ID
    }
}

