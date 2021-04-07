@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New project') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tasks_done" class="col-md-4 col-form-label text-md-right">{{ __('Taks Done') }}</label>

                            <div class="col-md-6">
                                <input id="tasks_done" type="text" class="form-control" name="tasks_done" value="{{ isset($project) ? $project->tasks_done : old('tasks_done') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project_price" class="col-md-4 col-form-label text-md-right">{{ __('Project Price') }}</label>

                            <div class="col-md-6">
                                <input id="project_price" type="number" class="form-control" name="project_price" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                {!! Form::label('users[]', 'Developers on project') !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::select('users[]', $users,  null, ['class' => 'form-control', 'multiple']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
