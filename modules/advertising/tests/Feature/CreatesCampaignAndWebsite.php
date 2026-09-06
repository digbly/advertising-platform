<?php

namespace Modules\Advertising\Tests\Feature;

use App\Models\User;
use Modules\Advertising\Models\Campaign;
use Modules\Advertising\Models\Website;

trait CreatesCampaignAndWebsite
{
    private function makeCampaign(User $user): Campaign
    {
        return Campaign::query()->create([
            'user_id' => $user->id,
            'name' => 'Test Campaign',
            'code' => 'TST'.substr((string) $user->id, 0, 8),
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
}
