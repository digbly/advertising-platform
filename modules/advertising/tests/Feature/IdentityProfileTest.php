<?php

namespace Modules\Advertising\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IdentityProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_act_as_both_advertiser_and_publisher(): void
    {
        $user = User::factory()->create([
            'company_name' => 'Acme Corp',
            'payout_method' => 'bank',
            'payout_account' => '123456789',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'company_name' => 'Acme Corp',
            'payout_method' => 'bank',
            'payout_account' => '123456789',
        ]);
    }

    public function test_publisher_payout_fields_are_stored_on_user(): void
    {
        $user = User::factory()->create([
            'payout_method' => 'paypal',
            'payout_account' => 'publisher@example.com',
        ]);

        $this->assertSame('paypal', $user->payout_method);
        $this->assertSame('publisher@example.com', $user->payout_account);
    }

    public function test_migration_adds_fields_without_breaking_existing_users(): void
    {
        $user = User::factory()->create();

        $this->assertNull($user->company_name);
        $this->assertNull($user->payout_method);
        $this->assertNull($user->payout_account);
    }
}
