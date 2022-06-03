@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="panel card col-10 my-5">
            <div class="card">
                <div class="card-header">{{ __('Tableau de bord') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Vous êtes connecté !') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
