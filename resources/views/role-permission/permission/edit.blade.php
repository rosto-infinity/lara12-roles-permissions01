<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="row">
            <div class="col-md-12">
                {{-- Affichage des erreurs de validation, le cas échéant --}}
                @if ($errors->any())
                <ul class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
  
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-200 px-4 py-2">
                        <h4 class="font-bold text-lg">
                            Edit Permission
                            {{-- Lien pour retourner à la liste des permissions --}}
                            <a href="{{ url('permissions') }}" class="bg-red-500 text-white px-4 py-2 rounded float-right">Back</a>
                        </h4>
                    </div>
                    <div class="p-4">
                        {{-- Formulaire POST pour mettre à jour une permission existante --}}
                        <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
                            @csrf {{-- Protection contre les attaques CSRF --}}
                            @method('PUT') {{-- Spécifie que la méthode HTTP est PUT pour la mise à jour --}}
                            
                            {{-- Champ pour le nom de la permission --}}
                            <div class="mb-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Permission Name</label>
                                <input type="text" name="name" value="{{ $permission->name }}" class="form-control border border-gray-300 rounded p-2 w-full" />
                            </div>
                            
                            {{-- Bouton pour soumettre le formulaire de mise à jour --}}
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