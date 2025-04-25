<!-- ====== Datepicker Section Start -->
<section>
    <div class="flex items-center w-full">
        <div class="w-full">
            <div class="mb-[15px]">
                <label for="" class="mb-[15px] block text-base font-medium text-black dark:text-white">
                    Pilih Bulan:
                </label>

                <div class="relative">
                    <!-- Datepicker Input with Icons -->
                    <div class="relative flex w-full items-center">
                        <span class="absolute left-0 pl-5 text-black">
                            <!-- Calendar Icon -->
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.5 3.3125H15.8125V2.625C15.8125 2.25 15.5 1.90625 15.0937 1.90625C14.6875 1.90625 14.375 2.21875 14.375 2.625V3.28125H5.59375V2.625C5.59375 2.25 5.28125 1.90625 4.875 1.90625C4.46875 1.90625 4.15625 2.21875 4.15625 2.625V3.28125H2.5C1.4375 3.28125 0.53125 4.15625 0.53125 5.25V16.125C0.53125 17.1875 1.40625 18.0937 2.5 18.0937H17.5C18.5625 18.0937 19.4687 17.2187 19.4687 16.125V5.25C19.4687 4.1875 18.5625 3.3125 17.5 3.3125ZM2.5 4.71875H4.1875V5.34375C4.1875 5.71875 4.5 6.0625 4.90625 6.0625C5.3125 6.0625 5.625 5.75 5.625 5.34375V4.71875H14.4687V5.34375C14.4687 5.71875 14.7812 6.0625 15.1875 6.0625C15.5937 6.0625 15.9062 5.75 15.9062 5.34375V4.71875H17.5C17.8125 4.71875 18.0625 4.96875 18.0625 5.28125V7.34375H1.96875V5.28125C1.96875 4.9375 2.1875 4.71875 2.5 4.71875ZM17.5 16.6562H2.5C2.1875 16.6562 1.9375 16.4062 1.9375 16.0937V8.71875H18.0312V16.125C18.0625 16.4375 17.8125 16.6562 17.5 16.6562Z"
                                    fill="" />
                            </svg>
                        </span>

                        <input id="monthpicker" name="bulan" type="text"
                            class="w-full bg-transparent pl-[50px] pr-8 py-2.5 border rounded-lg text-black outline-none transition 
           focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:focus:border-blue-300"
                            placeholder="Pilih Bulan" readonly>


                        <span class="absolute right-0 pr-4 text-dark-5 cursor-pointer" id="toggleMonthpicker">
                            <!-- Arrow Down Icon -->
                            <svg class="fill-current stroke-current" width="16" height="16" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.29635 5.15354L2.29632 5.15357L2.30055 5.1577L7.65055 10.3827L8.00157 10.7255L8.35095 10.381L13.701 5.10603L13.701 5.10604L13.7035 5.10354C13.722 5.08499 13.7385 5.08124 13.7499 5.08124C13.7613 5.08124 13.7778 5.08499 13.7963 5.10354C13.8149 5.12209 13.8187 5.13859 13.8187 5.14999C13.8187 5.1612 13.815 5.17734 13.7973 5.19552L8.04946 10.8433L8.04945 10.8433L8.04635 10.8464C8.01594 10.8768 7.99586 10.8921 7.98509 10.8992C7.97746 10.8983 7.97257 10.8968 7.96852 10.8952C7.96226 10.8929 7.94944 10.887 7.92872 10.8721L2.20253 5.2455C2.18478 5.22733 2.18115 5.2112 2.18115 5.19999C2.18115 5.18859 2.18491 5.17209 2.20346 5.15354C2.222 5.13499 2.2385 5.13124 2.2499 5.13124C2.2613 5.13124 2.2778 5.13499 2.29635 5.15354Z"
                                    fill="" stroke="" />
                            </svg>
                        </span>
                    </div>
                    <!-- Monthpicker Container -->

                    <body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">
                        <div id="monthpicker-container"
                            class="absolute left-1/2 top-full mt-2 -translate-x-1/2 bg-white border border-stroke rounded-lg shadow-datepicker pt-3 w-[320px] text-sm z-10 hidden">
                            <!-- Header: Navigation -->
                            <div class="flex items-center justify-between px-4">
                                <button type="button" id="prevYear"
                                    class="px-2 py-1 text-gray-700 hover:bg-gray-200 rounded">
                                    <svg class="fill-current" width="16" height="16" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.5312 17.9062C13.3437 17.9062 13.1562 17.8438 13.0312 17.6875L5.96875 10.5C5.6875 10.2187 5.6875 9.78125 5.96875 9.5L13.0312 2.3125C13.3125 2.03125 13.75 2.03125 14.0312 2.3125C14.3125 2.59375 14.3125 3.03125 14.0312 3.3125L7.46875 10L14.0625 16.6875C14.3438 16.9688 14.3438 17.4062 14.0625 17.6875C13.875 17.8125 13.7187 17.9062 13.5312 17.9062Z" />
                                    </svg>
                                </button>
                                <div id="currentYear" class="text-base font-medium text-gray-700 select-none"></div>
                                <button type="button" id="nextYear"
                                    class="px-2 py-1 text-gray-700 hover:bg-gray-200 rounded">
                                    <svg class="fill-current" width="16" height="16" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.46875 17.9063C6.28125 17.9063 6.125 17.8438 5.96875 17.7188C5.6875 17.4375 5.6875 17 5.96875 16.7188L12.5312 10L5.96875 3.3125C5.6875 3.03125 5.6875 2.59375 5.96875 2.3125C6.25 2.03125 6.6875 2.03125 6.96875 2.3125L14.0313 9.5C14.3125 9.78125 14.3125 10.2187 14.0313 10.5L6.96875 17.6875C6.84375 17.8125 6.65625 17.9063 6.46875 17.9063Z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Months Grid -->
                            <div id="months-container" class="grid grid-cols-3 gap-3 mt-4 px-6 pb-4">
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end mt-3 space-x-2 p-3 border-t border-stroke">
                                <button type="button" id="cancelButton"
                                    class="px-3 py-1.5 text-sm text-blue-600 rounded border border-blue-600 hover:bg-blue-100">Cancel</button>
                                <button type="button" id="applyButton"
                                    class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50"
                                    disabled>Apply</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
