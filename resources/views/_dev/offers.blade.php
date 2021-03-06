@extends('_layout.app')

@section('content')

    <div class="jumbotron">
        <h1>Объекты</h1>
        @if(empty($models[0]))
        <div class="alert alert-info">Nothing to show</div>
        @else
        <div class="card-columns">
            @foreach($models as $model)
            @php($agent = $model->agent()->first())
            <div class="card">
                <img class="card-img-top" src="{{ mapUrl($model->latitude, $model->longitude) }}" alt="Map">
                <div class="card-body">
                    <h4 class="card-title">{{ $model->title }} за&nbsp;{{ $model->price }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $model->address }}</h6>
                    <div class="card-text">
                        <p>{{ $model->description }}</p>
                        <p>Агент: <a target="_blank" href="{{ url('/agents/' . $agent->slug) }}">
                                {{ $agent->displayName }}</a></p>
                    </div>
                    <a target="_blank" href="{{ url('/agents/' . $agent->slug . '/offers/' . $model->slug) }}" class="card-link">Личная страница объекта</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

@endsection
