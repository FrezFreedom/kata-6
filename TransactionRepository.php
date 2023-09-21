<?php

require_once ('Database.php');

class TransactionRepository
{
    public function __construct(private Database $database)
    {
    }

    public function addTransaction(int $amount): void
    {
        $this->database->insertTransaction($amount);
    }

    public function loadTransactions(): array
    {
        return $this->database->loadTransactions();
    }
}