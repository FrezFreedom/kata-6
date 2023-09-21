<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once (__DIR__ . '/../TimeServiceInterface.php');
require_once (__DIR__ . '/../TransactionRepository.php');
require_once (__DIR__ . '/../AccountService.php');
require_once (__DIR__ . '/../Database.php');

final class AccountTest extends TestCase
{
    function test_account_deposit(): void
    {
        $timeService = Mockery::mock('TimeServiceInterface');

        $timeService->shouldReceive('now')->andReturn('10/04/2014');

        $database = new Database($timeService);

        $transactionRepository = new TransactionRepository($database);

        $account = new AccountService($transactionRepository);

        $account->deposit(500);

        ob_start();

        $account->printStatement();

        $output = ob_get_clean();

        $expectedOutput = "DATE | AMOUNT | BALANCE\n10/04/2014 | 500.00 | 500.00\n";

        $this->assertEquals($expectedOutput, $output);
    }
}