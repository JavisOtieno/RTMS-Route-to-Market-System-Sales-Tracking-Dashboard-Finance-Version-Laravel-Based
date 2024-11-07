<?php
namespace App\Http\Controllers\api;


use Google\Auth\AccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

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
    $response = $client->post('https://play.googleapis.com/v1/integrity/tokenVerification', [
        'json' => [
            'token' => $token,
        ],
        'headers' => [
            'Authorization' => 'Bearer ' . env('PLAY_API_ACCESS_KEY'),
        ]
    ]);

    return response()->json(['message' => $response->getBody()]);

    // $data = json_decode($response->getBody(), true);

    // if ($data['status'] === 'SUCCESS') {
    //     // The token is valid, process further logic (e.g., authenticate the user)
    //     return response()->json(['message' => 'Token verified successfully']);
    // } else {
    //     return response()->json(['error' => 'Token verification failed'], 400);
    // }
}

}
