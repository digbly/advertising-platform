<?php

namespace Modules\Advertising\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Advertising\Models\Website;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_publisher_registers_website_and_it_starts_pending(): void
    {
        $user = User::factory()->create();

        $website = Website::query()->create([
            'user_id' => $user->id,
            'url' => 'https://example.com',
            'name' => 'Example Blog',
        ]);

        $this->assertSame('pending', $website->fresh()->status);
        $this->assertDatabaseHas('websites', [
            'id' => $website->id,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
    }

    public function test_admin_approval_moves_website_to_approved(): void
    {
        $user = User::factory()->create();
        $website = Website::query()->create([
            'user_id' => $user->id,
            'url' => 'https://example.com',
            'name' => 'Example Blog',
        ]);

        $website->update(['status' => 'approved']);

        $this->assertSame('approved', $website->status);
    }

    public function test_website_belongs_to_exactly_one_user(): void
    {
        $user = User::factory()->create();
        $website = Website::query()->create([
            'user_id' => $user->id,
            'url' => 'https://example.com',
            'name' => 'Example Blog',
        ]);

        $this->assertTrue($website->user->is($user));
    }
}
