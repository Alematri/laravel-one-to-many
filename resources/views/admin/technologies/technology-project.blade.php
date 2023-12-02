@extends('layouts.admin')

@section('content')

<h1>elenco tech e post</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tech</th>
            </tr>
        </thead>
        <tbody>

            @foreach ( $technologies as $technology)
            <tr>
                <td>{{$technology->id}}</td>
                <td>{{$technology->name}}</td>
                <td>
                    <ul class="list-group">
                        @foreach ($technology->projects as $project)
                            <li class="list-group.item">{{ $project->title}}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

@endsection
