<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissões do Usuário:' . $user->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>

        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Papel</th>
                            <th scope="col">Ativar</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{$role->id}}</th>
                            <td>{{$role->name}}</td>
                            <td>
                                <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                    @if($user->hasRole($role))
                                        checked
                                    @endif
                                >
                            </td>
                        </tr>
                        @endforeach
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </tbody>

                </table>

            <button class="btn btn-primary">Salvar</button>
            <button class="btn btn-secondary">
                <a href="{{route('users.index')}}">Voltar</a>
            </button>
        </form>

    </div>

</x-app-layout>
