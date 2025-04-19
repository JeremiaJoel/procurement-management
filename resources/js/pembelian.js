//SWEET ALERT MENGHAPUS BARANG
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const pengadaanId = this.getAttribute("data-id");
            Swal.fire({
                title: `Apakah Anda yakin?`,
                text: `Data pembelian ini akan dihapus secara permanen!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deletePembelianUrl, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            kode_pengadaan: pengadaanId,
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

$(document).on("click", ".ubah-status-btn", function (e) {
    e.preventDefault();
    let url = $(this).attr("href"); // Ambil URL dari tombol

    Swal.fire({
        title: "Konfirmasi Ubah Status",
        text: "Apakah Anda yakin ingin mengubah status pengadaan?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Ubah Status!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    // Reload atau update tampilan setelah berhasil
                    setTimeout(() => location.reload(), 2000);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Terjadi kesalahan saat mengubah status.",
                        icon: "error",
                    });
                },
            });
        }
    });
});
$(document).on("click", ".ubah-status-btn", function (e) {
    e.preventDefault();

    let id = $(this).data("id");
    let statusSekarang = $(this).data("status"); // Ambil status saat ini dari data-* attribute
    let url = ubahStatusUrl.replace(":id", id);
    let _this = $(this);

    // Tentukan pesan konfirmasi berdasarkan status sekarang
    let pesan =
        statusSekarang === "Approved"
            ? "Status akan dikembalikan menjadi 'Sedang diproses' dan invoice akan dihapus. Lanjutkan?"
            : "Status akan diubah menjadi 'Approved' dan invoice akan dibuat otomatis. Lanjutkan?";

    Swal.fire({
        title: "Konfirmasi Ubah Status",
        text: pesan,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Lanjutkan!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(() => {
                        location.reload(); // Reload setelah sukses
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Terjadi kesalahan, silakan coba lagi.",
                        icon: "error",
                    });
                },
            });
        }
    });
});
