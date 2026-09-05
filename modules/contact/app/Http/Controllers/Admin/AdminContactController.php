<?php

namespace Modules\Contact\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Contact\Http\Requests\UpdateContactStatusRequest;
use Modules\Contact\Http\Resources\ContactResource;
use Modules\Contact\Models\Contact;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Admin Contacts', description: 'Admin contact message management')]
class AdminContactController extends Controller
{
    #[OA\Get(
        path: '/api/v1/admin/contacts',
        summary: 'List all contact messages',
        operationId: 'adminContacts.index',
        tags: ['Admin Contacts'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'search', in: 'query', required: false, schema: new OA\Schema(type: 'string'), description: 'Search by name, email or subject'),
            new OA\Parameter(name: 'status', in: 'query', required: false, schema: new OA\Schema(type: 'string', enum: ['pending', 'read', 'resolved']), description: 'Filter by status'),
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 20)),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Paginated list of contact messages'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 403, description: 'Forbidden'),
        ],
    )]
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Contact::query();

        // Search by name, email or subject
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $contacts = $query->latest()->paginate($request->integer('per_page', 20));

        return ContactResource::collection($contacts);
    }

    #[OA\Get(
        path: '/api/v1/admin/contacts/{contact}',
        summary: 'Get a contact message',
        operationId: 'adminContacts.show',
        tags: ['Admin Contacts'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'contact', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Contact message detail', content: new OA\JsonContent(ref: '#/components/schemas/ContactResource')),
            new OA\Response(response: 404, description: 'Contact message not found'),
        ],
    )]
    public function show(Contact $contact): ContactResource
    {
        return new ContactResource($contact);
    }

    #[OA\Put(
        path: '/api/v1/admin/contacts/{contact}/status',
        summary: 'Update contact message status',
        operationId: 'adminContacts.updateStatus',
        tags: ['Admin Contacts'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'contact', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateContactStatusRequest')
        ),
        responses: [
            new OA\Response(response: 200, description: 'Contact message updated', content: new OA\JsonContent(ref: '#/components/schemas/ContactResource')),
            new OA\Response(response: 404, description: 'Contact message not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ],
    )]
    public function updateStatus(UpdateContactStatusRequest $request, Contact $contact): ContactResource
    {
        $contact->update($request->validated());

        return new ContactResource($contact->fresh());
    }

    #[OA\Delete(
        path: '/api/v1/admin/contacts/{contact}',
        summary: 'Delete a contact message',
        operationId: 'adminContacts.destroy',
        tags: ['Admin Contacts'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'contact', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Contact message deleted'),
            new OA\Response(response: 404, description: 'Contact message not found'),
        ],
    )]
    public function destroy(Contact $contact): JsonResponse
    {
        $contact->delete();

        return response()->json(null, 204);
    }
}
