document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const invoiceId = this.getAttribute("data-id");
            Swal.fire({
                title: `Apakah Anda yakin?`,
                text: `Invoice ini akan dihapus secara permanen!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteInvoiceUrl, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            kode_invoice: invoiceId,
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
