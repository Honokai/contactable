<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageableContacts = Contact::orderBy("name","asc")->paginate(10);

        return view("contact.index", ["contacts" => $pageableContacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("contact.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateContactRequest $request)
    {
        $contactCreated = Contact::create($request->only(["name", "contact", "email"]));

        return redirect(route("contacts.show", $contactCreated));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contact.show', ['contactInformaction' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit', ["contactInformaction" => $contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect(route("contacts.index"));
    }
}
