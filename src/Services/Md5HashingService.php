<?php

namespace Hashing\Services;

class Md5HashingService implements HashingServiceInterface
{
    public function hash(string $plaintext, bool $binary = false): string
    {
        return hash('md5', $plaintext, $binary);
    }
}
