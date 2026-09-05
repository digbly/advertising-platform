<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\UpdateProfileRequest;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Profile', description: 'User profile management')]
class ProfileController extends Controller
{
    #[OA\Get(
        path: '/api/v1/profile',
        summary: 'Get Profile',
        operationId: 'profile.show',
        tags: ['Profile'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Profile retrieved',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: UserResource::class),
                    ]
                )
            ),
        ]
    )]
    public function show(Request $request): UserResource
    {
        return UserResource::make($request->user());
    }

    #[OA\Put(
        path: '/api/v1/profile',
        summary: 'Update Profile',
        operationId: 'profile.update',
        tags: ['Profile'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: [
                new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        type: UpdateProfileRequest::class
                    )
                ),
            ]
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Profile updated',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: UserResource::class),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Validation Error'),
        ]
    )]
    public function update(UpdateProfileRequest $request): UserResource
    {
        $user = $request->user();
        $user->update($request->validated());

        return UserResource::make($user->fresh());
    }
}
