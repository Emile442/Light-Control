@extends('layouts.guest')

@section('title', 'Guest Home')


@section('content')
   <div class="container">
       <div class="guest__main">
           <div class="row">
               <div class="card">
                   <div class="card-body">
                       <h1 class="guest__title">{{ env('APP_NAME') }}</h1>
                       <div class="alert alert-info">
                           Cette interface est disponible de {{ env('NIGHT_HOUR', 20) }}h à {{ env('DAY_HOUR', 8) }}h.
                       </div>

                       @include('layouts._flash')

                       @if($groups->count() != 0)
                           @foreach($groups as $k => $group)
                               <div class="row">
                                   <div class="col-md-4 my-auto">
                                    <span class="guest__timer pull-left text-uppercase">{{ $group->name }}</span>
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
                                           <button class="btn btn-warning btn-lg" type="submit" {{ $group->canSwitch ? '' : 'disabled' }}>Allumer</button>
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

                       <div class="mt-3">
                           <div class="">
                               <span class="text-muted">
                                    <i class="fa fa-code"></i> by <a href="mailto:emile.lepetit@epitech.eu" target="_blank" class="text-muted">Emile LEPETIT</a> & <a href="mailto:paul.bugeon@epitech.eu" target="_blank" class="text-muted">Paul BUGEON</a> with <i class="fa fa-heart"></i>
                               | <a href="{{ route("login") }}" class="text-muted">Login</a>
                               </span>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection