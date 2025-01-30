import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

//Untuk sweet alert menghapus permissions
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const permissionId = this.getAttribute("data-id");
            const permissionName = this.getAttribute("data-name");

            Swal.fire({
                title: `Apakah Anda yakin?`,
                text: `Akses untuk melihat "${permissionName}" akan dihapus secara permanen!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('permissions.destroy') }}", {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            id: permissionId,
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

//Untuk Modal detail spesifikasi barang
$(document).ready(function () {
    $(".btn-detail").on("click", function () {
        var barangId = $(this).data("id");

        $.ajax({
            url: "/barang/detail/" + barangId,
            type: "GET",
            success: function (response) {
                $("#modal-gambar").attr("src", "/img/" + response.image);
                $("#modal-nama").text(response.nama);
                $("#modal-deskripsi").text(response.spesifikasi);
                $("#exampleModal").modal("show");
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                alert("Terjadi kesalahan, coba lagi nanti.");
            },
        });
    });
});
