<?php

namespace App\Http\Controllers\api;

use Google\Client;

use Illuminate\Http\Request;
use Google\Service\PlayIntegrity;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Google\Service\PlayIntegrity\DecodeIntegrityTokenRequest;

class IntegrityController extends Controller
{
    public function verifyIntegrity(Request $request)
    {
        $integrityToken = $request->input('integrityToken');

        if (!$integrityToken) {
            return response()->json(['status' => 'error', 'message' => 'Token is required'], 400);
        }

        try {
            // Initialize Google Client
            $client = new Client();
            $client->setAuthConfig(storage_path('app/google-service-account.json')); // path to your JSON key
            $client->addScope('https://www.googleapis.com/auth/playintegrity');

            // Initialize Play Integrity Service
            $playIntegrityService = new PlayIntegrity($client);

            // Verify the token
            // $response = $playIntegrityService->v1->decodeIntegrityToken(
            //     'your-package-name', // Replace with your app's package name
            //     ['integrityToken' => $integrityToken]
            // );

            // Create DecodeIntegrityTokenRequest instance
            $decodeRequest = new DecodeIntegrityTokenRequest();
            $decodeRequest->setIntegrityToken($integrityToken);

            // Verify the token
            $response = $playIntegrityService->v1->decodeIntegrityToken(
                'your-package-name', // Replace with your app's package name
                $decodeRequest
            );

            // Check integrity verdict
            $accountDetails = $response->getAccountDetails();
            $appLicensingVerdict = $accountDetails->getAppLicensingVerdict();

            if ($appLicensingVerdict === 'LICENSED') {
                return response()->json(['status' => 'valid']);
            } else {
                return response()->json(['status' => 'invalid'], 401);
            }
        } catch (\Exception $e) {
            Log::error("Integrity API error: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Verification failed'], 500);
        }
    }
}
