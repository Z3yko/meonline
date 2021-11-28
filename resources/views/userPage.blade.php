
<x-app-layout>

    <div class="md:min-h-400 bg-mygreenSLight transform -rotate-6 scale-150 relative bottom-44 lg:bottom-44 z-0 w-full overflow-hidden"></div>
    <div id="app" class=" mx-auto md:w-3/4 md:max-w-700 md:-mt-60 z-10 relative">
        <div class=" md:shadow-lg pb-3">
            <div class="container bg-white mx-auto h-72" >
                <div class="mx-auto max-h-50 bg-mygreenMain md:bg-none min-h-150 " ></div>
                <img src="{{!empty($user['info']->img) ? Storage::url($user['info']->img)  : Storage::url('avatars/user.png')}}" alt="" width="200"  class="relative bottom-20 mx-auto rounded-full border-4 border-mygreenDark shadow-2xl overflow-hidden">
            </div>
            <div class="bg-white">
            <div class="m-auto px-3 pb-1 text-center text-mygreenSDark text-xl font-bold">{{$user['info']->d_name}}</div>

            <div class="flex justify-center text-sm text-mygreenSDark  font-normal">
                <div class="w-auto bg-gray-100 inline-block rounded-full px-2 py-0.5 "><i class="fa fa-map-marker" aria-hidden="true"></i> {{$user['info']->location}}</div>
            </div>

            <div class="flex space-x-1 justify-center p-3  ma">
                <x-small-button inner="Email" prefix="mailto:" :uri="$user['contact']->c_email"/>
                <x-small-button inner="Call" prefix="tel:" :uri="$user['contact']->phone"/>
            </div>

            <div class="mx-auto px-3 pt-1 pb-10 w-3/4 text-center text-sm break-words text-mygreenSDark font-normal">{{$user['info']->bio}}</div>
            <div class="flex justify-center">

                @foreach ($user['contact']->social as $app => $link)
                    @switch($app)
                        @case('Twitter')
                        <x-social class=" fab fa-twitter text-blue-400" :link="$link"/>
                            @break
                        @case('Youtube')
                        <x-social class=" fab fa-youtube text-red-500" :link="$link"/>
                            @break
                        @case('Facebook')
                        <x-social class=" fab fa-facebook text-blue-700" :link="$link"/>
                            @break
                            @case('Tiktok')
                            <x-social class=" fab fa-tiktok text-black" :link="$link"/>
                            @break
                            @case('LinkedIn')
                        <x-social class=" fab fa-linkedin text-blue-500" :link="$link"/>
                            @break
                            @case('Instagram')
                            <x-social class=" fab fa-instagram bg-clip-text text-transparent bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600" :link="$link"/>
                        @break
                        @case('Github')
                        <x-social class=" fab fa-github text-black" :link="$link"/>
                            @break
                            @case('Snapchat')
                            <x-social class=" fab fa-snapchat text-yellow-400" :link="$link"/>
                        @break
                        @case('Discord')
                        <x-social class=" fab fa-discord text-indigo-800" :link="$link"/>
                            @break
                            @case('Twitch')
                        <x-social class=" fab fa-twitch text-indigo-400" :link="$link"/>
                            @break
                            @case('Whatsapp')
                            <x-social class=" fab fa-whatsapp text-green-600" :link="$link"/>
                                @break
                        @default

                    @endswitch
                @endforeach
            </div>
        </div>
        </div>
            <div class="mt-4">
            @foreach ($user['contact']->website as $name => $link)
                <x-websites :link="$link" :name="$name"/>
            @endforeach


{{-- $user['contact']->social['youtube'] --}}



        </div>
    </div>
</x-app-layout>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" defer>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
