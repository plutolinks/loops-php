<?php

declare(strict_types=1);

namespace PlutoLinks\Loops;

use PlutoLinks\Loops\Resources\ContactResource;
use PlutoLinks\Loops\Resources\EventResource;
use PlutoLinks\Loops\Resources\TransactionalResource;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class Loops extends Connector
{
    use AcceptsJson;

    public function __construct(public readonly string $token)
    {
    }

    protected function defaultAuth(): Authenticator
    {
        return new TokenAuthenticator($this->token);
    }

    public function resolveBaseUrl(): string
    {
        return 'https://app.loops.so/api/v1';
    }

    public static function client(string $token): Loops
    {
        return new Loops($token);
    }

    public function contacts(): ContactResource
    {
        return new ContactResource($this);
    }

    public function events(): EventResource
    {
        return new EventResource($this);
    }

    public function transactional(): TransactionalResource
    {
        return new TransactionalResource($this);
    }
}
