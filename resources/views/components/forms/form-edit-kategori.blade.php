<div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-white p-6 rounded-lg shadow-lg">
    @if (session('success'))
        <div id="edit-success" data-message="{{ session('success') }}"
            data-redirect="{{ route('kategori.edit', $category->id_kategori) }}">
        </div>
    @endif
    <form id="edit-kategori" action="{{ route('kategori.update', $category->id_kategori) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <h1 class="text-2xl font-semibold mb-6">
            Edit Kategori
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div>
                <div class="border-2 border-dashed border-gray-300 p-6 pb-64 rounded-lg text-center h-auto">
                    <div class="translate-y-28 items-center">
                        <div class="mb-3">
                            <input class="form-control" type="file" id="formFile" name="image">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />

                        </div>
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <a class="text-red-500 mt-2" href="{{ route('barang.index') }}">
                        Cancel
                    </a>
                </div>
            </div>
            <!-- Right Column -->
            <div>
                <div class="space-y-4">
                    <!-- Right Column -->
                    <div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700">
                                    <x-input-label for="nama_kategori" :value="__('Nama Kategori')" />
                                    <x-text-input id="nama_kategori"
                                        class="block mt-1 w-full p-3 focus:ring-red-500 focus:border-red-500"
                                        type="text" name="nama_kategori" required autofocus
                                        autocomplete="nama_kategori" :value="old('nama_kategori', $category->nama)" />
                                    <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                                </label>
                            </div>
                        </div>
                        <button type="submit"
                            class="btn btn-primary mt-6 w-full bg-red-500 text-white py-2 rounded-lg">
                            Update Barang
                        </button>
                    </div>


    </form>

</div>
