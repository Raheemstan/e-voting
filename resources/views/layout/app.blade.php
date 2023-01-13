<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NACOS Voting {{ $title }}</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @livewireStyles

</head>
<style>
    .bg-image {
        background: rgba(0, 0, 0, 0.5) url("{{ asset('images/bg.jpg') }}");
        background-blend-mode: darken;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 30vh;
    }

</style>

<body>
    <nav class="container-fluid bg-dark">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="nav-link text-white">Home</h3>
                <div class="d-flex text-white align-items-center">
                    @auth
                        <h5>{{ Auth::user()->name }}</h5>
                        @livewire('frontend.logout')
                    @endauth
                    @guest
                        <a href="{{ route('front.login') }}" class="nav-link text-white">Login</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <!-- hero section -->
    <div class="container-fluid bg-image">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center flex-col" style="height:30vh;">
                <h1 class="text-white">{{ $image_title }}</h1> <br>
            <!-- </div>
            @auth
                <h4>Total Votes : {{ Auth::user()->vote_limit }}</h4>

            @endauth -->

        </div>
    </div>

    {{ $slot }}
    <!-- Latest compiled JavaScript -->
    <script src=" {{ asset('js/bootstrap.min.css') }}">
    </script>

    @livewireScripts
</body>

</html>
