<?php
declare(strict_types=1);

namespace doganoo\DI\Test\Encryption\AES;

use doganoo\DI\Encryption\AES\AESEncryptionServiceInterface;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Encryption\AES\AESEncryptionService;

class AESEncryptionTest extends TestCase {

    private AESEncryptionServiceInterface $encryptionService;

    protected function setUp(): void {
        parent::setUp();
        $this->encryptionService = new AESEncryptionService();
    }

    public function testEncryption(): void {
        $plain      = "thisisaplaintext";
        $passphrase = "thisisapassphrase";

        $encrypted = $this->encryptionService->encrypt($passphrase, $plain);
        $decrypted = $this->encryptionService->decrypt($passphrase, $encrypted);

        $this->assertSame($plain, $decrypted);
    }

}