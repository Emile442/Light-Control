<?php

namespace App\Concern;

use App\Light;

trait Lightable
{
    public function lights()
    {
        return $this->belongsToMany(Light::class, 'group_light');
    }

    public function savelights($lights) {
        $lights = array_filter(array_unique(array_map(function ($item) {
            return trim($item);
        }, explode(',', $lights))), function ($item) {
            return !empty($item);
        });

        $persisted_lights = Light::whereIn('name', $lights)->get();

        $this->lights()->sync($persisted_lights);
    }

    public function getlightsListAttribute(){
        return $this->lights->pluck('name')->implode(',');
    }
}
