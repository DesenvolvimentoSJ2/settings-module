@extends('templates.admin')

@section('content')
    {{-- page header --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Editando Regra: {{ $role->name }}
                    </h2>
                </div>

            </div>
        </div>
    </div>

    {{-- page body --}}

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <div class="col-6">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                
                        {{-- <div class="row"> --}}
                            
                            <label class="form-label">Permissões</label>
                            
                            @foreach ($permissions as $permission)
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                    <span class="form-check-label">
                                        {{ $permission->name }}
                                    </span>
                                    <span class="form-check-description">
                                        {{ $permission->description }}
                                    </span>
                                </label>
                            @endforeach
                
                        {{-- </div> --}}
                
                        <button type="submit" class="btn btn-primary">Add permissões a regra</button>
                    </form>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <label class="form-label">Permissões Adicionadas</label>

                            <ul>
                                @foreach ($role->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
