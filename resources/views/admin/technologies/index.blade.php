@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-6">

            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (@session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error')}}
                </div>
            @endif

            @if (@session('success'))
                <div class="alert alert-success" role="alert">
                     {{ session('success')}}
                </div>
            @endif


            <form
            action="{{route('admin.technologies.store')}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nuova Teconologia" name="name">
                    <button class="btn btn-outline-secondary type="submit" id="button-addon2">Crea</button>
                </div>
            </form>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($technologies as $technology )
                        <tr>
                            <td>
                                <form action="{{route('admin.technologies.update', $technology)}}"
                                method="POST"
                                id="form-edit-{{$technology->id}}"
                                >
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="form-hidden" value="{{ $technology->name }}" name="name"/>
                                </form>
                            <td>

                            <td>

                                <button onclick="submitForm()" class="btn btn-outline-secondary" id="button-addon2"><i class="fa-solid fa-pencil"></i></button>

                                @include('admin.partials.form-delete',[
                                    'route' => route('admin.technologies.destroy', $technology),
                                    'message' => 'sei sicuro di voler eliminare?'
                                ])

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function submitForm(id){
            const form = document.getElementById('form-edit-'+id);
            if(confirm('sei sicuro di voler modificare questo tipo?')){
            form.submit();
            }
        }
    </script>

@endsection
