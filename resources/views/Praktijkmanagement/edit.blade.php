<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-white">

                <h1>{{ $title }}</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('praktijkmanagement.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="InputName" class="form-label">Naam</label>
                        <input name="name" type="text" class="form-control" id="InputName"
                            aria-describedby="nameHelp" value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="mb-3">
                        <label for="InputDescription" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" id="InputDescription"
                            aria-describedby="descriptionHelp" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="mb-3">
                        <label for="InputRoleName" class="form-label">Gebruikersrol</label>
                        <select name="rolename" class="form-select" aria-label="InputRolename">
                            @foreach ($userroles as $userrole)
                                <option value="{{ $userrole->rolename }}" {{ $userrole->rolename == $user->rolename ? 'selected' : '' }}>{{ $userrole->rolename }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Opslaan</button>
                    <a href="{{ route('praktijkmanagement.index') }}" class="btn btn-secondary">Annuleren</a>
                </form>

            </div>
        </div>
    </div>
</div>
</x-app-layout>