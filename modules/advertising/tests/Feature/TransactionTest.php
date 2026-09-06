<?php

namespace Modules\Advertising\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Advertising\Models\Transaction;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_deposit_increases_balance_and_records_entry(): void
    {
        $user = User::factory()->create();
        $user->forceFill(['amount' => 0])->save();

        $newBalance = (float) $user->amount + 100.00;
        $user->forceFill(['amount' => $newBalance])->save();
        Transaction::query()->create([
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => 100.00,
            'balance_after' => $newBalance,
        ]);

        $this->assertSame('100.00', $user->amount);
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => 100.00,
            'balance_after' => 100.00,
        ]);
    }

    public function test_campaign_spend_decreases_balance_and_records_entry(): void
    {
        $user = User::factory()->create();
        $user->forceFill(['amount' => 100.00])->save();

        $newBalance = (float) $user->amount - 3.00;
        $user->forceFill(['amount' => $newBalance])->save();
        Transaction::query()->create([
            'user_id' => $user->id,
            'type' => 'campaign_spend',
            'amount' => 3.00,
            'balance_after' => $newBalance,
        ]);

        $this->assertSame('97.00', $user->amount);
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type' => 'campaign_spend',
            'amount' => 3.00,
            'balance_after' => 97.00,
        ]);
    }

    public function test_publisher_earning_increases_balance_and_records_entry(): void
    {
        $user = User::factory()->create();
        $user->forceFill(['amount' => 0])->save();

        $newBalance = (float) $user->amount + 5.00;
        $user->forceFill(['amount' => $newBalance])->save();
        Transaction::query()->create([
            'user_id' => $user->id,
            'type' => 'publisher_earning',
            'amount' => 5.00,
            'balance_after' => $newBalance,
        ]);

        $this->assertSame('5.00', $user->amount);
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type' => 'publisher_earning',
            'amount' => 5.00,
            'balance_after' => 5.00,
        ]);
    }

    public function test_each_entry_stores_balance_after_movement(): void
    {
        $user = User::factory()->create();
        $user->forceFill(['amount' => 50.00])->save();

        $newBalance = (float) $user->amount + 25.00;
        $user->forceFill(['amount' => $newBalance])->save();
        $transaction = Transaction::query()->create([
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => 25.00,
            'balance_after' => $newBalance,
        ]);

        $this->assertSame('75.00', $transaction->balance_after);
        $this->assertSame('75.00', $user->amount);
    }
}
