<?php

namespace Hashing\Services;

interface HashingServiceInterface
{
    public function hash(string $plaintext, bool $binary = false): string;
}
