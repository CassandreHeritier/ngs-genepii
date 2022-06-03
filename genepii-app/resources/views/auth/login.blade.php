@extends('layouts.app')

@section('content')
<div class="login-container col-4 my-5 p-5 row">
    <div class="text-center my-2">
        <img src="{{ url('/images/hcl.jpg') }}" width="100" height="100" />
        <img src="{{ url('/images/genepii.png') }}" width="200" height="100"/>
    </div>

    <div id="login" class="card text-center bg-light" style="border:1px solid black">
        <div class="card-body">
            <h3 class="card-title">GENEPII NGS</h3>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <!-- NOM -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <span class="fa fa-user"></span>
                        </span>
                        <input id="text" type="text" class="form-control" name="username" placeholder="Login Windows" required autofocus>
                    </div>
                    @if($flash = session('message'))
                        <div id="flash-message" class="col-sm-10 offset-sm-1 alert alert-success" role="alert">{{ $flash }}</div>
                    @endif
                    @if($flash = session('error'))
                        <div id="flash-error" class="col-sm-10 offset-sm-1 alert alert-danger" role="alert">{{ $flash }}</div>
                    @endif
                </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
