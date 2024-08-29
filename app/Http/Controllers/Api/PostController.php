<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;

class PostController extends Controller
{
    public function encryptRequest(Request $request)
    {
        $data = json_encode($request->all());
        
        $encryptionHelper = new EncryptionHelper(env('ENCRYPTION_KEY'));

        $encrypted = $encryptionHelper->encrypt($data);

        return response()->json(['encrypted_data' => $encrypted]);
    }

    public function decryptResponse(Request $request)
    {
        $encryptedHex = $request->input('encrypted_data');

        $encryptionHelper = new EncryptionHelper(env('ENCRYPTION_KEY'));

        $decrypted = $encryptionHelper->decrypt($encryptedHex);

        return response()->json(['decrypted_data' => $decrypted]);
    }
}
