<div>
    <x-slot:title>
        Dashboard
        </x-slot>

        <div class="container my-4 ">
            <div class="row flex justify-content-center">
                <div class="col-xl-4 my-3 col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h4>Candidates</h4>
                            <span>{{ $totalCandidates }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 my-3 col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h4>Voter</h4>
                            <span>{{ $totalVoter }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4  col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h4>Votes</h4>
                            <span>{{ $totalVotes }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 my-3 col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h4>Not Voted</h4>
                            <span>{{ count($notVotedUser) }}</span>
                            ~
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
