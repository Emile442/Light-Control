<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Controllers\Controller;
use App\Job;
use App\Jobs\GroupsStateJobs;
use App\Timer;
use App\Zigbee\DeconzApi;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->get('term');

        return Group::select('name')
            ->where('name', 'LIKE', $term . '%')
            ->get()
            ->map(function ($group) {
                return [
                    'value' => $group->name
                ];
            });
    }

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

        $rq = new DeconzApi();
        $lights = [];
        foreach ($group->lights as $light) {
            $lights[] = $light->networkId;
        }
        $errors = $rq->setLightsState($lights, $state);

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

        $group->switchDiffer($state, $period);

        $errors = [];
        return response()->json([
            'success' => empty($errors) ? true : false,
            'errors' => $errors
        ])->setStatusCode(empty($errors) ? 200 : 504);
    }

}
