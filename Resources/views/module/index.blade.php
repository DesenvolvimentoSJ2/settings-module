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
                        Sistemas
                    </h2>
                </div>

            </div>
        </div>
    </div>

    {{-- page body --}}

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th>Sistema</th>
                                        <th>Link</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($systems as $system)
                                        <tr>
                                            <td data-label="Title">
                                                <div>{{ $system->name }}</div>
                                            </td>
                                            <td data-label="Title">
                                                <div><a href="{{ route('modules.show', $system->id) }}">Acessar</a></div>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a href="#" class="btn">
                                                        Edit
                                                    </a>
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
