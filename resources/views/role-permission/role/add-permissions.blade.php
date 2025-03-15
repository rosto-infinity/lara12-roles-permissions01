<x-app-layout>
  <div class="container mx-auto mt-5">
      <div class="row">
          <div class="mb-3 col-md-12 ">
            @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
              {{ session('status') }}
            </div>
          @endif
              <div class="bg-white shadow-md rounded-lg overflow-hidden mt-3">
                  <div class="bg-gray-200 px-4 py-2">
                      <h4 class="font-bold text-lg flex items-center justify-between">
                         Role : {{ $role->name }}
                          <a href="{{ url('roles') }}" class="bg-red-500 text-white px-4 py-1 rounded">Back</a>
                      </h4>
                  </div>
                  <div class="p-4">
                      <form action="{{ url("roles/".$role->id."/give-permissions") }}" method="POST">
                          @csrf
                          @method('PUT')

                          <div class="mb-3">
                            @error('permission')
                                <div class="text-red-500">{{ $message }}</div>                               
                            @enderror
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Permissions</label>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($permissions as $permission)
                                <div class="flex items-center">
                                    <label class="flex items-center">
                                        <input
                                            type="checkbox"
                                            name="permission[]"
                                            value="{{ $permission->name}}"
                                            class="form-checkbox h-4 w-4 text-blue-600"
                                            />

                                        <span class="ml-2 text-gray-700">
                                            {{ $permission->name }}
                                        </span>

                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        

                          <div class="mb-3">
                              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>