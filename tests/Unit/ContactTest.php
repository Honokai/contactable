<?php

use App\Models\Contact;

it('formats a nine-digit contact correctly', function () {
    $contact = new Contact(['contact' => '123456789']);

    expect($contact->contact_formatted)
        ->toBe('1 2345-6789');
});