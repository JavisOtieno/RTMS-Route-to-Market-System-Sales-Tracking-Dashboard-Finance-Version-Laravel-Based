<?php
namespace App\Http\Controllers\api;


use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use GuzzleHttp\Client;
use Google\Auth\AccessToken;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;


class IntegrityController extends Controller
{
    public function verifyToken(Request $request)
    {
        $token = $request->input('token');
        $projectNumber = env('GOOGLE_PROJECT_NUMBER'); // Store this in .env

        // Verify token authenticity
        $decoded = $this->decodeAndVerifyToken($token, $projectNumber);

        if ($decoded) {
            $decoded = (object) $decoded;
            // Check app integrity claims (e.g., app package name, version)
            $appIntegrity = $decoded->payload['appIntegrity'];
            $deviceIntegrity = $decoded->payload['deviceIntegrity'];

            // Respond based on integrity checks
            if ($appIntegrity && $deviceIntegrity) {
                return response()->json(['status' => 'success', 'message' => 'App integrity verified.']);
            } else {
                return response()->json(['status' => 'fail', 'message' => 'Integrity verification failed.']);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Invalid token.']);
    }

    private function decodeAndVerifyToken($token, $projectNumber)
    {
        $accessToken = new AccessToken(['targetAudience' => $projectNumber]);

        try {
            $decoded = $accessToken->verify($token, ['targetAudience' => $projectNumber]);
            return $decoded;
        } catch (\Exception $e) {
            // Handle errors (e.g., token invalid, expired)
            return null;
        }
    }



public function verifyPlayIntegrityToken(Request $request)
{
    $token = $request->input('token'); // The token sent from the Android app

    $client = new Client();
    $response = $client->post('https://playintegrity.googleapis.com/v1/verifyIntegrityToken', [
        'headers' => [
            'Authorization' => 'Bearer ' . env('GOOGLE_API_KEY'),
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'integrityToken' => $token,
        ],
    ]);

    $data = json_decode($response->getBody(), true);

    if ($data['status'] === 'SUCCESS') {
        // The token is valid, process further logic (e.g., authenticate the user)
        return response()->json(['message' => 'Token verified successfully']);
    } else {
        return response()->json(['error' => 'Token verification failed'], 400);
    }
}

public function verifyTokenJWT(Request $request)
{
 $integrityToken = $request->input('token');

    if (!$integrityToken) {
        return response()->json(['error' => 'Integrity token is required'], 400);
    }

    try {
        // Decode the JWT token using the Google public key and RS256 algorithm
        $publicKey = env('GOOGLE_API_PUBLIC_KEY');
        $decodedToken = JWT::decode($integrityToken, new Key($publicKey, 'RS256'));

        // Verify token claims as needed
        if (isset($decodedToken->appIntegrity) && $decodedToken->appIntegrity->isValid) {
            return response()->json(['status' => 'valid']);
        } else {
            return response()->json(['status' => 'invalid'], 401);
        }

    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to decode token', 'message' => $e->getMessage()], 500);
}

}

}
