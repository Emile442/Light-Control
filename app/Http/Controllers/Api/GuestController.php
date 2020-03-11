<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Controllers\Controller;
use App\Zigbee\ZigbeeApi;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    public function groups()
    {
        $groups = Group::with('timers.job')->where('public', true)->get();
        return $groups;
    }

    public function groupsSwitch(Group $group) {
        if (!$group || !$group->public)
            abort(404);

        if (!$group->canSwitch)
            return response()->json([
                'success' => false,
                'errors' => [
                    'Groups cannot be switch before 10min ends'
                ]
            ])->setStatusCode(403);

        $group->switchDiffer(true, 30);

        $groupR = Group::with('timers.job')->find($group->id);
        return response()->json([
            'success' => true,
            'errors' => [],
            'group' => $groupR
        ]);
    }

}
