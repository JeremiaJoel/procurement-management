<div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
    <div class="relative">
        <div class="h-24 w-24 rounded-full border-t-8 border-b-8 border-gray-200"></div>
        <div class="absolute top-0 left-0 h-24 w-24 rounded-full border-t-8 border-b-8 border-blue-500 animate-spin">
        </div>
    </div>
</div>

<style>
    #loader {
        transition: opacity 0.5s ease;
    }

    #loader.fade-out {
        opacity: 0;
        pointer-events: none;
    }
</style>

<script>
    window.addEventListener("load", function() {
        const loader = document.getElementById("loader");

        setTimeout(() => {
            loader.classList.add("fade-out");
            setTimeout(() => {
                loader.style.display = "none";
            }, 500);
        }, 100);
    });
</script>
