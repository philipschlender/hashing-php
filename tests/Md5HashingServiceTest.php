<?php

namespace Tests;

use Hashing\Services\HashingServiceInterface;
use Hashing\Services\Md5HashingService;
use PHPUnit\Framework\Attributes\DataProvider;

class Md5HashingServiceTest extends TestCase
{
    protected HashingServiceInterface $hashingService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hashingService = new Md5HashingService();
    }

    #[DataProvider('dataProviderHash')]
    public function testHash(bool $binary): void
    {
        $plaintext = 'foobar';

        $expectedHash = '3858f62230ac3c915f300c664312c63f';

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
