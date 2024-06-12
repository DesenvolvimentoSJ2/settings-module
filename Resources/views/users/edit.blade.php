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
                        Usuário: {{ $user->name }}
                    </h2>
                </div>

            </div>
        </div>
    </div>

    {{-- page body --}}

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="row">
            @foreach ($form as $item)
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

        <button type="submit" class="btn btn-primary">Editar usuário</button>

    </form>

    <div class="col-6 mx-auto mt-3">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Sistemas adicionados ao usuário</h3>

                <ul>

                    @foreach($user_systems as $userS)
                        <li>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <div>
                                    {{ $userS->system->name }}
                                </div>
                                <div>
                                    <form method="POST" action="{{ route('userModules.remove', $userS->id) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method("DELETE")

                                        <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>

    <div class="col-6 mx-auto mt-3">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Roles adicionados ao usuário</h3>

                <ul>

                    @foreach($user->roles as $userR)
                        <li>
                            {{ $userR->name }}
                        </li>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>

@endsection
