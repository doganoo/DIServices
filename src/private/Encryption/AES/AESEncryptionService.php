<?php
declare(strict_types=1);

namespace doganoo\DIP\Encryption\AES;

use doganoo\DI\Encryption\AES\AESEncryptionServiceInterface;
use doganoo\DIP\Exception\DIServicesException;

class AESEncryptionService implements AESEncryptionServiceInterface {

    public function encrypt(string $passphrase, string $raw): string {
        $key = hash(
            AESEncryptionServiceInterface::HASH_ALGORITHM
            , $passphrase
            , true
        );

        $iv = openssl_random_pseudo_bytes(AESEncryptionServiceInterface::IV_LENGTH);

        $cipherText = openssl_encrypt(
            $raw
            , AESEncryptionServiceInterface::METHOD
            , (string) $key
            , OPENSSL_RAW_DATA
            , (string) $iv
        );

        $hash = hash_hmac(
            AESEncryptionServiceInterface::HASH_ALGORITHM
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
            , AESEncryptionServiceInterface::IV_LENGTH
        );

        $hash = substr(
            $encrypted
            , AESEncryptionServiceInterface::IV_LENGTH
            , 32
        );

        $cipherText = substr($encrypted, 48);

        $key = hash(
            AESEncryptionServiceInterface::HASH_ALGORITHM
            , $passphrase
            , true
        );

        $newHash = hash_hmac(
            AESEncryptionServiceInterface::HASH_ALGORITHM
            , $cipherText
            , $key
            , true
        );

        if (false === hash_equals($newHash, $hash)) {
            throw new DIServicesException("hashes do not match. There was an error. Aborting encryption");
        }

        $decrypted = openssl_decrypt(
            $cipherText
            , AESEncryptionServiceInterface::METHOD
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