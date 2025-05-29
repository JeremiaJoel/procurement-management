import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
//Untuk sweet alert menghapus permissions
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-hak-akses-btn");

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
                    fetch(deletePermissionUrl, {
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

// Sweet alert untuk mengahapus role
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-role-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const roleName = this.getAttribute("data-name");
            const roleId = this.getAttribute("data-id");

            Swal.fire({
                title: `Apakah Anda yakin?`,
                text: `Role "${roleName}" akan dihapus secara permanen!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(roleDeleteUrl, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            id: roleId,
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


