<?php

class Transaction
{
    public function __construct(public float $amount, public string $date)
    {
    }
}