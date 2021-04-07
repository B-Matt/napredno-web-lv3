@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($projects as $project)
            <div class="card mb-3">
                <div class="card-header">
                    <a href="{{ route('edit', ['project' => $project]) }}">{{ $project->name }}</a>
                </div>
                <div class="card-body">{{ $project->description }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
