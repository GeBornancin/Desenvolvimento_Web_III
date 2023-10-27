<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem de Papeis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Auth::check())
                <div style="margin-bottom:2%;">
                    <button type="button" class="btn btn-outline-primary">
                        <a href="{{ route('roles.create') }}">Criar Papel</a>
                    </button>
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{$role->id}}</th>
                            <td>{{$role->name}}</td>
                            <td>
                                <div style="display:flex">
                                    @auth
                                        @can('delete', $role)
                                        <div style="margin-right:2%">
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger">Deletar</button>
                                            </form>
                                        </div>
                                        @endcan

                                        @can('update', $role)
                                            <div style="margin-right:2%">
                                                <button type="button" class="btn btn-outline-success">
                                                    <a href="{{ route('roles.edit', $role->id) }}">Editar</a>
                                                </button>
                                            </div>
                                        @endcan

                                        @can('view', $role)
                                            <div style="margin-right:2%">
                                                <button type="button" class="btn btn-outline-info">
                                                    <a href="{{ route('roles.show', $role->id) }}">Permissões do Papel</a>
                                                </button>
                                            </div>
                                        @endcan
                                    @endauth
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>
