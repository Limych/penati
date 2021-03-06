@extends('_layout.app')

@section('content')

    <div class="jumbotron">
        <h1>Агенты</h1>
        @if(empty($models[0]))
        <div class="alert alert-info">Nothing to show</div>
        @else
        <div class="card-columns">
            @foreach($models as $model)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $model->displayName }}</h4>
                    @if($model->name != $model->displayName)
                    <h6 class="card-subtitle mb-2 text-muted">{{ $model->name }}</h6>
                    @endif
                    <p class="card-text">{{ $model->description }}</p>
                    <a target="_blank" href="{{ url('/agents/' . $model->slug) }}" class="card-link">Личная страница</a>
                    <a target="_blank" href="{{ url('/agents/' . $model->slug . '/offers') }}" class="card-link">Объекты агента</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

@endsection
