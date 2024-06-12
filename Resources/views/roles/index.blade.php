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
                        Roles
                    </h2>
                </div>

            </div>
        </div>
    </div>

    {{-- page body --}}

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('roles.create') }}" class="btn btn-outline-primary btn-sm px-3">Nova Regra</a>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th>Roles</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td data-label="Title">
                                                <div>{{ $role->name }}</div>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn">
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Você tem certeza?');">
                                                        @csrf
                                                        @method('DELETE')
    
                                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
    
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
