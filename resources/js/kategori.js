//SWEET ALERT UNTUK BERHASIL MENAMBAHKAN KATEGORI
document.addEventListener("DOMContentLoaded", function () {
    const kategoriForm = document.getElementById("add-kategori");

    if (kategoriForm) {
        kategoriForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Mencegah form disubmit langsung
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Pastikan semua data sudah benar.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Simpan",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, baru submit form
                    event.target.submit();
                }
            });
        });
    }

    // Menampilkan SweetAlert sukses setelah redirect
    const successMessage = document.getElementById("success-message");
    if (successMessage) {
        Swal.fire({
            title: "Berhasil!",
            text: successMessage.dataset.message,
            icon: "success",
            confirmButtonText: "OK",
        }).then(() => {
            // Redirect setelah konfirmasi "OK"
            window.location.href = successMessage.dataset.redirect;
        });
    }
});

//SWEET ALERT UNTUK BERHASIL MEMPERBARUI KATEGORI
document.addEventListener("DOMContentLoaded", function () {
    const kategoriForm = document.getElementById("edit-kategori");

    if (kategoriForm) {
        kategoriForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Mencegah form disubmit langsung

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Pastikan semua data sudah benar.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Perbarui",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, baru submit form
                    event.target.submit();
                }
            });
        });
    }

    // Menampilkan SweetAlert sukses setelah redirect
    const successMessage = document.getElementById("edit-success");
    if (successMessage) {
        Swal.fire({
            title: "Berhasil!",
            text: successMessage.dataset.message,
            icon: "success",
            confirmButtonText: "OK",
        }).then(() => {
            // Redirect setelah konfirmasi "OK"
            window.location.href = successMessage.dataset.redirect;
        });
    }
});

//SWEET ALERT MENGHAPUS KATEGORI
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const kategoriId = this.getAttribute("data-id");

            Swal.fire({
                title: `Apakah Anda yakin?`,
                text: `Kategori ini akan dihapus secara permanen!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteKategoriUrl, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            id_kategori: kategoriId,
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
