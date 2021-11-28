<x-app-layout>
    <div id="app">
        <cardmaker
            username="{{$username}}"
            bio="{{$bio}}"
            email="{{$email}}"
            phone="{{$phone}}"
            image="storage/{{$image}}"
            d_name="{{$d_name}}"
        ></cardmaker>
    </div>
</x-app-layout>
