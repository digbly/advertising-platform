<?php

namespace Modules\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Contact\Enums\ContactStatusEnum;
use Modules\Contact\Http\Requests\StoreContactRequest;
use Modules\Contact\Http\Resources\ContactResource;
use Modules\Contact\Models\Contact;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Contact', description: 'Public contact form')]
class ContactController extends Controller
{
    #[OA\Post(
        path: '/api/v1/contacts',
        summary: 'Submit a contact message',
        operationId: 'contacts.store',
        tags: ['Contact'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/StoreContactRequest')
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Contact message created',
                content: new OA\JsonContent(ref: '#/components/schemas/ContactResource')
            ),
            new OA\Response(response: 400, description: 'Proof of Work verification required'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function store(StoreContactRequest $request): JsonResponse
    {
        $contact = Contact::create([
            ...$request->validated(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => ContactStatusEnum::Pending,
        ]);

        return response()->json([
            'data' => new ContactResource($contact),
        ], 201);
    }
}
