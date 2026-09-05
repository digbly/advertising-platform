<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: __CLASS__,
    required: ['X-Timestamp', 'Signature'],
    properties: [
        new OA\Property(
            property: 'X-Timestamp',
            type: 'string',
            example: '1719830400000'
        ),
        new OA\Property(
            property: 'Signature',
            type: 'string',
            example: 'a1b2c3d4e5f6...'
        ),
    ]
)]
class RequestChallengeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        // Headers are validated in the controller since Laravel
        // does not merge HTTP headers into the request input bag.
        return [];
    }
}
