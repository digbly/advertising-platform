<?php

namespace Modules\Auth\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Models\ApiKey;
use OpenApi\Attributes as OA;

/**
 * @property-read ApiKey $resource
 */
#[OA\Schema(
    schema: __CLASS__,
    required: ['id', 'name', 'scopes', 'revoked', 'created_at', 'updated_at'],
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'name',
            type: 'string',
            nullable: true,
            example: 'My streaming app'
        ),
        new OA\Property(
            property: 'key',
            type: 'string',
            nullable: true,
            description: 'Plain text key. Only returned once, right after creation.',
            example: '9c3c6f1a6df74b1eb8eb9d8e6c7d9a10'
        ),
        new OA\Property(
            property: 'scopes',
            type: 'array',
            items: new OA\Items(type: 'string'),
            nullable: true,
            example: ['videos:read']
        ),
        new OA\Property(
            property: 'revoked',
            type: 'boolean',
            example: false
        ),
        new OA\Property(
            property: 'expires_at',
            type: 'string',
            format: 'date-time',
            nullable: true,
            example: '2027-09-05T09:00:00.000000Z'
        ),
        new OA\Property(
            property: 'last_used_at',
            type: 'string',
            format: 'date-time',
            nullable: true,
            example: '2026-09-05T09:00:00.000000Z'
        ),
        new OA\Property(
            property: 'created_at',
            type: 'string',
            format: 'date-time',
            example: '2026-09-05T09:00:00.000000Z'
        ),
        new OA\Property(
            property: 'updated_at',
            type: 'string',
            format: 'date-time',
            example: '2026-09-05T09:00:00.000000Z'
        ),
    ]
)]
class ApiKeyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'key' => $this->when($this->resource->plain_text_key, $this->resource->plain_text_key),
            'scopes' => $this->resource->scopes,
            'revoked' => $this->resource->revoked,
            'expires_at' => $this->resource->expires_at?->toISOString(),
            'last_used_at' => $this->resource->last_used_at?->toISOString(),
            'created_at' => $this->resource->created_at?->toISOString(),
            'updated_at' => $this->resource->updated_at?->toISOString(),
        ];
    }
}
