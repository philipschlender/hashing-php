<?php

namespace Tests;

use Hashing\Services\HashingServiceInterface;
use Hashing\Services\Sha256HashingService;
use PHPUnit\Framework\Attributes\DataProvider;

class Sha256HashingServiceTest extends TestCase
{
    protected HashingServiceInterface $hashingService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hashingService = new Sha256HashingService();
    }

    #[DataProvider('dataProviderHash')]
    public function testHash(bool $binary): void
    {
        $plaintext = 'foobar';

        $expectedHash = 'c3ab8ff13720e8ad9047dd39466b3c8974e592c2fa383d4a3960714caef0c4f2';

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
