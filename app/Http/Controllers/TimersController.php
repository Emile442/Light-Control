<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Timer;

class TimersController extends Controller
{
    public function destroy($id)
    {
        $timer = Timer::where('id', $id)->first();
        $timer->job->delete();
        $timer->delete();
        return redirect()->route('root')->with('success', "The Timer about {$timer->group->name} has been reset.");
    }
}
