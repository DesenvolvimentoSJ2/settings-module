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
                        Detalhes do sistema
                    </h2>
                </div>

            </div>
        </div>
    </div>

    {{-- page body --}}

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <div class="col-12 col-md-6">
                    {{-- <div class="card mb-3">
                        <div class="card-body">

                            <h3 class="card-title">Permissões</h3>

                            <form action="" method="POST">
                                @csrf

                                <div class="row">
                                    @foreach ($form_permission as $item)
                                        <div class="{{ $item['size'] }}">
                                            @if (isset($item['label']))
                                                <label class="form-label">{{ $item['label'] }}</label>
                                            @endif
                                            @if (isset($item['item']))
                                                @foreach ($item['item'] as $iten)
                                                    @include('components.form-elements.' . $iten['component'], $iten)
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-primary">Salvar autor</button>

                            </form>

                        </div>
                    </div> --}}
                    <div class="card">
                        <div class="card-body">

                            <h3 class="card-title">Menu</h3>

                            <form action="{{ route('menu.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    @foreach ($form_menu as $item)
                                        <div class="{{ $item['size'] }}">
                                            @if (isset($item['label']))
                                                <label class="form-label">{{ $item['label'] }}</label>
                                            @endif
                                            @if (isset($item['item']))
                                                @foreach ($item['item'] as $iten)
                                                    @include('components.form-elements.' . $iten['component'], $iten)
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <div class="table-responsive mb-3 d-none" id="menuTable">
                                    <table class="table table-vcenter table-mobile-md card-table">
                                        <thead>
                                            <tr>
                                                <th>Título</th>
                                                <th>Rota</th>
                                                <th class="w-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyMenuTable"></tbody>
                                    </table>
                                </div>

                                <button type="button" class="btn btn-ghost-info d-none" id="addSubmenuButton">Add</button>

                                <button type="submit" class="btn btn-primary">Enviar menu</button>

                            </form>

                        </div>
                    </div>
                </div>

                {{-- <div class="card col-12 col-md-6"></div> --}}

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/my-js/formMenu.js') }}"></script>
@endsection
