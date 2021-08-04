<?php

namespace EcoOnline\ContactManagerApi\v1\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EcoOnline\ContactManagerApi\v1\Models\Contact;
use EcoOnline\ContactManagerApi\v1\Http\Requests\ContactRequest;
use EcoOnline\ContactManagerApi\v1\Http\Resources\ContactResource;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
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
     * @return \EcoOnline\ContactManagerApi\v1\Http\Resources\ContactResource
     */
    public function store(ContactRequest $request)
    {
        // The "contacts" relation  need to exist
        $contact = auth()->user()->contacts()->create($request->all());

        return new ContactResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  Contact $contact
     * @return \EcoOnline\ContactManagerApi\v1\Http\Resources\ContactResource
     */
    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContactRequest $request
     * @param  Contact $contact
     * @return \EcoOnline\ContactManagerApi\v1\Http\Resources\ContactResource
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());

        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContactRequest $request
     * @param  Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactRequest $request, Contact $contact)
    {
        $contact->delete();

        return response(200);
    }
}
