<?php

namespace Tests;

use Hashing\Exceptions\HashingException;
use Hashing\Services\HashingServiceInterface;
use Hashing\Services\HmacHashingService;
use PHPUnit\Framework\Attributes\DataProvider;

class HmacHashingServiceTest extends TestCase
{
    protected HashingServiceInterface $hashingService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hashingService = new HmacHashingService('1797980b15dd9e3240e8aee6d4ca548291618084b75cfe73ef9d040389ed4d1a');
    }

    public function testConstructInvalidKey(): void
    {
        $this->expectException(HashingException::class);
        $this->expectExceptionMessage('The key must be a hexadecimal string and must have a length of 64.');

        new HmacHashingService('');
    }

    #[DataProvider('dataProviderHash')]
    public function testHash(bool $binary): void
    {
        $plaintext = 'foobar';

        $expectedHash = '3d14b7192be0302d8e304d19d8999742ff785f54035b989f5c165daf4ba95d5c';

        $hash = $this->hashingService->hash($plaintext, $binary);

        if ($binary) {
            $expectedHash = hex2bin($expectedHash);
        }

        $this->assertEquals($expectedHash, $hash);
    }

    /**
     * @return array<int,array<string,bool>>
     */
    public static function dataProviderHash(): array
    {
        return [
            [
                'binary' => false,
            ],
            [
                'binary' => true,
            ],
        ];
    }
}
