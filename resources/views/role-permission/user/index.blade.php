<x-app-layout>

  @include('role-permission.nav-links')
  <div class="container mx-auto mt-6">
      <div class="w-full">

          @if (session('status'))
              <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('status') }}</div>
          @endif

          <div class="bg-white shadow-md rounded mt-3">
             
              <div class="px-4 py-2 border-b bg-orange-200">
                <h4 class="flex justify-between items-center">
                  <span class="text-2xl  text-black">Users</span>
                  {{-- @can('create user')  --}}
                  <a href="{{ url('users/create') }}" class="bg-orange-500 text-white px-4 py-2 rounded">Add
                    User</a>
                  {{-- @endcan --}}
                </h4>
              </div>
              <div class="p-4">

                  <table class="min-w-full border-collapse border border-gray-300">
                      <thead>
                          <tr>
                              <th class="border border-gray-300 px-4 py-2">Id</th>
                              <th class="border border-gray-300 px-4 py-2">Name</th>
                              <th class="border border-gray-300 px-4 py-2">Email</th>
                              <th class="border border-gray-300 px-4 py-2">Roles</th>
                              <th class="border border-gray-300 px-4 py-2">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($users as $index =>$user)
                          <tr class="text-center {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                              <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                              <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                              <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                              <td class="border border-gray-300 px-4 py-2">
                                  @if (!empty($user->getRoleNames()))
                                      @foreach ($user->getRoleNames() as $rolename)
                                          <span class="bg-blue-500 text-white px-2 py-1 rounded mx-1">{{ $rolename }}</span>
                                      @endforeach
                                  @endif
                              </td>
                              <td class="border border-gray-300 px-4 py-2">
                                  @can('update user')
                                  <a href="{{ url('users/'.$user->id.'/edit') }}" class="bg-green-500 text-white px-4 py-2 rounded">Edit</a>
                                  @endcan

                                  @can('delete user')
                                  <a href="{{ url('users/'.$user->id.'/delete') }}" class="bg-red-500 text-white px-4 py-2 rounded mx-2">Delete</a>
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

</x-app-layout>
