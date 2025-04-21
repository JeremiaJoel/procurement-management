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
            selectedDate = `${month + 1}/${this.textContent}/${year}`;

            // Menghapus kelas dari semua tanggal sebelumnya
            document.querySelectorAll("#days-container div").forEach((d) => {
                d.classList.remove(
                    "bg-red-600",
                    "text-white",
                    "dark:text-white"
                );
            });

            // Menambahkan kelas pada tanggal yang baru diklik
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
