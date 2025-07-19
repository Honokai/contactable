<?php

use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function Pest\Laravel\delete;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;

uses(RefreshDatabase::class);

describe('ContactController', function () {
    
    beforeEach(function () {
        $user = User::factory()->create();

        actingAs($user);

        $this->contact = Contact::factory()->create([
            'name'    => 'Test User',
            'contact' => '123456789',
            'email'   => 'test@example.com',
        ]);
    });

    it('displays a paginated list of contacts on index', function () {
        Contact::factory()->count(15)->create();

        $response = get(route('contacts.index'));

        $response->assertStatus(200)
                 ->assertViewIs('contact.index')
                 ->assertViewHas('contacts', function ($paginated) {
                     return $paginated->count() > 0
                         && method_exists($paginated, 'links');
                 });
    });

    it('shows the create form', function () {
        get(route('contacts.create'))
            ->assertStatus(200)
            ->assertViewIs('contact.create');
    });

    it('stores a new contact and redirects to show', function () {
        $payload = [
            'name'    => 'New Contact',
            'contact' => '987654321',
            'email'   => 'new@example.com',
        ];

        $response = post(route('contacts.store'), $payload);

        $last = Contact::latest('id')->first();
        $response->assertRedirect(route('contacts.show', $last));

        assertDatabaseHas('contacts', $payload);
    });

    it('displays the details of an existing contact', function () {
        get(route('contacts.show', $this->contact))
            ->assertStatus(200)
            ->assertViewIs('contact.show')
            ->assertViewHas('contactInformaction', fn($c) => $c->is($this->contact));
    });

    it('shows the edit form', function () {
        get(route('contacts.edit', $this->contact))
            ->assertStatus(200)
            ->assertViewIs('contact.edit')
            ->assertViewHas('contactInformaction', fn($c) => $c->is($this->contact));
    });

    it('updates a contact and redirects to show', function () {
        $payload = [
            'name'    => 'Updated Test',
            'contact' => '112233445',
            'email'   => 'updated@example.com',
        ];

        $response = put(route('contacts.update', $this->contact), $payload);

        $response->assertRedirect(route('contacts.show', $this->contact));
        assertDatabaseHas('contacts', array_merge(['id' => $this->contact->id], $payload));
    });

    it('deletes a contact and redirects to index', function () {
        $response = delete(route('contacts.destroy', $this->contact));

        $response->assertRedirect(route('contacts.index'));
        assertSoftDeleted('contacts', ['id' => $this->contact->id]);
    });

    it('user not authenticated must not be able to view show or edit pages', function () {
        Auth::logout();

        $visitShowResponse = get(route('contacts.show', $this->contact));
        $visitEditResponse = get(route('contacts.edit', $this->contact));

        $visitShowResponse->assertRedirect(route('login'));
        $visitEditResponse->assertRedirect(route('login'));
    });

    it('rejects name shorter than 5 chars', function () {
        post(route('contacts.store'), [
            'name'    => 'Abc',
            'email'   => 'teste@teste.com',
            'contact' => '123456789',
        ])->assertInvalid(['name']);

        post(route('contacts.update', $this->contact), [
            'name'    => 'Abc',
            'email'   => 'teste@teste.com',
            'contact' => '123456789',
        ])->assertInvalid(['name']);
    });

    it('rejects invalid email format', function () {
        post(route('contacts.store'), [
            'name'    => 'Valid Name',
            'email'   => 'not-an-email',
            'contact' => '123456789',
        ])->assertInvalid(['email']);
        
        post(route('contacts.update', $this->contact), [
            'name'    => 'Valid Name',
            'email'   => 'not-an-email',
            'contact' => '123456789',
        ])->assertInvalid(['email']);
    });

    it('rejects contact that is not exactly 9 digits', function () {
        $payloadWithLessThanNineDigits = [
            'name'    => 'Valid Name',
            'email'   => 'valid@example.com',
            'contact' => '12345',
        ];
        
        $payloadWithInvalidCharacters = [
            'name'    => 'Valid Name',
            'email'   => 'valid@example.com',
            'contact' => '12345ABCD',
        ];
        
        put(route('contacts.update', ['contact' => $this->contact]), $payloadWithLessThanNineDigits)
            ->assertInvalid(['contact']);

        post(route('contacts.store'), $payloadWithLessThanNineDigits)
            ->assertInvalid(['contact']);

        put(route('contacts.update', ['contact' => $this->contact]), $payloadWithInvalidCharacters)
            ->assertInvalid(['contact']);
        
        post(route('contacts.store'), $payloadWithInvalidCharacters)
            ->assertInvalid(['contact']);
    });

});
