<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Praktijkmanagement Dashboard
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-white">

                    <div class="container d-flex justify-content-center">
                        <div class="col-md-10">

                            <h2 class="my-3">{{ $title }}</h2>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="sluiten"></button>
                                </div>
                                <meta http-equiv="refresh" content="3;url={{route('praktijkmanagement.index')}}">
                            @elseif (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="sluiten"></button>
                                </div>
                                <meta http-equiv="refresh" content="3;url={{route('praktijkmanagement.index')}}">
                            @endif

                            <div class="my-3 d-flex gap-3">

                            </div>

                            <table class="table table-dark table-striped table-bordered align-middle shadow-sm">
                                <thead>
                                    <th>Naam</th>
                                    <th>Email</th>
                                    <th>Gebruikersrol</th>
                                    <th class="text-center">Verwijder</th>
                                    <th class="text-center">Wijzig</th>
                                    <th class="text-center">Details</th>
                                </thead>
                                <tbody>

                                @forelse ($users as $user)
<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->rolename }}</td>

    <td class="text-center">
        <form action="{{ route('praktijkmanagement.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                Verwijderen
            </button>
        </form>
    </td>

    <td class="text-center">
        <form action="{{ route('praktijkmanagement.edit', $user->id) }}" method="GET">
            <button type="submit" class="btn btn-success btn-sm">
                Wijzigen
            </button>
        </form>
    </td>

    <td class="text-center">
        <form action="{{ route('praktijkmanagement.show', $user->id) }}" method="GET">
            <button type="submit" class="btn btn-warning btn-sm">
                Details
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="6">Geen allergenen beschikbaar</td>
</tr>
@endforelse
                            </tbody>
                        </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>