@props(['supplier'])

<div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-white p-6 rounded-lg shadow-lg">
    @if (session('success'))
        <div id="edit-success" data-message="{{ session('success') }}" data-redirect="{{ route('supplier.index') }}">
        </div>
    @endif
    <form id="edit-supplier" action="{{ route('supplier.update', $supplier->supplier_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <h1 class="text-2xl font-semibold mb-6">
            Edit Supplier
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div>
                <div class="border-2 border-dashed border-gray-300 p-6 pb-64 rounded-lg text-center h-auto">
                    <div class="translate-y-28 items-center">
                        <div class="mb-3">
                            <input class="form-control" type="file" id="formFile" name="image">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            <P class="m-3 opacity-30">(Gambar logo)</P>
                        </div>
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <a class="text-red-500 mt-2" href="{{ url()->previous() }}">
                        Cancel
                    </a>
                </div>
            </div>
            <!-- Right Column -->
            <div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700">
                            <x-input-label for="nama_supplier" :value="__('Nama Supplier')" />
                            <x-text-input id="nama_supplier" class="block mt-1 w-full" type="text"
                                name="nama_supplier" :value="old('nama_supplier', $supplier->nama)" required autofocus
                                autocomplete="nama_supplier" />
                            <x-input-error :messages="$errors->get('nama_supplier')" class="mt-2" />
                        </label>
                    </div>
                    <div>
                        <label class="block text-gray-700">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $supplier->email)" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('Email')" class="mt-2" />
                        </label>
                    </div>
                    <div>
                        <label class="block text-gray-700">
                            <x-input-label for="contact" :value="__('Nomor Telepon')" />
                            <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact"
                                :value="old('contact', $supplier->contact)" required autofocus autocomplete="contact" />
                            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                        </label>
                    </div>
                    <div>
                        <label for="address" class="block text-gray-700">
                            Alamat
                        </label>
                        <textarea name="address" id="address" class="w-full p-2 border rounded-lg" rows="4">{{ old('address', $supplier->address) }}</textarea>
                        <x-input-error :messages="$errors->get('address', $supplier->address)" class="mt-2" />
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-6 w-full bg-red-500 text-white py-2 rounded-lg">
                    Update supplier
                </button>
            </div>
    </form>

</div>
