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

//SWEET ALERT MENGHAPUS BARANG
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const supplierId = this.getAttribute("data-id");
            const supplierName = this.getAttribute("data-name");

            Swal.fire({
                title: `Apakah Anda yakin?`,
                text: `Data ${supplierName} ini akan dihapus secara permanen!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteSupplierUrl, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            supplier_id: supplierId,
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

//SWEET ALERT UNTUK BERHASIL MEMPERBARUI BARANG
document.addEventListener("DOMContentLoaded", function () {
    const editSupplierForm = document.getElementById("edit-supplier");

    if (editSupplierForm) {
        editSupplierForm.addEventListener("submit", function (event) {
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
