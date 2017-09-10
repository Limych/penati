@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        <div class="container p-5">
            <h1>Dashboard</h1>

            <div class="lead ml-2 text-success">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <p>You are logged in!</p>
            </div>
        </div>
    </div>

@endsection
