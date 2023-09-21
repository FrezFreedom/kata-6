<?php

require_once ('Transaction.php');

class Database
{
    private array $transactions = [];

    public function __construct(private TimeServiceInterface $timeService)
    {

    }

    public function insertTransaction(float $amount): void
    {
        $transaction = new Transaction($amount, $this->timeService->now());
        $this->transactions[] = $transaction;
    }

    public function loadTransactions(): array
    {
        return $this->transactions;
    }
}