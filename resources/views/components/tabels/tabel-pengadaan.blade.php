@props(['pengadaans'])

<table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                No
            </th>
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
                        {{ $pengadaan->kode_pengadaan }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                        {{ $pengadaan->nama_supplier }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                        {{ $pengadaan->tanggal }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                        {{ $pengadaan->status }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        @can('Ubah Status Pengadaan')
                            <button class="ubah-status-btn text-green-600 hover:text-green-900 py-1 rounded"
                                data-id="{{ $pengadaan->kode_pengadaan }}" data-status="{{ $pengadaan->status }}">
                                Ubah Status
                            </button>
                        @endcan

                        @can('Download Pengadaan')
                            <a href="{{ route('purchase-order.index', ['id' => $pengadaan->kode_pengadaan]) }}"
                                target="_blank" class="ml-2 text-blue-600 hover:text-red-900">
                                Download PDF
                            </a>
                        @endcan


                        @can('Hapus Pengadaan')
                            <button href=""
                                class="ml-2 hover:underline-offset-1 text-red-600 hover:text-red-900 delete-btn"
                                data-id="{{ $pengadaan->kode_pengadaan }}">Delete</button>
                        @endcan


                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{ $pengadaans->links() }}
<script>
    const deletePembelianUrl = "{{ route('pembelian.destroy') }}"
    const ubahStatusUrl = "{{ route('pembelian.ubahStatus', ':id') }}";
</script>
