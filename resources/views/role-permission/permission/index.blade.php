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
  
          <div class="bg-white shadow-md rounded mt-3">
            <div class="px-4 py-2 border-b bg-teal-200">
              <h4 class="flex justify-between items-center">
                Permissions
                {{-- Lien pour ajouter une nouvelle permission --}}
                <a href="{{ url('permissions/create') }}" class="bg-teal-500 text-white px-4 py-2 rounded">Add Permission</a>
              </h4>
            </div>
            <div class="p-4">
   {{-- Formulaire de recherche --}}
   <form action="{{ url('permissions') }}" method="GET" class="mb-4">
    <div class="flex items-center">
      <input type="text" name="search" placeholder="Search permissions..." 
      class="border border-gray-300 rounded-md p-2 w-full"
       value="{{ request('search') }}">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">
        Search</button>
      <a href="{{ url('permissions') }}" 
      class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
      Refresh</a>
    </div>
  </form>
              {{-- Tableau des permissions --}}
              <table class="min-w-full border border-gray-300">
                <thead>
                  <tr>
                    <th class="border-b">Id</th>
                    <th class="border-b">Name</th>
                    <th class="border-b" width="40%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- Boucle pour afficher chaque permission --}}
                  @foreach ($permissions as $index => $permission)
                  <tr class="text-center mt-2 {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                      <td class="border-b py-3">{{ $permission->id }}</td>
                      <td class="border-b">{{ $permission->name }}</td>
                      <td class="border-b">

                          {{-- Lien pour éditer la permission --}}
                          @can('update permission')
                          <a href="{{ url('permissions/'.$permission->id. '/edit') }}" class="bg-green-500 text-white my-5 px-2 py-1 rounded">Edit</a>
                          @endcan
                          
                          {{-- Lien pour supprimer la permission --}}
                          @can('update permission')
                          <a href="{{ url('permissions/'.$permission->id. '/delete') }}" class="bg-red-500 text-white px-2 py-1 rounded mx-2">Delete</a>
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