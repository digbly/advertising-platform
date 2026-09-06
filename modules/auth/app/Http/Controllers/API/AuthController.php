<?php

namespace Modules\Auth\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\User;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Http\Controllers\ConvertsPsrResponses;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Modules\Auth\Http\Requests\ChangePasswordRequest;
use Modules\Auth\Http\Requests\RefreshTokenRequest;
use Modules\Auth\Http\Resources\TokenResource;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends Controller
{
    use ConvertsPsrResponses;

    #[OA\Post(
        path: '/api/v1/auth/user/refresh-token',
        summary: 'Refresh Token',
        operationId: 'user.refresh',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: [
                new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        type: RefreshTokenRequest::class
                    )
                ),
            ]
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Token Refreshed',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: TokenResource::class),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Invalid Refresh Token'),
        ]
    )]
    public function refreshToken(RefreshTokenRequest $request): TokenResource
    {
        ['client_id' => $clientId, 'client_secret' => $clientSecret] = User::resolvePasswordClient();

        if (!$clientId || !$clientSecret) {
            throw ValidationException::withMessages([
                'refresh_token' => ['OAuth password client is not configured.'],
            ]);
        }

        $requestData = [
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $request->post('refresh_token'),
            'scope' => '',
        ];

        $serverRequest = app(ServerRequestInterface::class)->withParsedBody($requestData);

        try {
            $response = $this->convertResponse(
                app(AuthorizationServer::class)->respondToAccessTokenRequest($serverRequest, new Psr7Response)
            );
            $tokenData = json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR);
        } catch (OAuthServerException $e) {
            throw ValidationException::withMessages([
                'refresh_token' => [$e->getMessage()],
            ]);
        }

        return TokenResource::make($tokenData);
    }

    #[OA\Put(
        path: '/api/v1/auth/user/change-password',
        summary: 'Change Password',
        operationId: 'user.change-password',
        tags: ['Auth'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: [
                new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        type: ChangePasswordRequest::class
                    )
                ),
            ]
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Password Changed',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: MessageResource::class),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Validation Error'),
        ]
    )]
    public function changePassword(ChangePasswordRequest $request): MessageResource
    {
        /** @var User $user */
        $user = $request->user('api');

        if (!Hash::check($request->post('current_password'), $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Current password does not match.'],
            ]);
        }

        $user->forceFill(['password' => $request->post('password')]);
        $user->save();

        return MessageResource::make('Password changed successfully!');
    }

    #[OA\Post(
        path: '/api/v1/auth/user/logout',
        summary: 'Logout',
        operationId: 'user.logout',
        tags: ['Auth'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Logout Success',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: MessageResource::class),
                    ]
                )
            ),
        ]
    )]
    public function logout(Request $request): MessageResource
    {
        $request->user('api')?->token()?->revoke();

        return MessageResource::make('Successfully logged out');
    }
}
