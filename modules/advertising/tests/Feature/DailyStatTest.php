<?php

namespace Modules\Advertising\Tests\Feature;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Advertising\Models\Campaign;
use Modules\Advertising\Models\DailyStat;
use Modules\Advertising\Models\EventLog;
use Modules\Advertising\Models\Website;
use Tests\TestCase;

class DailyStatTest extends TestCase
{
    use RefreshDatabase;

    private function makeCampaign(User $user): Campaign
    {
        return Campaign::query()->create([
            'user_id' => $user->id,
            'name' => 'Test Campaign',
            'code' => 'DST'.substr((string) $user->id, 0, 8),
            'rate' => 5.00,
        ]);
    }

    private function makeWebsite(User $user): Website
    {
        return Website::query()->create([
            'user_id' => $user->id,
            'url' => 'https://example.com',
            'name' => 'Example Blog',
        ]);
    }

    public function test_aggregating_days_events_produces_correct_counts(): void
    {
        $user = User::factory()->create();
        $campaign = $this->makeCampaign($user);
        $website = $this->makeWebsite($user);

        for ($i = 0; $i < 3; $i++) {
            EventLog::query()->create([
                'campaign_id' => $campaign->id,
                'website_id' => $website->id,
                'type' => 'impression',
                'created_at' => now(),
            ]);
        }
        for ($i = 0; $i < 2; $i++) {
            EventLog::query()->create([
                'campaign_id' => $campaign->id,
                'website_id' => $website->id,
                'type' => 'click',
                'created_at' => now(),
            ]);
        }

        $impressions = EventLog::query()->where('type', 'impression')->count();
        $clicks = EventLog::query()->where('type', 'click')->count();

        $dailyStat = DailyStat::query()->create([
            'campaign_id' => $campaign->id,
            'website_id' => $website->id,
            'date' => today(),
            'impressions' => $impressions,
            'clicks' => $clicks,
            'spend' => $clicks * (float) $campaign->rate,
            'revenue' => $clicks * (float) $campaign->rate,
        ]);

        $this->assertSame(3, $dailyStat->impressions);
        $this->assertSame(2, $dailyStat->clicks);
    }

    public function test_spend_for_cpc_campaign_equals_rate_times_clicks(): void
    {
        $user = User::factory()->create();
        $campaign = $this->makeCampaign($user);
        $website = $this->makeWebsite($user);

        $dailyStat = DailyStat::query()->create([
            'campaign_id' => $campaign->id,
            'website_id' => $website->id,
            'date' => today(),
            'impressions' => 10,
            'clicks' => 10,
            'spend' => 10 * (float) $campaign->rate,
            'revenue' => 10 * (float) $campaign->rate,
        ]);

        $this->assertSame('50.00', $dailyStat->spend);
        $this->assertSame('50.00', $dailyStat->revenue);
    }

    public function test_unique_constraint_prevents_duplicate_rows(): void
    {
        $user = User::factory()->create();
        $campaign = $this->makeCampaign($user);
        $website = $this->makeWebsite($user);

        DailyStat::query()->create([
            'campaign_id' => $campaign->id,
            'website_id' => $website->id,
            'date' => today(),
        ]);

        $this->expectException(QueryException::class);

        DailyStat::query()->create([
            'campaign_id' => $campaign->id,
            'website_id' => $website->id,
            'date' => today(),
        ]);
    }
}
