<?php
declare(strict_types=1);

namespace doganoo\DIP\Banking;

use doganoo\DI\Banking\BankingServiceInterface;
use InvalidArgumentException;

class BankingService implements BankingServiceInterface {

    public function ibanToBankCodeAndBankAccount(string $iban): array {
        // Remove spaces and make uppercase
        $iban = strtoupper(str_replace(' ', '', $iban));

        // Check if it's a German IBAN
        if (substr($iban, 0, 2) !== 'DE' || strlen($iban) !== 22) {
            throw new InvalidArgumentException('Invalid German IBAN');
        }

        // Extract BLZ and Konto from positions
        $blz   = substr($iban, 4, 8);
        $konto = substr($iban, 12);

        return [
            'bankCode'    => $blz,
            'bankAccount' => ltrim($konto, '0') // Remove leading zeros
        ];
    }

}