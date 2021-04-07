@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit project') }}</div>

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

                    <form method="POST" action="{{ route('update', ['project' => $project]) }}">
                        @method('patch')
                        @csrf

                        @if ($is_project_owner)
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ isset($project) ? $project->name : old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ isset($project) ? $project->description : old('description') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tasks_done" class="col-md-4 col-form-label text-md-right">{{ __('Taks Done') }}</label>

                                <div class="col-md-6">
                                    <input id="tasks_done" type="text" class="form-control" name="tasks_done" value="{{ isset($project) ? $project->tasks_done : old('tasks_done') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Project Price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control" name="price" value="{{ isset($project) ? $project->price : old('price') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 col-form-label text-md-right">
                                    {!! Form::label('users[]', 'Developers on project') !!}
                                </div>

                                <div class="col-md-6">
                                    {!! Form::select('users[]', $users, $selected_users, ['class' => 'form-control', 'multiple']) !!}
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label for="tasks_done" class="col-md-4 col-form-label text-md-right">{{ __('Taks Done') }}</label>

                                <div class="col-md-6">
                                    <input id="tasks_done" type="text" class="form-control" name="tasks_done" value="{{ isset($project) ? $project->tasks_done : old('tasks_done') }}" required>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
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
