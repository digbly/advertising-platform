<?php

namespace Modules\Auth\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class Captcha
{
    /**
     * Handle an incoming request.
     *
     * Verifies Proof of Work captcha: token (JWT) + nonce (solution).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $powToken = $request->input('token');
        $powNonce = $request->input('nonce');

        if (empty($powToken) || $powNonce === null) {
            return response()->json([
                'message' => 'Proof of Work verification required.',
            ], 400);
        }

        $jwtSecret = config('services.pow.jwt_secret');

        // 1. Decode & verify JWT
        try {
            $decoded = JWT::decode($powToken, new Key($jwtSecret, 'HS256'));
        } catch (SignatureInvalidException) {
            return response()->json([
                'message' => 'Invalid Proof of Work token.',
            ], 401);
        } catch (ExpiredException) {
            return response()->json([
                'message' => 'Proof of Work challenge expired. Please try again.',
            ], 401);
        } catch (Exception $e) {
            logger()->warning('PoW JWT decode failed', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'Invalid Proof of Work token.',
            ], 401);
        }

        $jti = $decoded->jti ?? null;
        $difficulty = (int) ($decoded->difficulty ?? 4);

        if (!$jti) {
            return response()->json([
                'message' => 'Invalid Proof of Work token.',
            ], 401);
        }

        // Validate difficulty bounds
        if ($difficulty < 1 || $difficulty > 8) {
            $difficulty = (int) config('services.pow.difficulty', 4);
        }

        // 2. Validate nonce type
        if (!is_string($powNonce) && !is_int($powNonce)) {
            return response()->json([
                'message' => 'Invalid Proof of Work nonce.',
            ], 400);
        }
        $powNonce = (string) $powNonce;

        // 3. Check replay attack (atomic)
        $cacheKey = "pow_used_{$jti}";
        $ttl = config('services.pow.token_ttl', 300);

        // 4. Verify hash: sha256(token + nonce) must start with `difficulty` zeros
        $hash = hash('sha256', $powToken.$powNonce);
        $targetPrefix = str_repeat('0', $difficulty);

        if (!str_starts_with($hash, $targetPrefix)) {
            return response()->json([
                'message' => 'Proof of Work verification failed.',
            ], 400);
        }

        // 5. Atomically mark as used (replay protection)
        if (!Cache::add($cacheKey, true, $ttl)) {
            return response()->json([
                'message' => 'Proof of Work challenge already used.',
            ], 400);
        }

        return $next($request);
    }
}
