<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Light;
use App\Zigbee\DeconzApi;
use Illuminate\Http\Request;

class LightsController extends Controller
{
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

        $r = (new DeconzApi())->setLightState($light->networkId, $state);
        if (is_null($r))
            $errors[] = "Unable to connect the bridge";
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

        $r = (new DeconzApi())->setLightState($light->networkId);
        if (is_null($r))
            $errors[] = "Unable to connect the bridge";
        return response()->json([
            'success' => empty($errors) ? true : false,
            'state' => $r,
            'errors' => $errors
        ])->setStatusCode(empty($errors) ? 200 : 504);
    }
}
