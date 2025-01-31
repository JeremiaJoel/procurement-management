<div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-white p-6 rounded-lg shadow-lg">
    @if (session('success'))
        <div id="edit-success" data-message="{{ session('success') }}"
            data-redirect="{{ route('barang.by-category', $barang->kategori->id_kategori) }}">
        </div>
    @endif
    <form id="edit-barang" action="{{ route('barang.update', $barang->barang_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <h1 class="text-2xl font-semibold mb-6">
            Edit Barang
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
                    {{-- <div class="flex items-center justify-between p-2 border rounded-lg">
                        <div class="flex items-center">
                            <img alt="Navy Blue Shoe 01" class="w-10 h-10 rounded mr-2"
                                src="https://placehold.co/40x40" />
                            <div>
                                <p class="text-gray-700">
                                    Navy Blue Shoe 01.png
                                </p>
                                <p class="text-gray-500 text-sm">
                                    482 KB
                                </p>
                            </div>
                        </div>
                        <button class="text-gray-500 hover:text-red-500">
                            <i class="fas fa-trash-alt">
                            </i>
                        </button>
                    </div> --}}
                    <a class="text-red-500 mt-2"
                        href="{{ route('barang.by-category', $barang->kategori->id_kategori) }}">
                        Cancel
                    </a>
                </div>
            </div>
            <!-- Right Column -->
            <div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700">
                            <x-input-label for="nama_barang" :value="__('Nama Barang')" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang"
                                :value="old('nama_barang', $barang->nama)" required autofocus autocomplete="nama_barang" />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                        </label>
                    </div>
                    <div>
                        <label class="block text-gray-700">
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <select id="kategori" name="kategori"
                                class="block p-2 mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-opacity-50"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->nama }}"
                                        {{ old('kategori', $barang->kategori) == $category->nama ? 'selected' : '' }}>
                                        {{ $category->nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </label>
                    </div>
                    <div>
                        <label for="spesifikasi" class="block text-gray-700">
                            Deskripsi
                        </label>
                        <textarea name="spesifikasi" id="spesifikasi" class="w-full p-2 border rounded-lg" rows="4">{{ old('spesifikasi', $barang->spesifikasi) }}</textarea>
                        <x-input-error :messages="$errors->get('spesifikasi')" class="mt-2" />
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-6 w-full bg-red-500 text-white py-2 rounded-lg">
                    Update Barang
                </button>
            </div>


    </form>

</div>
