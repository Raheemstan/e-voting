<div>
    <x-slot:title>
        Voter
        </x-slot>
        <div class="container">
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ __('Voters ') }}({{ $total }})</h4>
                        <button wire:click='showForm' class="btn btn-primary">New</button>
                        <button wire:click='groupUpload' class="btn btn-primary">Group Upload</button>
                    </div>
                </div>
            </div>
            @if ($showTable == true)
                <input type="text" wire:model="search" class="form-control" placeholder="Search Here...">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="table-responsive my-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Matric_no</th>
                                <th>voted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($voters) > 0)
                                @foreach ($voters as $voter)
                                    <tr>
                                        <td>{{ $voter->email }}</td>
                                        <td>{{ $voter->vote_id }}</td>
                                        <td>{{ $voter->voted == 0 ? 'Not Voted' : 'Voted' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <h4>Record Not Found</h4>
                            @endif

                        </tbody>
                    </table>
                </div>
            @endif
            @if ($showCreate == true)
                <div class="my-2">
                    <button class="btn btn-secondary my-2" wire:click='goBack'>Go Back</button>

                    <form wire:submit.prevent='create'>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Name:</label>
                            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="pwd" class="form-label">Email:</label>
                            <input type="text" wire:model.lazy="email" class="form-control" placeholder="Enter Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Matric_no:</label>
                            <input type="text" wire:model.lazy="password" class="form-control"
                                placeholder="Enter Matric Number">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            @endif
            @if ($groupUpload == true)
                <div class="my-2">
                    <button class="btn btn-secondary my-2" wire:click='goBack'>Go Back</button>

                    <form method="post" action="{{ route('admin.votersUpload') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                            <label for="pwd" class="form-label">Upload CSV file:</label>
                            <input type="file" name="file" class="form-control" placeholder="Enter CSV file">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            @endif
            @if ($showUpdate == true)
                <div class="my-2">
                    <button class="btn btn-secondary my-2" wire:click='goBack'>Go Back</button>

                    <form wire:submit.prevent='update({{ $voter_id }})'>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Name:</label>
                            <input type="text" wire:model.lazy="edit_name" class="form-control" placeholder="Enter Name">
                            @error('edit_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="pwd" class="form-label">Email:</label>
                            <input type="text" wire:model.lazy="edit_email" class="form-control" placeholder="Enter Email">
                            @error('edit_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            @endif
        </div>
</div>
