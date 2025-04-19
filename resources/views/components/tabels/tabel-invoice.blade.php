@props(['invoices', 'pengadaans'])

<table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                No
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Kode Invoice
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Kode Pengadaan
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Tanggal
            </th>

            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Action
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 font-sans font-semibold">
        @if ($invoices->isNotEmpty())
            @foreach ($invoices as $index => $invoice)
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
                        {{ $invoice->kode_invoice }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                        {{ $invoice->kode_pengadaan }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                        {{ $invoice->pengadaan->tanggal }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('invoiceLayout.index', ['id' => $invoice->kode_pengadaan]) }}" target="_blank"
                            class="ml-2 text-blue-600 hover:text-red-900">
                            Lihat Invoice
                        </a>

                        <button class="ml-2 hover:underline-offset-1 text-red-600 hover:text-red-900 delete-invoice-btn"
                            data-id="{{ $invoice->kode_pengadaan }}">
                            Hapus Invoice
                        </button>

                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{ $invoices->links() }}
<script>
    // const deletePembelianUrl = "{{ route('pembelian.destroy') }}"
</script>
