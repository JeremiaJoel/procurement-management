$(document).ready(function () {
    $("#category").change(function () {
        let kategori_id = $(this).val();

        console.log("Kategori yang dipilih (mentah):", kategori_id); // Debugging awal

        if (!kategori_id) {
            console.log("⚠️ Tidak ada kategori yang dipilih!");
            return;
        }

        $.ajax({
            url: filterBarangUrl,
            type: "GET",
            data: {
                kategori: kategori_id,
            },
            success: function (response) {
                console.log("✅ Response dari server:", response);

                let selectBarang = $("#select-barang");
                selectBarang.empty();
                selectBarang.append('<option value="">Pilih Barang</option>');

                if (response.barangs.length > 0) {
                    $.each(response.barangs, function (index, barang) {
                        let option = `<option value="${barang.barang_id}">${barang.nama}</option>`;
                        selectBarang.append(option);
                    });
                } else {
                    selectBarang.append(
                        '<option value="">Tidak ada barang</option>'
                    );
                }
            },
            error: function () {
                alert("Gagal mengambil data barang.");
            },
        });
    });
});

//Fungsi untuk kalkulasi PPN
// Event listener untuk input harga di dalam tabel
$(document).on("input", ".ppn-input", function () {
    let value = $(this).val().replace(/\D/g, ""); // Ambil hanya angka

    // Jika pengguna menghapus semua angka, biarkan kosong (tanpa "0 %")
    if (value === "") {
        $(this).val("");
    } else {
        $(this).val(value + " %"); // Tambahkan "%" di akhir input
    }

    updateTotalHarga(); // Perbarui total harga setelah perubahan PPN
});

function hitungTotalDenganPPN() {
    let totalHarga = parseInt($("#totalHarga").attr("data-harga")) || 0; // Ambil total harga asli dari atribut data
    let ppnPersen = parseFloat($(".ppn-input").val().replace(/\D/g, "")) || 0; // Ambil angka dari input PPN

    let ppn = (totalHarga * ppnPersen) / 100; // Hitung PPN
    let totalSetelahPPN = totalHarga + ppn; // Total harga setelah PPN

    $("#totalHarga").text(formatRupiah(totalSetelahPPN, "Rp. ")); // Perbarui tampilan total harga
}

//Fungsi untuk mengupdate total harga
function updateTotalHarga() {
    let total = 0;

    $("tbody tr").each(function (index, element) {
        let hargaInput = $(this).find(".harga-input");
        let hargaText = hargaInput.length
            ? hargaInput.val().replace(/[^0-9]/g, "")
            : "0";
        let harga = hargaText ? parseInt(hargaText) : 0;

        let quantityText = $(this).find(".quantity").text().trim();
        let quantity = quantityText ? parseInt(quantityText) : 1; // Default 1 jika tidak valid

        console.log(
            `Row ${
                index + 1
            }: Harga = ${harga}, Quantity = ${quantity}, Subtotal = ${
                harga * quantity
            }`
        );

        total += harga * quantity;
    });

    // Ambil nilai PPN dari input dan pastikan hanya angka
    let ppnPersen = parseFloat($(".ppn-input").val().replace(/\D/g, "")) || 0;

    let ppn = (total * ppnPersen) / 100; // Hitung PPN
    let totalSetelahPPN = total + ppn; // Total harga setelah PPN

    console.log(`Total Harga Sebelum PPN: ${total}`);
    console.log(`PPN (${ppnPersen}%): ${ppn}`);
    console.log(`Total Harga Setelah PPN: ${totalSetelahPPN}`);

    $("#totalHarga").text(formatRupiah(totalSetelahPPN.toString(), "Rp. "));
    return formatRupiah(totalSetelahPPN.toString(), "Rp. ");
}

//Fungsi untuk format Rupiah pada harga di permintaan pengadaan
// Fungsi untuk format Rupiah
function formatRupiah(angka, prefix = "Rp. ") {
    angka = angka.replace(/[^0-9]/g, ""); // Hanya angka
    let number_string = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return prefix + number_string; // Tambahkan "0" jika kosong
}

// Event listener untuk input harga di dalam tabel
$(document).on("input", ".harga-input", function () {
    let value = $(this).val().replace(/^Rp. /, ""); // Hilangkan "Rp. " sementara
    $(this).val(formatRupiah(value, "Rp. "));

    updateTotalHarga();
});

// Code untuk membuat tabel barang permintaan pengadaan yang dinamis
$(document).ready(function () {
    loadTableFromLocalStorage(); // Panggil fungsi untuk memuat data saat halaman dimuat

    // Fungsi untuk menambahkan baris tabel barang
    $("#select-barang").change(function () {
        let selectedBarang = $(this).val();
        let selectedText = $("#select-barang option:selected").text();

        if (!selectedBarang) return;

        let row = `
        <tr data-id="${selectedBarang}">
            <td class="px-6 py-4">${selectedText}</td>
            <td class="px-6 py-4 flex items-center">
                <button class="decrease-btn bg-gray-300 px-2 py-1 rounded">-</button>
                <span class="quantity mx-2">1</span>
                <button class="increase-btn bg-gray-300 px-2 py-1 rounded">+</button>
            </td>
            <td class="px-6 py-4">
                <input type="text" class="harga-input bg-gray-100 px-2 py-1 rounded w-32 text-right" value="">
            </td>
            <td class="px-6 py-4">
                <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded">Delete</button>
            </td>
        </tr>
    `;

        $("tbody").append(row);
        saveTableToLocalStorage();
        $("#select-barang option:selected").remove();
    });

    // Event listener untuk tombol delete
    $(document).on("click", ".delete-btn", function () {
        let row = $(this).closest("tr");
        let barangID = row.data("id");
        let barangName = row.find("td:first").text();

        // Kembalikan barang ke combo box
        $("#select-barang").append(
            `<option value="${barangID}">${barangName}</option>`
        );

        // Hapus baris dari tabel
        updateTotalHarga();
        row.remove();

        // Simpan perubahan ke localStorage
        saveTableToLocalStorage();
    });

    // Event listener untuk tombol increase (+)
    $(document).on("click", ".increase-btn", function () {
        let quantitySpan = $(this).siblings(".quantity");
        let currentQuantity = parseInt(quantitySpan.text());
        quantitySpan.text(currentQuantity + 1);

        // Simpan perubahan ke localStorage
        updateTotalHarga();
        saveTableToLocalStorage();
    });

    // Event listener untuk tombol decrease (-)
    $(document).on("click", ".decrease-btn", function () {
        let quantitySpan = $(this).siblings(".quantity");
        let currentQuantity = parseInt(quantitySpan.text());

        if (currentQuantity > 1) {
            quantitySpan.text(currentQuantity - 1);
        } else {
            $(this).closest("tr").find(".delete-btn").click(); // Hapus jika kuantitas 0
        }

        // Simpan perubahan ke localStorage
        updateTotalHarga();
        saveTableToLocalStorage();
    });

    // Fungsi menyimpan data tabel ke localStorage
    function saveTableToLocalStorage() {
        let data = [];

        $("tbody tr").each(function () {
            let row = {
                id: $(this).data("id"),
                name: $(this).find("td:first").text().trim(),
                category: $(this).find("td:nth-child(2)").text().trim(),
                quantity: $(this).find(".quantity").text().trim(),
            };

            // Simpan hanya jika semua field valid
            if (row.id && row.name && row.category) {
                data.push(row);
            }
        });

        localStorage.setItem("savedTable", JSON.stringify(data));
    }

    // Fungsi memuat data tabel dari localStorage saat halaman dibuka kembali
    function loadTableFromLocalStorage() {
        let savedData = localStorage.getItem("savedTable");

        if (savedData) {
            let data = JSON.parse(savedData);

            data.forEach((row) => {
                if (row.id && row.name && row.category) {
                    // Cek jika data valid
                    let tableRow = `
                        <tr data-id="${row.id}">
                            <td class="px-6 py-4">${row.name}</td>
                            <td class="px-6 py-4 flex items-center">
                                <button class="decrease-btn bg-gray-300 px-2 py-1 rounded">-</button>
                                <span class="quantity mx-2">${row.quantity}</span>
                                <button class="increase-btn bg-gray-300 px-2 py-1 rounded">+</button>
                            </td>
                            <td class="px-6 py-4">
                                <input type="text" id="inputHarga" name="inputHarga" class="harga-input bg-gray-100 px-2 py-1 rounded w-32 text-right" value="">
                            </td>
                            <td class="px-6 py-4">
                                <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    `;
                    $("tbody").append(tableRow);
                }
            });
        }
    }
});

//Fungsi untuk submit pengadaan ke database
$("#submit-pengadaan").click(function () {
    let tableData = [];

    // Loop setiap baris tabel untuk mengambil data barang
    $("tbody tr").each(function () {
        let row = {
            id: $(this).data("id"), // Ambil ID barang
            quantity: $(this).find(".quantity").text().trim(), // Ambil kuantitas
        };

        if (row.id && row.quantity) {
            tableData.push(row);
        }
    });

    if (tableData.length === 0) {
        alert("Tidak ada barang yang dipilih!");
        return;
    }

    let supplierID = $("#supplier").val();
    let supplierName = $("#supplier option:selected").text(); // Ambil nama supplier
    let namaPengadaan = $("#nama-pengadaan").val().trim();
    let keterangan = $("#keterangan").val();
    let tanggal = $("#tanggal").val();
    let totalHarga = updateTotalHarga();
    console.log(typeof totalHarga);
    console.log("Data yang dikirim:", {
        totalHarga,
        supplierID,
        supplierName,
        tableData,
        namaPengadaan,
        keterangan,
    });

    // Kirim data ke backend
    $.ajax({
        url: "/pengadaan",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            nama_pengadaan: namaPengadaan,
            supplier_id: supplierID,
            nama_supplier: supplierName, // Kirim nama supplier
            keterangan: keterangan,
            total_harga: totalHarga,
            items: tableData,
        },
        success: function (response) {
            alert("Data berhasil disimpan!");
            localStorage.removeItem("savedTable");
            location.reload();
        },
        error: function (xhr) {
            console.error("Response Error:", xhr.responseText);
            alert("Terjadi kesalahan saat menyimpan data!");
        },
    });
});
