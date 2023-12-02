@extends('layouts.admin')

@section('content')

    <h1>{{ $project->title}}</h1>

    @if ($projects->technology);
    <p>Tech:<strong>{{ $project->technology->name }}</strong></p>
    @endif

@endsection
