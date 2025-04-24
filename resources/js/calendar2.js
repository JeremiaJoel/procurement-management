(() => {
    const months = [
        { short: "Jan", full: "January" },
        { short: "Feb", full: "February" },
        { short: "Mar", full: "March" },
        { short: "Apr", full: "April" },
        { short: "May", full: "May" },
        { short: "Jun", full: "June" },
        { short: "Jul", full: "July" },
        { short: "Aug", full: "August" },
        { short: "Sep", full: "September" },
        { short: "Oct", full: "October" },
        { short: "Nov", full: "November" },
        { short: "Dec", full: "December" },
    ];

    const currentYearEl = document.getElementById("currentYear");
    const monthsContainer = document.getElementById("months-container");
    const prevYearBtn = document.getElementById("prevYear");
    const nextYearBtn = document.getElementById("nextYear");
    const cancelButton = document.getElementById("cancelButton");
    const applyButton = document.getElementById("applyButton");
    const monthpicker = document.getElementById("monthpicker");
    const monthpickerContainer = document.getElementById(
        "monthpicker-container"
    );
    const toggleMonthpicker = document.getElementById("toggleMonthpicker");

    let selectedYear = new Date().getFullYear();
    let selectedMonthIndex = null;

    function renderYear() {
        currentYearEl.textContent = selectedYear;
    }

    function renderMonths() {
        monthsContainer.innerHTML = "";
        months.forEach((month, index) => {
            const btn = document.createElement("button");
            btn.type = "button";
            btn.className =
                "py-2 rounded text-center text-gray-700 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition select-none";
            btn.textContent = month.short;
            btn.setAttribute("aria-label", month.full);
            btn.dataset.monthIndex = index;

            if (selectedMonthIndex === index) {
                btn.classList.add("bg-blue-600", "text-white", "font-semibold");
            }

            btn.addEventListener("click", () => {
                selectedMonthIndex = index;
                applyButton.disabled = false;
                renderMonths();
            });

            monthsContainer.appendChild(btn);
        });
    }

    monthpicker.addEventListener("click", function () {
        monthpickerContainer.classList.toggle("hidden");
        renderMonths();
    });

    toggleMonthpicker.addEventListener("click", function () {
        monthpickerContainer.classList.toggle("hidden");
    });

    prevYearBtn.addEventListener("click", () => {
        selectedYear--;
        renderYear();
    });

    nextYearBtn.addEventListener("click", () => {
        selectedYear++;
        renderYear();
    });

    cancelButton.addEventListener("click", () => {
        selectedMonthIndex = null;
        applyButton.disabled = true;
        renderMonths();
    });

    applyButton.addEventListener("click", () => {
        if (selectedMonthIndex !== null) {
            alert(
                `Selected Month: ${months[selectedMonthIndex].full} ${selectedYear}`
            );
        }
    });

    // Initial render
    renderYear();
    renderMonths();

    
})();
