<?php
declare(strict_types=1);

namespace doganoo\DIP\Encryption\AES;

use doganoo\DI\Encryption\AES\IAESEncryptionService;
use doganoo\DIP\Exception\DIServicesException;

class AESEncryptionService implements IAESEncryptionService {

    public function encrypt(string $passphrase, string $raw): string {
        $key = hash(
            IAESEncryptionService::HASH_ALGORITHM
            , $passphrase
            , true
        );

        $iv = openssl_random_pseudo_bytes(IAESEncryptionService::IV_LENGTH);

        $cipherText = openssl_encrypt(
            $raw
            , IAESEncryptionService::METHOD
            , (string) $key
            , OPENSSL_RAW_DATA
            , (string) $iv
        );

        $hash = hash_hmac(
            IAESEncryptionService::HASH_ALGORITHM
            , (string) $cipherText
            , (string) $key
            , true
        );

        return $iv . $hash . $cipherText;
    }

    public function decrypt(string $passphrase, string $encrypted): string {
        $iv = substr(
            $encrypted
            , 0
            , IAESEncryptionService::IV_LENGTH
        );

        $hash = substr(
            $encrypted
            , IAESEncryptionService::IV_LENGTH
            , 32
        );

        $cipherText = substr($encrypted, 48);

        $key = hash(
            IAESEncryptionService::HASH_ALGORITHM
            , $passphrase
            , true
        );

        $newHash = hash_hmac(
            IAESEncryptionService::HASH_ALGORITHM
            , $cipherText
            , $key
            , true
        );

        if ($newHash !== $hash) {
            throw new DIServicesException("hashes do not match. There was an error. Aborting encryption");
        }

        $decrypted = openssl_decrypt(
            $cipherText
            , IAESEncryptionService::METHOD
            , $key
            , OPENSSL_RAW_DATA
            , $iv
        );

        if (false === $decrypted) {
            throw new DIServicesException();
        }

        return $decrypted;
    }

}