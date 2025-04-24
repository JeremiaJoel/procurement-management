const datepicker = document.getElementById("datepicker");
const datepickerContainer = document.getElementById("datepicker-container");
const daysContainer = document.getElementById("days-container");
const currentMonthElement = document.getElementById("currentMonth");
const prevMonthButton = document.getElementById("prevMonth");
const nextMonthButton = document.getElementById("nextMonth");
const cancelButton = document.getElementById("cancelButton");
const applyButton = document.getElementById("applyButton");
const toggleDatepicker = document.getElementById("toggleDatepicker");

let currentDate = new Date();
let selectedDate = null;

// Tambahkan helper zeroPad
function zeroPad(num) {
    return num < 10 ? `0${num}` : num;
}

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    currentMonthElement.textContent = currentDate.toLocaleDateString("en-US", {
        month: "long",
        year: "numeric",
    });

    daysContainer.innerHTML = "";
    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDayOfMonth; i++) {
        daysContainer.innerHTML += `<div></div>`;
    }

    for (let i = 1; i <= daysInMonth; i++) {
        daysContainer.innerHTML += `<div class="flex items-center justify-center cursor-pointer w-[41px] h-[41px] text-black dark:text-white rounded-full hover:bg-red-500 hover:text-white">${i}</div>`;
    }

    document.querySelectorAll("#days-container div").forEach((day) => {
        day.addEventListener("click", function () {
            const dayValue = parseInt(this.textContent);
            const formattedMonth = zeroPad(month + 1);
            const formattedDay = zeroPad(dayValue);
            selectedDate = `${year}-${formattedMonth}-${formattedDay}`;

            // Hapus highlight sebelumnya
            document.querySelectorAll("#days-container div").forEach((d) => {
                d.classList.remove(
                    "bg-red-600",
                    "text-white",
                    "dark:text-white"
                );
            });

            // Tambahkan highlight ke tanggal terpilih
            this.classList.add("bg-red-600", "text-white", "dark:text-white");
        });
    });
}

datepicker.addEventListener("click", function () {
    datepickerContainer.classList.toggle("hidden");
    renderCalendar();
});

toggleDatepicker.addEventListener("click", function () {
    datepickerContainer.classList.toggle("hidden");
    renderCalendar();
});

prevMonthButton.addEventListener("click", function () {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
});

nextMonthButton.addEventListener("click", function () {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

cancelButton.addEventListener("click", function () {
    selectedDate = null;
    datepickerContainer.classList.add("hidden");
});

applyButton.addEventListener("click", function () {
    if (selectedDate) {
        datepicker.value = selectedDate;
        localStorage.setItem("selectedDate", selectedDate); // Sudah dalam format YYYY-MM-DD
    }
    datepickerContainer.classList.add("hidden");
});

// Close datepicker when clicking outside
document.addEventListener("click", function (event) {
    if (
        !datepicker.contains(event.target) &&
        !datepickerContainer.contains(event.target)
    ) {
        datepickerContainer.classList.add("hidden");
    }
});
// Saat halaman dimuat, ambil tanggal dari localStorage
document.addEventListener("DOMContentLoaded", function () {
    const savedDate = localStorage.getItem("selectedDate");
    if (savedDate) {
        datepicker.value = savedDate;
        selectedDate = savedDate;
    }
});

window.addEventListener("load", function () {
    const loader = document.getElementById("loader");
    loader.classList.add("fade-out");

    // Setelah animasi selesai (0.5 detik), benar-benar disembunyikan
    setTimeout(() => {
        loader.style.display = "none";
    }, 500);
});
