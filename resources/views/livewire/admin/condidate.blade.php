<div>
    <x-slot:title>
        Position
        </x-slot>
        <div class="container">
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ __('Candidates ') }}({{ $total }})</h4>
                        <button wire:click='showForm' class="btn btn-primary">New</button>
                    </div>
                    <a href="{{ route('result') }}"><button type="button" class="btn btn-primary">Print Result</button></a>

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
                                <th>Fullname</th>
                                <th>Call Sign</th>
                                <th>Email</th>
                                <th>Votes</th>
                                <th>Position</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($candidates) > 0)
                                @foreach ($candidates as $candidate)
                                    <tr>
                                        <td>{{ $candidate->fname }}</td>
                                        <td>{{ $candidate->lname }}</td>
                                        <td>{{ $candidate->email }}</td>
                                        <td>{{ $candidate->points }}</td>
                                        <td>{{ $candidate->positions->positions }}</td>
                                        <td><img src="{{ asset('storage') }}/{{ $candidate->image }}"
                                                style="width:70px;height:70px;" alt=""></td>
                                        <td><button wire:click="edit({{ $candidate->id }})" class="btn btn-success">Edit</button></td>
                                        <td><button class="btn btn-danger" wire:click.prevent='delete({{ $candidate->id }})'>Delete</button></td>
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

                    <form wire:submit.prevent='store'>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Fullname:</label>
                            <input type="text" wire:model.lazy="fname" class="form-control"
                                placeholder="Enter Fullname">
                            @error('fname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Call Sign:</label>
                            <input type="text" wire:model.lazy="lname" class="form-control"
                                placeholder="Enter Call Sign">
                            @error('lname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Positions:</label>
                            <select wire:model.lazy='pos_id' class="form-control">
                                <option selected>Select the position</option>

                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->positions }}</option>
                                @endforeach
                            </select>
                            @error('pos_id')
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
                            <label for="pwd" class="form-label">Image:</label>
                            <input type="file" wire:model="image" class="form-control" placeholder="Enter Image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" style="width:70px;height:70px;" alt="">
                            @endif

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            @endif
            @if ($showUpdate == true)
                <div class="my-2">
                    <button class="btn btn-secondary my-2" wire:click='goBack'>Go Back</button>

                    <form wire:submit.prevent='update({{ $candidate_id }})'>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Fullname:</label>
                            <input type="text" wire:model.lazy="edit_fname" class="form-control"
                                placeholder="Enter Fullname">
                            @error('edit_fname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Call Sign:</label>
                            <input type="text" wire:model.lazy="edit_lname" class="form-control"
                                placeholder="Enter Call Sign">
                            @error('edit_lname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Positions:</label>
                            <select wire:model.lazy='edit_pos_id' class="form-control">
                                <option selected>Select the position</option>

                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->positions }}</option>
                                @endforeach
                            </select>
                            @error('edit_pos_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Email:</label>
                            <input type="email" wire:model.lazy="edit_email" class="form-control" placeholder="Enter Email">
                            @error('edit_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Image:</label>
                            <input type="file" wire:model="new_image" class="form-control" placeholder="Enter Image">
                            @if ($new_image)
                                <img src="{{ $new_image->temporaryUrl() }}" style="width:70px;height:70px;" alt="">
                            @else
                                <img src="{{ asset('storage') }}/{{ $old_image }}"
                                    style="width:70px;height:70px;" alt="">
                            @endif
                            <input type="hidden" wire:model="old_image">

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            @endif
        </div>
</div>
