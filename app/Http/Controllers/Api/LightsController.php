<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Light;
use App\Zigbee\ZigbeeApi;
use Illuminate\Http\Request;

class LightsController extends Controller
{
    public function index(Request $request) {
        $term = $request->get('term');
        $lights = Light::with('groups')
            ->where('name', 'LIKE', $term . '%')
            ->get()
            ->map(function ($light) {
                $light['value'] = $light->name;
                return $light;
            });
        return response()->json($lights);
    }

    public function delete($id) {
        $light = Light::find($id);
        $light->delete();
        return response()->json(['ok']);
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

        $deconz = (new ZigbeeApi())->getLight($light->networkId);
        if (!isset($deconz->state))
            $deconz = [];
        return response()->json($deconz)->setStatusCode(empty($deconz) ? 504 : 200);
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

        $rq = (new ZigbeeApi())->setLightState($light->networkId);
        if (is_null($rq))
            $errors[] = 'Unable to connect the bridge';

        return response()->json([
            'success' => empty($errors) ? true : false,
            'state' => $rq,
            'errors' => $errors
        ])->setStatusCode(empty($errors) ? 200 : 504);
    }
}
