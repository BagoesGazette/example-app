<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;
use Illuminate\Support\Facades\Crypt;

class PostController extends Controller
{
    public function encryptRequest(Request $request)
    {
        $data = json_encode([
            "authKey" => "SYtest21",
            "iccid" => "8985207180040554807"
        ]);

        
        $encryptedData = $this->encryptWithPadding($data, 'key01');

        return response()->json([
            'encryptedData' => $encryptedData
        ]);
    }

    public function encryptMessage(Request $request)
    {

        $data = json_encode([
            "authKey" => "SYtest21",
            "iccid" => "8985207180040554807"
        ]);

        $key = 'key01';
        $mac = '09FFFFFFFFFFFFFF';

        $encryptedString = $this->encryptWithMAC($data, $key, $mac);

        $returnMessage = '00490233BDC85C50B58E4DA84552EDE0BCBC401FF875EDD8BCB54E0A2F6B97DA597BD8A2784C84F3A9BAF44BCB21FCE4EFE42B10F1DCEF2B04543534A90A8304628523875698DCCB7A407C';
        $jsonResponse = [
            "retCode" => "300011",
            "retMesg" => "Subscriber does not exist"
        ];

        return response()->json([
            'encryptedMessage' => $encryptedString,
            'expectedReturnMessage' => $returnMessage,
            'jsonResponse' => $jsonResponse
        ]);
    }

    public function decryptResponse(Request $request)
    {
        $encryptedHex = $request->input('encrypted_data');

        $encryptionHelper = new EncryptionHelper(env('ENCRYPTION_KEY'));

        $decrypted = $encryptionHelper->decrypt($encryptedHex);

        return response()->json(['decrypted_data' => $decrypted]);
    }

    private function encryptWithPadding($data, $key){
        $hexData = bin2hex($data);

        $padLength = 8 - (strlen($hexData) % 8);
        $paddedHexData = $hexData . str_repeat('FF', $padLength);

        $binaryData = hex2bin($paddedHexData);

        $encryptedData = openssl_encrypt($binaryData, 'DES-EDE3', $key, OPENSSL_RAW_DATA);

        return bin2hex($encryptedData);
    }

    private function encryptWithMAC($data, $key, $mac)
    {
        $hexData = bin2hex($data);

        $padLength = 8 - (strlen($hexData) % 8);
        $paddedHexData = $hexData . str_repeat('FF', $padLength);

        $binaryData = hex2bin($paddedHexData);

        $encryptedData = openssl_encrypt($binaryData, 'DES-EDE3', $key, OPENSSL_RAW_DATA);

        $macData = openssl_encrypt(hex2bin($mac), 'DES-EDE3', $key, OPENSSL_RAW_DATA);

        $encryptedHex = bin2hex($encryptedData);
        $macHex = bin2hex($macData);

        $secretKeyIdLength = 6;
        $length = dechex(strlen($secretKeyIdLength . $encryptedHex . $macHex) / 2);
        $length = str_pad($length, 4, '0', STR_PAD_LEFT);
        $header = strtoupper($length . "01");

        $finalString = $header . $encryptedHex . $macHex;

        return $finalString;
    }
}

