<?php

namespace Hashing\Services;

class Sha256HashingService implements HashingServiceInterface
{
    public function hash(string $plaintext, bool $binary = false): string
    {
        return hash('sha256', $plaintext, $binary);
    }
}
