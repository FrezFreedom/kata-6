<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class AccountTest extends TestCase
{
    function test_account_deposit(): void
    {
        $timeService = Mockery::mock(TimeServiceInterface);

        $timeService->shouldReceive('now')->andReturn('10/04/2014');

        $accountRepository = new AccountRepository($timeService);

        $account = new Account($accountRepository);

        $account->deposit(500);

        ob_start();

        $account->printStatement();

        $output = ob_get_clean();

        $expectedOutput = "DATE | AMOUNT | BALANCE\n10/04/2014 | 500.00 | 500.00\n";

        $this->assertEquals($expectedOutput, $output);
    }
}