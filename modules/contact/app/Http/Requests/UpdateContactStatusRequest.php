<?php

namespace Modules\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Contact\Enums\ContactStatusEnum;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UpdateContactStatusRequest',
    required: ['status'],
    properties: [
        new OA\Property(property: 'status', type: 'string', enum: ['pending', 'read', 'resolved'], example: 'read'),
    ]
)]
class UpdateContactStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(ContactStatusEnum::class)],
        ];
    }
}
