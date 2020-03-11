@extends('layouts.guest')

@section('title', 'Guest Home')


@section('content')
   <div class="container">
       <div class="guest__main">
           <div class="row">
               <div class="card">
                   <div class="card-body">
                       <h1 class="guest__title">{{ env('APP_NAME') }}</h1>
                       @if(\Auth::user()->suspend)
                           <div class="alert alert-danger">
                               Votre compte a été suspendu, merci de prendre avec l'ADM
                           </div>
                       @endif
                       <div class="alert alert-info">
                           Cette interface est disponible de {{ env('NIGHT_HOUR', 20) }}h à {{ env('DAY_HOUR', 8) }}h.
                       </div>

                       @include('layouts._flash')

                      <student-table></student-table>
                   </div>
                   <div class="card-footer text-muted">
                       <i class="fas fa-code"></i> by <a href="mailto:emile.lepetit@epitech.eu" target="_blank" class="text-muted">Emile LEPETIT</a> & <a href="mailto:paul.bugeon@epitech.eu" target="_blank" class="text-muted">Paul BUGEON</a> with <i class="fas fa-heart"></i>
                       | 
                       @auth
                           <a href="{{ route('logout') }}" class="text-muted" data-method="post">Se déconnecter</a>
                       @elseauth
                           <a href="{{ route("login") }}" class="text-muted">Se connecter</a>
                       @endauth
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection
