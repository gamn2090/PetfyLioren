@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('Error'))
        <div class="alert alert-danger" style="width: 100%;">
            {{ session('Error') }}
        </div>
    @endif
    @if (session('Exito'))
        <div class="alert alert-success" style="width: 100%;">
            {{ session('Exito') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
