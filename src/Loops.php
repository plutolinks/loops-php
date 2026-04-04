<?php

declare(strict_types=1);

namespace Hosmelq\Loops;

use Hosmelq\Loops\Resources\ContactResource;
use Hosmelq\Loops\Resources\EventResource;
use Hosmelq\Loops\Resources\TransactionalResource;
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

    public static function client(string $token): self
    {
        return new self($token);
    }

    public function contacts(): ContactResource
    {
        return new ContactResource($this);
    }

    public function events(): EventResource
    {
        return new EventResource($this);
    }

    public function resolveBaseUrl(): string
    {
        return 'https://app.loops.so/api/v1';
    }

    public function transactional(): TransactionalResource
    {
        return new TransactionalResource($this);
    }

    protected function defaultAuth(): Authenticator
    {
        return new TokenAuthenticator($this->token);
    }
}
