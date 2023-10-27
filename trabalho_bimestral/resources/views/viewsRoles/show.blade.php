<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissões do Papel: '. $role->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>

        <form action="{{ route('permissions.store') }}" method="post">
            @csrf
            <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Permissão</th>
                            <th scope="col">Ativar</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <th scope="row">{{$permission->id}}</th>
                            <td>{{$permission->name}}</td>
                            <td>
                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                    @if($role->hasPermissionTo($permission))
                                        checked
                                    @endif
                                >
                            </td>
                        </tr>
                        @endforeach
                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                    </tbody>

                </table>

            <button class="btn btn-primary">Salvar</button>
            <button class="btn btn-secondary">
                <a href="{{route('roles.index')}}">Voltar</a>
            </button>
        </form>
    </div>
</x-app-layout>