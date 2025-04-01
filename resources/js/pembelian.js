$(document).on("click", ".download-inv-btn", function () {
    let pengadaanID = $(this).data("id"); // Ambil ID dari tombol

    $.ajax({
        url: `/pengadaan/status/${pengadaanID}`, // Endpoint untuk cek status
        type: "GET",
        success: function (response) {
            if (response.status === "disetujui") {
                // Jika status disetujui, lanjut download PDF
                window.location.href = `/download-inv/${pengadaanID}`;
            } else {
                // Jika belum disetujui, tampilkan SweetAlert
                Swal.fire({
                    icon: "error",
                    title: "Gagal Download!",
                    text: "Permintaan pengadaan masih diproses.",
                    confirmButtonText: "OK",
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: "error",
                title: "Terjadi Kesalahan",
                text: "Gagal memeriksa status pengadaan.",
            });
        },
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
    let url = ubahStatusUrl.replace(":id", id);
    let _this = $(this);

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
                    }).then(() => {
                        // Auto reload halaman setelah SweetAlert ditutup
                        location.reload();
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
