<?php

namespace App\Helpers;

use phpseclib3\Crypt\TripleDES;

class EncryptionHelper
{
    private $key;

    public function __construct($key)
    {
        $this->key = hex2bin($key);
    }

    public function encrypt($data)
    {
        $des = new TripleDES('ecb');
        $des->setKey($this->key);
        $padded_data = $this->padStringToMultipleOf8($data);
        $encrypted_data = $des->encrypt($padded_data);
        $mac = $this->generateMac($padded_data);
        $header = $this->generateHeader($encrypted_data);

        return $header . bin2hex($encrypted_data) . bin2hex($mac);
    }

    public function decrypt($encrypted_string)
    {
        $des = new TripleDES('ecb');
        $des->setKey($this->key);

        $encrypted_data = hex2bin($encrypted_string);

        $decrypted_data = $des->decrypt($encrypted_data);

        return json_decode(rtrim($decrypted_data, "\xFF"), true);
    }

    private function padStringToMultipleOf8($data)
    {
        $blocksize = 8;
        $pad = $blocksize - (strlen($data) % $blocksize);
        return $data . str_repeat("\xFF", $pad);
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
        $length = strlen($encrypted_data) + 8;
        $key_id = '01';
        return bin2hex(pack('n', $length) . $key_id);
    }
}
