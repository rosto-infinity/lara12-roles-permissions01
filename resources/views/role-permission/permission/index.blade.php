<x-app-layout>
  <div class="container mx-auto mt-5">
    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded mx-1">Roles</a>
    <a href="#" class="bg-teal-500 text-white px-4 py-2 rounded mx-1">Permissions</a>
    <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded mx-1">Users</a>
  </div>

  <div class="container mx-auto mt-6">
    <div class="row">
      <div class="col-md-12">

        <div class="bg-white shadow-md rounded mt-3">
          <div class="px-4 py-2 border-b">
            <h4 class="flex justify-between items-center">
              Permissions
              <a href="{{ url('permissions/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add
                Permission</a>
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
                <tr class="text-center mt-2">
                  <td class="border-b">id</td>
                  <td class="border-b">name</td>
                  <td class="border-b">
                    <a href="#" class="bg-green-500 text-white px-2 py-1 rounded">Edit</a>
                    <a href="#" class="bg-red-500 text-white px-2 py-1 rounded mx-2">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>