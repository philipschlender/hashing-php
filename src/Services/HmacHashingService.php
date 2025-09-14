<?php

namespace Hashing\Services;

use Hashing\Exceptions\HashingException;

class HmacHashingService implements HashingServiceInterface
{
    protected string $key;

    /**
     * @throws HashingException
     */
    public function __construct(
        #[\SensitiveParameter] string $key,
    ) {
        if (1 !== preg_match('/^[0-9a-f]{64}$/', $key)) {
            throw new HashingException('The key must be a hexadecimal string and must have a length of 64.');
        }

        $key = hex2bin($key);

        if (!is_string($key)) {
            throw new HashingException('Failed to convert the hexadecimal string to its binary representation.');
        }

        $this->key = $key;
    }

    public function hash(string $plaintext, bool $binary = false): string
    {
        return hash_hmac('sha256', $plaintext, $this->key, $binary);
    }
}
