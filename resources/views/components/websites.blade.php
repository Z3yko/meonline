<a href="{{$link}}">
    <div {{$attributes->merge(['class' => "group flex my-3 py-1 justify-between shadow-md items-center content-center py-2 transform duration-300 relative bg-white "])}}>
        <div class=" text-gray-400 font-bold group-hover:text-mygreenDark text-xl pl-6 ">
            <i class="fas fa-link pr-3 text-2xl "></i> {{$name}}
        </div>
        <i class="fas fa-angle-right text-gray-400 group-hover:text-mygreenDark pr-6 group-hover:cruiser-pointer  text-4xl"></i>
    </div>
</a>