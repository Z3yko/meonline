<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

                <div class="relative z-3052">
                    @include('layouts.navigation')
                </div>


            <!-- Page Heading -->


            <!-- Page Content -->
            <main class="relative z-20">
                {{ $slot }}
            </main>
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" defer />
        <script src="/js/app.js"></script>
    </body>
</html>
