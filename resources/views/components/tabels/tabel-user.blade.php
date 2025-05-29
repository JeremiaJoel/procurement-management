@props(['users'])


<table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>

            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                No
            </th>

            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nama
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Role
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Created At
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Action
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 font-sans font-semibold">
        @if ($users->isNotEmpty())
            @foreach ($users->filter(function ($user) {
        return !$user->roles->contains('name', 'Super admin');
    }) as $index => $user)
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

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->roles->pluck('name')->implode(', ') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <a href="#" class="ml-2 text-red-600 hover:text-red-900 delete-user-btn"
                            data-name="{{ $user->name }}" data-id="{{ $user->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        @endif

    </tbody>
</table>

<script>
    const userDeleteUrl = "{{ route('users.destroy') }}"
</script>
<script>
    // Sweet alert untuk mengahapus user
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-user-btn");

        deleteButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const userName = this.getAttribute("data-name");
                const userId = this.getAttribute("data-id");

                Swal.fire({
                    title: `Apakah Anda yakin?`,
                    text: `User "${userName}" akan dihapus secara permanen!`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(userDeleteUrl, {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document
                                        .querySelector('meta[name="csrf-token"]')
                                        .getAttribute("content"),
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify({
                                    id: userId,
                                }),
                            })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.status) {
                                    Swal.fire("Terhapus!", data.message, "success");

                                    // Tambahkan durasi 2 detik sebelum refresh halaman
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000); // 2000ms = 2 detik
                                } else {
                                    Swal.fire("Gagal!", data.message, "error");
                                }
                            })
                            .catch((error) => {
                                console.error("Error:", error);
                                Swal.fire(
                                    "Error!",
                                    "Terjadi kesalahan. Silakan coba lagi.",
                                    "error"
                                );
                            });
                    }
                });
            });
        });
    });
</script>
