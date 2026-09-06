<?php

namespace Modules\Advertising\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Advertising\Models\Campaign;
use Modules\Advertising\Models\Creative;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    public function test_campaign_stores_cpc_rate_and_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $campaign = Campaign::query()->create([
            'user_id' => $user->id,
            'name' => 'Test Campaign',
            'code' => 'TEST01',
            'rate' => 5.00,
        ]);

        $this->assertSame('5.0000', $campaign->rate);
        $this->assertTrue($campaign->user->is($user));
    }

    public function test_campaign_stores_targeting_fields(): void
    {
        $user = User::factory()->create();
        $campaign = Campaign::query()->create([
            'user_id' => $user->id,
            'name' => 'Test Campaign',
            'code' => 'TEST02',
            'rate' => 5.00,
            'geo_countries' => ['VN', 'US'],
            'device_types' => ['desktop', 'mobile'],
        ]);

        $this->assertSame(['VN', 'US'], $campaign->geo_countries);
        $this->assertSame(['desktop', 'mobile'], $campaign->device_types);
    }

    public function test_campaign_stores_budget_caps(): void
    {
        $user = User::factory()->create();
        $campaign = Campaign::query()->create([
            'user_id' => $user->id,
            'name' => 'Test Campaign',
            'code' => 'TEST03',
            'rate' => 5.00,
            'budget_total' => 100.00,
            'budget_daily' => 10.00,
        ]);

        $this->assertSame('100.00', $campaign->budget_total);
        $this->assertSame('10.00', $campaign->budget_daily);
    }

    public function test_campaign_lifecycle_transitions(): void
    {
        $user = User::factory()->create();
        $campaign = Campaign::query()->create([
            'user_id' => $user->id,
            'name' => 'Test Campaign',
            'code' => 'TEST04',
            'rate' => 5.00,
        ]);

        $this->assertSame('draft', $campaign->fresh()->status);
        $campaign->update(['status' => 'pending']);
        $this->assertSame('pending', $campaign->fresh()->status);
        $campaign->update(['status' => 'active']);
        $this->assertSame('active', $campaign->fresh()->status);
        $campaign->update(['status' => 'paused']);
        $this->assertSame('paused', $campaign->fresh()->status);
        $campaign->update(['status' => 'ended']);
        $this->assertSame('ended', $campaign->fresh()->status);
    }

    public function test_campaign_has_multiple_creatives(): void
    {
        $user = User::factory()->create();
        $campaign = Campaign::query()->create([
            'user_id' => $user->id,
            'name' => 'Test Campaign',
            'code' => 'TEST05',
            'rate' => 5.00,
        ]);

        Creative::query()->create([
            'campaign_id' => $campaign->id,
            'title' => 'Creative A',
            'target_url' => 'https://example.com/a',
        ]);
        Creative::query()->create([
            'campaign_id' => $campaign->id,
            'title' => 'Creative B',
            'target_url' => 'https://example.com/b',
        ]);

        $this->assertCount(2, $campaign->creatives);
    }
}
