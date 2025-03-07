<div>
    <x-slot:title>
        Home
        </x-slot>
        <x-slot:image_title>
            Election 2022
            </x-slot>
            <div class="my-5">
                <h1 class="text-center">Time to Decide</h1>
                <div class="container my-4">
                    <div class="table-responsive">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <form action="{{ route('newVote') }}" method="post">
                                @CSRF
                                @foreach($posts as $post)
                                <thead>
                                    <tr>
                                        <th> {{ $post->positions }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Candidate Name</th>
                                        <th class="text-center">Vote</th>
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
                                                {{ $candidate->fname }} {{ $candidate->lname }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <input type="radio" required name="candidates[{{ $candidate->positions->id }}]" id="{{ $candidate->positions->positions}}" value="{{ $candidate->id }}">
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
                                            <button type="submit" class="btn btn-primary">Submit Votes</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
</div>
