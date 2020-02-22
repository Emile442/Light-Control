<?php

namespace App\Jobs;

use App\Light;
use App\Zigbee\ZigbeeApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NetworkImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $networkId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $networkId)
    {
        $this->networkId = $networkId;
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle()
    {
        $zibee = new ZigbeeApi();

        foreach ($this->networkId as $id) {
            $lightDb = Light::where('networkId', $id)->first();
            if (!$lightDb) {
                $lightNet = $zibee->getLight($id);
                if (is_null($lightNet))
                    throw new \Exception('Light not found on the network');
                Light::create(['name' => $lightNet->name, 'networkId' => $id]);
            }
        }
    }
}
