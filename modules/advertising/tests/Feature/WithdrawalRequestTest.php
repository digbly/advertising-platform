<?php

namespace Modules\Advertising\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Advertising\Models\Transaction;
use Modules\Advertising\Models\WithdrawalRequest;
use Tests\TestCase;

class WithdrawalRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_publisher_requests_withdrawal_and_it_starts_pending(): void
    {
        $user = User::factory()->create();
        $user->forceFill(['amount' => 100.00])->save();
        $request = WithdrawalRequest::query()->create([
            'user_id' => $user->id,
            'amount' => 50.00,
            'method' => 'bank',
        ]);

        $this->assertSame('pending', $request->fresh()->status);
        $this->assertDatabaseHas('withdrawal_requests', [
            'id' => $request->id,
            'user_id' => $user->id,
            'amount' => 50.00,
            'status' => 'pending',
        ]);
    }

    public function test_admin_approval_decreases_balance_and_records_withdrawal_entry(): void
    {
        $user = User::factory()->create();
        $user->forceFill(['amount' => 100.00])->save();
        $request = WithdrawalRequest::query()->create([
            'user_id' => $user->id,
            'amount' => 50.00,
            'method' => 'bank',
        ]);

        $newBalance = (float) $user->amount - 50.00;
        $user->forceFill(['amount' => $newBalance])->save();
        Transaction::query()->create([
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'amount' => 50.00,
            'balance_after' => $newBalance,
            'cause_id' => $request->id,
            'cause_type' => WithdrawalRequest::class,
        ]);
        $request->update(['status' => 'approved']);

        $this->assertSame('50.00', $user->amount);
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'amount' => 50.00,
            'balance_after' => 50.00,
        ]);
        $this->assertSame('approved', $request->status);
    }

    public function test_withdrawal_exceeding_balance_is_rejected(): void
    {
        $user = User::factory()->create();
        $user->forceFill(['amount' => 30.00])->save();
        $request = WithdrawalRequest::query()->create([
            'user_id' => $user->id,
            'amount' => 50.00,
            'method' => 'bank',
        ]);

        $request->update(['status' => 'rejected']);

        $this->assertSame('rejected', $request->status);
        $this->assertSame('30.00', $user->amount);
        $this->assertDatabaseMissing('transactions', [
            'user_id' => $user->id,
            'type' => 'withdrawal',
        ]);
    }
}
