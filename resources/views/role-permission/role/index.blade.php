<x-app-layout>
  @include('role-permission.nav-links')
  <div class="container mx-auto mt-6">
    <div class="row">
      <div class="col-md-12">
        {{-- Affichage du message de statut, le cas échéant --}}
        @if (session('status'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('status') }}
          </div>
        @endif
        <div class="bg-white shadow-md rounded mt-3 ">
          <div class="px-4 py-2 border-b bg-blue-200">
            <h4 class="flex justify-between items-center">
              <span class="text-2xl text-black">Roles</span>
              {{-- Lien pour ajouter un nouveau rôle --}}
              <a href="{{ url('roles/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Role</a>
            </h4>
          </div>
          <div class="p-4">

            {{-- Tableau des rôles --}}
            <table class="min-w-full border border-gray-300">
              <thead>
                <tr>
                  <th class="border-b">Id</th>
                  <th class="border-b">Name</th>
                  <th class="border-b" width="40%">Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- Boucle pour afficher chaque rôle --}}
                @foreach ($roles as $index => $role)
                <tr class="text-center mt-2 {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                  <td class="border-b py-3">{{ $role->id }}</td>
                  <td class="border-b">{{ $role->name }}</td>
                  <td class="border-b">
                    @can('update addPermissionToRole')
                    {{-- Lien pour ajouter/éditer les permissions du rôle --}}
                    <a href="{{ url('roles/'.$role->id. '/give-permissions') }}" class="bg-orange-400 text-white my-5 px-2 py-1.5 rounded">Add / Edit Role Permission</a>
                    @endcan

                    {{-- Lien pour éditer le rôle --}}
                    @can('update role')
                    <a href="{{ url('roles/'.$role->id. '/edit') }}" class="bg-green-500 text-white my-5 px-2 py-1.5 rounded">Edit</a>
                    @endcan

                    {{-- Lien pour supprimer le rôle --}}
                    @can('delete role')
                    <a href="{{ url('roles/'.$role->id. '/delete') }}" class="bg-red-500 text-white px-2 py-1.5 rounded mx-2">Delete</a>
                   @endcan
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
</x-app-layout>