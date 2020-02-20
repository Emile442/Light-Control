<?php

namespace App\Rules;

use App\Group;
use Illuminate\Contracts\Validation\Rule;

class GroupsList implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $array = $this->parseTagify($value);
        $routines = Group::whereIn('name', $array)->count();

        return count($array) == $routines;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute is invalid, it must be an existing group';
    }

    private function parseTagify(string $str) : array
    {
        $tmp = [];
        foreach (json_decode($str) as $item)
            $tmp[] = $item->value;
        return $tmp;
    }
}
