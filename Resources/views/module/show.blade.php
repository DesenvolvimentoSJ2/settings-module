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
                        Detalhes do módulo: {{ $management->name }}
                    </h2>
                </div>

            </div>
        </div>
    </div>

    {{-- page body --}}

    <div class="page-body">
        <div class="container-xl">
            {{-- <div class="row row-cards">

                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body row">
                            <div class="col-3">
                                <div class="page-pretitle">
                                    Modulo:
                                </div>
                                <h4 class="page-title">
                                    {{ $management->name }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card mb-3">
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
                    <div class="card">
                        <div class="card-body">

                            <h3 class="card-title">Permissões</h3>

                            <form action="{{ route('permissions.store') }}" method="POST">
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

                                <button type="submit" class="btn btn-primary">Adicionar permissão</button>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <h3 class="card-title">Permissões</h3>

                            <table class="table table-vcenter table-mobile-md table-sm card-table">
                                <thead>
                                    <tr>
                                        <th>Permissões</th>
                                        <th>Rota</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td data-label="Title">
                                                <div>{{ $permission->name }}</div>
                                            </td>
                                            <td data-label="Title">
                                                <div>{{ $permission->route_id }}</div>
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

            </div> --}}

            <div class="row row-cards">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">
                            Menu
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">
                            Permissões
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit"
                            type="button" role="tab" aria-controls="edit" aria-selected="false">
                            Editar
                        </button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row row-cards">
                            <div class="col-12 col-md-6">
                                <div class="card mb-3">
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
                                                                @include(
                                                                    'components.form-elements.' .
                                                                        $iten['component'],
                                                                    $iten)
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

                                            <button type="button" class="btn btn-ghost-info d-none"
                                                id="addSubmenuButton">Add</button>

                                            <button type="submit" class="btn btn-primary">Enviar menu</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">

                                        <h3 class="card-title">Menu</h3>

                                        <ol class="list-group list-group-numbered">
                                            @foreach ($menu as $m)
                                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto d-flex flex-column">
                                                        <div class="fw-bold">{{ $m->title }}</div>
                                                        @foreach ($m->menu_list as $item)
                                                            <span>{{ $item->title }}</span>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row row-cards">

                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h3 class="card-title">Permissões</h3>

                                        <form action="{{ route('permissions.store') }}" method="POST">
                                            @csrf

                                            <div class="row">
                                                @foreach ($form_permission as $item)
                                                    <div class="{{ $item['size'] }}">
                                                        @if (isset($item['label']))
                                                            <label class="form-label">{{ $item['label'] }}</label>
                                                        @endif
                                                        @if (isset($item['item']))
                                                            @foreach ($item['item'] as $iten)
                                                                @include(
                                                                    'components.form-elements.' .
                                                                        $iten['component'],
                                                                    $iten)
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                            <button type="submit" class="btn btn-primary">Adicionar permissão</button>

                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h3 class="card-title">Permissões</h3>

                                        <table class="table table-vcenter table-mobile-md table-sm card-table">
                                            <thead>
                                                <tr>
                                                    <th>Permissões</th>
                                                    <th>Rota</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($permissions as $permission)
                                                    <tr>
                                                        <td data-label="Title">
                                                            <div>{{ $permission->name }}</div>
                                                        </td>
                                                        <td data-label="Title">
                                                            <div>{{ $permission->route_id }}</div>
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
                    <div class="tab-pane" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        <div class="row row-cards">
                            <div class="col-12 col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">

                                        <h3 class="card-title">Edição</h3>

                                        <form action="{{ route('modules.update', $management->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                @foreach ($form_edit as $item)
                                                    <div class="{{ $item['size'] }}">
                                                        @if (isset($item['label']))
                                                            <label class="form-label">{{ $item['label'] }}</label>
                                                        @endif
                                                        @if (isset($item['item']))
                                                            @foreach ($item['item'] as $iten)
                                                                @include(
                                                                    'components.form-elements.' .
                                                                        $iten['component'],
                                                                    $iten)
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                            <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/my-js/formMenu.js') }}"></script>
@endsection
