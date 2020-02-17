<?php

namespace App\Zigbee;


use GuzzleHttp\Client as Client;
use GuzzleHttp\Promise;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;
use function foo\func;

class DeconzApi {


    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env("DECONZ_URL");
        $this->apiKey = env("DECONZ_KEY");
    }

    private function buildUrl($endpoint) : string
    {
        return ("{$this->baseUrl}/api/{$this->apiKey}{$endpoint}");
    }

    public function getLights()
    {
        $client = new Client();

        try {
            $rq = $client->get($this->buildUrl("/lights"));
        } catch (ClientException $e) {
            return (null);
        }

        return(json_decode($rq->getBody()->getContents()));
    }

    public function getLight(int $lightId)
    {
        $client = new Client();

        try {
            $rq = $client->get($this->buildUrl("/lights/{$lightId}"));
        } catch (ClientException $e) {
            return (null);
        }

        return(json_decode($rq->getBody()->getContents()));
    }

    public function setLightState(int $lightId, bool $state = null)
    {
        $client = new Client(['http_errors' => false]);

        $l = $this->getLight($lightId);
        if (is_null($l))
            return (null);
        if ($state == null)
            $state = !$l->state->on;

        $rq = $client->put(
            $this->buildUrl("/lights/{$lightId}/state"),
            [
                'json' => ['on' => $state]
            ]
        );

        return ($state);
    }

    // Todo: WIP
    public function setLightsState(array $ligthsId, bool $state) {
        $client = new Client(['http_errors' => false]);

        $rq = [];
        foreach ($ligthsId as $id) {
            $rq[] = $client->putAsync(
                $this->buildUrl("/lights/{$id}/state"),
                [
                    'json' => ['on' => $state]
                ]
            );
        }

        $errors = [];
        $result = Promise\any($rq)->then(
            function($value){
                dump($value->getBody()->getContents());
            },
            function ($value) use (&$errors) {
                $errors[] = "Unable to connect the light";
                // dump($value);
            }
        );

        $result->wait();

        return ($errors);
    }
}
