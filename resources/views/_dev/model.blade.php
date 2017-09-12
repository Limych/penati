@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        <h1>{{ $model }}</h1>
        @if(empty($models[0]))
        <div class="alert alert-info">Nothing to show</div>
        @else
        <table class="table table-striped"><thead>
            <tr>
            @foreach($models[0]->getFillable() as $attribute)
                <th>{{ $attribute }}</th>
            @endforeach
            </tr>
        </thead><tbody>
            @foreach($models as $model)
            <tr>
                @foreach($model->getFillable() as $attribute)
                    <td>{{ $model->$attribute }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody></table>
        @endif
    </div>

@endsection
