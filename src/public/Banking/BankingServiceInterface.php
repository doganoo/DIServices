<?php
declare(strict_types=1);

namespace doganoo\DI\Banking;

interface BankingServiceInterface {

    public function ibanToBankCodeAndBankAccount(string $iban): array;

}