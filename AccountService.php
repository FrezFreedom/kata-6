<?php

class AccountService
{
    public function __construct(private TransactionRepository $transactionRepository)
    {
    }

    public function deposit(float $amount): void
    {
        $this->transactionRepository->addTransaction($amount);
    }

    public function printStatement(): void
    {
        $transactions = $this->transactionRepository->loadTransactions();

        echo "DATE | AMOUNT | BALANCE\n";

        $balance = 0.0;
        foreach($transactions as $transaction)
        {
            $balance += $transaction->amount;

            echo $transaction->date
                . ' | ' . number_format((float)$transaction->amount, 2, '.', '')
                . ' | ' . number_format($balance, 2, '.', '') . "\n" ;
        }
    }
}