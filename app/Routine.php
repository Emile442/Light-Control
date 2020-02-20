<?php

namespace App;

use App\Concern\Groupable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use Groupable;

    protected $fillable = ['name', 'state', 'exec_at'];

    public function getExecAttribute()
    {
        if (!$this->id)
            return '';
        return Carbon::createFromFormat('H:i:s', $this->exec_at)->format('H:i');
    }

}
