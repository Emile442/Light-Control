<?php

namespace Tests\Unit;

use App\Zigbee\ZigbeeApi;
use PHPUnit\Framework\TestCase;

class ZigbeeApiTest extends TestCase
{

    public function testGetLights()
    {
        $zigbee = new ZigbeeApi();
        $zLights = $zigbee->getLights();

        $i = 0;
        $assert = [0 => 'Cafet', 1 => 'Cafet 2'];
        foreach ($zLights as $k => $zLight) {
            $this->assertTrue($zLight->name == $assert[$i]);
            $i++;
        }
        $this->assertTrue($i == 2);
    }

    public function testGetLight()
    {
        $zigbee = new ZigbeeApi();
        $zLight1 = $zigbee->getLight(1);

        $this->assertNotNull($zLight1);
        $this->assertTrue($zLight1->name == 'Cafet');

        $zLight2 = $zigbee->getLight(45);
        $this->assertNull($zLight2);
    }

    public function testSetLightState()
    {
        $zigbee = new ZigbeeApi();
        $zLight1 = $zigbee->setLightState(1, true);
        $this->assertNotNull($zLight1);
        $this->assertTrue($zLight1 === true);

        $zLight2 = $zigbee->setLightState(45, false);
        $this->assertNull($zLight2);
    }

}
