<?php

namespace Modules\Contact\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ContactResource',
    required: ['id', 'name', 'email', 'subject', 'message', 'status', 'created_at', 'updated_at'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'john@example.com'),
        new OA\Property(property: 'subject', type: 'string', example: 'Question about pricing'),
        new OA\Property(property: 'message', type: 'string', example: 'I would like to know more about your plans.'),
        new OA\Property(property: 'ip_address', type: 'string', nullable: true, example: '127.0.0.1'),
        new OA\Property(property: 'user_agent', type: 'string', nullable: true, example: 'Mozilla/5.0 ...'),
        new OA\Property(property: 'status', type: 'string', enum: ['pending', 'read', 'resolved'], example: 'pending'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
    ]
)]
class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'status' => $this->status?->value,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
