@extends('layouts.guest')

@section("title", "Login")

@section('content')

    <div class="container">
        <div class="guest__main">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Connexion</div>

                        <div class="card-body">
                            <a href="{{ route('auth.azure.redirect') }}" class="btn btn-info"><i class="fab fa-microsoft"></i> Connexion avec Office 365</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
