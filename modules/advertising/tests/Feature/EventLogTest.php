<?php

namespace Modules\Advertising\Tests\Feature;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Modules\Advertising\Models\Campaign;
use Modules\Advertising\Models\EventLog;
use Modules\Advertising\Models\Website;
use Tests\TestCase;

class EventLogTest extends TestCase
{
    use RefreshDatabase;

    private function makeCampaign(User $user): Campaign
    {
        return Campaign::query()->create([
            'user_id' => $user->id,
            'name' => 'Test Campaign',
            'code' => 'EVT'.substr((string) $user->id, 0, 8),
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

    public function test_recording_impression_event_persists_fields(): void
    {
        $user = User::factory()->create();
        $campaign = $this->makeCampaign($user);
        $website = $this->makeWebsite($user);

        $event = EventLog::query()->create([
            'campaign_id' => $campaign->id,
            'website_id' => $website->id,
            'type' => 'impression',
            'geo' => 'VN',
            'device' => 'desktop',
            'created_at' => now(),
        ]);

        $this->assertDatabaseHas('event_log', [
            'id' => $event->id,
            'campaign_id' => $campaign->id,
            'website_id' => $website->id,
            'type' => 'impression',
            'geo' => 'VN',
            'device' => 'desktop',
        ]);
    }

    public function test_recording_click_event_persists_fields(): void
    {
        $user = User::factory()->create();
        $campaign = $this->makeCampaign($user);
        $website = $this->makeWebsite($user);

        $event = EventLog::query()->create([
            'campaign_id' => $campaign->id,
            'website_id' => $website->id,
            'type' => 'click',
            'geo' => 'US',
            'device' => 'mobile',
            'created_at' => now(),
        ]);

        $this->assertDatabaseHas('event_log', [
            'id' => $event->id,
            'type' => 'click',
            'geo' => 'US',
            'device' => 'mobile',
        ]);
    }

    public function test_foreign_keys_reject_missing_campaign(): void
    {
        $user = User::factory()->create();
        $website = $this->makeWebsite($user);

        $this->expectException(QueryException::class);

        EventLog::query()->create([
            'campaign_id' => (string) Str::uuid(),
            'website_id' => $website->id,
            'type' => 'impression',
            'created_at' => now(),
        ]);
    }
}
