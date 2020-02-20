<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Light;
use App\Zigbee\DeconzApi;
use Illuminate\Http\Request;

class LightsController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->get('term');

        return Light::select('name')
            ->where('name', 'LIKE', $term . '%')
            ->get()
            ->map(function ($group) {
                return [
                    'value' => $group->name
                ];
            });
    }

    public function getLights($id)
    {
        $light = Light::find($id);
        if (!$light)
            return response()->json([
                'success' => false,
                'errors' => [
                    'Light not Found'
                ]
            ])->setStatusCode(404);

        $deconz = (new DeconzApi())->getLight($light->networkId);
        if (!isset($deconz->state))
            $deconz = [];
        return response()->json($deconz)->setStatusCode(empty($deconz) ? 504 : 200);
    }

    public function setLightState($id, $state)
    {
        $light = Light::find($id);
        $errors = [];
        if (!$light)
            return response()->json([
                'success' => false,
                'errors' => [
                    'Light not Found'
                ]
            ])->setStatusCode(404);

        $rq = (new DeconzApi())->setLightState($light->networkId, $state);
        if (is_null($rq))
            $errors[] = 'Unable to connect the bridge';
        return response()->json([
            'success' => empty($errors) ? true : false,
            'state' => $state,
            'errors' => $errors
        ])->setStatusCode(empty($errors) ? 200 : 504);
    }

    public function switchLightState($id)
    {
        $light = Light::find($id);
        $errors = [];
        if (!$light)
            return response()->json([
                'success' => false,
                'errors' => [
                    'Light not Found'
                ]
            ])->setStatusCode(404);

        $rq = (new DeconzApi())->setLightState($light->networkId);
        if (is_null($rq))
            $errors[] = 'Unable to connect the bridge';

        return response()->json([
            'success' => empty($errors) ? true : false,
            'state' => $rq,
            'errors' => $errors
        ])->setStatusCode(empty($errors) ? 200 : 504);
    }
}
