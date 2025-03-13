@props(['suppliers'])

<table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>

            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Kode Pengadaan
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nama Supplier
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Tanggal
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Action
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 font-sans font-semibold">
        @if ($pengadaans->isNotEmpty())
            @foreach ($pengadaans as $index => $pengadaan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $index + 1 }}
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                        {{ $supplier->nama }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                        {{ $supplier->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-indigo-600 hover:text-indigo-900 mr-3 btn-detail"
                            data-id="{{ $supplier->supplier_id }}">Detail</button>
                        <a href="{{ route('supplier.edit', $supplier->supplier_id) }}"
                            class="text-green-500 hover:text-indigo-900">Edit</a>
                        <button href="" class="ml-2 text-red-600 hover:text-red-900 delete-btn"
                            data-name="{{ $supplier->nama }}" data-id="{{ $supplier->supplier_id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{ $suppliers->links() }}
{{-- <script>
    const deleteSupplierUrl = "{{ route('supplier.destroy') }}"
</script> --}}
