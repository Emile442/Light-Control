<?php

namespace App\Rules;

use App\Group;
use App\Light;
use Illuminate\Contracts\Validation\Rule;

class LightsList implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Your code here
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $array = $this->parseTagify($value);
        $lightsCount = Light::whereIn('name', $array)->count();

        return count($array) == $lightsCount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute is invalid, it must be an existing light';
    }

    private function parseTagify(string $str): array
    {
        $tmp = [];
        foreach (json_decode($str) as $item)
            $tmp[] = $item->value;
        return $tmp;
    }
}
