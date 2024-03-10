<?php

declare(strict_types=1);

use PlutoLinks\Loops\Loops;
use PlutoLinks\Loops\Requests\Transactional\TransactionalSendRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
    $this->loops = Loops::client('asdf');
});

describe('send', function (): void {
    it('can send a transactional email', function (): void {
        $mockClient = MockClient::global([
            TransactionalSendRequest::class => MockResponse::make([
                'success' => true,
            ]),
        ]);

        $response = $this->loops->transactional()->send(
            'asdf',
            'john@example.com',
            [
                'variable' => 'This is the variable content.',
            ],
            [
                [
                    'filename' => 'ramen.jpg',
                    'contentType' => 'image/jpg',
                    'data' => base64_encode(file_get_contents(__DIR__.'/../../test_files/ramen.jpg')),
                ],
            ]
        );

        $mockClient->assertSent(function (TransactionalSendRequest $request): bool {
            return $request->body()->all() == [
                'email' => 'john@example.com',
                'transactionalId' => 'asdf',
                'dataVariables' => [
                    'variable' => 'This is the variable content.',
                ],
                'attachments' => [
                    [
                        'filename' => 'ramen.jpg',
                        'contentType' => 'image/jpg',
                        'data' => base64_encode(file_get_contents(__DIR__.'/../../test_files/ramen.jpg')),
                    ],
                ],
            ];
        });

        expect($response)
            ->success->toBeTrue();
    });
});
