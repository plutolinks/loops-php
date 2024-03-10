<?php

declare(strict_types=1);

use PlutoLinks\Loops\Loops;
use PlutoLinks\Loops\Requests\Events\EventSendRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
    $this->loops = Loops::client('asdf');
});

describe('send', function (): void {
    it('can send an event', function (): void {
        $mockClient = MockClient::global([
            EventSendRequest::class => MockResponse::make([
                'message' => null,
                'success' => true,
            ]),
        ]);

        $response = $this->loops->events()->send(eventName: 'signup', email: 'john@example.com');

        $mockClient->assertSent(function (EventSendRequest $request): bool {
            return $request->body()->all() == [
                'eventName' => 'signup',
                'email' => 'john@example.com',
            ];
        });

        expect($response)
            ->message->toBeNull()
            ->success->toBeTrue();
    });
});
