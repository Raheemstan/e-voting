<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NACOS Voting / Result</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @livewireStyles

</head>
<style>
    @media print{
        .btn{display:none;}
    }

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
        <!-- hero section -->
        <div class="container-fluid bg-image">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center flex-col" style="height:30vh;">
                <h1 class="text-white">Final Result NACOS {{ date('Y') }}</h1> <br>
            <!-- </div>
            @auth
                <h4>Total Votes : {{ Auth::user()->vote_limit }}</h4>

            @endauth -->

        </div>
    </div>
        <x-slot:image_title>
            </x-slot>
            <div class="my-5">
                <div class="container my-4">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                                @foreach($posts as $post)
                                <thead>
                                    <tr>
                                        <th> {{ $post->positions }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Candidate Name</th>
                                        <th class="text-center">Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <fieldset id="{{ $post->positions }}">
                                    @foreach($candidates as $candidate)
                                    @if($post->id == $candidate->pos_id)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle"><img
                                                    src="{{ asset('storage') }}/{{ $candidate->image }}" alt=""
                                                    style="width:100px;height:100px;">
                                            </td>   
                                            <td class="text-center" style="vertical-align: middle">
                                                {{ $candidate->fname }} ({{ $candidate->lname }})
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                {{ $candidate->points }}
                                            </td>
                                        </tr>
                                        @else
                                        @continue
                                        @endif
                                        @endforeach
                                    </fieldset>
                                </tbody>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <button type="button" onclick="window.print();" class="btn btn-primary">Print</button>
                                        </td>
                                    </tr>
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
</div>
 <!-- Latest compiled JavaScript -->
 <script src=" {{ asset('js/bootstrap.min.css') }}">
    </script>

    @livewireScripts
</body>

</html>
