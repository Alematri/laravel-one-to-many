@extends('layouts.admin')

@section('content')

    <h1>{{ $project->title}}<a href="{{ route('admin.projects.edit', $project)}}" class="btn"><i class="fa-solid fa-pencil"></i></a></h1>

    @if ($project->technology)
    <p>Tecnologia: <strong>{{ $project->technology->name }}</strong></p>
    @endif

@endsection
