@extends('_layout.app')

@php($auth_mode = true)

@section('body-classes')auth flex-row align-items-center @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-body">
                            @include('auth.components.login')
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-none d-md-flex" style="width:44%">
                        <div class="card-body text-center">
                            @include('auth.components.signup')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
