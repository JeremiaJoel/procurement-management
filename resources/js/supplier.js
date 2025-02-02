//Modal detail Supplier
$(document).ready(function () {
    $(".btn-detail").on("click", function () {
        var supplierId = $(this).data("id");
        $.ajax({
            url: "/supplier/detail/" + supplierId,
            type: "GET",
            success: function (response) {
                $("#modal-gambar").attr("src", "/storage/" + response.image);
                $("#modal-nama").text(response.nama);
                $("#modal-alamat").text(response.address);
                $("#exampleModal").modal("show");
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                alert("Terjadi kesalahan, coba lagi nanti.");
            },
        });
    });
});

//Sweet Alert untuk berhasil menambah data supplier
document.addEventListener("DOMContentLoaded", function () {
    const supplierForm = document.getElementById("add-supplier");

    if (supplierForm) {
        supplierForm.addEventListener("submit", function (event) {
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
                    supplierForm.submit(); // Pastikan pakai form langsung
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
