<x-app-layout>
    <header class="border-mygreenDark border-b-3 shadow-md border-t-1 border-opacity-30 z-40 relative">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 sm:text-lg md:text-2xl font-bold text-gray-600 ml-5">
            <h1 class=" text-mygreenSDark font-bold md:ml-10 lg:ml-20"
        >Dear {{$user['user']->name}}, Welcome to your space</h1>
        </div>
    </header>

<div id="app">
    <div class="mx-auto  md:mt-10 p-0 shadow-2xl relative z-10 md:w-3/4 overflow-hidden">

        <div class="min-h-400 bg-mygreen md:transform md:-rotate-6 md:scale-200 relative w-screen bottom-64 md:bottom-80 lg:bottom-72 z-0 overflow-hidden"></div>

        <div class="">
            <user-image
            vsrc="{{asset('storage/'.$user['info']->img)}}"
            vclass=" w-52 md:w-80 mx-auto rounded-full shadow-2xl overflow-hidden relative"
            user-avatar="{{asset('storage/avatars/user.png')}}"
            />
        </div>

        <div class="bg-white border-mygreenDark border-t-3 -mt-72 md:-mt-48">
            <info-form
            name='{{$user['info']->d_name}}'
            contact-email="{{$user['contact']->c_email}}"
            bio="{{$user['info']->bio}}"
            location="{{$user['info']->location}}"
            phone="{{$user['contact']->phone}}"
            social="{{json_encode($user['contact']->social)}}"
            websites="{{json_encode($user['contact']->website)}}"
            ><info-form/>
        </div>




    </div>
</div>

</x-app-layout>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" defer>

