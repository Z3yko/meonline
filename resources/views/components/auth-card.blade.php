<div class="min-h-screen sm:w-2/3 md:w-1/2 md:mt-64 mx-auto shadow-xl rounded-md flex flex-col sm:justify-center items-center pt-6 mt-16 sm:pt-0 bg-white">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-lg p-6">
        {{ $slot }}
    </div>
</div>
