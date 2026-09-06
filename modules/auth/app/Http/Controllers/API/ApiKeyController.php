<?php

namespace Modules\Auth\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Auth\Http\Requests\StoreApiKeyRequest;
use Modules\Auth\Http\Requests\UpdateApiKeyRequest;
use Modules\Auth\Http\Resources\ApiKeyResource;
use Modules\Auth\Models\ApiKey;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Api Keys', description: 'Manage personal API keys')]
class ApiKeyController extends Controller
{
    #[OA\Get(
        path: '/api/v1/api-keys',
        summary: 'List API Keys',
        operationId: 'api-keys.index',
        tags: ['Api Keys'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of API keys',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(type: ApiKeyResource::class)
                        ),
                    ]
                )
            ),
        ]
    )]
    public function index(Request $request): AnonymousResourceCollection
    {
        $apiKeys = $request->user()->apiKeys()->latest('id')->get();

        return ApiKeyResource::collection($apiKeys);
    }

    #[OA\Post(
        path: '/api/v1/api-keys',
        summary: 'Create API Key',
        operationId: 'api-keys.store',
        tags: ['Api Keys'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: [
                new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        type: StoreApiKeyRequest::class
                    )
                ),
            ]
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'API key created. The plain text key is returned only once.',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: ApiKeyResource::class),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Validation Error'),
        ]
    )]
    public function store(StoreApiKeyRequest $request): ApiKeyResource
    {
        $apiKey = $request->user()->apiKeys()->create($request->validated());

        return ApiKeyResource::make($apiKey);
    }

    #[OA\Get(
        path: '/api/v1/api-keys/{id}',
        summary: 'Show API Key',
        operationId: 'api-keys.show',
        tags: ['Api Keys'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'API key retrieved',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: ApiKeyResource::class),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Not Found'),
        ]
    )]
    public function show(Request $request, int $id): ApiKeyResource
    {
        $apiKey = $this->findOwned($request, $id);

        return ApiKeyResource::make($apiKey);
    }

    #[OA\Put(
        path: '/api/v1/api-keys/{id}',
        summary: 'Update API Key',
        operationId: 'api-keys.update',
        tags: ['Api Keys'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: [
                new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        type: UpdateApiKeyRequest::class
                    )
                ),
            ]
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'API key updated',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: ApiKeyResource::class),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Not Found'),
            new OA\Response(response: 422, description: 'Validation Error'),
        ]
    )]
    public function update(UpdateApiKeyRequest $request, int $id): ApiKeyResource
    {
        $apiKey = $this->findOwned($request, $id);
        $apiKey->update($request->validated());

        return ApiKeyResource::make($apiKey->fresh());
    }

    #[OA\Delete(
        path: '/api/v1/api-keys/{id}',
        summary: 'Delete API Key',
        operationId: 'api-keys.destroy',
        tags: ['Api Keys'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'API key deleted'),
            new OA\Response(response: 404, description: 'Not Found'),
        ]
    )]
    public function destroy(Request $request, int $id): JsonResponse
    {
        $apiKey = $this->findOwned($request, $id);
        $apiKey->delete();

        return response()->json(null, 204);
    }

    /**
     * Find an API key owned by the authenticated user or abort with 404.
     */
    private function findOwned(Request $request, int $id): ApiKey
    {
        return $request->user()->apiKeys()->findOrFail($id);
    }
}
