@extends('layouts.guest')

@section('title', 'Guest Home')


@section('content')
   <div class="container">
       <div class="guest__main">
           <div class="row">
               <div class="card">
                   <div class="card-body">
                       <div class="alert alert-info">
                           Cette interface est disponible de 20h à 8h.
                       </div>

                       @include('layouts._flash')

                       @if($groups->count() != 0)
                           @foreach($groups as $k => $group)
                               <div class="row">
                                   <div class="col-md-4 my-auto">
                                    <span class="guest__timer text-uppercase">{{ $group->name }}</span>
                                   </div>
                                   <div class="col-md-4">
                                       @foreach($group->timers as $timer)
                                           <div class="circle-progress left timer" data-animation-start-value="" data-start="{{ $timer->job->created_at->timestamp }}" data-end="{{ $timer->job->available_at }}">
                                               <strong></strong>
                                           </div>
                                       @endforeach
                                   </div>
                                   <div class="col-md-4">
                                       <form action="{{ route('guest.group', $group) }}" method="get">
                                           <button class="btn btn-warning btn-lg" type="submit" {{ $group->canSwitch ? '' : 'disabfled' }}>Allumer</button>
                                       </form>
                                   </div>
                               </div>
                               @if($groups->count() != $k  + 1)
                                   <hr>
                               @endif
                            @endforeach
                       @else
                           <div class="alert alert-warning">
                               Aucun groupe n'est publique.
                           </div>
                       @endif
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection
