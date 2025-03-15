<x-app-layout>
  @include('role-permission.nav-links')
<div class="container mx-auto mt-6">
    <div class="row">
      <div class="col-md-12">
        @if (session('status'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('status') }}
      </div>
    @endif
        <div class="bg-white shadow-md rounded mt-3">
          <div class="px-4 py-2 border-b">
            <h4 class="flex justify-between items-center">
              Roles
              <a href="{{ url('roles/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add
                Role</a>
            </h4>
          </div>
          <div class="p-4">

            <table class="min-w-full border border-gray-300">
              <thead>
                <tr>
                  <th class="border-b">Id</th>
                  <th class="border-b">Name</th>
                  <th class="border-b" width="40%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roles as $index => $role)
                <tr class="text-center mt-2 {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                    
                  <td class="border-b py-3">{{ $role->id }}</td>
                  <td class="border-b">{{ $role->name }}</td>
                  <td class="border-b">
                    <a href="{{ url('roles/'.$role->id. '/edit') }}" class="bg-green-500  text-white my-5 px-2 py-1 rounded">Edit</a>
                    <a href="{{ url('roles/'.$role->id. '/delete') }}" class="bg-red-500 text-white px-2 py-1 rounded mx-2">Delete</a>
                  </td>
                  @endforeach
                </tr>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>