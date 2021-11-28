<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('landing/css/style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/brands.min.css



">
		<script src="{{asset('landing/js/main.min.js')}}"></script>
<style>
	*{
		box-sizing: border-box;
	}
	body::after {
  content: '';
  display: block;
  height: 50px; /* Set same as footer's height */
}

	#footer{
		position: absolute;
        bottom: 0;
        width: 100%;
        height: 50px;
		text-decoration: none;
	}
	body{
		min-height:100vh;
		margin:0;
		width: 100%;
		background-image: url("{{Storage::url('landing/bg.jpg')}}");
		background-size:cover;
		top: 0;
		background-attachment: fixed;
		position: relative;

    }
</style>
    </head>
    <body>

	    	<div class="flex z-50 items-center justify-between w-82 md:w-full  py-0 sm:mx-auto bg-white md:py-0 border-b-3 border-mygreenSDark sticky top-0">
				<a href="/">
	    		<img src="{{Storage::url('logo.png')}}" class="w-40 md:w-52 p-2 " alt="">
                </a>
                <div class="flex items-center justify-between">
                    <a href="https://github.com/Z3yko/meonline" class="mr-8 text-4xl">
                        <i class="fab fa-github text-decoration-none no-underline not-italic "></i>
                    </a>
                    <a href="/login" class="mr-8">
                        <input type="button" class="button is-primary sm:is-small md:is-normal" value="Login">
                    </a>
                </div>

            </div>

	    	<div class="grid sm:grid-cols-1 md:grid-cols-2">

                <div class="md:w-full grid col-1 mx-auto h-52 text-mygreenDark font-bold pt-6 sm:mt-7 md:mt-96">
                    <h1 class="mx-auto text-center text-white text-4xl md:text-6xl xl:text-7xl font-light ">
                        Your <span class="text-mygreenLight font-weight-bolder">Digital </span>Profile
                    </h1>
                    <div class=" flex justify-center font-normal sm:items-center md:items-baseline mt-5">
                    <a href="/register"><input type="button" class="button is-primary mr-3" value="Create"></a>
                    <div class="text-3xl md:text-4xl relative top-0 md:top-4 md:pl-2 text-white"> Yours for FREE</div>
                    </div>
                </div>


	    		<div class="sm:w-full sm:flex sm:justify-center md:w-2/3 mx-auto sm:col-start-1 md:col-start-2 md:col-end-2 pt-4 sm:mt-20 md:mt-28">
	    			<img src="{{Storage::url('landing/phone.png')}}" class="sm:w-40 md:w-full" alt="">
	    		</div>



	    	</div>

		<div id="footer" class="text-sm font-bold w-full bg-white">
			<h2  class="mx-auto text-center font-bold text-blue-700">Made with <span class="text-red-500 text-2xl relative top-1">&hearts;</span> by  <span> <a href="{{App\Models\User::find(1)->name}}"> Abdurhman</a></span> </h2>
            <h3 class="mx-auto text-center font-bold text-blue-700 pb-2">Found an issue ? <a href="mailto:daa7im5@gmail.com"> Email me</a></h3>
		</div>
	</body>
</html>
