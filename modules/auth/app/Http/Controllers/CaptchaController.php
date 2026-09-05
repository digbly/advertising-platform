<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Modules\Auth\Http\Requests\RequestChallengeRequest;
use OpenApi\Attributes as OA;

class CaptchaController extends Controller
{
    #[OA\Post(
        path: '/api/v1/request-challenge',
        summary: 'Request PoW Challenge',
        operationId: 'captcha.requestChallenge',
        tags: ['Captcha'],
        requestBody: new OA\RequestBody(
            required: true,
            content: [
                new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        type: RequestChallengeRequest::class
                    )
                ),
            ]
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Challenge issued',
            ),
            new OA\Response(response: 403, description: 'Invalid signature'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function requestChallenge(RequestChallengeRequest $request): JsonResponse
    {
        $timestamp = $request->header('X-Timestamp');
        $signature = $request->header('Signature');

        // Validate required headers
        if (empty($timestamp) || empty($signature)) {
            abort(422, 'X-Timestamp and Signature headers are required.');
        }

        // Validate timestamp is numeric
        if (!ctype_digit((string) $timestamp)) {
            abort(422, 'Timestamp must be a valid unix timestamp in milliseconds.');
        }

        // Validate timestamp is within ±5 minutes of server time
        $clientTime = (int) $timestamp;
        $serverTime = (int) now()->getTimestampMs();
        if (abs($serverTime - $clientTime) > 300_000) {
            abort(422, 'Request expired. Please try again.');
        }

        $clientKey = config('services.pow.key');
        $jwtSecret = config('services.pow.jwt_secret');

        // Verify client signature: sha256(timestamp_clientKey)
        $expectedSignature = hash('sha256', $timestamp.'_'.$clientKey);

        if (!hash_equals($expectedSignature, $signature)) {
            abort(403, 'Invalid signature.');
        }

        $difficulty = (int) config('services.pow.difficulty', 4);
        $ttl = (int) config('services.pow.token_ttl', 300);

        // Create JWT payload
        $payload = [
            'jti' => Str::uuid()->toString(),
            'iat' => now()->getTimestamp(),
            'exp' => now()->addSeconds($ttl)->getTimestamp(),
            'difficulty' => $difficulty,
        ];

        $token = JWT::encode($payload, $jwtSecret, 'HS256');

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token,
                'difficulty' => $difficulty,
            ],
        ]);
    }
}
