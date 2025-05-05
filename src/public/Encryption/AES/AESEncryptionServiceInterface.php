<?php
declare(strict_types=1);

namespace doganoo\DI\Encryption\AES;

interface AESEncryptionServiceInterface {

    public const METHOD         = "AES-256-CBC";
    public const HASH_ALGORITHM = "sha256";
    public const IV_LENGTH      = 16;

    public function encrypt(string $passphrase, string $raw): string;

    public function decrypt(string $passphrase, string $encrypted): string;

}