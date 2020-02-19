<?php

namespace App\Concern;


use App\Group;
use Illuminate\Support\Str;

trait Groupable
{
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'routine_group');
    }

    public function saveGroups($groups) {
        $groups = array_filter(array_unique(array_map(function ($item) {
            return trim($item);
        }, explode(',', $groups))), function ($item) {
            return !empty($item);
        });

        $persisted_groups = Group::whereIn('name', $groups)->get();

        $this->groups()->sync($persisted_groups);
    }

    public function getGroupsListAttribute(){
        return $this->groups->pluck('name')->implode(',');
    }
}
