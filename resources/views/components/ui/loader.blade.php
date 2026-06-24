  <!-- Loading Overlay -->
    <div class="loader-overlay fixed inset-0 bg-white flex justify-center items-center z-[9999] transition-opacity duration-500">
        <div class="text-center w-full max-w-xs p-5">
            <div class="mb-5 flex justify-center loader-logo">
                <img src="{{ asset('logo.jpeg') }}" class="h-16 w-auto object-contain n" alt="Logo" />
            </div>
            <div class="w-full h-1 bg-gray-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-primary-red to-primary-blue loader-progress"></div>
            </div>
        </div>
    </div>