<?php

namespace App\Zigbee;


use GuzzleHttp\Client as Client;
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

        return(json_decode($rq->getBody()->getContents()));
    }

    public function setLightState(int $lightId, bool $state) : bool
    {
        $client = new Client(['http_errors' => false]);

        $rq = $client->put(
            $this->buildUrl("/lights/{$lightId}/state"),
            [
                'json' => ['on' => $state]
            ]
        );

        if ($rq->getStatusCode() != 200)
            return (false);

        $reponse = json_decode($rq->getBody()->getContents());

        return(isset($reponse->success) ? true : false);
    }
}
