//SWEET ALERT UNTUK BERHASIL MENAMBAHKAN BARANG
document.addEventListener("DOMContentLoaded", function () {
    const barangForm = document.getElementById("add-barang");

    if (barangForm) {
        barangForm.addEventListener("submit", function (event) {
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

//SWEET ALERT UNTUK BERHASIL MENAMBAHKAN BARANG
document.addEventListener("DOMContentLoaded", function () {
    const barangForm = document.getElementById("edit-barang");

    if (barangForm) {
        barangForm.addEventListener("submit", function (event) {
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

//SWEET ALERT MENGHAPUS BARANG
