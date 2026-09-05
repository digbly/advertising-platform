<?php

namespace Modules\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'StoreContactRequest',
    required: ['name', 'email', 'subject', 'message'],
    properties: [
        new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'john@example.com'),
        new OA\Property(property: 'subject', type: 'string', example: 'Question about pricing'),
        new OA\Property(property: 'message', type: 'string', example: 'I would like to know more about your plans.'),
        new OA\Property(property: 'token', type: 'string', description: 'Proof of Work challenge token'),
        new OA\Property(property: 'nonce', type: 'string', description: 'Proof of Work solution nonce'),
    ]
)]
class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }
}
