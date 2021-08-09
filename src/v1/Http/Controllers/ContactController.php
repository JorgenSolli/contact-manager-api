<?php

namespace EcoOnline\ContactManagerApi\v1\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use EcoOnline\ContactManagerApi\v1\Models\Contact;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use EcoOnline\ContactManagerApi\v1\Http\Requests\ContactRequest;
use EcoOnline\ContactManagerApi\v1\Http\Resources\ContactResource;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $contacts = Contact::whereOwns()
            ->search($request->get('qs'))
            ->sort($request)
            ->paginate($request->get('limit'));

        return ContactResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContactRequest $request
     * @return ContactResource
     */
    public function store(ContactRequest $request): ContactResource
    {
        /** @var \EcoOnline\ContactManagerApi\v1\Models\User */
        $user = auth()->user();
        $contact = $user->contacts()->create($request->all());

        return new ContactResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  Contact $contact
     * @param  ContactRequest $request
     * @return ContactResource
     */
    public function show(Contact $contact): ContactResource
    {
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContactRequest $request
     * @param  Contact $contact
     * @return ContactResource
     */
    public function update(ContactRequest $request, Contact $contact): ContactResource
    {
        $contact->update($request->all());

        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @param  ContactRequest $request
     * @return Response
     */
    public function destroy(Contact $contact)
    {
        return $contact->delete();
    }
}
