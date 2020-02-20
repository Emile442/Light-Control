<?php

namespace App\Zigbee;


use GuzzleHttp\Client as Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Exception\ClientException;

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

        $json = json_decode($rq->getBody()->getContents());

        if (!isset($json->state))
            return (null);
        return($json);
    }

    public function setLightState(int $lightId, bool $state = null) : ?bool
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

    public function setLightsState(array $ligthsId, bool $state) : array
    {
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
        $result = Promise\some(count($rq), $rq)
            ->then(
                function($res) use (&$errors, $ligthsId) {
                    foreach ($res as $k => $item) {
                        $body = json_decode($item->getBody()->getContents());
                        if (isset($body[0]) && isset($body[0]->error)) {
                            $errors[] = "Unable to connect the light #{$ligthsId[$k]}";
                        }
                    }
                },
                function ($res) use (&$errors) {
                    $errors[] = "Unable to connect the bridge";
                }
            );


        $result->wait();

        return ($errors);
    }
}
