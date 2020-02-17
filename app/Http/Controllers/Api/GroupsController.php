<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Controllers\Controller;
use App\Jobs\GroupsStateJobs;
use App\Zigbee\DeconzApi;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function setGroupState($id, $state)
    {
        $group = Group::find($id);
        if (!$group)
            return response()->json([
                'success' => false,
                'errors' => [
                    'Group not Found'
                ]
            ])->setStatusCode(404);

        $r = new DeconzApi();
        $errors = [];
        foreach ($group->lights as $light) {
            $e = $r->setLightState($light->networkId, $state);
            if (is_null($e))
                $errors[] = "[{$light->name}][#{$light->networkId}] Unable to connect the light";
        }
        return response()->json([
            'success' => empty($errors) ? true : false,
            'state' => $state,
            'errors' => $errors
        ])->setStatusCode(empty($errors) ? 200 : 504);
    }

    public function setGroupStateForXMinutes($id, $state, $period)
    {
        $group = Group::find($id);
        if (!$group)
            return response()->json([
                'success' => false,
                'errors' => [
                    'Group not Found'
                ]
            ])->setStatusCode(404);

        $this->dispatch((new GroupsStateJobs($group, !$state))->delay(Carbon::now()->addMinutes($period)));
        $this->dispatch((new GroupsStateJobs($group, $state)));
        $errors = [];
        return response()->json([
            'success' => empty($errors) ? true : false,
            'errors' => $errors
        ])->setStatusCode(empty($errors) ? 200 : 504);
    }
}
